<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>OUR DISCUSSION SPOT</title>
    <link rel="stylesheet" href="ods.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="body">

    <header class="header">
        <img class="logo" src="img/ods-high-resolution-logo-white-on-transparent-background.png" alt="Logo Site">
        <h1>OUR DISCUSSION SPOT</h1>
    </header>
  
    <div class="divButtons">
    <a href="formularioPost.html" class="buttonHeader1"><span class="material-icons">assignment</span></a>
    <a href="perfilutilizador.php" class="buttonHeader2"><span class="material-icons">person</span></a>
    <a href="logout.php" class="buttonLogout"><span class="material-icons">logout</span></span></a>
</div>

    <div class="areaPosts">
        <?php
        require 'conexao.php';
        $sql = "SELECT * FROM post";
        $sql_query = $conn->query($sql);

        if ($sql_query !== false) {
            $numLinhas = $sql_query->num_rows;
            while ($numLinhas > 0) {
                $linhas = $sql_query->fetch_assoc();
                $id = $linhas['ID_post']; //para usar nos comentários.
                $titulo = $linhas['Titulo_post'];
                $nomeAutor = $linhas['Nome_Autor'];
                $assunto = $linhas['Assunto'];
                $corpo = $linhas['Texto_Post'];
                echo "<div class='postVer'>";
                echo "<p name='1st'>" . $nomeAutor . " | " . $assunto . "<span style='margin-left: 210px'><a href='respostas.php?id=$id'>Ver Mais</a></span>" . " </p>";
                echo "<p>" . $titulo . "</p>";
                echo "<p>" . $corpo . "</p>";
                echo "</div>";
                $numLinhas--;
            }
        }
            
        ?>
    </div>
    
        <i class="bi-instagram instagram"></i>
        <i class="bi-twitter-x twitter"></i>        
        <i class="bi-facebook facebook"></i>  

    <footer class="footer">
        Our Discussion Spot © | Ricardo Ferreira | 2023.
    </footer>

</body>