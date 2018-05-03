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
        
        <div class="table-responsive">
            <table class='table table-bordered'>
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

    //evento click del boton listar.
    $("#btnListar").click(function()
    {
        var filtro = '';
        if($('#filtro').val() != '')
        {
            filtro = $('#filtro').val()
        }
      $.post('libs/client_management.php?action=getClients&filter='+$('#filtrarPor option:selected').val()
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
            var clients = JSON.parse(data); 
            
            if(Array.isArray(clients) && clients.length > 0)
            {
                clients.forEach(function(element)
                {
                    showColumn(element);
                });
            }
            else if(typeof(clients) == 'object' && clients != null)
            {
            showColumn(userclients);
            }      
        }
        
    }

    function showColumn(element)
    {
      if(element != null)
      {
        tBody.append('<tr>');
        tBody.append('<td>'+element.dni+'</td>');
        tBody.append('<td>'+element.nombre+'</td>');
        tBody.append('<td>'+element.apellido+'</td>');
        tBody.append('<td>'+element.direccion+'</td>');
        tBody.append('<td>'+element.provincia+'</td>');
        tBody.append('<td>'+element.poblacion+'</td>');
        tBody.append('<td>'+element.codigo_postal+'</td>');
        tBody.append('<td>'+element.telefono+'</td>');
        tBody.append('<td>'+element.email+'</td>');
        tBody.append('<td>'+element.created_at+'</td>');
        tBody.append('<td><i class="fas fa-eye"><a href="libs/client_management.php?action=getClient&id='+element.id+'">Detalle</a></i></td>');
        tBody.append('<td><i class="fas fa-edit"><a href="libs/client_management.php?action=updateClient&id='+element.id+'">Modificar</a></i></td>');
        tBody.append('<td><i class="fas fa-trash-alt"><a href="libs/client_management.php?action=deleteClient&id='+element.id+'">Eliminar</a></i></td>');
        tBody.append('</tr>');
      }
    }
</script>

<!-- Modal -->
<div class="modal fade" id="modificarCliente" tabindex="-1" role="dialog" aria-labelledby="ModificarClienteTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modificarClienteLongTitle">Modificar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                        <input type="text" class="form-control" id="dirección" placeholder="Dirección">
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
                <button type="button" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>
