(()=>{
    var body = document.querySelector("body")
    var footer = `
                <div class="container-fluid footer-container p-0">
                <div class="container-lg footer">
                    <div class="footer-links">
                        <ul class="ft-10">
                            <li>
                                <a href="https://www.google.com/" target="_blank"> 
                                    Terms & Conditions
                                </a>
                            </li>                          
                            <li>
                                <a href=""> Privacy Policy</a>
                            </li>                            
                            <li>
                                <a href="">Copyright Policy</a>
                            </li>                         
                            <li>
                                <a href="https://www.google.com/" > HyperLinking Policy</a>
                            </li>                            
                            <li>
                                <a href=""> Disclaimer</a>
                            </li>                            
                            <li>
                                <a href="">Help</a>
                            </li>                            
                            <li>
                                <a href=""> Sitemap</a>
                            </li>                            
                            <li>
                                <a href="">Feedback</a>
                            </li>                            
                            <li>
                                <a href="">Archive</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-copyright ft-12 margin-center">
                        <p>
                            Copyright &copy 2021 Department of Social Justice & Special Assistance, Government of Maharashtra, All Rights Reserved.
                        </p>
                    </div>
                    <div class="footer-website ft-12 margin-center">
                        <p>
                            Website Contents and Data Provided & Maintained by Department of Social Justice & Special Assistance, Government of Maharashtra
                        </p>
                        <p>
                            Best Viewed in IE-9 and Above, Google Chrome and Mozilla Firefox.
                        </p>
                    </div>
                </div>
            </div>
     `
     body.insertAdjacentHTML("beforeend", footer)

})()