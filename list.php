<?php
    $testsPathList = glob('uploaded_tests/*.json');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Список тестов</title>
    <link rel="stylesheet" href="css/styles.css">  
</head>
<body>

    <h3>Список доступных тестов</h3>
    
    <ul>
        <?php

            foreach ($testsPathList as $num => $test) {
                $singleTest = file_get_contents($test);
                $testNum = 'Тест №'. ($num + 1).'.';
            ?>            
                <li><?= $testNum ?><a href="test.php?test=<?= $num + 1 ?>" >Пройти тест</a></li>
            <?
            }
        ?>
    </ul>

    <a href="admin.php">Перейти к загрузке тестов</a>

</body>
</html>