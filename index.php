<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"
    <title>Ващелев Н.В.</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css” />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 index">
                
                <?php
                if (!isset($_COOKIE['User'])) {
                ?>
                    <h1>Кто ты?</h1>
                    <a href="/registration.php">Зарегистрируйтесь</a> или <a href="/login.php">войдите</a>, чтобы просматривать контент!
                <?php
                } else {
                    echo "<h1>Посты</h1>";
                    $link = mysqli_connect('127.0.0.1', 'root', '1', 'first');

                    $sql = "SELECT * FROM posts";
                    $res = mysqli_query($link, $sql);

                    if (mysqli_num_rows($res) >  0) {
                        while ($post = mysqli_fetch_array($res)) {
                            echo "<a href='/posts.php?id=" . $post["id"] . "'>" . $post['title'] . "</a><br>";
                        }
                       } else {
                            echo "Записей пока нет";
                       }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>