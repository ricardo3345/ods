<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "conexao.php"; 

    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM login WHERE Email = '$email'";
    $sqlquery = $conn->query($sql);

    if ($sqlquery == true) {
        if ($sqlquery->num_rows == 1) {
            $row = $sqlquery->fetch_assoc();    
            $passwordBD = $row['Password'];

            if ($password === $passwordBD) {
                session_start();
                $_SESSION['id'] = $row['ID'];
                header("Location: /paginaInicial.php");
            } else {
                echo "Password Incorreta.";
            }
        } else {
            echo "Email não encontrado.";
        }
    } else {
        echo "<p style='color: red'>Error:</p> " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>