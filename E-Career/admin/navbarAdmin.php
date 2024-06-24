<link rel="stylesheet" href="./styles/stylesNavbarAdmin.css">

<div class="container-fluid title-background">
    <img src="../assets/img/titlev2.jpg" alt="" class="image-title-background">
    <img src="../assets/img/logo.png" alt="" class="logo-on-title">
    <h1 class="font-on-title text-white fw-bold">E-Career</h1>
</div>

<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #212121;">
    <div class="container-fluid">
        <!-- Navbar Toggler Icon -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Collapse Content -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-md-0 nav-pills" id="pills-tab">
                <!-- รายการ Navbar จะถูกแสดงใน burger menu นี้ -->
                <li class="nav-item">
                    <a class="nav-link" href="homeAdmin.php" id="pills-home-tab">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">Criteria</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="uploadDWHAdmin.php">Upload DWH</a></li>
                        <li><a class="dropdown-item" href="percentileAdmin.php">Percentile</a></li>
                        <li><a class="dropdown-item" href="paAdmin.php">PA</a></li>
                        <li><a class="dropdown-item" href="#">SA</a></li>
                        <li><a class="dropdown-item" href="#">Quota</a></li>
                        <li><a class="dropdown-item" href="addMasterPeaceAdmin.php">Master Peace</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">Promote</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">PA (Promotion Adjustment)</a></li>
                        <li><a class="dropdown-item" href="#">SA (Special Adjustment)</a></li>
                        <li><a class="dropdown-item" href="#">SR (Special Recognition)</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="pills-xxxx-tab">XXXXX</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="pills-xxxx-tab">XXXXX</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="pills-forecast-tab">Forecast</a>
                </li>
            </ul>
        </div>
        <div class="dropdown d-flex align-items-center">
            <button class="dropdown-toggle btn btn-primary border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <?php
                if ($role == 1) {
                    $role = "Admin";
                }
                ?>
                <span class="text-white"><?php echo $firstname . " " . $lastname . " (" . $role . ")" ?></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" style="margin-bottom: 10px;" href="../login/logout.php">ออกจากระบบ</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Set Active Class Based on Current URL -->
<script>
    // JavaScript to set the active class based on current URL
    document.addEventListener('DOMContentLoaded', function() {
        var path = window.location.pathname;
        var page = path.split("/").pop();

        var navLinks = document.querySelectorAll('.nav-pills .nav-link');
        navLinks.forEach(function(link) {
            if (link.getAttribute('href') === page) {
                link.classList.add('active');
            }
        });

        var dropdownItems = document.querySelectorAll('.dropdown-item');
        dropdownItems.forEach(function(item) {
            if (item.getAttribute('href') === page) {
                item.classList.add('active');
                var parentDropdown = item.closest('.nav-item.dropdown').querySelector('.nav-link');
                if (parentDropdown) {
                    parentDropdown.classList.add('active');
                }
            }
        });
    });
</script>