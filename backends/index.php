<?php include("../configs/global.php"); ?>

<?php include("layouts/header.php"); ?>

<?php
    if($_SESSION['is_login'] == false){
        header("Location: ". route('login'));
    }
?>

  <div style="padding:12px;">
      <?php include("../configs/message.php"); ?>
      <h2>Welcome</h2>
      <?php
        // setcookie('kokleng','hello world',time() + 20);
      ?>
  </div>
                

<?php include("layouts/bottom.php"); ?>