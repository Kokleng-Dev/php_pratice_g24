<nav class="navbar navbar-expand-lg bg-primary postition-sticky sticky-top">
    <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo route('home'); ?>">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link <?php echo isRoute('home') ? 'text-white' : ''; ?>" href="<?php echo route('home'); ?>"><i class="fas fa-home"></i> Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo isRoute('user') ? 'text-white' : ''; ?> " href="<?php echo route('user'); ?>"><i class="fas fa-users"></i> User</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo isRoute('customer') ? 'text-white' : ''; ?> " href="<?php echo route('customer'); ?>"><i class="fa fa-user"></i> Customer</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
            </a>
            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </li> -->
        </ul>
    </div>
    </div>
</nav>