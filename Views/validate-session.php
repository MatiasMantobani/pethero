<?php
  if(!isset($_SESSION["loggedUser"]))
    header('location:../Index.php');  //el header es relativo al path desde donde llamas al validate-session.php. Es decir, puede ser desde los controllers u otro path
?>

<!-- Creo que hay que verificar para cada tipo de usuario (dueno, guardian y admin) -->
<!-- quedaria algo asi (?)

if(isset($_SESSION['user']))
            if($_SESSION['type'] == 'T') {

 -->