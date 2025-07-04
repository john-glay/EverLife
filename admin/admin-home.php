<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Links -->
    <link rel="icon" type="image/x-icon" href="../images/logo-icon.jpg">
    <link rel="stylesheet" href="../styles/css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <title>EverLife</title>
</head>
<body>
    <div class="global-container">
        <!-- Navigation -->
        <div class="nav">
            <ul class="nav-list">
                <li class="nav-item active">
                    <a href="admin-home.php"><i class="bi bi-house-fill"></i><span>Home</span></a>
                </li>
                <li class="nav-item">
                    <a href="admin-about.php"><i class="bi bi-people"></i><span>About</span></a>
                </li>
                <li class="nav-item">
                    <a href="admin-registration.php"><i class="bi bi-plus-circle"></i><span>Registration</span></a>
                </li>
                <li class="nav-item">
                    <a href="admin-members.php"><i class="bi bi-database"></i><span>Database</span></a>
                </li>
                <li class="nav-item">
                    <a href="../index.php"><i class="bi bi-box-arrow-right"></i><span>Exit</span></a>
                </li>
            </ul>
        </div>

        <!-- Content -->
        <div class="main-content">
            <div class="content">
                <header>
                    <h2 class="title">EverLife</h2>
                </header>
                <section>
                    <div class="home-info">
                        <div>
                            <p class="home-text">EverLife is a trusted health insurance provider dedicated to ensuring that every Filipino has access to <mark>reliable, comprehensive, and affordable health care services.</mark></p>
                            <a class="apply-btn" href="admin-registration.php">Apply now</a>    
                        </div>
                        <img class="home-img" src="../images/family.png" alt="family" draggable="false">
                    </div>
                    <div class="home-info">
                        <div>
                            <p class="home-text">Through its health insurance program, <mark>EverLife provides financial assistance for inpatient and outpatient services</mark>, ensuring members access quality healthcare in public and private hospitals across the Philippines.</p>
                            <a class="learn-btn" href="admin-about.php">Learn more</a>    
                        </div>
                        <img class="home-img" src="../images/hospital.png" alt="hospital" draggable="false">
                    </div>
                </section>

                <header>
                    <h3 class="sub-title">
                        Contact
                    </h3>
                </header>
                <section class="position-relative">
                    <div class="home-contact">
                        <div class="contact-item">
                            <i class="bi bi-telephone"></i>
                            <div class="contact-info">
                                <p>New Hotline</p>
                                <p>(01) 432-765-98</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="bi bi-phone"></i>
                            <div class="contact-info">
                                <p>Smart</p>
                                <p>0987-654-3210</p>
                                <p>0901-234-5678</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="bi bi-phone"></i>
                            <div class="contact-info">
                                <p>Globe</p>
                                <p>0912-543-9876</p>
                                <p>0998-765-4321</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="bi bi-facebook"></i>
                            <div class="contact-info">
                                <p>Facebook</p>
                                <a href="https://www.facebook.com/EverLifeOfficial/" target="_blank">EverLifeOfficial</a>
                            </div>  
                        </div>
                        <div class="contact-item">
                            <i class="bi bi-twitter-x"></i>
                            <div class="contact-info">
                                <p>X (formerly Twitter)</p>
                                <a href="https://x.com/everlifeofficial/" target="_blank">@everlifeofficial</a>
                            </div>  
                        </div>
                        <div class="contact-item">
                            <i class="bi bi-envelope"></i>
                            <div class="contact-info">
                                <p>Email</p>
                                <p>actioncenter@everlife.gov.ph</p>
                            </div>  
                        </div>
                    </div>
                    <a href="admin-home.php"><img class="org-logo" src="../images/logo-name.png" alt="logo" draggable="false"></a>
                </section>
            </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="disclaimerModal" tabindex="-1" aria-labelledby="disclaimerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modalContent">
                    <div class="modalBody">
                        <div class="d-block w-100 text-end">
                            <i class="bi bi-x-lg modal-close-btn" data-bs-dismiss="modal" aria-label="Close"></i>
                        </div>
                        <div class="modal-title">  
                            <i class="bi bi-info-circle"></i>
                            <h4 class="modal-disclaimer">Disclaimer</h4>
                        </div>
                        <p class="modal-text">This academic project is <b>NOT</b> a real health insurance provider. All trademarks are the property of their respective owners. The database contains fictional information for educational and demonstrative purposes only. This project is <b>NOT</b> intended for commercial use or distribution.</p>
                        <button type="button" class="modalClose" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    
    <script>
        // Check if the modal has been shown before
        if (localStorage.getItem('disclaimerShown') === 'false') {
            // If not, show the modal and set the flag
            new bootstrap.Modal(document.getElementById('disclaimerModal')).show();
            localStorage.setItem('disclaimerShown', 'true');
        }
    </script>
</body>
</html>