<?php
// upload.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Processar o formulário de upload

    // Diretório para armazenar os aplicativos enviados
    $uploadDirectory = 'uploads/';

    // Informações do aplicativo
    $appName = $_POST['appName'];
    $appLogo = $_POST['appLogo'];
    $appVersion = $_POST['appVersion'];
    $uploadDate = $_POST['uploadDate'];
    $configVersion = $_POST['configVersion'];
    $aboutApp = $_POST['aboutApp'];

    // Criar uma pasta para cada aplicativo
    $appFolder = $uploadDirectory . $appName . '_' . time() . '/';
    mkdir($appFolder);

    // Mover o arquivo APK para a pasta
    $apkPath = $appFolder . basename($_FILES['arquivo']['name']);
    move_uploaded_file($_FILES['arquivo']['tmp_name'], $apkPath);

    // Salvar as informações em um arquivo JSON
    $data = [
        'appName' => $appName,
        'appLogo' => $appLogo,
        'appVersion' => $appVersion,
        'uploadDate' => $uploadDate,
        'configVersion' => $configVersion,
        'aboutApp' => $aboutApp,
        'apkPath' => $apkPath,
    ];

    $json_data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($appFolder . 'app_info.json', $json_data);

    // Redire**⬤**
