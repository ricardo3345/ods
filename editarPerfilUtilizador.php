<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>OUR DISCUSSION SPOT</title>
    <link rel="stylesheet" href="ods.css">
</head>

<body class="bodyutilizador">

    <header class="header">
        <img class="logo" src="img/ods-high-resolution-logo-white-on-transparent-background.png" alt="Logo Site">
        <h1>OUR DISCUSSION SPOT</h1>
    </header>


    <?php
        require 'conexao.php';
        session_start();
        $id = $_SESSION['id'];
        $sqlPerfil = "SELECT * FROM login WHERE ID = $id";
        $sqlPerfil_query = $conn->query($sqlPerfil);
        $nome;

        if($sqlPerfil_query == true){
            $result = $sqlPerfil_query->fetch_assoc();
            $nome = $result['Nome'];
            $cidade = $result['Cidade'];
            $descricao = $result['Descricao'];
        }

        echo "<div class='perfil'>";
        echo "<h1>O Teu Perfil!</h1>";
        echo "<p><b>Nome: </b>" . $nome . "</p>";
        echo "<p><b>Cidade: </b>" . $cidade . "</p>";
        echo "<p><b>Descrição </b>" . $descricao . "</p>";
        echo "</div>";
    ?>

        <a href="paginaInicial.php" class="butaoPerfilVoltar">Confirmar Edição</a>

    <footer class="footer">
        Our Discussion Spot © | Ricardo Ferreira | 2023.
    </footer>

</body>

</html>