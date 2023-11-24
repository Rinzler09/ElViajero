<div class="sidebar">
    <h2>Sidebar</h2>
    <ul>
        <?php
        $menuItems = array("Inicio", "Perfil", "Configuración", "Cerrar sesión");

        foreach ($menuItems as $item) {
            echo "<li><a href='#'>$item</a></li>";
        }
        ?>
    </ul>
</div>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Side Menu</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="sidebar">
    <h2>Sidebar</h2>
    <ul>
        <li><a href="#">Inicio</a></li>
        <li><a href="#">Perfil</a></li>
        <li><a href="#">Configuración</a></li>
        <li><a href="#">Cerrar sesión</a></li>
    </ul>
</div>

<div class="content">
    <h2>Contenido principal</h2>
    <!-- Aquí va tu contenido principal -->
</div>

</body>
</html>
