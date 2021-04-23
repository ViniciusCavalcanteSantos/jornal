<style>
    #topbar .adm-link {
        position: absolute;
        font-size: 1rem;
        color: gold;
        right: 30px;
        top: 40px;
        transform: translateY(-50%);
    }
</style>
<header id="topbar">
    <a class=adm-link href="<?= URLROOT?>/admin/login">
        Ir para Admin
    </a>

    <i onclick="openMenu()" class="fas fa-bars"></i>
    
    <div class="title">
        <p>JORNAL DIGITAL<span>.NIN</span></p>
    </div>

    <ul id="navbar">
        <li class="current"><a href="#">INTERNACIONAL</a></li>
        <li><a href="#">NACIONAL</a></li>
        <li><a href="#">REGIONAL</a></li>
        <li><a href="#">BELO JARDIM</a></li>
        <li><a href="#">GERAL</a></li>
        <li><a href="#">SAÚDE</a></li>
        <li><a href="#">SEGURANÇA</a></li>
        <li><a href="#">ESPORTE</a></li>
    </ul>
    
    <div onclick="closeMenu()" class="fullscreen-shadow"></div>
</header>

<script type="text/javascript">
    const navbar = document.getElementById("navbar");

    function openMenu() {
        navbar.classList.add("active");
    }

    function closeMenu() {
        navbar.classList.remove("active");
    }
</script>