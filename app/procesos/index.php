<?php
include("../API/mysqlconnection.php");
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
    $response = getResponsable( $_SESSION['nombre']);
     ?>

    <div id="container">

    <?php foreach($response as $key=>$value): ?>
	  <p class="text-center" id="proceso<?php echo $key; ?>">
      <strong>ID</strong>: <?php echo $value["ID"]; ?> <strong>Aplicativo</strong>: <?php echo $value["NOMBRE"]; ?> <strong>TRIPLETA</strong>: <?php echo $value["TRIPLETA"]; ?> <br/> <strong>RA: </strong> <?php echo $value["RA"]; ?>
    </p>
		<div class="aplicativo" id="aplicativo" >
        <h4>Subaplicativos</h4>
        <table id="subaplicaciones<?php echo $key; ?>" name="<?php echo $value['ID'] ?>,<?php echo $value['RAU'] ?>">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>AFA</th>
              <th>RA</th>
              <th>Finalizado</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
    </div>
    <hr>
    <?php endforeach; ?>
    </div>

</body>
<?php
include('../Layout/Footer.php');
?>

</html>
