<?php
    $testNumber = $_GET['test'];
    $testsPathList = glob('uploaded_tests/*.json');
    $currentTest = json_decode(file_get_contents($testsPathList[$testNumber - 1]) ,true);

    $totalQuestions = count($currentTest);
    $correctAnswers = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Тест</title>
    <link rel="stylesheet" href="css/styles.css">  
</head>
<body>

    <h2>Тест №<?= $testNumber ?></h2>

    <form enctype = "multipart/form-data" action = "" method = "POST" >
        <? foreach ($currentTest as $num => $test): ?>

            <fieldset>
                <legend><?= $test['question'] ?></legend>

                <? foreach ($test['varAnswers'] as $var => $questions) : ?>

                    <label><input type="radio" name="question<?= $num + 1 ?>" value="<?= $var ?>"><?= $questions ?></label><br>

                <? endforeach ?>

            </fieldset>

        <? endforeach ?>

        <input type="submit" name="check" value="Проверить ответы" style="margin-top: 20px;">
    </form>
        
    <?
        if (isset($_POST['check'])) {            

            foreach ($currentTest as $key => $test) {

                if (!isset($_POST['question'.($key + 1)])) {
                    echo "Необходимо ответить на все вопросы";
                    break;
                } else {
                    if ($test['trueAnswer'] === $_POST['question'.($key + 1)]) {
                         $correctAnswers++;
                    }

                }                 
            }
            ?>

            <div>
                <p>Всего вопросов: <?= $totalQuestions ?></p>
                <p>Правильных ответов: <?= $correctAnswers ?></p>
                <p>Ваш результат: <?= round($correctAnswers / $totalQuestions * 100) ?>%</p>
            </div>

            <?
        }        
    ?>
    
    <a href="list.php">Перейти к списку тестов</a>

</body>
</html>