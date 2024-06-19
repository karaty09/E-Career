<style>
    .title-background {
        height: 400px;
        padding: 0px;
    }

    .image-title-background {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .logo-on-title {
        position: absolute;
        z-index: 1;
        top: 30px;
        left: 2%;
        width: 300px;
        height: 100px;
    }

    .font-on-title {
        position: absolute;
        z-index: 1;
        top: 60px;
        right: 2%;
    }

    /* Default state */
    .nav-pills .nav-link {
        color: white;
        margin: 0 5px;
    }

    /* Active state */
    .nav-pills .nav-link.active {
        background-color: white;
        /* Background color when active */
        color: black;
        /* Text color when active */
    }

    /* Hover state */
    .nav-pills .nav-link:hover {
        background-color: grey;
        /* Background color on hover */
        color: black;
        /* Text color on hover */
    }

    /* Optional: Focus state */
    .nav-pills .nav-link:focus {
        background-color: white;
        /* Background color on focus */
        color: black;
        /* Text color on focus */
    }
</style>

<div class="container-fluid title-background">
    <img src="../assets/img/titlev3.jpg" alt="" class="image-title-background">
    <img src="../assets/img/logo.png" alt="" class="logo-on-title">
    <h1 class="font-on-title text-white fw-bold">E-Career</h1>
</div>

<nav class="navbar navbar-expand" style="background-color: #212121;">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-home-tab" href="homeAdmin.php" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Criteria
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="uploadDWHAdmin.php">Upload DWH</a></li>
                        <li><a class="dropdown-item" href="percentileAdmin.php">Percentile</a></li>
                        <li><a class="dropdown-item" href="paAdmin.php">PA</a></li>
                        <li><a class="dropdown-item" href="#">SA</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Promote
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">PA (Promotion Adjustment)</a></li>
                        <li><a class="dropdown-item" href="#">SA (Special Adjustment)</a></li>
                        <li><a class="dropdown-item" href="#">SR (Special Recognition)</a></li>
                    </ul>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-xxxx-tab" href="" role="tab" aria-controls="pills-xxxx" aria-selected="false">XXXXX</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-xxxx-tab" href="" role="tab" aria-controls="pills-xxxx" aria-selected="false">XXXXX</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-forecast-tab" href="" role="tab" aria-controls="pills-forecast" aria-selected="false">Forecast</a>
                </li>
            </ul>
        </div>
        <div style="margin-right: 10px;">
            <span class="text-white">Admin</span>
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
                // Find the parent dropdown and add the active class to it
                var parentDropdown = item.closest('.nav-item.dropdown').querySelector('.nav-link');
                if (parentDropdown) {
                    parentDropdown.classList.add('active');
                }
            }
        });
    });
</script>