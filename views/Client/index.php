<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->config['site_title']?></title>
    <link rel="stylesheet" href="<?= URLROOT?>/assets/css/main.css">
    <link rel="stylesheet" href="<?= URLROOT?>/assets/css/layouts/header.css">
    <link rel="stylesheet" href="<?= URLROOT?>/assets/css/layouts/slider.css">
    <link rel="shortcut icon" href="#" type="image/x-icon">
</head>
<body>
    <?php
    $this->view("layouts/header");
    $this->view("layouts/slider");
    $this->view("layouts/notices", $data);
    ?>

    <script>
        const financeInfo = <?= $data["FinanceJsArray"];?>;
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js"></script>
    <script src="<?= URLROOT?>/assets/js/slider.js"></script>
    <script src="<?= URLROOT?>/assets/js/chart.js"></script>
    <script src="https://kit.fontawesome.com/5fb103eefc.js"></script>
</body>
</html>