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
                        <h5 class="card-title text-center text-white">Filtrar Clientes</h5>
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
                                    <div class="col-sm-4">
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
                                    <div class="col-sm-4">
                                        <select id='orderType' class='form-control'>
                                            <option value="asc">Ascendente</option>
                                            <option value="desc">Descendente</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="form-control btn btn-primary col-sm-1" id='btnListar'>Listar</button>
                                </div>
                            </form>
                        </fieldset>
                        
                    </div>
                </div>
                
                <br>
                <hr>
                <br>
                
                <div class="table-responsive-sm" id="resultTable">
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

                <div >
                    <div id="mensaje" class="d-flex justify-content-center">
                        <p id="mensajeConsulta"></p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <ul id="pagination-clients" class="pagination-sm pagination">
                        </ul>
                    </div>
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
    $('#clientFilterForm').submit(function(e)
    {
        e.preventDefault();
        return false;
    });
    
    var tBody = $("#tbody");
    var pages = 0;
    var content;
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
        var filtro = '';
        if($('#filtro').val() != '')
        {
            filtro = $('#filtro').val()
        }

        $.post("libs/client_management.php?action=getClients&filter="+$('#filtrarPor option:selected').val()
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
        $('#pagination-clients').empty();
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

            $('#pagination-clients').append('<li class="page-item first disabled"><a href="#" class="page-link">Primero</a></li>');
            $('#pagination-clients').append('<li class="page-item prev disabled"><a href="#" class="page-link">Anterior</a></li>');
            for(i=1; i<=pages; i++)
            {
                $('#pagination-clients').append('<li class="page-item"><a href="#" class="page-link">'+i+'</a></li>');
            }
            $('#pagination-clients').append('<li class="page-item next"><a href="#" class="page-link">Siguiente</a></li>');
            $('#pagination-clients').append('<li class="page-item last"><a href="#" class="page-link">Ultimo</a></li>');
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

            $('#pagination-clients').append('<li class="page-item first disabled"><a href="#" class="page-link">Primero</a></li>');
            $('#pagination-clients').append('<li class="page-item prev disabled"><a href="#" class="page-link">Anterior</a></li>');
            $('#pagination-clients').append('<li class="page-item disabled"><a href="#" class="page-link">1</a></li>');
            $('#pagination-clients').append('<li class="page-item next disabled"><a href="#" class="page-link">Siguiente</a></li>');
            $('#pagination-clients').append('<li class="page-item last disabled"><a href="#" class="page-link">Ultimo</a></li>');
            //mensaje.text('Mostrando resultados '+start+' a '+ fin +' de '+ rows +' resultados. ');
        }
        else
        {
            pages = 0;
        }

        
        if(visible > 0)
        {
            //Pagination 
            $('#pagination-clients').twbsPagination
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
    });

    /**
     * Establecemos todo el contenido de la tabla separado en grupos de 10.
     * Cada grupo representa una pagina. El ultimo elemento puede contener 10 o menos filas.
     * @param response Respuesta a la petición de datos de clientes.
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
        tBody.append('<td scope="row" id="dni'+id+'">'+element.dni+'</td>');
        tBody.append('<td scope="row" id="nombre'+id+'">'+element.nombre+'</td>');
        tBody.append('<td scope="row" id="apellido'+id+'">'+element.apellido+'</td>');
        tBody.append('<td scope="row" id="direccion'+id+'">'+element.direccion+'</td>');
        tBody.append('<td scope="row" id="provincia'+id+'">'+element.provincia+'</td>');
        tBody.append('<td scope="row" id="poblacion'+id+'">'+element.poblacion+'</td>');
        tBody.append('<td scope="row" id="codigo_postal'+id+'">'+element.codigo_postal+'</td>');
        tBody.append('<td scope="row" id="telefono'+id+'">'+element.telefono+'</td>');
        tBody.append('<td scope="row" id="email'+id+'">'+element.email+'</td>');
        tBody.append('<td scope="row" id="created_at'+id+'">'+new Date(element.created_at).toLocaleDateString("es-ES")+'</td>');
        tBody.append('<td scope="row"><button id="btnGet'+id+'" onclick="getRow('+element.id+');"><i class="fas fa-eye"></i></button></td>');
        tBody.append('<td scope="row"><button id="btnUpdate'+id+'" onclick="updateRow('+id+');" data-toggle="modal" data-target="#modificarCliente"><i class="fas fa-edit"></i></button></td>');
        tBody.append('<td><button id="btnDelete'+id+'" onclick="deleteRow('+id+');" data-toggle="modal" data-target="#borrarCliente"><i class="fas fa-trash-alt"></i></button></td>');
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
