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

    <?php foreach($response as $key=>$value): ?>
	  <p class="text-center" id="proceso<?php echo $key; ?>">
      <strong>ID</strong>: <?php echo $value["ID"]; ?> <strong>Subaplicativo</strong>: <?php echo $value["NOMBRE"]; ?> <br/> <strong>AFA: </strong> <?php echo $value["AFA"]; ?>
    </p>
    <?php
    if( $_SESSION['c'] == "1"){
      revisado($value["ID"]);
    }
    ?>
    <div id="subtitle">
    <a class="button secondary" href="index.php">Volver</a>
  </div>
		<div class="servidores" id="servidoresk" >
        <h4>Servidores Kenos</h4> <a href="agregar_servidor.php?id=<?php echo $value['ID']?>&server=kenos" title="" class="button">Agregar</a>
        <table id="servidork" name="<?php echo $value['ID'] ?>">
          <thead>
            <tr>
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
    <div class="servidores" id="servidoresm" >
        <h4>Servidores Morande</h4> <a href="agregar_servidor.php?id=<?php echo $value['ID']?>&server=morande" title="" class="button">Agregar</a>
        <table id="servidorm" name="<?php echo $value['ID'] ?>">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Sistema Operativo</th>
              <th>IP</th>
              <th>Granja</th>
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
