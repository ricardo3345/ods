<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "conexao.php";

    if(!isset($_SESSION['id'])){
        session_start();
    }

    $id = $_SESSION['id'];
    $sqlAutor = "SELECT Nome from login where ID = $id";
    $sqlAutor_query = $conn->query($sqlAutor);

    if($sqlAutor_query == true){
        $linhasAutor = $sqlAutor_query->fetch_assoc();
        $autor = $linhasAutor['Nome'];
    }

    $titulo = $_POST['titulo'];
    $tema = $_POST['tema'];
    $corpoPost = $_POST['corpo'];
    $temaPost;

    if ($tema == "Tema1") {
        $temaPost = "Desporto";
    } else if ($tema == "Tema2") {
        $temaPost = "Tecnologia";
    } else if ($tema == "Tema3") {
        $temaPost = "Video Jogos";
    } else if ($tema == "Tema4") {
        $temaPost = "Culinária";
    } else if ($tema == "Tema5") {
        $temaPost = "Música";
    } else if ($tema == "Tema6") {
        $temaPost = "Viagens";
    } else if ($tema == "Tema7") {
        $temaPost = "Documentários, Filmes, Séries";
    } else if ($tema == "Tema8") {
        $temaPost = "Literatura";
    } else if ($tema == "Tema9") {
        $temaPost = "Meio Ambiente";
    } else if ($tema == "Tema10") {
        $temaPost = "Bem Estar";
    } else if ($tema == "Tema11") {
        $temaPost = "Politica";
    } else if ($tema == "Tema12") {
        $temaPost = "Outro";
    }

    $sql = "INSERT INTO post (Titulo_post, Nome_Autor, Assunto, Texto_Post) VALUES ('$titulo', '$autor','$temaPost','$corpoPost')";
    if ($conn->query($sql) == true) {
        header("Location: paginaInicial.php");
        exit;
    } else {
        echo "<p style='color: red'>Error:</p> " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
