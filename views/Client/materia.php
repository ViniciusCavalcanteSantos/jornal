<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=URLROOT?>/assets/css/style.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php 
if(isset($data["notice"])): 
    $notice = $data["notice"];
?>
    <div id="materia" class="mx-auto">

        <div id="title"><?= $notice->notice?></div>
        <div id="descricao">
            amentiss faiz malandris se pirulitá. Mais vale um bebadis conhecidiss, que um alcoolatra anonimis. Quem manda na minha terra sou euzis!
        </div>
        <img src="<?= URLROOT ?>/assets/image/profile.jpg" alt="" class="img">
        <div id="data"><?= $notice->date ?></div>
        <div id="texto"><?= utf8_encode($notice->notice) ?></div>
    </div>
<?php endif;?>
</body>
</html>
