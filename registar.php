    <?php
require "conexao.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $sql = "INSERT INTO login (Nome, Password, Email) VALUES ('$name', '$password', '$email')";
    if($conn -> query($sql) === true ){
        header('Location: index.html');
        exit;
    } else {
        echo "<p style='color: red'>Erro.</p>" . $sql . "<br>" . $conn->error;
    }
    $conn -> close();
}
?>