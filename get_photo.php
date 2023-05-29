<?php 
// require_once 'auth.php';
// if (!checkAuth()) exit;

photo();

function photo(){
    // $error=array(); 
    $api_keyPB = '35563072-13a0b8de05901b512d78537d1';
    $keyword = $_GET['keyword']; // (pistacchio)Parola chiave per le immagini
    $per_page = 9; // Numero di immagini da ottenere per pagina
    $category="nature";
    
     
    $url = "https://pixabay.com/api/?key=" .$api_keyPB. "&q=" .urlencode($keyword)."&category=".$category."&per_page=".$per_page;

     $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        $error = 'Errore nella richiesta API: ' . curl_error($curl);
        return false;
    }

    curl_close($curl);
    // echo ("AAAAAA: " .$response);
    $responseData = json_decode($response, true);
    // echo("HO TROVATO: " .$responseData);
    
    $photos=$responseData['hits'];
    
    // Estrai le ricette dalla risposta
    // Restituisci i dati come JSON
    header('Content-Type: application/json');
    echo json_encode($photos);
}


?>