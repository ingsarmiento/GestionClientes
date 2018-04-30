<?php
include('libs/header.php');
?>
<div class="container col-sm-8">
    <div class="card">
        <p id="message">
        
        </p>
        <div class="card-body">
            <h5 class="card-title">Nuevo Usuario</h5>
            <form id="saveUserForm" action="" method="POST">
                <div class="form-group row">
                    <label for="inputUsername" class="col-sm-2 col-form-label">Usuario</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputUsername" name="inputUsername" placeholder="Usuario">
                    </div>
                </div>
                    
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Contraseña</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword" name ="inputPassword" placeholder="Password">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputDni" class="col-sm-2 col-form-label">Dni</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputDni" name="inputDni" placeholder="DNI">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputNombre" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputNombre" name="inputNombre" placeholder="Nombre">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputApellido" class="col-sm-2 col-form-label">Apellido</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputApellido" name="inputApellido" placeholder="Apellido">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputDireccion" class="col-sm-2 col-form-label">direccion</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputDireccion" name="inputDireccion" placeholder="Dirección">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputProvincia" class="col-sm-2 col-form-label">Provincia</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputProvincia" name="inpuProvincia" placeholder="Provincia">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPoblacion" class="col-sm-2 col-form-label">Población</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPoblacion" name="inputPoblacion" placeholder="Población">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputCodigo_postal" class="col-sm-2 col-form-label">Código Postal</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputCodigo_postal" name="inputCodigo_postal" placeholder="Código Postal">
                    </div>
                </div>
                    
                <div class="form-group row">
                    <label for="inputTelefono" class="col-sm-2 col-form-label">Télefono</label>
                    <div class="col-sm-10">
                        <input type="telefono" class="form-control" id="inputTelefono" name="inputTelefono" placeholder="Télefono">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" name="inputTelefono" placeholder="Email">
                    </div>
                </div>

                <!--div class="form-group row">
                    <label for="fecha" class="col-sm-2 col-form-label">Fecha</label>
                    <div class="input-group date" data-provide="datepicker">
                        <input type="text" class="form-control">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                </div-->

                <div class="form-group row">
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="inputAdmin" name="inputAdmin">
                            <label class="form-check-label" for="inputAdmin">Administrador</label>
                        </div>
                    </div>
                </div-->
            </form>
        </div> 

        <div class="card_footer text-right">
            <button type="submit" class="btn btn-primary" id="saveButton">Guardar</button>
        </div>
        
</div>

<?php
include('libs/footer.php');
?>

<script>
    //Guardar Usuario
    function guardarUsuario()
    {
      var username = $("#inputUsername").val();
      var password = $("#inputPassword").val();
      var dni = $("#inputDni").val();
      var nombre = $("#inputNombre").val();
      var apellido = $("#inputApellido").val();
      var direccion = $("#inputDireccion").val();
      var telefono = $("#inputTelefono").val();
      var provincia = $("#inputProvincia").val();
      var telefono = $("#inputPoblacion").val();
      var mail = $("#inputEmail").val();
      var admin = false;
      if($("#inputAdmin").checked)
      {
          admin = true;
      }
      
    }
    $("#saveButton").click(function()
    {

        var username = $("#inputUsername").val();
        var password = $("#inputPassword").val();
        var dni = $("#inputDni").val();
        var nombre = $("#inputNombre").val();
        var apellido = $("#inputApellido").val();
        var direccion = $("#inputDireccion").val();
        var telefono = $("#inputTelefono").val();
        var provincia = $("#inputProvincia").val();
        var poblacion = $("#inputPoblacion").val(); 
        var codigo_postal = $("#inputCodigo_postal").val();
        var telefono = $("#inputTelefono").val();
        var email = $("#inputEmail").val();
        var admin = false;

        if($("#inputAdmin").checked)
        {
            admin = true;
        }

        var data = 
        {
            "username":username,
            "password":password,
            "dni":dni,
            "nombre":nombre,
            "apellido":apellido,
            "direcion":direccion,
            "provincia":provincia,
            "poblacion":poblacion,
            "codigo_postal":codigo_postal,
            "telefono":telefono,
            "email":email,
            "admin":admin
        };

        console.log(data);

        /*$.post('libs/user_management.php?action=saveUser&data='+data, function(response)
        {
            console.log(response);
        });*/
    });
</script>