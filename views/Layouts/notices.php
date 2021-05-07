<style>
    body {
        background-color: #f1f5f9;
    }

    .ads {
        /*background: linear-gradient(45deg, #c06554 0%,#c06554 50%,#e57667 51%,#e57667 100%);*/
        background: linear-gradient(45deg, #c06554 50%, #e57667 50%);
        height: 394px;
        color: white;
        font-size: 2rem;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .notices-container {
        max-width: 1150px;
        width: 100%;
        margin: 0 auto;
        display: grid;
        grid-template-columns: auto 300px;
        column-gap: 50px;
        row-gap: 10px;
    }

    .notices .notice {
        display: flex;
        flex-wrap: nowrap;
        padding: 20px 0;
        border-bottom: #555 1px solid;
        height: 250px;

    }

    .notices .notice img {
        height: 100%;
        width: 360px;
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
    }

    .notices .notice .titles .title:hover {
        color: #0055a0;
    }

    .notices .notice .titles .subtitle {
        color: #555;
        font-weight: 400
        margin-top: 10px;
    }

    .notices .notice .titles .time {
        margin-top: 12px;
    }
</style>
<div class="notices-container">
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
    </div>

    <div class="aside">
        <div style="width: 300px; height: 200px; margin-bottom: 30px;">
            <canvas id="chart"></canvas>
        </div>

        <div class="ads ads-grid">394x300</div>
    </div>
</div>



