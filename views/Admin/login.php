<!doctype html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
        <link rel="stylesheet" href="<?php echo URLROOT."/assets/css/login.css"?>">
        <title>login</title>
    </head>
    <body>
    <div class="offset-md">
        <div class="login">
            <div class="login-form">
                <?php
                if (!empty($data['erro'])) {
                    echo $data['erro'];
                }

                ?>                <div class="admin-form-title text-white">Logue-se</div>
                <div class="admin-form-body">
                    <form method="POST">
                        <input type="email" name="email" class="form-control" placeholder="email">
                        <input type="text" name="user_name" class="form-control" placeholder="user_name">
                        <input type="password" name="password" class="form-control" placeholder="**********">
                        <input type="submit" value="Entrar" class="btn btn-outline-light btn-lg btn-block">
                        <input type="hidden" name="env" value="log">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php


    ?>
    </body>
    </html>