<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Reservas Deportivas</title>
    <link rel="stylesheet" href="app/view/style.css">
    <style>
        /* Sidebar Navigation for small screens */
@media (max-width: 720px) {
    nav.navbar {
        display: none;
        position: fixed;
        left: 0;
        top: 0;
        width: 250px;
        height: 100%;
        background-color: #333;
        padding-top: 20px;
        z-index: 1000;
        transition: transform 0.3s ease;
        transform: translateX(-100%);
    }

    nav.navbar ul {
        flex-direction: column;
        align-items: center;
    }

    nav.navbar ul li {
        margin: 1rem 0;
    }

    nav.navbar ul li a {
        color: white;
    }

    nav.navbar.show {
        transform: translateX(0);
        display: block;
    }

    .menu-toggle {
        display: block;
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 1001;
        cursor: pointer;
    }

    .menu-toggle span {
        display: block;
        width: 25px;
        height: 3px;
        margin: 5px;
        background-color: #333;
    }
}
    </style>
</head>
<body>
    <header class="header">
        <div class="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div><br>
        <h1>Pagina de reservas para áreas deportivas</h1>
        <nav class="navbar">
            <ul>
                <li><a href="http://localhost/proyecto-reservas/?C=usuariosController&M=indexAdmin">Inicio</a></li>
                <li><a href="http://localhost/proyecto-reservas/?C=areasController&M=indexAdmin">Areas Deportivas</a></li>
                <li><a href="http://localhost/proyecto-reservas/?C=clasesController&M=indexAdmin">Clases Deportivas</a></li>
                <li><a href="http://localhost/proyecto-reservas/?C=eventosController&M=indexAdmin">Eventos Deportivos</a></li>
                <li><a href="http://localhost/proyecto-reservas?C=usuariosController&M=logedout">Cerrar Sesion</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <?php include_once($vista); ?>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuToggle = document.querySelector('.menu-toggle');
            const navbar = document.querySelector('nav.navbar');

            menuToggle.addEventListener('click', () => {
                navbar.classList.toggle('show');
            });
        });
    </script>
</body>
</html>
