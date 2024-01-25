<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Download do Aplicativo</title>
  <style>
    body {
      text-align: center;
      font-family: Arial, sans-serif;
      margin: 20px;
      background-color: #f4f4f4;
    }

    h1 {
      color: #007bff;
    }

    .app-info {
      margin-top: 30px;
    }
  </style>
</head>

<body>
  <?php
  // Inclua as informaÃ§Ãµes do aplicativo
  $appName = "Nome do Seu App";
  $appLogo = "caminho/do/seu/logo.png";
  $appVersion = "1.0";
  $uploadDate = "25 de Janeiro de 2024";
  $configVersion = "1.0.0";
  $aboutApp = "Alguma InformaÃ§Ã£o sobre o seu aplicativo.";

  // Exiba as informaÃ§Ãµes do aplicativo
  echo "<h1>$appName</h1>";
  echo "<img src=\"$appLogo\" alt=\"Logo do Seu App\" width=\"100\">";
  echo "<div class=\"app-info\">";
  echo "<p>VersÃ£o: <span>$appVersion</span></p>";
  echo "<p>Data de Upload: <span>$uploadDate</span></p>";
  echo "<p>VersÃ£o das ConfiguraÃ§Ãµes: <span>$configVersion</span></p>";
  echo "<p>Sobre o Aplicativo: <span>$aboutApp</span></p>";
  echo "</div>";
  ?>
</body>

</html>