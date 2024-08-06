<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Reservas Deportivas</title>
    <link rel="stylesheet" href="app/view/style.css">
</head>
<body>
    <header class="header">
        <h1>Pagina de reservas para áreas deportivas</h1>
        <nav class="navbar">
            <ul>
                <li><a href="http://localhost/proyecto-reservas/?C=usuarioController&M=index">Inicio</a></li>
                <li><a href="http://localhost/proyecto-reservas?C=usuarioController&M=logedout">Cerrar Sesion</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <?php include_once($vista);?>
    </section>
</body>
</html>