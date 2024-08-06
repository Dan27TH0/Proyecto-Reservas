<h1>Áreas Deportivas</h1>

<?php
// Mostrar el mensaje de éxito si el parámetro `success` está presente en la URL
if (isset($_GET['success'])) {
    if ($_GET['success'] === 'true') {
        echo '<div class="notification success">Área eliminada exitosamente.</div>';
    } elseif ($_GET['success'] === 'false') {
        echo '<div class="notification error">Hubo un problema al eliminar el área.</div>';
    }
}
?>
<div class="contenedor-boton">
    <button onclick="redirigirAñadirArea()">Registrar Área</button>
</div>
<div class="area-container">
    <?php foreach ($datos_Area as $area): ?>
    <div class="area-item">
        <input hidden type="checkbox" id="img-<?php echo $area['idArea']; ?>" class="image-checkbox">
        <label for="img-<?php echo $area['idArea']; ?>">
            <img src="data:image/jpg;base64,<?php echo base64_encode($area['imagen_area']); ?>" alt="<?php echo htmlspecialchars($area['NombreArea']); ?>" class="clickable-image">
        </label>
        <div>
            <h3><?php echo htmlspecialchars($area['NombreArea']); ?></h3>
            <p><?php echo htmlspecialchars($area['Descripcion']); ?></p>
        </div>
        <hr>
        <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) {?>
            <button onclick="editarArea(<?php echo $area['idArea']; ?>)">Editar Area</button>
            <hr>
            <button class="eliminar" data-id="<?php echo $area['idArea']; ?>">Eliminar Area</button>
        <?php } ?>
    </div>
    <?php endforeach; ?>
</div>

<dialog id="modalArea">
    <h2>¿Seguro que deseas eliminar esta área?</h2>
    <div class ="botonEliminar">
        <button id="confirmarEliminar">Si</button>
        <button id="cerrarEliminarArea">No</button>
    </div>
</dialog>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const botonesArea = document.querySelectorAll('.eliminar');
        const ventanaArea = document.getElementById('modalArea');
        let idAreaParaEliminar = null;

        botonesArea.forEach(boton => {
            boton.addEventListener('click', () => {
                idAreaParaEliminar = boton.getAttribute('data-id');
                ventanaArea.showModal();
            });
        });

        document.getElementById('cerrarEliminarArea').addEventListener('click', () => {
            ventanaArea.close();
        });

        document.getElementById('confirmarEliminar').addEventListener('click', () => {
            eliminarArea(idAreaParaEliminar);
        });
    });

    function redirigirAñadirArea(){
        window.location.href = "http://localhost/proyecto-reservas/?C=areasController&M=callRegisterAreaForm";
    }

    function editarArea(idArea){
        window.location.href = "http://localhost/proyecto-reservas/?C=areasController&M=callEditAreaForm&idArea=" + idArea;
    }

    function eliminarArea(idArea){
        window.location.href = "http://localhost/proyecto-reservas/?C=areasController&M=deleteArea&idArea=" + idArea;
    }
</script>

<style>
/* CSS General */
h1 {
    text-align: center;
    font-size: 2rem; /* Ajuste de tamaño para pantallas más pequeñas */
}

h2 {
    text-align: center;
    margin-top: 2rem;
    margin-bottom: 10px;
}

.area-container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
}

.area-item {
    display: flex;
    flex-direction: column; /* Cambiado para que los botones se alineen verticalmente */
    align-items: center;
    border: 1px solid #000;
    margin-bottom: 20px;
    padding: 10px;
}

.area-item img {
    width: 100%; /* Ajusta la imagen al ancho del contenedor */
    max-width: 300px; /* Tamaño máximo para la imagen */
    height: auto; /* Mantiene la relación de aspecto */
}

.area-item div {
    text-align: center;
    margin-top: 10px;
}

button {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    margin-top: 10px;
    font-size: 1rem; /* Ajuste de tamaño para pantallas más pequeñas */
}

button:hover {
    background-color: #45a049;
}
.contenedor-boton {
            display: flex;
            justify-content: center; /* Centra el botón horizontalmente */
            align-items: center; 
            margin-top: 20px;
        }

.notification {
    width: 300px;
    padding: 15px;
    margin: 20px auto;
    border-radius: 8px;
    text-align: center;
    font-size: 16px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.notification.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.notification.error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* Estilos responsivos */
@media (max-width: 1024px) {
    .clickable-image {
        width: 150px; /* Ajuste el tamaño de la imagen en pantallas medianas */
    }
    .contenedor-boton {
        flex-direction: column; /* Botones en columna */
    }
    .contenedor-boton button {
        width: auto;
        margin: 5px 0;
    }
}

@media (max-width: 720px) {
    .clickable-image {
        width: 100px; /* Ajuste el tamaño de la imagen en pantallas pequeñas */
    }
    .notification {
        width: 80%;
        font-size: 14px;
    }
    button {
        padding: 10px;
        font-size: 14px;
        padding: 8px 16px; /* Ajuste de padding para pantallas más pequeñas */
        font-size: 14px; /* Ajuste de tamaño de fuente */
        display: inline-block;
    }
    h1 {
        font-size: 1.5rem;
    }
}

</style>
