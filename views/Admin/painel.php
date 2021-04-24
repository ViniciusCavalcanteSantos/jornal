<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="<?= URLROOT?>/assets/css/main.css">
    <link rel="stylesheet" href="<?= URLROOT?>/assets/css/sidebar.css">
    <link rel="stylesheet" href="<?= URLROOT?>/assets/css/painel.css">
    <link rel="stylesheet" href="<?= URLROOT?>/assets/css/custom_alert.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="lab la-accusoft"></span> <span>Accusoft</span></h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="<?= URLROOT?>/admin/painel" class="active">
                        <span class="las la-igloo"></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?= URLROOT?>/admin/editor">
                        <span class="las la-pen"></span>
                        <span>Editor</span>
                    </a>
                </li>
                <li>
                    <a href="<?= URLROOT?>/admin/sair">
                        <span class="las la-sign-out-alt"></span>
                        <span>Sair</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header>
            <div class="header-title">
                <h2>
                    <label for="nav-toggle">
                        <span class="las la-bars"></span>
                    </label>

                    Dashboard
                </h2>
            </div>

            <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="Search here" />
            </div>

            <div class="user-wrapper">
                <img src="<?= URLROOT?>/assets/image/profile.jpg" alt="" width="40px" height="40px">
                <div>
                    <h4>Vinicius C.</h4>
                    <small>Super admin</small>
                </div>
            </div>
        </header>
        <main>
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
        </main>
    </div>
<script src="https://kit.fontawesome.com/5fb103eefc.js"></script>
<script src="<?= URLROOT?>/assets/js/custom_alert.js"></script>
<script src="<?= URLROOT?>/assets/js/painel.js"></script>
</body>
</html>