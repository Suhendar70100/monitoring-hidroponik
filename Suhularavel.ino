#include <ArduinoJson.h>
#include <stdio.h>
#include <iostream>
#include <iomanip>
#include<bits/stdc++.h>
#include <ESP8266WiFi.h>
#include <WiFiClientSecure.h>
#include <ESP8266HTTPClient.h>
#include "DHT.h"
#include <math.h>
#include <cstring>
#include <typeinfo>
WiFiClient wifiClient;

#define DHTPIN D4
#define waterPump D3
#define DHTTYPE DHT22

//sensor ph
const int ph_pin = A0;
float po = 0;
float ph_step;
int nilai_analog_ph;
double tegangan_ph;
float ph4 = 3.3;
float ph7 = 2.8;

const char* ssid = "Galaxy A20s2840";
const char* pass = "badranaya";
String host = "https://vnvajtvlrwkttlydzoyy.supabase.co/rest/v1";
const char* fingerpr = "C6 82 33 E6 5C 46 AF 27 69 21 FD 90 87 E3 39 08 E6 0A 09 95";
String SUPABASE_KEY = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InZudmFqdHZscndrdHRseWR6b3l5Iiwicm9sZSI6ImFub24iLCJpYXQiOjE2NzA1NDY1MjAsImV4cCI6MTk4NjEyMjUyMH0.sDY3tvWM2hcGjzmBHkZSzqCCidrqXtyvK8faDxqw37M";
const int httpsPort = 443;

DHT dht(DHTPIN, DHTTYPE);

void setup() {
  pinMode(waterPump, OUTPUT);
  pinMode(ph_pin, INPUT);
  Serial.begin(115200);
  delay(1000);
  Serial.print("Connecting");

  dht.begin();
  WiFi.begin(ssid, pass);

  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    delay(500);
  }

  Serial.println("Conected");
}

void loop() {
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  nilai_analog_ph = analogRead(ph_pin);
  tegangan_ph = 3.3 / 1024.0 * nilai_analog_ph;
  ph_step = (ph4 - ph7) / 3;
  po = 7.00 + ((ph7 - tegangan_ph) / ph_step);

  WiFiClientSecure client;
  HTTPClient http;
  HTTPClient httpII;

  client.setInsecure();
  client.connect(host, httpsPort);

  http.begin(client, host + "/akuator?select=*&order=id.desc&id=eq.1&limit=1");
  http.addHeader("apikey", SUPABASE_KEY);
  http.addHeader("Authorization", SUPABASE_KEY);
  http.GET();
  
  String payload = http.getString();
  const size_t capacity = JSON_OBJECT_SIZE(3) + JSON_ARRAY_SIZE(2) + 60;
  DynamicJsonDocument doc(capacity);
  DeserializationError error = deserializeJson(doc, payload);
  if (error) {
    Serial.print(F("deserializeJson() failed: "));
    Serial.println(error.f_str());
    client.stop();
    return;
  }
  int waterpump = doc[0]["switch"].as<int>();
  Serial.println(payload);
  if(waterpump != 1){
    digitalWrite(waterPump, HIGH);
  } else{
    digitalWrite(waterPump, LOW);
  }
  http.end();

  httpII.begin(client, host + "/data");
  httpII.addHeader("apikey", SUPABASE_KEY);
  httpII.addHeader("Authorization", SUPABASE_KEY);
  httpII.addHeader("Content-Type", "application/json");
  StaticJsonDocument<200> buff;
  String jsonParams;

  buff["suhu"] = t;
  buff["kelembaban"] = h;
  buff["ph"] = po;
  serializeJson(buff, jsonParams);
  Serial.println(jsonParams);

  int httpCode = httpII.POST(jsonParams);
  
  httpII.end();
  delay(100);
}
