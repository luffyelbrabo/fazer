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
    // Obter o nome do aplicativo da consulta
    $appName = isset($_GET['appName']) ? $_GET['appName'] : '';

    // Verificar se o nome do aplicativo foi fornecido
    if (!empty($appName)) {
        // Caminho para o diretÃ³rio do aplicativo
        $appFolder = 'uploads/' . $appName . '/';

        // Verificar se o diretÃ³rio do aplicativo existe
        if (is_dir($appFolder)) {
            // Ler as informaÃ§Ãµes do arquivo JSON
            $json_data = file_get_contents($appFolder . 'app_info.json');
            $appInfo = json_decode($json_data, true);

            // Exibir as informaÃ§Ãµes do aplicativo
            echo "<h1>{$appInfo['appName']}</h1>";
            echo "<img src=\"{$appInfo['appLogo']}\" alt=\"Logo do Seu App\" width=\"100\">";
            echo "<div class=\"app-info\">";
            echo "<p>VersÃ£o: <span>{$appInfo['appVersion']}</span></p>";
            echo "<p>Data de Upload: <span>{$appInfo['uploadDate']}</span></p>";
            echo "<p>VersÃ£o das ConfiguraÃ§Ãµes: <span>{$appInfo['configVersion']}</span></p>";
            echo "<p>Sobre o Aplicativo: <span>{$appInfo['aboutApp']}</span></p>";
            echo "</div>";

            // Adicionar link para download do APK
            echo "<p><a href=\"{$appInfo['apkPath']}\" download>Baixar Aplicativo</a></p>";
        } else {
            echo "<p>Aplicativo nÃ£o encontrado.</p>";
        }
    } else {
        echo "<p>Nome do aplicativo nÃ£o fornecido.</p>";
    }
    ?>
</body>

</html>