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
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="orderBy" placeholder="">
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
                        <th scope='col'> NOMBRE</th>
                        <th scope='col'> APELLIDO</th>
                        <th scope='col'> DIRECCIÓN</th>
                        <th scope='col'> TÉLEFONO </th>
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