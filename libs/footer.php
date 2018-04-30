<footer class="container">
      <p>&copy; Company 2017-2018</p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <!--script src="../assets/js/jquery-3.3.1.slim.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')</script-->
    <script src="../assets/js/vendor/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    <script>
    
    //Area de usuarios

    //Listar Usuarios
    $('#userFilterForm').submit(function(e)
    {
        /*e.preventDefault();
        return false;*/
    });
    
    var tBody = $("#tbody");
    //evento click del boton listar.
    $("#btnListar").click(function()
    {
      $.post('libs/user_management.php?action=getUsers&filter='+$('#filtrarPor option:selected').val()
      +'&value='+$('#filtro').val()+'&order='+$('#ordenarPor option:selected').val(),
      function(response){

        showColumns(response);
      });
    });

    function showColumns(data)
    {
        var users = JSON.parse(data);   console.log(users);
        tBody.empty();
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
    function showColumn(element)
    {
      if(element != null)
      {
        tBody.append('<tr>');
        tBody.append('<td>'+element.nombre+'</td>');
        tBody.append('<td>'+element.apellido+'</td>');
        tBody.append('<td>'+element.direccion+'</td>');
        tBody.append('<td>'+element.telefono+'</td>');
        tBody.append('<td>'+element.email+'</td>');
        tBody.append('<td>'+element.username+'</td>');
        tBody.append('<td>'+element.created_at+'</td>');
        tBody.append('<td><a href="libs/user_management.php?action=getUser&id='+element.id+'">Detalle</a></td>');
        tBody.append('<td><a href="libs/user_management.php?action=updateUser&id='+element.id+'">Modificar</a></td>');
        tBody.append('<td><a href="libs/user_management.php?action=deleteUsers&id='+element.id+'">Eliminar</a></td>');
        tBody.append('</tr><a></a>');
      }
    }

    //Guardar Usuario
    function guardarUsuario()
    {
      var username = $("#username").val();
      var password = $("#password").val();
      var dni = $("#dni").val();
      var nombre = $("#nombre").val();
      var apellido = $("#apellido").val();
      var direccion = $("#direccion").val();
      var telefono = $("#telefono").val();
      var mail = $("#email").val();
      var admin = $("#admin").val();

      //Enviar datos 
      $.ajax(
        {
          type:"POST",
          url:"libs/user_management.php",
          data:
          {
            username:username, password:password, dni:dni, nombre:nombre, apellido:apellido,
            direccion:direccion, telefono:telefono, email:email, admin:admin  
          },
          dataType:"JSON",
          success: function(data)
          {
            $("#message").html(data);
            $("p").addClass("alert alert-success");
            
          },
          error: function(err)
            {
              alert(err);
            }
        });

    }

    //Fin Area de usuarios


    //Area de clientes.


    //Fin Area de clientes.

    </script>
  </body>
</html>