<?php
// upload.php

// Caminho da pasta uploads
$uploadDirectory = 'uploads/';

// Verifica se a pasta existe ou a cria
if (!file_exists($uploadDirectory)) {
    mkdir($uploadDirectory, 0777, true); // Certifique-se de ajustar as permissÃµes conforme necessÃ¡rio
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o formulÃ¡rio de upload foi enviado

    // InformaÃ§Ãµes predefinidas para app_info.json
    $defaultInfo = [
        'defaultAppName' => 'Nome PadrÃ£o',
        'defaultAppLogo' => 'caminho/do/logo.png',
        'defaultAppVersion' => '1.0',
        'defaultUploadDate' => '01 de Janeiro de 2022',
        'defaultConfigVersion' => '1.0.0',
        'defaultAboutApp' => 'InformaÃ§Ã£o padrÃ£o sobre o aplicativo.',
    ];

    // InformaÃ§Ãµes do aplicativo
    $appName = $_POST['appName'];
    $appLogo = $_POST['appLogo'];
    $appVersion = $_POST['appVersion'];
    $uploadDate = $_POST['uploadDate'];
    $configVersion = $_POST['configVersion'];
    $aboutApp = $_POST['aboutApp'];

    // DiretÃ³rio especÃ­fico para o aplicativo
    $appDirectory = $uploadDirectory . $appName . '_' . time() . '/';

    // Verifica se a pasta do aplicativo existe ou a cria
    if (!file_exists($appDirectory)) {
        mkdir($appDirectory, 0777, true); // Certifique-se de ajustar as permissÃµes conforme necessÃ¡rio
    }

    // Move o arquivo APK para a pasta especÃ­fica
    $apkPath = $appDirectory . basename($_FILES['arquivo']['name']);
    move_uploaded_file($_FILES['arquivo']['tmp_name'], $apkPath);

    // Caminho do arquivo JSON
    $jsonPath = $appDirectory . 'app_info.json';

    // LÃª as informaÃ§Ãµes existentes ou usa as predefinidas
    $existingInfo = file_exists($jsonPath) ? json_decode(file_get_contents($jsonPath), true) : $defaultInfo;

    // Atualiza as informaÃ§Ãµes com os novos valores do upload
    $existingInfo['appName'] = $appName;
    $existingInfo['appLogo'] = $appLogo;
    $existingInfo['appVersion'] = $appVersion;
    $existingInfo['uploadDate'] = $uploadDate;
    $existingInfo['configVersion'] = $configVersion;
    $existingInfo['aboutApp'] = $aboutApp;
    $existingInfo['apkPath'] = $apkPath;

    // Salva as informaÃ§Ãµes atualizadas no arquivo JSON
    $json_data = json_encode($existingInfo, JSON_PRETTY_PRINT);
    file_put_contents($jsonPath, $json_data);

    // Redireciona para a pÃ¡gina de download
    header('Location: download.php?appName=' . urlencode($appName));
    exit();
}
?>