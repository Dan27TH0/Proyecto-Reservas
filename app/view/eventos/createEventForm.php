<div>
<h2>Registro de eventos</h2>
        <form action="http://localhost/proyecto-reservas/?C=eventosController&M=registerEvent" method="post">
            <div class="form-container">
                <input type="hidden" name="idEvento">
                <div>
                    <label for="Nombre">Nombre para la clase: </label><br>
                    <input class="campos" type="text" name="Nombre" required pattern="^[a-zA-Z]{5,50}$">
                </div><br>
                <div>
                    <label for="Descripcion">Descripcion para la clase : </label><br>
                    <input class="campos" type="textarea" name="Descripcion" required pattern="^[a-zA-Z]{5,100}$">
                </div><br>
                <div>
                    <label for="Hora_Inicio">Hora de Inicio : </label><br>
                    <input class="campos" type="time" name="Hora_Inicio" required min="05:00" max="23:00">
                </div><br>
                <div>
                    <label for="Hora_Fin">Hora de finalizaion : </label><br>
                    <input class="campos" type="time" name="Hora_Fin" required min="05:00" max="23:00">
                </div><br>
                <div>
                    <label for="Fecha">Fecha que se realizará : </label><br>
                    <input class="campos" type="date" name="Fecha" required min="2024-08-01" max="2030-12-31">
                </div><br>
                <div>
                    <label for="idDeporteSeleccion">Tipo de deporte : </label><br>
                    <select name="idDeporteSeleccion">
                    <?php foreach ($deporte as $deport): ?>
                        <option value="<?php echo htmlspecialchars($deport['id']); ?>"<?php echo isset($deporte['idDeporte']) && $deporte['idDeporte'] == $deport['id'] ? 'selected' : ''; ?>> 
                            <?php echo htmlspecialchars($deport['tipo']); ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </div><br>
                <div>
                    <label for="CantidadParticipantes">Cantidad de participantes : </label><br>
                    <input class = "campos" type="number" name="CantidadParticipantes" required pattern="^[0-9]" min="0" max="10000">
                </div><br>
                <div>
                    <input class="boton" type="submit" value="Confirmar">
                </div>
            </div>
        </form>
</div>

<style>
h2 {
    text-align: center;
    margin-top: 2rem;
    margin-bottom: 10px;
}

form {
    padding: 0.5rem;
    text-align: center;
    font-size: 1.2rem;
}

.form-container {
    box-shadow: 0px 4px 6px 3px rgba(0, 0, 0, 0.4);
    margin: 1rem;
    padding-top: 2rem;
    padding-bottom: 2rem;
}

/* Estilos para dispositivos grandes */
form input, form select, form textarea {
    width: 60%;
    padding: 0.75rem;
    margin: 0.5rem 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 1rem;
    font-family: Arial, sans-serif;
    transition: border-color 0.3s;
}

form input:focus, form select:focus, form textarea:focus {
    border-color: #007BFF; 
    outline: none; 
}

form button {
    width: 100%;
    padding: 0.75rem;
    margin: 1rem 0;
    border: none;
    border-radius: 4px;
    background-color: #007BFF; 
    color: white; 
    font-size: 1rem;
    font-family: Arial, sans-serif;
    cursor: pointer;
    transition: background-color 0.3s;
}

form button:hover {
    background-color: #0056b3;
}

/* Estilos responsivos */
@media (max-width: 1024px) {
    form input, form select, form textarea {
        width: 80%;
    }
}

@media (max-width: 720px) {
    form input, form select, form textarea {
        width: 100%;
    }

    h2 {
        font-size: 1.5rem;
    }

    form {
        font-size: 1rem;
    }

    .form-container {
        padding: 1rem;
        margin: 0.5rem;
    }

    form button {
        width: 100%;
        font-size: 1rem;
    }
}
</style>