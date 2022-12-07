#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include "DHT.h"
WiFiClient wifiClient;
#define DHTPIN D4
#define waterPump D3
#define DHTTYPE DHT22   // DHT 22  (AM2302), AM2321
#include <ArduinoJson.h>
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
const char* host = "192.168.43.147";
//const String laravelPath = "http://192.168.43.147/";


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
  
  // Reading temperature or humidity takes about 250 milliseconds!
  // Sensor readings may also be up to 2 seconds 'old' (its a very slow sensor)
  float h = dht.readHumidity();
  // Read temperature as Celsius (the default)
  float t = dht.readTemperature();
  // Read temperature as Fahrenheit (isFahrenheit = true)
  nilai_analog_ph = analogRead(ph_pin);
  tegangan_ph = 3.3 / 1024.0 * nilai_analog_ph;

  ph_step = (ph4 - ph7) / 3;
  po = 7.00 + ((ph7 - tegangan_ph) / ph_step);
//  
Serial.println("Suhu " + String(t) );
Serial.println("Kelembaban " + String(h) );
Serial.println("Nilai PH " + String(po) );

WiFiClient client;
const int httpport = 80;
if( !client.connect(host,httpport)){
  Serial.println("Koneksi Gagal Boss");
  return;

}
String Link;
HTTPClient http;


Link = "http://" + String(host) + "/monitoring-hidroponik/public/api/terimadata/" + String(t) + "/" + String(h) + "/" + String(po);
http.begin(wifiClient, Link);
http.GET();

String respon = http.getString();
Serial.println(respon);
http.end();
//delay(2500);

String LinkWaterPump;
HTTPClient httpWaterPump;

LinkWaterPump = "http://" + String(host) + "/monitoring-hidroponik/public/api/switcher";
httpWaterPump.begin(wifiClient, LinkWaterPump);
httpWaterPump.GET();

DynamicJsonDocument doc(1024);
String payload = httpWaterPump.getString();
Serial.println(payload);
deserializeJson(doc, payload);

JsonObject obj = doc.as<JsonObject>();
int sts = obj["waterpump"];
Serial.println(sts);

http.end();
//delay(1000);

  if(sts == 1){
    Serial.print("waterpump on");
    digitalWrite(waterPump, HIGH);
  } else{
    Serial.print("waterpump off");
    digitalWrite(waterPump, LOW);
  }  
}
