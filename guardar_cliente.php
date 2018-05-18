<?php
include('libs/header.php');
?>
<div class="container col-sm-8">

    <div class="card">
        <div id="notification" role="alert">
            <p id="message" ></p>
        </div>
        
        <div class="card-body">
            <h5 class="card-title">Nuevo Cliente</h5>
            <form id="saveClientForm">
      
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
                    <label for="inputDireccion" class="col-sm-2 col-form-label">Dirección</label>
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

                <div class="form-group row">
                    <label for="inputDate" class="col-2 col-form-label">Fecha</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" id="inputDate">
                    </div>
                </div>
            </form>
            <div class="card_footer text-right">
                <button type="submit" class="btn btn-primary" id="saveButton">Guardar</button>
            </div>
        </div> 
        <input type="hidden" id="listadoEmailsClientes">
</div>

<?php
include('libs/footer.php');
?>

<script>

    $(document).ready(function()
    {
        cargarListadoEmailsClientes();
    });

    //Esta funcion carga un listado de todos los emails de los clientes desde la base de datos.
    function cargarListadoEmailsClientes()
    {
        $.post("/libs/client_management.php?action=getEmailList", 
            function(response)
            {
                if(response)
                {
                    $("#listadoEmailsClientes").val(response);
                }   
            }
        );
    }

    //Devuelve un email del listado de Emails de Clientes
    function getEmailFromList(val)
    {
        data = JSON.parse($("#listadoEmailsClientes").val());
        client = data.find(function(data)
        {
            if(data.email === val)
            {
                return data;
            }
            return "";
        });
        return client.email;
    }

    function checkEmail()
    {
        email =$("#inputEmail").val();
        if(email == getUsernameFromList(email))
        {
            //Poner mensaje de alerta de duplicado.
        }
    }

    //Guardar Cliente
    $("#saveButton").click(function()
    {
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
        var fechaAlta = $("#inputDate").val()+" "+ new Date().toLocaleTimeString();

        $.post("/libs/client_management.php?action=saveClient"+"&dni="+dni+"&nombre="+nombre
        +"&apellido="+apellido+"&direccion="+direccion+"&provincia="+provincia+"&poblacion="+poblacion
        +"&codigo_postal="+codigo_postal+"&telefono="+telefono+"&email="+email+"&created_at="+fechaAlta,
            function(response)
            {
                var mensaje = $("#message");
                var notification = $("#notification");
            
                var resultado = JSON.parse(response);

                if(resultado.success)
                {
                    notification.addClass("alert alert-success");
                }
                else if(resultado.success == null || !resultado.success)
                {
                    notification.addClass("alert alert-danger");
                }
                mensaje.html(resultado.mensaje); 
                $('#saveClientForm')[0].reset();
            }
        );
    });
</script>