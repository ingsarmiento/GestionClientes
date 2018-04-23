<?php
//Header Section 
include('libs/header.php');
?>
    <!-- Custom styles for this template -->
    <link href="../assets/css/app.css" rel="stylesheet">
    <div class="container">
        <form>
            <div class="form-group row">
                <label for="filtrarPor" class="col-sm-2 col-form-label">Filtrar</label>
                <div class="col-sm-3">
                    <select id='filtrarPor' class='form-control'>
                        <option value="0">Todos</option>
                        <option value="1">Por usuario</option>
                        <option value="2">Pord dni</option>
                        <option value="3">Por nombre</option>
                        <option value="4">Por apellido</option>
                    </select>
                </div>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="filtro" name="filtro">
                </div>
            </div>
            <div class="form-group row">
                <label for="orderBy" class="col-sm-2 col-form-label">Ordenar por</label>
                <div class="col-sm-3">
                    <select id='ordenarPor' class='form-control'>
                        <option value="0">Por fecha de alta</option>
                        <option value="1">Por usuario</option>
                        <option value="2">Por dni</option>
                        <option value="3">Por nombre</option>
                        <option value="4">Por apellido</option>
                    </select>
                </div>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="orderBy" placeholder="">
                </div>
            </div>
            <button type="submit" class="form-control btn btn-primary col-sm-2">Listar</button>
        </form>
        <br>
        <hr>
        <br>
        
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th scope='col'> DNI </th>
                    <th scope='col'> NOMBRE</th>
                    <th scope='col'> APELLIDO</th>
                    <th scope='col'> DIRECCIÓN</th>
                    <th scope='col'> TÉLEFONO </th>
                    <th scope='col'> EMAIL</th>
                    <th scope='col'> USUARIO </th>
                    <th scope='col'> FECHA DE ALTA</th>
                    <th scope='col'> </th>
                    <th scope='col'> </th>
                    <th scope='col'> </th>
                </tr>
            </thead>
            <tbody>
                <?php

                ?>
            </tbody>
        <table/>
    </div>

<?php
//Footer Section
include('libs/footer.php');
?>