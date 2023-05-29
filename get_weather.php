<?php


weather();

function weather(){
  // Ottieni la posizione corrente dell'utente
  $locationKey = "215605"; //catania
  $apikey="tSgpD604FuWGVQ03gC5vYPVFAdRZpIRh";

  // Effettua una richiesta all'API per ottenere le informazioni sul meteo attuale
  $url = "http://dataservice.accuweather.com/currentconditions/v1/".$locationKey."?apikey=".$apikey."&language=it&details=true";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  curl_close($ch);
  // echo("AAAA: " .$response);
  $data = json_decode($response, true);
  // echo("HO TROVATO:" .$data);
  $weatherData = [
    'HasPrecipitation' => $data[0]['HasPrecipitation'],
    'temperature' => $data[0]['Temperature']['Metric']['Value'],
    'weatherText' => $data[0]['WeatherText'],
    ];

  // Restituisci i dati come JSON
  header('Content-Type: application/json');
  echo json_encode($weatherData);
  }
?>