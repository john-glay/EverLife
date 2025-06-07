<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Links -->
    <link rel="icon" type="image/x-icon" href="../images/logo-icon.jpg">
    <link rel="stylesheet" href="../styles/css/about.css">
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
                <li class="nav-item">
                    <a href="admin-home.php"><i class="bi bi-house"></i><span>Home</span></a>
                </li>
                <li class="nav-item active">
                    <a href="admin-about.php"><i class="bi bi-people-fill"></i><span>About</span></a>
                </li>
                <li class="nav-item">
                    <a href="admin-registration.php"><i class="bi bi-plus-circle"></i><span>Registration</span></a>
                </li>
                <li class="nav-item">
                    <a href="admin-members.php"><i class="bi bi-database"></i><span>Database</span></a>
                </li>
                <li class="nav-item">
                    <a href="admin-simple.php"><i class="bi bi-code-slash"></i><span>SQL Codes</span></a>
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
                    <h2 class="title">About the Project</h2>
                </header>
                <section>
                    <div class="about-info">
                        <p class="about-text">This project serves as a hands-on learning experience for applying SQL and information management principles to optimize the member application process for PhilHealth. The goal of the system is <mark>to streamline member registration, update processes, and enhance overall efficiency</mark> by utilizing database management techniques.</p>
                        <img class="about-img" src="../images/collab.png" alt="collab" draggable="false">
                        <p class="about-text">The project showcases the use of SQL queries to retrieve, update, and manage member data in a <mark>more organized and scalable manner.</mark> It reflects the practical application of database design, optimization, and user interface design to improve user experience.</p>
                    </div>
                </section>

                <header>
                    <h3 class="sub-title">
                        Meet the Creators
                    </h3>
                </header>
                <section>
                    <div class="about-members" id="scrollContainer">
                        <div class="member">
                            <p class="last-name">Bunao,</p>
                            <p>John Glay C.</p>
                            <div class="member-socials">
                                <a href="https://github.com/john-glay" target="_blank"><i class="bi bi-github"></i></a>
                                <a href="https://www.linkedin.com/in/john-glay-bunao-8b5948255" target="_blank"><i class="bi bi-linkedin"></i></a>
                            </div>
                            <img class="member-img" src="../images/glay.png" alt="matt" draggable="false">
                        </div>
                        <div class="member">
                            <p class="last-name">Maravilla,</p>
                            <p>Ernest Matthew I.</p>
                            <div class="member-socials">
                                <a href="https://www.linkedin.com/in/ernest-matt-maravilla" target="_blank"><i class="bi bi-linkedin"></i></a>
                            </div>
                            <img class="member-img" src="../images/matt.png" alt="rainiel" draggable="false">
                        </div>
                        <div class="member">
                            <p class="last-name">Ladiao,</p>
                            <p>Raniel Josh D.</p>
                            <div class="member-socials">
                                <a href="https://www.linkedin.com/in/rainiel-josh-ladiao" target="_blank"><i class="bi bi-linkedin"></i></a>
                            </div>
                            <img class="member-img" src="../images/rainiel.png" alt="glay" draggable="false">
                        </div>
                        <div class="member">
                            <p class="last-name">Prudente,</p>
                            <p>Lady Marah G.</p>
                            <div class="member-socials">
                                <a href="https://www.linkedin.com/in/marah-prudente-1079ab2b2" target="_blank"><i class="bi bi-linkedin"></i></a>
                            </div>
                            <img class="member-img" src="../images/marah.png" alt="glay" draggable="false">
                        </div>
                    </div>
                </section>

                <section class="about-disclaimer">
                    <div class="disclaimer-title">
                        <i class="bi bi-info-circle"></i>
                        <h3 class="sub-title m-0">
                            Disclaimer
                        </h3>
                    </div>
                    <p class="m-0">This project is solely for educational and demonstration purposes as part of the COMP 010 – Information Management course. It is <b>NOT</b> affiliated with, endorsed by, or connected to the Philippine Health Insurance Corporation (PhilHealth) in any way. All trademarks, including the PhilHealth name, logo, and any related materials, are the property of their respective owners. The use of these materials in this project is intended for academic purposes only, to demonstrate the application of SQL statements and information management concepts. The information in the database is entirely fictional, and any resemblance to actual individuals, organizations, or events is purely coincidental. No commercial use or distribution of this project is intended.</p>
                    <a href="admin-home.php"><img class="philhealth-logo" src="../images/logo-name.png" alt="logo" draggable="false"></a>
                </section>
            </div>      
        </div>
    </div>

    <script>
        const scrollContainer = document.getElementById('scrollContainer');

        const handleStart = (evt) => {
            let oldX;
            let scrollLeft;

            if (evt.type === "mousedown") {
                oldX = evt.pageX;
                scrollLeft = scrollContainer.scrollLeft;
            } else if (evt.type === "touchstart") {
                oldX = evt.touches[0].pageX;
                scrollLeft = scrollContainer.scrollLeft;
            }

            const handleMove = (evt) => {
                let newX;

                if (evt.type === "mousemove") {
                    newX = evt.pageX;
                } else if (evt.type === "touchmove") {
                    newX = evt.touches[0].pageX;
                }

                const offset = newX - oldX;
                scrollContainer.scrollLeft = scrollLeft - offset;
            };

            const handleEnd = () => {
                window.removeEventListener("mousemove", handleMove);
                window.removeEventListener("mouseup", handleEnd);
                window.removeEventListener("touchmove", handleMove);
                window.removeEventListener("touchend", handleEnd);
            };

            window.addEventListener("mousemove", handleMove);
            window.addEventListener("mouseup", handleEnd);
            window.addEventListener("touchmove", handleMove);
            window.addEventListener("touchend", handleEnd);
        };

        scrollContainer.addEventListener("mousedown", handleStart);
        scrollContainer.addEventListener("touchstart", handleStart);
    </script>
</body>
</html>