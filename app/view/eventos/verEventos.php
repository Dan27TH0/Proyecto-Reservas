<h1>Eventos Deportivos</h1>

<?php 
if (isset($_GET['success'])) {
    if ($_GET['success'] === 'true') {
        echo '<div class="notification success">Evento eliminado exitosamente.</div>';
    } elseif ($_GET['success'] === 'false') {
        echo '<div class="notification error">Hubo un problema al eliminar el evento.</div>';
    }
}
?>
<div class="contenedor-boton">
    <button onclick="redirigirCrearEvento()">Crear Evento</button>
</div>
<div class="area-container">
    <?php if (isset($datoEvento) && is_array($datoEvento)): ?>
        <?php foreach ($datoEvento as $evento): ?>
            <div class="area-item">
                <div>
                    <h3>Nombre del evento: <?php echo htmlspecialchars($evento['Nombre']); ?></h3>
                    <p>Descripción: <?php echo htmlspecialchars($evento['Descripcion']); ?></p>
                    <p>Hora de inicio: <?php echo htmlspecialchars($evento['Hora_Inicio']); ?></p>
                    <p>Hora de finalización: <?php echo htmlspecialchars($evento['Hora_Fin']); ?></p>
                    <p>Organizador: <?php echo htmlspecialchars($evento['Organizador']); ?></p>
                    <p>Tipo de deporte: <?php echo htmlspecialchars($evento['Tipo_Deporte']); ?></p>
                    <p>Fecha: <?php echo htmlspecialchars($evento['Fecha']); ?></p>
                </div>
                <button onclick="editarEvento(<?php echo $evento['idEvento']; ?>)">Editar Evento</button>
                <button class="eliminar" data-id="<?php echo $evento['idEvento']; ?>">Eliminar Evento</button>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No se encontraron eventos.</p>
    <?php endif; ?>
</div>

<dialog id="modalEvento">
    <h2>¿Seguro que deseas eliminar este evento?</h2>
    <div class ="botonEliminar">
        <button id="confirmarEliminar">Sí</button>
        <button id="cerrarEliminarEvento">No</button>
    </div>
</dialog>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const botonesEvento = document.querySelectorAll('.eliminar');
        const ventanaEvento = document.getElementById('modalEvento');
        let idEventoParaEliminar = null;

        botonesEvento.forEach(boton => {
            boton.addEventListener('click', () => {
                idEventoParaEliminar = boton.getAttribute('data-id');
                ventanaEvento.showModal();
            });
        });

        document.getElementById('cerrarEliminarEvento').addEventListener('click', () => {
            ventanaEvento.close();
        });

        document.getElementById('confirmarEliminar').addEventListener('click', () => {
            eliminarEvento(idEventoParaEliminar);
        });
    });

    function redirigirCrearEvento(){
        window.location.href = "http://localhost/proyecto-reservas/?C=eventosController&M=callRegisterEventForm";
    }

    function editarEvento(idEvento){
        window.location.href = "http://localhost/proyecto-reservas/?C=eventosController&M=callEditEventForm&idEvento=" + idEvento;
    }

    function eliminarEvento(idEvento){
        window.location.href = "http://localhost/proyecto-reservas/?C=eventosController&M=deleteEvent&idEvento=" + idEvento;
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
    .contenedor-boton {
        flex-direction: column; /* Botones en columna */
    }
    .contenedor-boton button {
        width: auto;
        margin: 5px 0;
    }
}

@media (max-width: 720px) {
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
