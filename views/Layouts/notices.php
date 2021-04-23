<style>
    @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap");
    .ads {
        /*background: linear-gradient(45deg, #c06554 0%,#c06554 50%,#e57667 51%,#e57667 100%);*/
        background: linear-gradient(45deg, #c06554 50%, #e57667 50%);
        color: white;
        font-size: 2rem;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .ads-grid {
        grid-column: 2;
    }

    .notices {
        width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 4fr 2fr;
        grid-auto-rows: 300px;
        grid-auto-flow: dense;
        column-gap: 20px;
        row-gap: 7px;
        /*background: red;*/
    }

    .notices .notice {
    }

    .notices .notice:first-child {
        border-top: #555 1px solid;
    }

    .notices .notice {
        display: flex;
        flex-wrap: nowrap;
        grid-column: 1;
        padding: 20px 0;
        border-bottom: #555 1px solid;
        max-height: 600px;
        max-width: 800px;
    }

    .notices .notice img {
        height: 254px;
        width: 356px;
    }

    .notices .notice .titles {
        padding: 6px 15px;
    }

    .notices .notice .titles .theme {
        color: #555;
        font-size: 1.15rem;
        font-weight: 600;
        margin-bottom: 12px;
    }

    .notices .notice .titles .title {
        color: var(--primary);
        font-size: 1.5rem;
        font-family: Roboto, sans-serif;
    }

    .notices .notice .titles .title:hover {
        color: #0055a0;
    }

    .notices .notice .titles .subtitle {
        color: #555;
        font-weight: 400;
        font-family: "Open Sans", sans-serif;
        margin-top: 10px;
    }

    .notices .notice .titles .time {
        margin-top: 12px;
    }

    .notices .social-media {
        grid-column: 2;
        color: var(--primary);
        font-size: 2rem;
        /*font-family: Roboto, sans-serif;*/
        font-family: "Open Sans", sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .notices .social-media .social-media-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .notices .social-media .social-media-container a {
        color: var(--primary);
        margin-bottom: 8px;
    }

    .notices .social-media .social-media-container i {
        width: 32px;
        margin-right: 8px;
        text-align: center;
    }

    .notices .aside-menu {
        /*background: var(--primary);*/
        grid-column: 2;
    }

    .notices .aside-menu .economy {
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 300px;
        width: 100%;
        text-align: center;
    }

    .notices .aside-menu .economy h1 {
        color: var(--primary);
        margin-bottom: 2px;
        /*color: #58b467;*/
    }

    .notices .aside-menu .economy p {
        font-size: 1.5rem;
        font-family: montserrat, sans-serif;
        font-weight: 300;
        margin-bottom: 15px;
    }
</style>
<div id="notices" class="notices">
    <div class="notice">
        <a href="#">
            <img src="img/cS-1.jpg">
        </a>
        <div class="titles">
            <p class="theme">Artistas Famosos</p>
            <a class="title" href="#">Taylor Swift achieves rare U.S. chart double, this is a amazing conquest, she said "I'm so happy!"</a>
            <p class="subtitle">Taylor Swift achieves rare U.S. chart doubleTaylor Swift achieves rare U.S. chart double</p>
            <p class="time">- Há 2 minutos</p>
        </div>
    </div>
    <div class="notice">
        <a href="#">
            <img src="img/cS-2.jpg">
        </a>
        <div class="titles">
            <p class="theme">Artistas Famosos</p>
            <a class="title" href="#">Taylor Swift achieves rare U.S. chart double"</a>
            <p class="subtitle">Taylor Swift achieves rare U.S. chart doubleTaylor Swift achieves rare U.S. chart double</p>
            <p class="time">- Há 2 horas</p>
        </div>
    </div>
    <div class="notice">
        <a href="#">
            <img src="img/cS-2.jpg">
        </a>
        <div class="titles">
            <p class="theme">Artistas Famosos</p>
            <a class="title" href="#">Taylor Swift achieves rare U.S. chart double"</a>
            <p class="subtitle">Taylor Swift achieves rare U.S. chart doubleTaylor Swift achieves rare U.S. chart double</p>
            <p class="time">- Há 2 horas</p>
        </div>
    </div>
    <div class="notice">
        <a href="#">
            <img src="img/cS-2.jpg">
        </a>
        <div class="titles">
            <p class="theme">Artistas Famosos</p>
            <a class="title" href="#">Taylor Swift achieves rare U.S. chart double"</a>
            <p class="subtitle">Taylor Swift achieves rare U.S. chart doubleTaylor Swift achieves rare U.S. chart double</p>
            <p class="time">- Há 2 horas</p>
        </div>
    </div>
    <div class="notice">
        <a href="#">
            <img src="img/cS-2.jpg">
        </a>
        <div class="titles">
            <p class="theme">Artistas Famosos</p>
            <a class="title" href="#">Taylor Swift achieves rare U.S. chart double"</a>
            <p class="subtitle">Taylor Swift achieves rare U.S. chart doubleTaylor Swift achieves rare U.S. chart double</p>
            <p class="time">- Há 2 horas</p>
        </div>
    </div>
    <div class="notice">
        <a href="#">
            <img src="img/cS-2.jpg">
        </a>
        <div class="titles">
            <p class="theme">Artistas Famosos</p>
            <a class="title" href="#">Taylor Swift achieves rare U.S. chart double"</a>
            <p class="subtitle">Taylor Swift achieves rare U.S. chart doubleTaylor Swift achieves rare U.S. chart double</p>
            <p class="time">- Há 2 horas</p>
        </div>
    </div>
    <div class="notice">
        <a href="#">
            <img src="img/cS-2.jpg">
        </a>
        <div class="titles">
            <p class="theme">Artistas Famosos</p>
            <a class="title" href="#">Taylor Swift achieves rare U.S. chart double"</a>
            <p class="subtitle">Taylor Swift achieves rare U.S. chart doubleTaylor Swift achieves rare U.S. chart double</p>
            <p class="time">- Há 2 horas</p>
        </div>
    </div>

    <div class="aside-menu">
        <?php

        include "assets/api/hg_finance.php";
        $HGFinance = new HGFinance("19ab62a6");
        $HGFinance->get();

        // Configuração do dolar
        $dollarValue = number_format($HGFinance->data["currencies"]["USD"]["buy"], 2, ',', '.');

        $dollarVariation = $HGFinance->data["currencies"]["USD"]["variation"];

        $dollarVariationFormated = number_format($dollarVariation, 2, ",", ".");
        $dollarVariationFormated = ($dollarVariation > 0) ? "+".$dollarVariationFormated : $dollarVariationFormated;
        $dollarColor = ($dollarVariation > 0) ? "#58b467" : "red";

        // Configuração da ibovespa
        $ibovespaVariation = $HGFinance->data["stocks"]["IBOVESPA"]["variation"];

        $ibovespaVariationFormated = number_format($ibovespaVariation, 2, ',', '.');
        $ibovespaVariationFormated = ($ibovespaVariation > 0) ? "+".$ibovespaVariationFormated : $ibovespaVariationFormated;
        $ibovespaColor = ($ibovespaVariation > 0) ? "#58b467" : "red";

        ?>

        <div class="economy">

            <h1>Dolar Hoje <i class="fas fa-search-dollar"></i></h1>
            <?php echo "<p style='color: {$dollarColor}'>R$ {$dollarValue} ({$dollarVariationFormated}%)</p>" ?>
            <h1>Ibovespa</h1>
            <?php echo "<p style='color: {$ibovespaColor}'>{$ibovespaVariationFormated}%</p>" ?>
        </div>

    </div>

    <div class="ads ads-grid">394x300</div>

    <div class="social-media">
        <div class="social-media-container">
            <a href="#"><i class="fab fa-instagram"> </i>Instagram</a>
            <a href="#"><i class="fab fa-whatsapp">  </i>Whatsapp </a>
            <a href="#"><i class="fab fa-facebook-f"></i>Facebook </a>
            <a href="#"><i class="fab fa-twitter">   </i>Twitter  </a>
        </div>
    </div>
</div>

