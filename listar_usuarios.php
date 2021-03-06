<?php
//Header Section 
include('libs/header.php');
?>
    <!-- Custom styles for this template -->
    <link href="../assets/css/app.css" rel="stylesheet">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card border-info bg-info col-md-10 offset-1">
                    <div class="card-header">
                        <h5 class="card-title text-center text-white">Filtrar Usuarios</h5>
                    </div>
                    <div class="card-body">
                        <fieldset id='fieldset_listar_usuarios' class="text-center">
                            <form id='userFilterForm'>
                                <div class="form-group row">
                                    <label for="filtrarPor" class="col-sm-2 col-form-label text-white text-right"><b>Filtrar</b></label>
                                    <div class="col-sm-3">
                                        <select id='filtrarPor' class='form-control'>
                                            <option value="0">Todos</option>
                                            <option value="1">Por usuario</option>
                                            <option value="2">Por nombre</option>
                                            <option value="3">Por apellido</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="filtro" name="filtro">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="orderBy" class="col-sm-2 col-form-label text-white text-right"><b>Ordenar Por</b></label>
                                    <div class="col-sm-3">
                                        <select id='ordenarPor' class='form-control'>
                                            <option value="username">Por usuario</option>
                                            <option value="created_at">Por fecha de alta</option>
                                            <option value="nombre">Por nombre</option>
                                            <option value="apellido">Por apellido</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <select id='orderType' class='form-control'>
                                            <option value="asc">Ascendente</option>
                                            <option value="desc">Descendente</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="button" class="form-control btn btn-primary col-sm-1" id='btnListar'>Listar</button>
                                </div>
                            </form>
                        </fieldset>
                        
                    </div>
            </div>

            <br>
            <br>
        
            <div class="d-none table-responsive" id="resultTable">
                <table class="table table-sm table-bordered small col-sm-10">
                    <thead>
                        <tr>
                            <th scope="col"> Dni</th>
                            <th scope="col"> Nombre</th>
                            <th scope="col"> Apellido</th>
                            <th scope="col"> Dirección</th>
                            <th scope="col"> Provincia</th>
                            <th scope="col"> Población</th>
                            <th scope="col"> C. Postal</th>
                            <th scope="col"> Teléfono </th> 
                            <th scope="col"> Email </th>
                            <th scope="col"> Usuario </th>
                            <th scope="col"> Fec. Alta</th>
                            <th scope="col"> Admin</th>
                            <!--th class="col-sm-1" scope="col"> </th-->
                            <th scope="col"> </th>
                            <th scope="col"> </th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        
                    </tbody>
                <table/>
            </div>

            <div id="mensaje" class="d-flex justify-content-center">
                <p id="mensajeConsulta"></p>
            </div>
            <div class="d-flex justify-content-center">
                <ul id="pagination-users" class="pagination-sm pagination">
                </ul>
            </div>
                </div>
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
    var pages = 0;
    var content = [];
    var visible = 0;
    var jsonResponse; 
    var rows = 0;
    var mod = null;
    var contents = [];
    var start = 0;
    var fin = 0;
    var pag = 0;
    var contentSize = 0;

    //evento click del boton listar.
    $("#btnListar").click(function()
    {
        var filtro = "";
        if($('#filtro').val() != "")
        {
            filtro = $('#filtro').val()
        }

      $.post('libs/user_management.php?action=getUsers&filter='+$('#filtrarPor option:selected').val()
      +'&value='+filtro+'&order='+$('#ordenarPor option:selected').val()+" "+$("#orderType option:selected").val(),
      function(response)
      {
        tBody.empty();
        if(response)
        {
            jsonResponse = JSON.parse(response); 
            if(jsonResponse != null)
            {
                if(jsonResponse.hasOwnProperty("length"))
                {
                    rows = jsonResponse.length;
                }
                else if(!jsonResponse.hasOwnProperty("length") && jsonResponse)
                {
                    rows = 1;
                }
                
                $("#resultTable").removeClass('d-none');
            }
        }
        else
        {
            $("#resultTable").addClass('d-none');
        }
        
        
        if(rows > 0)
        {
            mod = rows % 10;
        }

        if( rows >= 10)
        {
            if(mod != null)
            {
                 if(mod > 0 && mod < 4)
                {
                    pages = Math.round(rows/10) + 1;
                }
                else
                {
                    pages = Math.round(rows/10);
                }
            }
           
        } 
        else if(rows > 0 && rows < 9)
        {
            pages = 1;
        }

        mensaje = $('#mensajeConsulta');
        $('#pagination-users').empty();
        if(pages > 1)
        {
            contents = [];
            contents = setContent(jsonResponse, pages);
            contentSize = contents[0].length;
            
            showColumns(contents[0]);
            start = 0;
            fin = 0;
            start = fin + 1;
            fin = fin + contentSize;

            $('#pagination-users').append('<li class="page-item first disabled"><a href="#" class="page-link">Primero</a></li>');
            $('#pagination-users').append('<li class="page-item prev disabled"><a href="#" class="page-link">Anterior</a></li>');
            for(i=1; i<=pages; i++)
            {
                $('#pagination-users').append('<li class="page-item"><a href="#" class="page-link">'+i+'</a></li>');
            }
            $('#pagination-users').append('<li class="page-item next"><a href="#" class="page-link">Siguiente</a></li>');
            $('#pagination-users').append('<li class="page-item last"><a href="#" class="page-link">Ultimo</a></li>');
            //mensaje.text('Mostrando resultados '+start+' a '+ fin +' de '+ rows +' resultados. ');
        }
        else if(pages == 1)
        {
            contents = [];
            contents = setContent(jsonResponse, pages);
            contentSize = contents[0].length;
            showColumns(contents[0]);

            start = 0;
            /*fin = 0;
            start = fin + 1;
            fin = fin + contentSize;*/

            $('#pagination-users').append('<li class="page-item first disabled"><a href="#" class="page-link">Primero</a></li>');
            $('#pagination-users').append('<li class="page-item prev disabled"><a href="#" class="page-link">Anterior</a></li>');
            $('#pagination-users').append('<li class="page-item disabled"><a href="#" class="page-link">1</a></li>');
            $('#pagination-users').append('<li class="page-item next disabled"><a href="#" class="page-link">Siguiente</a></li>');
            $('#pagination-users').append('<li class="page-item last disabled"><a href="#" class="page-link">Ultimo</a></li>');
            //mensaje.text('Mostrando resultados '+start+' a '+ fin +' de '+ rows +' resultados. ');
        }
        else
        {
            pages = 0;
        }

        
        if(visible > 0)
        {
            //Pagination 
            $('#pagination-users').twbsPagination
            (
                {
                    totalPages: pages,
                    visiblePages: visible,
                    onPageClick: function (event, page) 
                    {
                        pag = page-1;
                        start = fin + 1;
                        fin = fin + contents[pag].length;
                        tBody.empty();
                        //mensaje.text('Mostrando resultados '+start+' a '+ fin +' de '+ rows +' resultados. ');
                        showColumns(contents[pag]);
                    }
                }
            );
        }
        else
        {
            $("#resultTable").addClass('d-none');
            mensaje.text('La consulta no ha devuelto resultados');
        }
      }
    );
    }
);

    /**
     * Establecemos todo el contenido de la tabla separado en grupos de 10.
     * Cada grupo representa una pagina. El ultimo elemento puede contener 10 o menos filas.
     * @param response Respuesta a la petición de datos de usuarios.
     * @param pages Numero de páginas a mostrar en la tabla.
     * @return un array con todo el contenido de la tabla, agrupado en filas de 10 elementos.  
     */
    function setContent(response, pages)
    {
        var content = [];
        if(response)
        {
            if(response.hasOwnProperty("length"))
            {
                 response.forEach
                (
                    function(element)
                    {
                        /**
                        * Si el Array Content tiene 10 elementos o el número de elementos del array principal contents
                        *  es igual al numero de paginas - 1, se ha agrega content al array principal contents.
                        */
                        content.push(element);
                        if(content.length == 10 || (pages == 1 && content.length == response.length) || (pages > 1 && contents.length == pages - 1 && content.length == mod))
                        {
                            contents.push(content);
                            content = [];
                        }
                    }
                );
            }
            else
            { 
                content.push(response);
                contents.push(content);
                content = [];
            }
            
            if(contents.length < 5)
            {
                visible = contents.length;
            }
            else if(contents.length >= 5)
            {
                visible = 5;
            }
            else if(contents.length == 0)
            {
                rows = 0;
                visible = 0;
            }
        }
        return contents;
    }

    function showColumns(data)
    {
        if(data != null)
        {
            if(Array.isArray(data) && data.length > 0)
            {
                data.forEach(function(element)
                {
                    showColumn(element);
                });
            }
            else if(typeof(data) == 'object')
            {
                showColumn(data);
            }      
        }
    }

    function showColumn(element)
    {
        if(element != null)
        {
            var administrador = "No";
            if(element.admin)
            {
                administrador = "Si";
            }
            tBody.append('<tr id="'+element.id+'">');
            tBody.append('<th scope="row" id="dni'+element.id+'">'+element.dni+'</th>');
            tBody.append('<td id="nombre'+element.id+'">'+element.nombre+'</td>');
            tBody.append('<td id="apellido'+element.id+'">'+element.apellido+'</td>');
            tBody.append('<td id="direccion'+element.id+'">'+element.direccion+'</td>');
            tBody.append('<td id="provincia'+element.id+'">'+element.provincia+'</td>');
            tBody.append('<td id="poblacion'+element.id+'">'+element.poblacion+'</td>');
            tBody.append('<td id="codigo_postal'+element.id+'">'+element.codigo_postal+'</td>');
            tBody.append('<td id="telefono'+element.id+'">'+element.telefono+'</td>');
            tBody.append('<td id="email'+element.id+'">'+element.email+'</td>');
            tBody.append('<td id="username'+element.id+'">'+element.username+'</td>');
            tBody.append('<td id="created_at'+element.id+'">'+new Date(element.created_at).toLocaleDateString("es-ES")+'</td>');
            tBody.append('<td class="text-center" id="admin'+element.id+'">'+administrador+'</td>');
            //tBody.append('<td><button id="getUser'+element.id+'" onclick="getRow('+element.id+');"><i class="fas fa-eye"></i></button></td>');
            tBody.append('<td><button id="updateUser'+element.id+'" onclick="updateRow('+element.id+');" data-toggle="modal" data-target="#modificarUsuario"><i class="fas fa-edit"></i></button></td>');
            tBody.append('<td><button id="deleteUser'+element.id+'" onclick="deleteRow('+element.id+');" data-toggle="modal" data-target="#borrarUsuario"><i class="fas fa-trash-alt"></i></button></td>');
            
            tBody.append('</tr>');
        }
    }

    $("#modificarUsuario").submit(function(e)
    {
        e.preventDefault();
        return false;
    });

    function getRow(id)
    { 
        $.get('/libs/user_management.php?action=getUser&id='+id,
            function(response)
            {
               return response;
            }
        );
    }

    //Carga los valores de los campos y actualiza el registro seleccionado.
    function updateRow(id)
    {
        $("#username").val($("#username"+id).text());
        $("#dni").val($("#dni"+id).text());
        $("#nombre").val($("#nombre"+id).text());
        $("#apellido").val($("#apellido"+id).text());
        $("#direccion").val($("#direccion"+id).text());
        $("#provincia").val($("#provincia"+id).text());
        $("#poblacion").val($("#poblacion"+id).text());
        $("#codigo_postal").val($("#codigo_postal"+id).text());
        $("#telefono").val($("#telefono"+id).text());
        $("#email").val($("#email"+id).text());
        
        //Marca o desmarca el check de usuario Administrador.
        if($("#admin"+id).text() == 1)
        {
            $("#admin").prop('checked', true);
        }
        else
        {
            $("#admin").prop('checked', false);
        }
        
        //Botón que ejecuta la accion de actualización.
        $("#btnActualizarUsuario").click(
            function()
            {
                var admin = 0;

                if($("#admin").prop('checked'))
                {
                    admin = 1;
                }
                else
                {
                    admin = 0;
                }
               
                $.post('/libs/user_management.php?action=updateUser&id='+id+'&username='+$("#username").val()
                +'&dni='+$("#dni").val()+'&nombre='+$("#nombre").val()+'&apellido='+$("#apellido").val()+'&direccion='+$("#direccion").val()
                +'&provincia='+$("#provincia").val()+'&poblacion='+$("#poblacion").val()+'&codigo_postal='+$("#codigo_postal").val()
                +'&telefono='+$("#telefono").val()+'&email='+$("#email").val()+'&admin='+admin,
                                
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
                $.post('/libs/user_management.php?action=deleteUser&id='+id, 
                    function(response)
                    {
                        if(response != null)
                        {
                            jsonResponse = JSON.parse(response);
                            $("#borrarUsuario").modal('hide');
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
<div class="modal fade" id="modificarUsuario" tabindex="-1" role="dialog" aria-labelledby="modificarUsuarioTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modificarUsuarioLongTitle">Editar Usuario</h5>
                
                <button id="closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <p id="mensaje" class="lead"></p>
                </div>
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
<!-- Fin Modal Modificar -->

<!-- Modal borrar -->
<div class="modal" tabindex="-1" role="dialog" id="borrarUsuario">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Borrar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Está seguro que desea borrar el usuario seleccionado?</p>
      </div>
      <div class="modal-footer">
        <button id="btnEliminar" type="button" class="btn btn-danger">Eliminar</button>
        <button id="btnCerrar" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal Borrar -->