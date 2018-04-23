<?php
//Header Section 
include('libs/header.php');
?>
    <!-- Custom styles for this template -->
    <link href="../assets/css/app.css" rel="stylesheet">
    <div class="container">
        <form>
            <div class="form-group row">
                <label for="filtro" class="col-sm-2 col-form-label">Filtrar por</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="filtro">
                </div>
            </div>
            <div class="form-group row">
                <label for="orderBy" class="col-sm-2 col-form-label">Ordenar por</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="orderBy" placeholder="">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Listar</button>
        </form>
    </div>

<?php
//Footer Section
include('libs/footer.php');
?>