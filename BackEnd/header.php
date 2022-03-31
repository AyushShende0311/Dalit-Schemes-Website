<?php
    function nav(){
        return "
        <div class='bg-secondary container-fluid mb-4'>
            <div class='container-sm'>
                <nav class='navbar navbar-expand-lg navbar-dark  '>
                <div class='container-fluid'>
                <a class='navbar-brand' href='../Users/index.php'>Backend</a>
                <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarNav'>
                    <ul class='navbar-nav'>
                        <li class='nav-item'>
                            <a class='nav-link' id='page-district' aria-current='page' href='../Districts/index.php'>District</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' id='page-taluka' href='../Taluka/index.php'>Taluka</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' id='page-localarea' href='../LocalAreas/index.php'>LocalArea</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' id='page-scheme' href='../Schemes/index.php'>Schemes</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' id='page-main' href='../DistrictWiseSchemes/index.php'>DistrictWiseSchemes</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' id='page-images' href='../Images/index.php'>Images</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' id='page-events' href='../Events/index.php'>Events</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link'  href='../index.php'>Logout</a>
                        </li>
                    </ul>
                </div>
                </div>
            </nav>
        </div>
      </div>
      ";

    }
?>