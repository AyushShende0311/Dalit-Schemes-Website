(()=>{
    var body  = document.querySelector("body")
    var header = `
                <div class="container-fluid header-wrapper m-0 p-0">
                    <div class="header-upper-wrapper">
                        <div class="header-upper container-md">
                            <div class="row">
                            
                                <div class="header-title col-lg-4 col-sm-12">
                                    <img src="../FullStackProject/Assets/logo/Social Justice.png">
                                </div>
                                <div class="header-name col-lg-4 col-sm-12"><p>निवडक दलित वस्ती सुधार योजना</p></div>
                                <div class="header-helpline col-lg-4 col-sm-12"><p>Helpline (Toll Free) : 2546000, 1800-3458-4578</p></div>
                                <div id="header-photo1">
                                    <img src="../FullStackProject/Assets/images/Dr.Ambedkar.png">
                                </div>
                                <div id="minister-photo">
                                    <img src="../FullStackProject/Assets/images/ministers.png">
                                </div>

                            </div>  
                        </div>
                    </div>
                    <div class="header-lower p-2">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <div class="container">
                            <!-- <a class="navbar-brand" href="#">Navbar</a> -->
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                <div class="navbar-nav">
                                <a class="nav-link1" aria-current="page" href="./home.html">HOME</a>
                                <a class="nav-link2" href="./about-us.html">ABOUT US</a>
                                <a class="nav-link3" href="./scheme.html">SCHEMES</a>
                                <a class="nav-link4" href="./district-wise-covered-areas.html">DISTRICT WISE COVERED AREAS</a>
                                <a class="nav-link5" href="./news&events.html">NEWS & UPDATES</a>
                                </div>
                            </div>
                            </div>
                        </nav>     
                    </div>  
                </div>    
      `

      body.insertAdjacentHTML("afterbegin", header)
})()

