<div>
<h2>Registro de cuentas</h2>
        <form action="http://localhost/proyecto-reservas/?C=usuariosController&M=registerUsers" method="post">
            <div class="form-container">
                <input type="hidden" name="idCliente">
                <div>
                    <label for="Nombre">Nombre : </label><br>
                    <input class="campos" type="text" name="Nombre" required>
                </div><br>
                <div>
                    <label for="ApPaterno">Apellido Paterno : </label><br>
                    <input class="campos" type="text" name="ApPaterno" required >
                </div><br>
                <div>
                    <label for="ApMaterno">Apellido Materno : </label><br>
                    <input class="campos" type="text" name="ApMaterno" required >
                </div><br>
                <div>
                    <label for="Email">Correo : </label><br>
                    <input class="campos" type="email" name="Email" required >
                </div><br>
                <div>
                    <label for="Telefono">Telefono : </label><br>
                    <input class="campos" type="tel" name="Telefono" required >
                </div><br>
                <div>
                    <label for="Contraseña">Contraseña : </label><br>
                    <input class="campos" type="password" name="Contraseña" required >
                </div><br>
                <div>
                    <input class="boton" type="submit" value="Confirmar">
                </div>
            </div>
        </form>
</div>

<style>
    /*DISEÑO DEL FORMULARIO REGISTER*/
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
</style>