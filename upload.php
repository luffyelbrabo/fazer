if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $defaultInfo = [
        'defaultAppName' => 'Nome PadrÃ£o',
        'defaultAppLogo' => 'loja.dnetvpn.site/img/do/logo.png',
        'defaultAppVersion' => '1.0',
        'defaultUploadDate' => '01 de Janeiro de 2022',
        'defaultConfigVersion' => '1.0.0',
        'defaultAboutApp' => 'Informação padrão sobre o aplicativo.',
    ];

    $appName = $_POST['appName'];
    $appLogo = $_POST['appLogo'];
    $appVersion = $_POST['appVersion'];
    $uploadDate = $_POST['uploadDate'];
    $configVersion = $_POST['configVersion'];
    $aboutApp = $_POST['aboutApp'];

    // Diretório Unico para todos os aplicativos
    $uploadDirectory = 'uploads/';

    // Verifica se a pasta existe ou a cria
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true); // Cria o diretório com permissões 0777 (leitura, escrita e execução para todos)
    }

    // Define permissões específicas após criar o diretório
    chmod($uploadDirectory, 0777);

    $apkPath = $uploadDirectory . basename($_FILES['arquivo']['name']);
    move_uploaded_file($_FILES['arquivo']['tmp_name'], $apkPath);

    // Conectar ao banco de dados
    $db = new SQLite3('database.db');

    // Inserir ou atualizar informações na tabela
    $stmt = $db->prepare('INSERT OR REPLACE INTO app_info (id, appName, appLogo, appVersion, uploadDate, configVersion, aboutApp, apkPath) VALUES (NULL, :appName, :appLogo, :appVersion, :uploadDate, :configVersion, :aboutApp, :apkPath)');
    $stmt->bindValue(':appName', $appName, SQLITE3_TEXT);
    $stmt->bindValue(':appLogo', $appLogo, SQLITE3_TEXT);
    $stmt->bindValue(':appVersion', $appVersion, SQLITE3_TEXT);
    $stmt->bindValue(':uploadDate', $uploadDate, SQLITE3_TEXT);
    $stmt->bindValue(':configVersion', $configVersion, SQLITE3_TEXT);
    $stmt->bindValue(':aboutApp', $aboutApp, SQLITE3_TEXT);
    $stmt->bindValue(':apkPath', $apkPath, SQLITE3_TEXT);
    $stmt->execute();

    // Redirecionar para a pagina de download
    header('Location: download.php?appName=' . urlencode($appName));
    exit();
}