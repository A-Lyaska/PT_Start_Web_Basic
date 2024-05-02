<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" <title>Ващелев Н.В.</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css” />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container nav_bar">
        <div class="row">
            <div class="row">
                <div class="col-3 nav_logo"></div>
                <div class="col-9">
                    <div class="nav_text">Информация обо мне!</div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-5">
                Меня зовут Ващелев Никита Витальевич. Студент 3-его курса РТУ МИРЭА на направлении ИКБ
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h1>Здесь могла бы быть ваша реклама</h1>
                Чтобы сдать сети, нужно всего лишь на ночь... Читайте по ссылке
            </div>
            <div class="col-4">
                <div class="row photo"></div>
                <div class="row">
                    <p class="title_photo">Да. Это я! Никита Н.В.</p>
                </div>
            </div>
            <div class="col-8">
                <h3>Здесь могла бы быть ваша реклама</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="button_js col-12">
                <button id="myButton">Нажми!</button>
                <p id="demo"></p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="hello">
                    Привет, <?php echo $_COOKIE['User']; ?>
                </h1>
            </div>
            <div class="col-12">
                <form method="POST" action="profile.php" enctype="multipart/form-data" name="upload">
                    <input type="text" class="form" type="text" name="title" placeholder="Заголовок">
                    <textarea name="text" cols="30" rows="10" placeholder="Текст"></textarea>
                    <input type="file" name="file" /><br>
                    <button type="submit" class="btn_red" name="submit">Сохранить пост!</button>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/button.js"></script>
</body>

</html>

<?php

require_once("db.php");

$link = mysqli_connect('127.0.0.1', 'root', 'kali', 'first');

    if (isset($_POST['submit'])) {

        $title = strip_tags($_POST['title']);
        $main_text = strip_tags($_POST['text']);

        $title = mysqli_real_escape_string($link, $title);
        $main_text = mysqli_real_escape_string($link, $main_text);

        if (!$title || !$main_text) die("Заполните все поля");

        $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
        $main_text = htmlspecialchars($main_text, ENT_QUOTES, 'UTF-8');

        $sql = "INSERT INTO posts (title, main_text) VALUES ('$title', '$main_text')";

        if (!mysqli_query($link, $sql)) die("не удалось добавить пост");
    }

    if (isset($_FILES["file"])) {

        $errors = [];
        $allowedTypes = ['image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg', 'image/x-png', 'image/png'];
        $maxFileSize = 102400;

        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'Произошла ошибка при загрузке файла.';
        }

        $realFileSize = filesize($_FILES['file']['tmp_name']);
        if ($realFileSize > $maxFileSize) {
            $errors[] = 'Файл слишком большой.';
        }

        $fileType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['file']['tmp_name']);
        if (!in_array($fileType, $allowedTypes)) {
            $errors[] = 'Недопустимый тип файла.';
        }

        if (empty($errors)) {

            $tempPath = $_FILES['file']['tmp_name'];
            $destinationPath = 'upload/' . uniqid() . '_' . basename($_FILES['file']['name']);

            if (move_uploaded_file($tempPath, $destinationPath)) {
                echo "Файл загружен успешно: " . $destinationPath;
            } else {
                $errors[] = 'Не удалось переместить загруженный файл.';
            }
        } else {
            foreach ($errors as $error) {
                echo $error . '<br>';
            }
        }
    }

?>