<h1>Clases Deportivas</h1>

<?php 
if (isset($_GET['success'])) {
    if ($_GET['success'] === 'true') {
        echo '<div class="notification success">Clase eliminada exitosamente.</div>';
    } elseif ($_GET['success'] === 'false') {
        echo '<div class="notification error">Hubo un problema al eliminar la clase.</div>';
    }
}
?>
<div class="contenedor-boton">
    <button onclick="redirigirCrearClase()">Crear Clase</button>
</div>
<div class="area-container">
    <?php if (isset($clases) && is_array($clases)): ?>
        <?php foreach ($clases as $clase): ?>
        <div class="area-item">
            <div>
                <h3>Nombre de la clase: <?php echo htmlspecialchars($clase['Nombre']); ?></h3>
                <p>Descripción de la clase: <?php echo htmlspecialchars($clase['Descripcion']); ?></p>
                <p>Hora de inicio: <?php echo htmlspecialchars($clase['Hora_Inicio']); ?></p>
                <p>Hora de finalización: <?php echo htmlspecialchars($clase['Hora_Fin']); ?></p>
                <p>Organizador: <?php echo htmlspecialchars($clase['Organizador']); ?></p>
                <p>Tipo de deporte: <?php echo htmlspecialchars($clase['Tipo_Deporte']); ?></p>
            </div>
            <!-- Botón centrado debajo del texto -->
            <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) {?>
                <button onclick="editarClase(<?php echo $clase['idClase']; ?>)">Editar Clase</button>
                <button class="eliminar" data-id="<?php echo $clase['idClase']; ?>">Eliminar Clase</button>
            <?php } ?>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No se encontró ninguna clase</p>
    <?php endif; ?>
</div>

<dialog id="modalClase">
    <h2>¿Seguro que deseas eliminar esta clase?</h2>
    <div class="botonEliminar">
        <button id="confirmarEliminar">Sí</button>
        <button id="cerrarEliminarClase">No</button>
    </div>
</dialog>

<dialog id="modalInscripcion" class="modalInscripcion">
    <div>
        <h2>¡Registro completo!</h2>
        <button id="salirInscripcion">Salir</button>
    </div>
</dialog>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const botonesClase = document.querySelectorAll('.eliminar');
        const ventanaClase = document.getElementById('modalClase');
        const botonesInscripcion = document.querySelectorAll('.inscripcion');
        const modalInscripcion = document.getElementById('modalInscripcion');

        let idClaseParaEliminar = null;

        botonesInscripcion.forEach(boton => {
            boton.addEventListener('click', () => {
                const idClase = boton.getAttribute('data-id');
                registrarInscripcion(idClase);
            });
        });

        botonesClase.forEach(boton => {
            boton.addEventListener('click', () => {
                idClaseParaEliminar = boton.getAttribute('data-id');
                ventanaClase.showModal();
            });
        });

        document.getElementById('salirInscripcion').addEventListener('click', () => {
            modalInscripcion.close();
        });

        document.getElementById('cerrarEliminarClase').addEventListener('click', () => {
            ventanaClase.close();
        });

        document.getElementById('confirmarEliminar').addEventListener('click', () => {
            eliminarClase(idClaseParaEliminar);
        });
    });

    function redirigirCrearClase(){
        window.location.href = "http://localhost/proyecto-reservas/?C=clasesController&M=callRegisterClassForm";
    }

    function editarClase(idClase){
        window.location.href = "http://localhost/proyecto-reservas/?C=clasesController&M=callEditClassForm&idClase=" + idClase;
    }

    function eliminarClase(idClase){
        window.location.href = "http://localhost/proyecto-reservas/?C=clasesController&M=deleteClass&idClase=" + idClase;
    }

    function registrarInscripcion(idClase) {
        fetch(`http://localhost/proyecto-reservas/?C=clasesController&M=inscription&idClase=${idClase}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    modalInscripcion.showModal();
                } else {
                    alert('Hubo un problema al inscribirse en la clase.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un problema al procesar la solicitud.');
            });
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
