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

	   <?php
            echo form_open('search');
            echo form_label('Enter Github Username', 'username');
            echo form_input('username');
            echo form_submit('submit', 'Query');
            echo form_close();
        ?>
         <div class="red"> <?=validation_errors()?> </div>
    </body>
</html>
