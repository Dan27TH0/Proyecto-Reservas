<div>
    <h2>Registro de Áreas Deportivas</h2>
    <form action="http://localhost/proyecto-reservas/?C=areasController&M=registerArea" method="post" enctype="multipart/form-data">
        <div class="form-container">
            <input type="hidden" name="idArea">
            <div>
                <label for="Nombre">Nombre para el área: </label><br>
                <input class="campos" type="text" name="Nombre" required pattern="^[a-zA-Z]{5,50}$">
            </div><br>
            <div>
                <label for="Area">Tipo de área: </label><br>
                <select name="Area" required>
                    <?php foreach ($areas as $area): ?>
                        <option value="<?php echo htmlspecialchars($area['id']); ?>">
                            <?php echo htmlspecialchars($area['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div><br>
            <div>
                <label for="Descripcion">Descripcion para el área: </label><br>
                <input class="campos" type="textarea" name="Descripcion" required pattern="^[a-zA-Z]{5,100}$">
            </div><br>
            <div>
                <label for="Ubicacion">Ubicación: </label><br>
                <select name="Ubicacion" required>
                    <?php foreach ($ubicaciones as $ubicacion): ?>
                        <option value="<?php echo htmlspecialchars($ubicacion['id']); ?>">
                            <?php echo htmlspecialchars($ubicacion['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div><br>
            <div>
                <label for="Imagen">Imagen referencial: </label><br>
                <input class="campos" type="file" name="Imagen" required >
            </div><br>
            <div>
                <input class="boton" type="submit" value="Confirmar">
            </div>
        </div>
    </form>
</div>


<style>
h2{
    text-align: center;
    margin-top: 2rem;
    margin-bottom: 10px;
}
form{
    padding: 0.5rem;
    text-align: center;
    font-size: 1.2rem;
}
.form-container{
    box-shadow: 0px 4px 6px 3px rgba(0, 0, 0, 0.4);
    margin: 1rem;
    padding-top: 2rem;
    padding-bottom: 2rem;
}
form input, form select, form textarea{
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
</style>