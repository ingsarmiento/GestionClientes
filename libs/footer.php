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
      $('#userFilterForm').submit(function(e){
        e.preventDefault();
    });

    //evento click del boton listar.
    $("#btnListar").click(function(){
      $.post('libs/user_management.php?action=getUsers&filter='+$('#filtrarPor option:selected').val()
      +'&order='+$('#ordenarPor option:selected').val(),
      function(response){
        $("#tbody").html(response);
      });
    });

    </script>
  </body>
</html>