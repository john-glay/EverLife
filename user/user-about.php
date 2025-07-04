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
                    <a href="user-home.php"><i class="bi bi-house"></i><span>Home</span></a>
                </li>
                <li class="nav-item active">
                    <a href="user-about.php"><i class="bi bi-people-fill"></i><span>About</span></a>
                </li>
                <li class="nav-item">
                    <a href="user-registration.php"><i class="bi bi-plus-circle"></i><span>Registration</span></a>
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
                        <p class="about-text">This project serves as a hands-on learning experience for applying web development principles to optimize the member application process for a fictional health insurance provider. The goal of the system is <mark>to streamline member registration, update processes, and enhance overall efficiency</mark> through web-based solutions.</p>
                        <img class="about-img" src="../images/collab.png" alt="collab" draggable="false">
                        <p class="about-text">The project showcases the use of HTML, CSS, JavaScript, and PHP to create, update, and manage member data in a <mark>more organized and user-friendly manner</mark>. It reflects the practical application of front-end and back-end development, database integration, and interface design to improve user experience.</p>
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
                            <p class="last-name">Alfaro,</p>
                            <p>Abram S.</p>
                            <div class="member-socials">
                                <a href="https://github.com/ram4209" target="_blank"><i class="bi bi-github"></i></a>
                                <a href="" target="_blank"><i class="bi bi-linkedin"></i></a>
                            </div>
                            <img class="member-img" src="../images/abram.png" alt="abram" draggable="false">
                        </div>
                        <div class="member">
                            <p class="last-name">Bunao,</p>
                            <p>John Glay C.</p>
                            <div class="member-socials">
                                <a href="https://github.com/john-glay" target="_blank"><i class="bi bi-github"></i></a>
                                <a href="https://www.linkedin.com/in/john-glay-bunao-8b5948255" target="_blank"><i class="bi bi-linkedin"></i></a>
                            </div>
                            <img class="member-img" src="../images/glay.png" alt="glay" draggable="false">
                        </div>
                        <div class="member">
                            <p class="last-name">Damaso,</p>
                            <p>Edriana Joy R.</p>
                            <div class="member-socials">
                                <a href="https://github.com/EdrianaJoy" target="_blank"><i class="bi bi-github"></i></a>
                                <a href="https://www.linkedin.com/in/edriana-joy-damaso-b7b238240/" target="_blank"><i class="bi bi-linkedin"></i></a>
                            </div>
                            <img class="member-img" src="../images/edriana.png" alt="edriana" draggable="false">
                        </div>
                        <div class="member">
                            <p class="last-name">Dela Cruz</p>
                            <p>Jhana Mae L.</p>
                            <div class="member-socials">
                                <a href="https://github.com/jhanaMae" target="_blank"><i class="bi bi-github"></i></a>
                                <a href="https://www.linkedin.com/in/jhana-mae-dela-cruz-a36490254/" target="_blank"><i class="bi bi-linkedin"></i></a>
                            </div>
                            <img class="member-img" src="../images/jhana.png" alt="jhana" draggable="false">
                        </div>
                        <div class="member">
                            <p class="last-name">Estrella</p>
                            <p>Novelle Lyn</p>
                            <div class="member-socials">
                                <a href="https://github.com/NovelleEstrella" target="_blank"><i class="bi bi-github"></i></a>
                                <a href="https://www.linkedin.com/in/novelleestrella/" target="_blank"><i class="bi bi-linkedin"></i></a>
                            </div>
                            <img class="member-img" src="../images/novelle.png" alt="novelle" draggable="false">
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
                    <p class="m-0">This project is solely for educational and demonstration purposes as part of the COMP 016 – Web Development course. It is <b>NOT</b> affiliated with, endorsed by, or connected to any real health insurance provider. All trademarks, names, logos, and related materials are the property of their respective owners. The use of these materials in this project is intended for academic purposes only, to demonstrate the application of web development concepts. No commercial use or distribution of this project is intended.</p>
                    <a href="user-home.php"><img class="org-logo" src="../images/logo-name.png" alt="logo" draggable="false"></a>
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