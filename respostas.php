<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>OUR DISCUSSION SPOT</title>
    <link rel="stylesheet" href="ods.css">
</head>

<body class="body">

    <header class="header">
        <img class="logo" src="img/ods-high-resolution-logo-white-on-transparent-background.png" alt="Logo Site">
        <h1>OUR DISCUSSION SPOT</h1>
    </header>
    <div class="areaPosts" style="margin-top: 150px;">
        <?php
        require 'conexao.php';

        $id = $_GET['id'];
        $sql = "SELECT * FROM post WHERE ID_post = $id";
        $sql_query = $conn->query($sql);

        if ($sql_query !== false) {
            $numLinhas = $sql_query->num_rows;
            while ($numLinhas > 0) {
                $linhas = $sql_query->fetch_assoc();
                $id = $linhas['ID_post'];
                $titulo = $linhas['Titulo_post'];
                $nomeAutor = $linhas['Nome_Autor'];
                $assunto = $linhas['Assunto'];
                $corpo = $linhas['Texto_Post'];

                $sqlR = "SELECT * FROM respostas WHERE ID_Post = $id";
                $sqlR_query = $conn->query($sqlR);

                $numRespostas = $sqlR_query->num_rows;

                echo "<div class='postVer'>";
                echo "<p name='1st'>" . $nomeAutor . " | " . $assunto . " </p>";
                echo "<p>" . $titulo . "</p>";
                echo "<p>" . $corpo . "</p>";
                echo "<hr>";
                echo "<p>Respostas:</p>";

                if ($numRespostas > 0) {
                    while ($Respostas = $sqlR_query->fetch_assoc()) {
                        echo "<p>" . $Respostas['Resposta'] . "</p>";
                    }
                } else {
                    echo "<p>Ainda não há respostas para este post, seja o primeiro a comentar!</p>";
                }

                echo "<form method='post' action=''>";
                echo "<input name='res' placeholder='Comentar'> </input>";
                echo "<button type='submit'>Comentar</button>";
                echo "</form>";
                echo "</div>";

                $numLinhas--;
            }

            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $resposta = $_POST['res'];
                $envio = "INSERT INTO respostas (ID_POST, Resposta) VALUES ('$id', '$resposta')";
                $envio_query = $conn->query($envio);
                if ($envio_query == true) {
                    header("Location: respostas.php?id=$id");
                    exit();
                }
            }
        }
        ?>

        <a href="paginaInicial.php" class="butaoPerfilVoltar">Página Inicial </a>
    </div>
    <footer class="footer">
        Our Discussion Spot © | Ricardo Ferreira | 2023.
    </footer>
</body>