<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jornal - Editor</title>
    <link rel="stylesheet" href="<?= URLROOT?>/assets/css/editor.css">
    <link rel="stylesheet" href="<?= URLROOT?>/assets/css/sidebar.css">
    <link rel="stylesheet" href="<?= URLROOT?>/assets/css/custom_alert.css">
    <link rel="stylesheet" href="<?= URLROOT?>/assets/css/custom_popup.css">
</head>
<body>
<div id="popup-container"></div>
<div id="alert"></div>

<div class="wrapper">
    <ul class="sidebar">
        <a href="<?= URLROOT?>/">
            <div>
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div>FUNDA <sup>WEB IT</sup></div>
        </a>

        <hr>

        <li>
            <a href="<?= URLROOT?>/admin/painel">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Painel</span>
            </a>
        </li>
        <li class="active">
            <a href="<?= URLROOT?>/admin/editor">
                <i class="fas fa-pen"></i>
                <span>Editor</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="fas fa-sign-out-alt"></i>
                <span>Sair</span>
            </a>
        </li>
    </ul>
    <div class="content">
        <div class="create-notices">
            <div class="selection">
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
                        <textarea name="editor" id="editor" ></textarea>
                    </form>
                    <input class="btn btn-submit" type="submit" value="SALVAR NOTÍCIA" onclick="saveNotice()">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= URLROOT?>/assets/js/custom_alert.js"></script>
<script src="<?= URLROOT?>/assets/js/custom_popup.js"></script>
<script>
    const customAlert = new CustomAlert(document.getElementById("alert"));
    const customPopup = new CustomPopup(document.getElementById("popup-container"));
    
    <?php
    echo "const urlRoot = '" . URLROOT . "';";
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
<script src="<?= URLROOT?>/assets/api/ckeditor5/build/ckeditor.js"></script>
<script src="<?= URLROOT?>/assets/js/notices.js"></script>
<script src="https://kit.fontawesome.com/5fb103eefc.js"></script>
<!--<button onclick="teste()">teste</button>-->
</body>
</html>

