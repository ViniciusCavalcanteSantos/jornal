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
    <link rel="stylesheet" href="<?= URLROOT?>/assets/css/table_sort.css">
    <link rel="stylesheet" href="<?= URLROOT?>/assets/css/custom_alert.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>
    <div id="custom-alert"></div>
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
                    <a href="<?= URLROOT?>/admin/logout">
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
            <?php
            foreach ($data["profile"] as $profile) {
                $url = URLROOT."/assets/image/profile/profile".md5($profile->id).".jpg";
                $name = $profile->name;
                $office = $profile->office;
                echo '<div class="user-wrapper">';
                echo "<img src='{$url}' alt='' width='40px' height='40px'>";
                echo '<div>';
                echo "<h4>{$name}</h4>";
                echo "<small>{$office}</small>";
                echo '</div>';
                echo '</div>';
            }
            ?>

        </header>
        <main>
            <div class="content">
                <table class="content-table table-sortable">
                    <thead>
                    <tr>
                        <th data-sort="true">Titúlo</th>
                        <th data-sort="true">Vizualizações</th>
                        <th>Editar</th>
                        <th>Apagar</th>
                        <th data-sort="true" data-date="true">Data</th>
                        <th>Ativo</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($data["notices"] as $notice) {
                        // Titúlo
                        $title = substr(trim($notice->title), 0, 50);
                        $title = $title . (substr($notice->title, 51) ? "..." : "");

                        $date = new DateTime($notice->date); // Data
                        $rand = rand(10, 1000); // Views
                        $active = ($notice->active === 0) ? "" : "checked";


                        $href = URLROOT."/admin/editor/".$notice->id;
                        $posts = URLROOT."/client/posts/".$notice->id;

                        echo "<tr>";
                        echo    "<td><a href='{$posts}'>{$title}</a></td>";
                        echo    "<td>{$rand} Views</td>";
                        echo    "<td class='link'><a href='{$href}'>Editar</a></td>";
                        echo    "<td class='link' onclick='deleteNotice(\"{$notice->id}\")'>Apagar</td>";
                        echo    "<td>{$date->format("d/m/Y H:i")}</td>";
                        echo    "<td onclick='toggleActive(\"{$notice->id}\")'><input type='checkbox' {$active}></td>";
                        echo "</tr>";
                    }
                    ?>
                    
                    </tbody>
                </table>
            </div>
        </main>
    </div>
<script>const URLROOT = "<?= URLROOT?>";</script>
<script src="<?= URLROOT?>/assets/js/custom_alert.js"></script>
<script src="<?= URLROOT?>/assets/js/painel.js"></script>
<script src="<?= URLROOT?>/assets/js/table_sort.js"></script>
<script src="https://kit.fontawesome.com/5fb103eefc.js"></script>
</body>
</html>