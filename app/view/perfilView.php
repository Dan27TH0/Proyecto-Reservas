<div>
    <h2>¡Bienvenido a tu perfil <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
    <div class="inscripciones">
        <div class="section-box">
            <h3>Clases inscritas</h3>
            <?php if (is_array($datos_Clase) && !empty($datos_Clase)): ?>
                <div class="item-conteiner">
                    <div class="data-conteiner">
                        <?php foreach ($datos_Clase as $inscripcionClase): ?>
                            <h4>Nombre de la clase:</h4>
                            <p><?php echo htmlspecialchars($inscripcionClase['NombreClase']); ?></p>
                            <h4>Entrenador encargado:</h4>
                            <p><?php echo htmlspecialchars($inscripcionClase['Entrenador']); ?></p>
                            <button class="salirClase">Salir de la clase</button>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <p>No hay inscripciones disponibles.</p>
            <?php endif; ?>
        </div>

        <div class="section-box">
            <h3>Eventos inscritos</h3>
            <?php if (is_array($datos_Eventos) && !empty($datos_Eventos)): ?>
                <div class="item-conteiner">
                    <div class="data-conteiner">
                        <?php foreach ($datos_Eventos as $inscripcionEvento): ?>
                            <h4>Nombre del evento:</h4>
                            <p><?php echo htmlspecialchars($inscripcionEvento['NombreEvento']); ?></p>
                            <h4>Entrenador encargado:</h4>
                            <p><?php echo htmlspecialchars($inscripcionEvento['Entrenador']); ?></p>
                            <button class="salirEvento">Salir del evento</button>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <p>No hay eventos disponibles.</p>
            <?php endif; ?>
        </div>

        <div class="section-box">
            <h3>Áreas reservadas</h3>
            <?php if (is_array($datos_Areas) && !empty($datos_Areas)): ?>
                <div class="item-conteiner">
                    <div class="data-conteiner">
                        <?php foreach ($datos_Areas as $areasReserva): ?>
                            <h4>Nombre del área reservada:</h4>
                            <p><?php echo htmlspecialchars($areasReserva['Area_Reservada']); ?></p>
                            <h4>Total de participantes:</h4>
                            <p><?php echo htmlspecialchars($areasReserva['CantidadParticipantes']); ?></p>
                            <button class="cancelarArea">Cancelar reserva</button>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <p>No hay áreas disponibles.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Ventanas Emergentes -->
<dialog id="clase-evento">
    <h2>¿Seguro que deseas cancelar tu inscripción?</h2>
    <button>Si</button>
    <button id="cerrarSalir">No</button>
</dialog>

<dialog id="modalArea">
    <h2>¿Deseas cancelar tu reserva?</h2>
    <button>Si</button>
    <button id="cerrarCancelarArea">No</button>
</dialog>

<!-- Logica JS -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const botonesClase = document.querySelectorAll('.salirClase');
        const botonesEvento = document.querySelectorAll('.salirEvento');
        const botonesArea = document.querySelectorAll('.cancelarArea');

        const ventanaEvento = document.getElementById('clase-evento');
        const ventanaArea = document.getElementById('modalArea');

        botonesClase.forEach(boton => {
            boton.addEventListener('click', () => {
                ventanaEvento.showModal();
            });
        });

        botonesEvento.forEach(boton => {
            boton.addEventListener('click', () => {
                ventanaEvento.showModal();
            });
        });

        botonesArea.forEach(boton => {
            boton.addEventListener('click', () => {
                ventanaArea.showModal();
            });
        });

        document.getElementById('cerrarSalir').addEventListener('click', () => {
            ventanaEvento.close();
        });

        document.getElementById('cerrarCancelarArea').addEventListener('click', () => {
            ventanaArea.close();
        });
    });
</script>

<style>
h2{
    text-align: center;
}

.inscripciones {
    display: flex;
    justify-content: space-around;
    gap: 20px;
    padding: 20px;
    margin-top: 20px;
}

.section-box {
    flex: 1;
    max-width: 30%;
    border: 2px solid #000;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
}

.section-box h3 {
    margin-bottom: 10px;
}

.item-conteiner {
    display: flex;
    flex-direction: column;
    gap: 10px;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
}

#clase-evento::backdrop, #modalArea::backdrop{
    background-color: rgba(0,0,0,.55);
}

#clase-evento, #modalArea{
    text-align: center;
}

#clase-evento button, #modalArea button{
    border-color: gray;
    font-size: 1rem;
}

/* Estilos responsivos */
@media (max-width: 1024px) {
    .inscripciones {
        flex-direction: column;
        align-items: center;
    }
    .section-box {
        max-width: 80%;
        margin-bottom: 20px;
    }
}

@media (max-width: 720px) {
    .inscripciones {
        flex-direction: column;
        align-items: center;
    }
    .section-box {
        max-width: 100%;
        margin-bottom: 20px;
    }
}
</style>
