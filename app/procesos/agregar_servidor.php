<?php
include('../../ajax/validarSesion.php');
?>
<!DOCTYPE html>
<html>

<?php
include('../Layout/Head.php');
include('../Layout/Header.php');
?>
<body>

  <?php
  $response = getResponsableSubaplicativo( $_SESSION['nombre'],$_GET["id"]);
  ?>

    <div id="container">
      <p class="text-center" id="proceso">
        <strong>ID</strong>: <?php echo $response[0]["ID"]; ?> <strong>Subaplicativo</strong>: <?php echo $response[0]["NOMBRE"]; ?> <br/> <strong>AFA: </strong> <?php echo $response[0 ]["AFA"]; ?>
      </p>
      <div id="subtitle">
      <h3>Servidores</h3>
      <a class="button secondary" href="subaplicativos.php?id=<?php echo $_GET["id"];?>">Volver</a>
      </div>
      <div class="grid-container">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar">
      <table id="resultado-servidor">
        <thead
        ><tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Sistema Operativo</th>
          <th>IP</th>
          <th>Base de datos</th>
          <th>Granja</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
      </table>
      </div>
    </div>
    <script src="../js/app.js"></script>

</body>
<?php
include('../Layout/Footer.php');
?>
</html>
