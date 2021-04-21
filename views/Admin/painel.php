<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="<?= URLROOT?>/assets/css/custom_alert.css">
    <link rel="stylesheet" href="<?= URLROOT?>/assets/css/sidebar.css">
    <link rel="stylesheet" href="<?= URLROOT?>/assets/css/painel.css">
</head>
<body>
<div class="wrapper">
    <ul class="sidebar">
    <a href="<?= URLROOT?>/">
            <div>
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div>FUNDA <sup>WEB IT</sup></div>
        </a>

        <hr>

        <li class="active">
            <a href="<?= URLROOT?>/admin/painel">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Painel</span>
            </a>
        </li>
        <li>
            <a href="<?= URLROOT?>/admin/editor">
                <i class="fas fa-pen"></i>
                <span>Editor</span>
            </a>
        </li>
        <li>
            <a href="sair">
                <i class="fas fa-sign-out-alt"></i>
                <span>Sair</span>
            </a>
        </li>
    </ul>
    <div class="content">

        <table class="content-table">
            <thead>
            <tr>
                <th>Titúlo</th>
                <th>Vizualizações</th>
                <th>Editar</th>
                <th>Apagar</th>
                <th>Data</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($data["notices"] as $notice) {
                $rand = rand(10, 1000);

                $href = URLROOT."/admin/editor/".$notice->id;

                echo ($notice->active === 0) ? "<tr>" : "<tr class='active'>";
                echo    "<td><a href='#'>{$notice->title}</a></td>";
                echo    "<td>{$rand} Views</td>";
                echo    "<td class='link'><a href='{$href}'>Editar</a></td>";
                echo    "<td class='link' onclick='deleteNotice(\"{$notice->id}\")'>Apagar</td>";
                echo    "<td>{$notice->date}</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://kit.fontawesome.com/5fb103eefc.js"></script>
<script src="<?= URLROOT?>/assets/js/custom_alert.js"></script>
<script src="<?= URLROOT?>/assets/js/painel.js"></script>
</body>
</html>