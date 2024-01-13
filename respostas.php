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
        session_start();
        $idUser = $_SESSION['id'];

        $sql = "SELECT * FROM post WHERE ID_post = $id";
        $sql_query = $conn->query($sql);

        if ($sql_query !== false) {
            $linhas = $sql_query->fetch_assoc();
            $id = $linhas['ID_post'];
            $titulo = $linhas['Titulo_post'];
            $nomeAutorOriginal = $linhas['Nome_Autor']; // Armazene o nome original do autor

            $sqlR = "SELECT * FROM respostas WHERE ID_Post = $id";
            $sqlR_query = $conn->query($sqlR);

            $numRespostas = $sqlR_query->num_rows;

            echo "<div class='postVer'>";
            echo "<p name='1st'>" . $nomeAutorOriginal . " | " . $linhas['Assunto'] . " </p>";
            echo "<p>" . $titulo . "</p>";
            echo "<p>" . $linhas['Texto_Post'] . "</p>";
            echo "<hr>";
            echo "<p>Respostas:</p>";

            if ($numRespostas > 0) {
                while ($Respostas = $sqlR_query->fetch_assoc()) {
                    // Obtenha o nome do autor de cada resposta
                    $idAutorResposta = $Respostas['ID_Utilizador'];
                    $sqlNomeAutorResposta = "SELECT Nome FROM login WHERE ID = $idAutorResposta";
                    $sqlNomeAutorResposta_query = $conn->query($sqlNomeAutorResposta);

                    if ($sqlNomeAutorResposta_query !== false) {
                        $dadosAutorResposta = $sqlNomeAutorResposta_query->fetch_assoc();
                        $nomeAutorResposta = $dadosAutorResposta['Nome'];
                        $dataHoraResposta = $Respostas['Data_Hora_Resposta'];

                        echo "<p><strong>" . $nomeAutorResposta . ":</strong> " . $Respostas['Resposta'] . " | <span style='font-size: 12px; color: gray;'>  " . $dataHoraResposta . "</span></p>";
                    }
                }
            } else {
                echo "<p><strong>Ainda não há respostas para este post, seja o primeiro a comentar!</strong></p>";
            }

            echo "<form method='post' action=''>";
            echo "<input name='res' placeholder='Comentar'> </input>";
            echo "<button class='botaoComentar' type='submit'>Comentar</button>";
            echo "</form>";            

            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $resposta = $_POST['res'];
                date_default_timezone_set("Europe/Lisbon");
                $dataHoraAtual = date('d-m-Y H:i');
                $envio = "INSERT INTO respostas (ID_POST, ID_Utilizador, Resposta, Data_Hora_Resposta) VALUES ('$id', '$idUser', '$resposta', '$dataHoraAtual')";
                $envio_query = $conn->query($envio);
                if ($envio_query == true) {
                    header("Location: respostas.php?id=$id");
                    exit();
                }
            }
        }
        ?>
    </div>
                <a href="paginaInicial.php" class="botaoPerfilVoltar" style="width:493px; margin-left:10px; text-align:center;">Voltar Atrás</a>
    <footer class="footer">
        Our Discussion Spot © | Ricardo Ferreira | 2023
    </footer>

</body>

</html>
