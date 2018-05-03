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
                            <!--div class="col-sm-5">
                                <input type="text" class="form-control" id="orderBy" placeholder="">
                            </div-->
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
        console.log(filtro);
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
        tBody.append('<td>'+element.dni+'</td>');
        tBody.append('<td>'+element.nombre+'</td>');
        tBody.append('<td>'+element.apellido+'</td>');
        tBody.append('<td>'+element.direccion+'</td>');
        tBody.append('<td>'+element.provincia+'</td>');
        tBody.append('<td>'+element.poblacion+'</td>');
        tBody.append('<td>'+element.telefono+'</td>');
        tBody.append('<td>'+element.email+'</td>');
        tBody.append('<td>'+element.username+'</td>');
        tBody.append('<td>'+element.created_at+'</td>');
        tBody.append('<td><a href="libs/user_management.php?action=getUser&id='+element.id+'">Detalle</a></td>');
        tBody.append('<td><a href="libs/user_management.php?action=updateUser&id='+element.id+'">Modificar</a></td>');
        tBody.append('<td><a href="libs/user_management.php?action=deleteUsers&id='+element.id+'">Eliminar</a></td>');
        tBody.append('</tr>');
      }
    }
</script>

<!-- Sección Modificar -->