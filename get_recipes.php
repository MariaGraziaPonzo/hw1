<?php


ricette();

function ricette(){
$apiKey = 'f9bafba7374f557d2a868d7d16982d34';
$api_id = '7a639f7f';
$ingredient = $_GET['ingredient'];

$url = "https://api.edamam.com/search?q=" . urlencode($ingredient) . "&app_id=" .$api_id. "&app_key=" .$apiKey;

// Effettua la richiesta all'API Edamam
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Decodifica la risposta JSON
$data = json_decode($response, true);

// Estrai le ricette dalla risposta
$recipes = $data['hits'];

// Restituisci le ricette come JSON
header('Content-Type: application/json');
echo json_encode($recipes);
}
?>