<?php
    //Header Section 
    include('libs/header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card border-info col-sm-6 offset-3" id="password_card">
                    <div class="card-header">
                        <h3>Cambiar Contraseña <span class="extra-title muted"></span></h3>
                    </div>
                    <div class="card-body">
                        <form role="form">
                            <fieldset>
                                <div class="form-group row">
                                    <label for="current_password" class="col-sm-4 col-form-label text-right">Current Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="current_password" id="current_password" class="col-sm-12" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="new_password" class="col-sm-4 col-form-label text-right">New Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="new_password" id="new_password" class="col-sm-12" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="confirm_password" class="col-sm-4 col-form-label text-right">Confirm Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="confirm_password" id="confirm_password" class="col-sm-12" required>
                                    </div>
                                </div> 
                            </fieldset>
                        </form> 
                    </div>
                    <div class="card-footer text-right">
                        <button href="#" class="btn btn-primary" id="password_card_save">Guardar Cambios</button>
                    </div>
            </div>

            <div class="row" id="containerMensaje">
                <p class="lead" id="mensaje"> </p>
            </div>
        </div>
    </div>
</div>

<?php
    //Footer Section 
    include('libs/footer.php');
?>

<script>

    $('#password_card_save').click
    (
        function()
        {
            changePassword();
        }
    );

    function changePassword()
    {
        $.post('/libs/user_management.php?action=changePassword&current_password='+$('#current_password').val()
        +'&new_password='+$('#new_password').val()+'&confirm_password='+$('#confirm_password').val(), 
            function(response)
            {
                if(response)
                {
                    console.log(response);
                    if(response.success)
                    {
                        $("containerMensaje").removeClass("alert-danger");
                        $("containerMensaje").addClass("alert-success");
                    }
                    else
                    {
                        $("containerMensaje").removeClass("alert-success");
                        $("containerMensaje").addClass("alert-danger");
                    }
                    
                    $("#mensaje").html(response.mensaje);
                }
            }
        );
    }


</script>