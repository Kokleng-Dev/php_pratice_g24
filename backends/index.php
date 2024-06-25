<?php include("../configs/global.php"); ?>

<?php include("layouts/header.php"); ?>

<?php
  $status = -1;
  $sms = "";
  if(isset($_GET['status'])){
    if($_GET['status'] == 1){
      $status = 1;
      setcookie('auth', true, time() + 30);
    }
  }
  if(isset($_GET['sms'])){
    $sms = $_GET['sms'];
  }
  if(isset($_COOKIE['auth'])){
    // need login
    if($_COOKIE['auth'] == false){
      header("Location: " . route('login'));
    }
  }
?>
  <div style="padding:12px;">
      <?php 
        if($status == 1){
          echo "<div class='alert alert-success'>". $sms ."</div>";
        }
      ?>
      <h2>Welcome</h2>
      <?php
        // setcookie('kokleng','hello world',time() + 20);
      ?>
  </div>
                

<?php include("layouts/bottom.php"); ?>