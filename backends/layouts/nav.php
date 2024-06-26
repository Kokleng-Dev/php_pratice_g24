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
            <li class="nav-item">
                <a class="nav-link <?php echo isRoute('file') ? 'text-white' : ''; ?> " href="<?php echo route('file'); ?>"><i class="fa fa-file"></i> File</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo isRoute('photo') ? 'text-white' : ''; ?> " href="<?php echo route('photo'); ?>"><i class="fa fa-file"></i> Photo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo isRoute('picture') ? 'text-white' : ''; ?> " href="<?php echo route('picture'); ?>"><i class="fa fa-file"></i> Picture</a>
            </li>
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo route('auth.logout'); ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>
    </div>
</nav>