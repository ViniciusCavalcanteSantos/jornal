<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jornal - Editor</title>
    <link rel="stylesheet" href="<?= URLROOT?>/assets/css/main.css">
    <link rel="stylesheet" href="<?= URLROOT?>/assets/css/editor.css">
    <link rel="stylesheet" href="<?= URLROOT?>/assets/css/sidebar.css">
    <link rel="stylesheet" href="<?= URLROOT?>/assets/css/custom_alert.css">
    <link rel="stylesheet" href="<?= URLROOT?>/assets/css/custom_popup.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>
    <div id="popup-container"></div>
    <div id="alert"></div>
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="lab la-accusoft"></span> <span>Accusoft</span></h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="<?= URLROOT?>/admin/painel">
                        <span class="las la-igloo"></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?= URLROOT?>/admin/editor" class="active">
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
            <div class="ckeditor">
                <form style="max-width: 100%" onsubmit="saveNotice()">
                    <div class="input-data">
                        <div class="wrapper">
                            <input id="title" type="text" maxlength="80" required>
                            <div class="underline"></div>
                            <label>Título</label>
                        </div>

                        <div class="wrapper">
                            <input id="subtitle" type="text" maxlength="80" required>
                            <div class="underline"></div>
                            <label>Subtítulo</label>
                        </div>
                    </div>

                    <textarea name="editor" id="editor"></textarea>
                    <input type="submit" value="SALVAR NOTÍCIA">
                </form>
            </div>
        </main>
    </div>


<script src="<?= URLROOT?>/assets/js/custom_alert.js"></script>
<script src="<?= URLROOT?>/assets/js/custom_popup.js"></script>
<script>
    const customAlert = new CustomAlert(document.getElementById("alert"));
    const customPopup = new CustomPopup(document.getElementById("popup-container"));
    
    let id;
    let title;
    let subtitle;
    let notice;
    let editor;

    <?php
    if(isset($data["notice"]) && !empty($data["notice"])) {
        $notice = $data["notice"];

        echo "id = '$notice->id';";
        echo "title = '$notice->title';";
        echo "subtitle = '$notice->subtitle';";
        echo "notice = '$notice->notice';";
    }
    ?>
</script>
<script>const URLROOT = "<?= URLROOT?>";</script>
<script src="<?= URLROOT?>/assets/api/ckeditor5/build/ckeditor.js"></script>
<script src="<?= URLROOT?>/assets/js/upload_adapter.js"></script>
<script src="<?= URLROOT?>/assets/js/notices.js"></script>
<script src="https://kit.fontawesome.com/5fb103eefc.js"></script>
</body>
</html>

