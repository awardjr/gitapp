<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Github App</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <h1>Viewing <?=$username?>'s Repositories</h1>

        <img src=<?=$avatar?>/>
        <hr>
        <?php
            foreach($repos as $repo)
            {
                echo ("<a href='" . current_url() . "/" . $repo . "'>" . $repo . "</a><br/>");
            }
        ?>

    </body>
</html>
