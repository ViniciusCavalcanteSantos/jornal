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
            <div class="ckeditor-wrapper">
                <div id="select-title" class="select-title">
                    <input  id="title" type="text" placeholder="Título da notícia" maxlength="80">
                    <button class="btn btn-select-title" onclick="customPopup.openPopup()">SELECIONAR TÍTULO</button>
                </div>

                <div onclick="checkPermission()">
                    <form style="max-width: 100%" id="notice-form" class="blocked" action="upload_notice.php" onsubmit="submitForm()" enctype="multipart/form-data" method="POST">
                        <div class="dropdown-menu">
                            <select>
                                <option value="0">Selecione o Tema</option>
                                <option value="1">Educação</option>
                                <option value="2">Segurança</option>
                                <option value="3">Saúde</option>
                            </select>
                        </div>

                        <input type="text" name="filesdeleted" id="filesdeleted" style="display: none"/>
                        <input type="text" name="title" id="titleForm" style="display: none"/>
                        <textarea name="editor" id="editor"></textarea>
                    </form>
                    <input class="btn btn-submit" type="submit" value="SALVAR NOTÍCIA" onclick="saveNotice()">
                </div>
            </div>
        </main>
    </div>


<script src="<?= URLROOT?>/assets/js/custom_alert.js"></script>
<script src="<?= URLROOT?>/assets/js/custom_popup.js"></script>
<script>
    const customAlert = new CustomAlert(document.getElementById("alert"));
    const customPopup = new CustomPopup(document.getElementById("popup-container"));
    
    <?php
    $notice = $data["notice"];
    if($notice) {
        echo "let id = '$notice->id';";
        echo "let title = '$notice->title';";
        echo "let notice = '$notice->notice';";
    } else {
        echo "let id;";
        echo "let title;";
        echo "let notice = null;";
    }
    ?>

    let editor;
    let paths = [];
</script>
<script>const URLROOT = "<?= URLROOT?>";</script>
<script src="<?= URLROOT?>/assets/api/ckeditor5/build/ckeditor.js"></script>
<script src="<?= URLROOT?>/assets/js/notices.js"></script>
<script src="https://kit.fontawesome.com/5fb103eefc.js"></script>
</body>
</html>

