<?php
    //Header Section 
    include('libs/header.php');
?>
    <!-- Custom styles for this template -->
    <link href="../assets/css/app.css" rel="stylesheet">
    <div class="container">
        <div class="card border-info bg-info mb-3 text-center" style="width:50rem;">
            <div class="card-header">
                <h5 class="card-title text-center">Filtrar Clientes</h5>
            </div>
            <div class="card-body">
                <fieldset id='fieldset_listar_usuarios' class="text-center">
                    <form id='clientFilterForm'>
                        <div class="form-group row">
                            <label for="filtrarPor" class="col-sm-2 col-form-label">Filtrar</label>
                            <div class="col-sm-3">
                                <select id='filtrarPor' class='form-control'>
                                    <option value="0">Todos</option>
                                    <option value="1">Por dni</option>
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
                                    <option value="dni">Por dni</option>
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
    $('#clientFilterForm').submit(function(e)
    {
        e.preventDefault();
        return false;
    });
    
    var tBody = $("#tbody");
    var pages = 0;
    var content;
    //evento click del boton listar.
    $("#btnListar").click(function()
    {
        var filtro = '';
        if($('#filtro').val() != '')
        {
            filtro = $('#filtro').val()
        }

        $.post("libs/client_management.php?action=getClients&filter="+$('#filtrarPor option:selected').val()
        +'&value='+filtro+'&order='+$('#ordenarPor option:selected').val(),
        function(response)
        {
            tBody.empty();
            var jsonResponse = JSON.parse(response); 
            var rows = jsonResponse.length;
            if( rows >= 10)
            {
                mod = rows%10;
                if(mod > 0 && mod < 4)
                {
                    pages = Math.round(rows/10) + 1;
                }
                else
                {
                    pages = Math.round(rows/10);
                }
            } 
            else
            {
                pages = 1;
            }
            var content = [];
            if(pages > 1)
            {
                var i = 0;
                jsonResponse.foreach
                (
                    function(element)
                    {
                        content.push(element);
                        i++;
                        if(i == 10)
                        {
                            showColumns(JSON.parse(content)); // Dividir en grupos de 10, Mostrar primer grupo, los demas grupos los debe mostrar el panel de paginación.
                        }
                    }
                );
            }
            else
            {
                if(jsonResponse.length > 1)
                {
                    showColumns(jsonResponse);
                } 
                else
                {
                    if(typeof(jsonResponse) == 'object')
                    {
                        showColumns(jsonResponse);
                    }
                    else
                    {
                        showColumns(jsonResponse[0]);
                    }

                }  
            }
        });
    });

    function showColumns(data)
    {
        if(data != null)
        {
            //var clients = JSON.parse(data); 
            
            if(Array.isArray(data) && data.length > 0)
            {
                data.forEach(function(element)
                {
                    showColumn(element);
                });
            }
            else if(typeof(data) == 'object' && data != null)
            {
                showColumn(data);
            }      
        }
        
    }

    function showColumn(element)
    {
      if(element != null)
      {
        var id = element.id;
        tBody.append('<tr id='+id+'>');
        tBody.append('<td id="dni'+id+'">'+element.dni+'</td>');
        tBody.append('<td id="nombre'+id+'">'+element.nombre+'</td>');
        tBody.append('<td id="apellido'+id+'">'+element.apellido+'</td>');
        tBody.append('<td id="direccion'+id+'">'+element.direccion+'</td>');
        tBody.append('<td id="provincia'+id+'">'+element.provincia+'</td>');
        tBody.append('<td id="poblacion'+id+'">'+element.poblacion+'</td>');
        tBody.append('<td id="codigo_postal'+id+'">'+element.codigo_postal+'</td>');
        tBody.append('<td id="telefono'+id+'">'+element.telefono+'</td>');
        tBody.append('<td id="email'+id+'">'+element.email+'</td>');
        tBody.append('<td id="created_at'+id+'">'+element.created_at+'</td>');
        tBody.append('<td scope="row"><button id="btnGet'+id+'" onclick="getRow('+element.id+');"><i class="fas fa-eye"></i></button></td>');
        tBody.append('<td scope="row"><button id="btnUpdate'+id+'" onclick="updateRow('+id+');" data-toggle="modal" data-target="#modificarCliente"><i class="fas fa-edit"></i></button></td>');
        tBody.append('<td scope="row"><button id="btnDelete'+id+'" onclick="deleteRow('+id+');" data-toggle="modal" data-target="#borrarCliente"><i class="fas fa-trash-alt"></i></button></td>');
        tBody.append('</tr>');
      }
    }

    $("#modificarCliente").submit
    (
        function(e)
        {
            e.preventDefault();
            return false;
        }
    );

    function getRow(id)
    { 
        $.get('/libs/client_management.php?action=getUser&id='+id,
            function(response)
            {
               return response;
            }
        );
    }

    //Carga los valores de los campos y actualiza el registro seleccionado.
    function updateRow(id)
    {
        $("#dni").val($("#dni"+id).text());
        $("#nombre").val($("#nombre"+id).text());
        $("#apellido").val($("#apellido"+id).text());
        $("#direccion").val($("#direccion"+id).text());
        $("#provincia").val($("#provincia"+id).text());
        $("#poblacion").val($("#poblacion"+id).text());
        $("#codigo_postal").val($("#codigo_postal"+id).text());
        $("#telefono").val($("#telefono"+id).text());
        $("#email").val($("#email"+id).text());
        
        //Botón que ejecuta la accion de actualización.
        $("#btnActualizarCliente").click(
            function()
            {
                $.post('/libs/client_management.php?action=updateClient&id='+id+'&dni='+$("#dni").val()+'&nombre='+$("#nombre").val()
                +'&apellido='+$("#apellido").val()+'&direccion='+$("#direccion").val()+'&provincia='+$("#provincia").val()
                +'&poblacion='+$("#poblacion").val()+'&codigo_postal='+$("#codigo_postal").val()+'&telefono='+$("#telefono").val()+'&email='+$("#email").val(),
                                
                    function(response)
                    {
                        var mensaje = $("#mensaje");
                        var jsonResponse = JSON.parse(response);
                        if(jsonResponse.success)
                        {
                            mensaje.addClass('alert-success');
                        }
                        else
                        {
                            mensaje.addClass('alert-danger');
                        }

                        mensaje.html(jsonResponse.mensaje);
                    }
                );
            }
        );
 
       $("#closeModal").click(function()
       {
           $("#btnListar").trigger("click");
           $("#mensaje").empty();
           
       });
       
    }

    function deleteRow(id)
    {
        var mensaje ='';
        $("#btnEliminar").click(
            function()
            {
                $.post('/libs/client_management.php?action=deleteClient&id='+id, 
                    function(response)
                    {
                        if(response != null)
                        {
                            jsonResponse = JSON.parse(response);
                            $("#borrarCliente").modal('hide');
                            mensaje = jsonResponse.mensaje;
                            $("#btnListar").trigger("click");   
                        }
                    }
                );  
            }
        );
    }

</script>

<!-- Modal Modificar -->
<div class="modal fade" id="modificarCliente" tabindex="-1" role="dialog" aria-labelledby="ModificarClienteTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modificarClienteLongTitle">Modificar Cliente</h5>
                <button id="closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <p id="mensaje" class="lead"></p>
                </div>
                <form>
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
                        <input type="text" class="form-control" id="codigo_postal" placeholder="codigo_postal">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" id="telefono" placeholder="Télefono">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnActualizarCliente" type="button" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal Modificar -->
<!--Modal borrar-->
<div class="modal" tabindex="-1" role="dialog" id="borrarCliente">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Borrar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Está seguro que desea borrar el cliente seleccionado?</p>
      </div>
      <div class="modal-footer">
        <button id="btnEliminar" type="button" class="btn btn-danger">Eliminar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal borrar -->
