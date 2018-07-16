<?php

function isValidJSON ($file) {
    return (json_decode($file)) ? true : false;
}

$upploadDir = 'uploaded_tests';
$message = '';

if (isset($_FILES) && isset($_FILES['testfile'])) {
    
    $fileName = strtolower($_FILES['testfile']['name']);
    $filePathTmp = $_FILES['testfile']['tmp_name'];
    
    if ($fileName) {
        $decode = file_get_contents($filePathTmp);
        $valid = isValidJSON($decode);       

        if (strpos(strtolower($fileName), 'json', -4)) {            
            if ($valid) {
                move_uploaded_file($filePathTmp, $upploadDir.'/'.$fileName);

                $message = 'Поздравляем! Ваш тест успешно загружен.';

            } else {                
                $message = 'Структура файла не JSON!';
            }

        } else {
            $message = 'Загрузите файл с расширением JSON!';
        }

    } else {
        $message = 'Вы должны выбрать файл!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Загрузка тестов</title>
    <link rel="stylesheet" href="css/styles.css">  
</head>
<body>

    <form enctype = "multipart/form-data" action="admin.php" method="POST">
        <input type = "file" name="testfile" style="display: block; margin-bottom: 10px">
        <input type = "submit" value="Загрузить">
    </form>

    <p><?= $message ?></p>

    <ul>
        <li><a href="admin.php">Обновить</a></li>
        <li><a href="list.php" >Перейти к списку тестов</a></li>
    </ul>

</body>
</html>