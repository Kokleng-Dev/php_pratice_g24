<nav class="navbar navbar-expand-lg bg-info-subtle p-0">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo $burl . "/admin/index.php"; ?>">
        <img src="#" class="rounded-circle" style="width: 50px; height: 50px;" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item <?php echo $page == 'home' ? "navActive" : " "; ?>">
          <a class="nav-link" aria-current="page" href="<?php echo $burl . "/admin/index.php"; ?>"><i class="fas fa-laptop-house"></i> Home</a>
        </li>
        <li class="nav-item <?php echo $page == 'customer' ? "navActive" : " "; ?>">
          <a class="nav-link" href="<?php echo $burl . "/admin/customers/index.php"; ?>"><i class="fas fa-walking"></i> Customer</a>
        </li>
        <li class="nav-item <?php echo $page == 'product' ? "navActive" : " "; ?>">
          <a class="nav-link" href="<?php echo $burl . "/admin/products/index.php"; ?>"><i class="fas fa-boxes"></i> Product</a>
        </li>
        <li class="nav-item <?php echo $page == 'order' ? "navActive" : " "; ?>">
          <a class="nav-link" href="<?php echo $burl . "/admin/product_orders/index.php"; ?>"><i class="fas fa-cart-arrow-down"></i> Order</a>
        </li>
        <li class="nav-item <?php echo $page == 'category' ? "navActive" : " "; ?>">
          <a class="nav-link" href="<?php echo $burl . "/admin/product_categories/index.php"; ?>"><i class="fas fa-luggage-cart"></i> Category</a>
        </li>
        <li class="nav-item <?php echo $page == 'user' ? "navActive" : " "; ?>">
          <a class="nav-link" href="<?php echo $burl . "/admin/users/index.php"; ?>"><i class="fas fa-user"></i>User</a>
        </li>
      </ul>
      <ul class="navbar-nav d-flex justify-content-end w-100">
        <li class="nav-item btn btn-danger btn-logout">
          <a class="nav-link text-white" href="<?php echo $burl . "/admin/auth/action_logout.php"; ?>">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>



<!-- check login -->
<?php
    if($_SESSION['login'] == false){
        header("Location: " . $burl . "/admin/auth/login.php");
    }
?>