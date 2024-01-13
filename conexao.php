<?php
    $username = 'RicardoPAF';
    $password = 'Ricardo2005';
    $servername = 'localhost';
    $db_name = 'ods';

    $conn = new mysqli($servername, $username, $password, $db_name);
    if($conn -> connect_error){
        die('Erro'.'<br>$conn->connect_error');
    }
?>
