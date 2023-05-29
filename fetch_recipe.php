<?php


header('Content-Type: application/json');

saveRecipe();

function saveRecipe(){
    $conn = mysqli_connect($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['name']);
    $userid = mysqli_real_escape_string($conn, $userid);
    $query = "SELECT * FROM users WHERE id = $userid";
    $res_1 = mysqli_query($conn, $query);
    $userinfo = mysqli_fetch_assoc($res_1);   

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);
    $ingredienti = mysqli_real_escape_string($conn, $_POST['ingredienti']);

     # check if song is already present for user
     $query2 = "SELECT * FROM recipe WHERE user = '$userid' AND recipe_id = '$id'";
     $res = mysqli_query($conn, $query2) or die(mysqli_error($conn));
     # if song is already present, do nothing
     if(mysqli_num_rows($res) > 0) {
         echo json_encode(array('ok' => true));
         exit;
     }

     $query = "INSERT INTO recipe(user, recipe_id, content) VALUES('$userid','$id', JSON_OBJECT('id', '$id', 'title', '$title', 'image', '$image', 'ingredienti, '$ingredienti))";
     error_log($query);
     # Se corretta, ritorna un JSON con {ok: true}
     if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {
         echo json_encode(array('ok' => true));
         exit;
     }

     
     mysqli_close($conn);
     echo json_encode(array('ok' => false));
}
?>

