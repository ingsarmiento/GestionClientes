<?php
//Header Section 
include('libs/header.php');
?>
    <!-- Custom styles for this template -->
    <link href="../assets/css/app.css" rel="stylesheet">
    <div class="container">
        <div class="card border-info bg-info mb-3 text-center" style="width:50rem;">
            <div class="card-header">
                <h5 class="card-title text-center">Filtrar Usuarios</h5>
            </div>
            <div class="card-body">
                <fieldset id='fieldset_listar_usuarios' class="text-center">
                    <form id='userFilterForm'>
                        <div class="form-group row">
                            <label for="filtrarPor" class="col-sm-2 col-form-label">Filtrar</label>
                            <div class="col-sm-3">
                                <select id='filtrarPor' class='form-control'>
                                    <option value="0">Todos</option>
                                    <option value="1">Por usuario</option>
                                    <option value="2">Por nombre</option>
                                    <option value="3">Por apellido</option>
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="filtro" name="filtro">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="orderBy" class="col-sm-2 col-form-label">Ordenar por</label>
                            <div class="col-sm-3">
                                <select id='ordenarPor' class='form-control'>
                                    <option value="username">Por usuario</option>
                                    <option value="created_at">Por fecha de alta</option>
                                    <option value="nombre">Por nombre</option>
                                    <option value="apellido">Por apellido</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="form-control btn btn-primary col-sm-2" id='btnListar'>Listar</button>
                        </div>
                    </form>
                </fieldset>
                
            </div>
        </div>
        
        <br>
        <hr>
        <br>
        
        <div class="table-responsive-sm">
            <table class='table table-sm table-bordered'>
                <thead>
                    <tr>
                        <th scope='col'> DNI</th>
                        <th scope='col'> NOMBRE</th>
                        <th scope='col'> APELLIDO</th>
                        <th scope='col'> DIRECCIÓN</th>
                        <th scope='col'> PROVINCIA</th>
                        <th scope='col'> POBLACIÓN</th>
                        <th scope='col'> CÓDIGO POSTAL</th>
                        <th scope='col'> TÉLEFONO </th> 
                        <th scope='col'> EMAIL </th>
                        <th scope='col'> USUARIO </th>
                        <th scope='col'> FECHA DE ALTA</th>
                        <th scope='col'> </th>
                        <th scope='col'> </th>
                        <th scope='col'> </th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    
                </tbody>
            <table/>
        </div>
        
    </div>

<?php
//Footer Section
include('libs/footer.php');
?>

<script>
    
    //Listar Usuarios
    $('#userFilterForm').submit(function(e)
    {
        e.preventDefault();
        return false;
    });
    
    var tBody = $("#tbody");

    //evento click del boton listar.
    $("#btnListar").click(function()
    {
        var filtro = '';
        if($('#filtro').val() != '')
        {
            filtro = $('#filtro').val()
        }
      $.post('libs/user_management.php?action=getUsers&filter='+$('#filtrarPor option:selected').val()
      +'&value='+filtro+'&order='+$('#ordenarPor option:selected').val(),
      function(response){
        tBody.empty();
        showColumns(response);
      });
    });

    function showColumns(data)
    {
        if(data != null)
        {
            var users = JSON.parse(data); 
            
            if(Array.isArray(users) && users.length > 0)
            {
                users.forEach(function(element)
                {
                    showColumn(element);
                });
            }
            else if(typeof(users) == 'object' && users != null)
            {
                showColumn(users);
            }      
        }
        
    }

    function showColumn(element)
    {
      if(element != null)
      {
        tBody.append('<tr>');
        tBody.append('<td scope="row">'+element.dni+'</td>');
        tBody.append('<tdscope="row">'+element.nombre+'</td>');
        tBody.append('<td scope="row">'+element.apellido+'</td>');
        tBody.append('<td scope="row">'+element.direccion+'</td>');
        tBody.append('<td scope="row">'+element.provincia+'</td>');
        tBody.append('<td scope="row">'+element.poblacion+'</td>');
        tBody.append('<td scope="row">'+element.codigo_postal+'</td>');
        tBody.append('<td scope="row">'+element.telefono+'</td>');
        tBody.append('<td scope="row">'+element.email+'</td>');
        tBody.append('<td scope="row">'+element.username+'</td>');
        tBody.append('<td scope="row">'+element.created_at+'</td>');
        tBody.append('<td scope="row"><button id="getUser'+element.id+'"><i class="fas fa-eye"></i></button></td>');
        tBody.append('<td scope="row"><button id="updateUser'+element.id+'" data-toggle="modal" data-target="#modificarUsuario"><i class="fas fa-edit"></i></button></td>');
        tBody.append('<td scope="row"><button id="deleteUser'+element.id+'"'+element.id+' ><i class="fas fa-trash-alt"></i></button></td>');
        tBody.append('</tr>');

        var admin;
        var id;
        $("#getUser"+element.id).click(
                function()
                {
                    $.get('/libs/user_management.php?action=getUser&id='+element.id,
                        function(response)
                        {
                            $("#username").val(element.username);
                            $("#dni").val(element.dni);
                            $("#nombre").val(element.nombre);
                            $("#apellido").val(element.apellido);
                            $("#direccion").val(element.direccion);
                            $("#provincia").val(element.provincia);
                            $("#poblacion").val(element.poblacion);
                            $("#telefono").val(element.telefono);
                            $("#email").val(element.email);
                            $("#admin").val(element.admin);
                        }
                   );
                }
        );
        
        $("#updateUser"+element.id).click(
            function()
            {
                id = element.id;
                $("#username").val(element.username);
                $("#dni").val(element.dni);
                $("#nombre").val(element.nombre);
                $("#apellido").val(element.apellido);
                $("#direccion").val(element.direccion);
                $("#provincia").val(element.provincia);
                $("#poblacion").val(element.poblacion);
                $("#codigo_postal").val(element.codigo_postal);
                $("#telefono").val(element.telefono);
                $("#email").val(element.email);
                admin = $("#admin").prop('checked',element.admin);
                /*$.get('/libs/user_management.php?action=getUser&id='+element.id,
                    function(response)
                    {
                        
                    }
                );*/
            }
        );
        //href="libs/user_management.php?action=getUser&id='+element.id+'"
        //href="libs/user_management.php?action=updateUser&id='+element.id+'"
        //href="libs/user_management.php?action=deleteUsers&id='+element.id+'"
      }
    }

    $("#btnActualizarUsuario").click(
        function()
        {
            if($("#inputAdmin").prop('checked'))
            {
                admin = 1;
            }
            else
            {
                admin = 0;
            }

            $.post('/libs/user_management.php?action=update&id='+id+'&username='+$("#username").val()
            +'&dni='+$("#dni").val()+'&nombre='+$("#nombre").val()+'&apellido='+$("#apellido").val()+'&direccion='+$("#direccion").val()
            +'&provincia='+$("#provincia").val()+'&poblacion='+$("#poblacion").val()+'&codigo_postal='+$("#codigo_postal").val()
            +'&telefono='+$("#telefono").val()+'&email='+$("#email").val()+'&admin='+admin,
                    
                function(response)
                {
                    console.log(response);
                    /*mensaje = $("#mensaje");
                    if(response.success)
                    {
                        mensaje.addClass('alert-success');
                    }
                    else
                    {
                        mensaje.addClass('alert-danger');
                    }

                    mensaje.html(response.mensaje);*/
                }
            );
        }
    );
</script>

<!-- Sección Modificar -->
<!-- Modal -->
<div class="modal fade" id="modificarUsuario" tabindex="-1" role="dialog" aria-labelledby="modificarUsuarioTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p id="mensaje" class="lead"></p>
                <h5 class="modal-title" id="modificarUsuarioLongTitle">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group mx-3 mb-2">
                        <input type="text" class="form-control" id="username" placeholder="Usuario">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" id="dni" placeholder="DNI">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" id="apellido" placeholder="Apellido">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" id="direccion" placeholder="Dirección">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" id="provincia" placeholder="Provincia">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" id="poblacion" placeholder="Población">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" id="codigo_postal" placeholder="Código Postal">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" id="telefono" placeholder="Télefono">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-check mx-sm-3 mb-2">
                        <input type="checkbox" class="form-check-input" id="admin">
                        <label for="admin" class="form-check-label">Administrador</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnActualizarUsuario" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>
