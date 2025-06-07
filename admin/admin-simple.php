<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Links -->
    <link rel="icon" type="image/x-icon" href="../images/logo-icon.jpg">
    <link rel="stylesheet" href="../styles/css/sql.css">
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
                <li class="nav-item">
                    <a href="admin-about.php"><i class="bi bi-people"></i><span>About</span></a>
                </li>
                <li class="nav-item">
                    <a href="admin-registration.php"><i class="bi bi-plus-circle"></i><span>Registration</span></a>
                </li>
                <li class="nav-item">
                    <a href="admin-members.php"><i class="bi bi-database"></i><span>Database</span></a>
                </li>
                <li class="nav-item active">
                    <a href="admin-simple.php"><i class="bi bi-code-slash"></i><span>SQL Codes</span></a>
                </li>
                <li class="nav-item">
                    <a href="../index.php"><i class="bi bi-box-arrow-right"></i><span>Exit</span></a>
                </li>
            </ul>
        </div>

        <!-- Content -->
        <div class="main-content">
            <div class="tables">
                <a class="active" href="admin-simple.php">Simple</a>
                <a href="admin-moderate.php">Moderate</a>
                <a href="admin-difficult.php">Difficult</a>
            </div> 

            <div class="content">
                <header>
                    <h2 class="title">Simple</h2>
                </header>
                <section>
                    <h3 class="sub-title">SQL Statements</h3>
                    <div class="sql-statement">
                        <p class="sql-description">1. Display all records of disabled dependents whose citizenship is Filipino.</p>
                        <div class="sql-codes">
                            <p class="m-0"><b>SELECT</b> *<br><b>FROM</b> dependent<br><b>WHERE</b> dep_citizenship = 'F' <b>AND</b> dep_perm_disability = 'Y';</p>
                        </div>
                        <div id="simple-1" class="sql-output">
                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $database = "philhealth";

                            // Create connection
                            $connection = new mysqli( $servername, $username, $password, $database );

                            // Check connection
                            if ($connection->connect_error) {
                                die("Connection failed". $connection->connect_error);
                            }

                            $sql = "SELECT * FROM dependent WHERE dep_citizenship = 'F' AND dep_perm_disability = 'Y'";
                            $result = $connection->query($sql);
                            
                            if ($result->num_rows > 0) {
                                echo "
                                    <div class='sql-label simple-1'>
                                        <label style='margin: auto;'>pin</label>
                                        <label style='margin: auto;'>dep_id</label>
                                        <label>dep_name</label>
                                        <label style='margin: auto;'>dep_birth_date</label>
                                        <label style='margin: auto;'>dep_citizenship</label>
                                        <label style='margin: auto;'>dep_perm_disability</label>
                                        <label>relationship</label>
                                    </div>
                                ";

                                // Read data of each row
                                $counter = 0; // Initialize a counter
                                while ($row = $result->fetch_assoc()) {
                                    // Determine the background color based on the counter
                                    $backgroundColor = ($counter % 2 == 0) ? '#E8F2D9' : '#FFFFFF';
                                    echo "
                                        <div class='sql-info simple-1' style='background-color: $backgroundColor;'>
                                            <p style='margin: auto;'>$row[pin]</p>
                                            <p style='margin: auto;'>$row[dep_id]</p>
                                            <p>$row[dep_name]</p>
                                            <p style='margin: auto;'>$row[dep_birth_date]</p>
                                            <p style='margin: auto;'>$row[dep_citizenship]</p>
                                            <p style='margin: auto;'>$row[dep_perm_disability]</p>
                                            <p>$row[relationship]</p>
                                        </div>
                                    ";
                                    $counter++; // Increment the counter
                                }
                            } else {
                                echo "
                                    <div class='no-record' style='position: relative;'>
                                        <img src='../images/no-record.png' alt='no-record' draggable='false'>
                                        <p class='text-center'>No records found.</p>
                                    </div>
                                ";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="sql-statement">
                        <p class="sql-description">2. Display all information for members who have 'Manila' included in their permanent address.</p>
                        <div class="sql-codes">
                            <p class="m-0"><b>SELECT</b> *<br><b>FROM</b> member<br><b>WHERE</b> perm_adrs <b>LIKE</b> '%Manila%';</p>
                        </div>
                        <div id="simple-2" class="sql-output">
                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $database = "philhealth";

                            // Create connection
                            $connection = new mysqli( $servername, $username, $password, $database );

                            // Check connection
                            if ($connection->connect_error) {
                                die("Connection failed". $connection->connect_error);
                            }

                            $sql = "SELECT * FROM member WHERE perm_adrs LIKE '%Manila%'";
                            $result = $connection->query($sql);
                            
                            if ($result->num_rows > 0) {
                                echo "
                                    <div class='sql-label simple-2'>
                                        <label style='margin: auto;'>pin</label>
                                        <label>name</label>
                                        <label>mother_mdn_name</label>
                                        <label>spouse</label>
                                        <label style='margin: auto;'>birth_date</label>
                                        <label>birth_place</label>
                                        <label style='margin: auto;'>sex</label>
                                        <label style='margin: auto;'>civil_status</label>
                                        <label style='margin: auto;'>citizenship</label>
                                        <label>philsys_id_no</label>
                                        <label>tin</label>
                                        <label>perm_adrs</label>
                                        <label>mailing_adrs</label>
                                        <label>home_phone_no</label>
                                        <label style='margin: auto;'>mobile_no</label>
                                        <label>business_directline</label>
                                        <label>email</label>
                                        <label style='margin: auto;'>contributor</label>
                                        <label>contributor_type</label>
                                        <label>pra_srrv_no</label>
                                        <label>acr_icard_no</label>
                                        <label>pwd_id_no</label>
                                        <label>profession</label>
                                        <label>monthly_income</label>
                                        <label>income_proof</label>
                                    </div>
                                ";
                                // Read data of each row
                                $counter = 0; // Initialize a counter
                                while ($row = $result->fetch_assoc()) {
                                    // Determine the background color based on the counter
                                    $backgroundColor = ($counter % 2 == 0) ? '#E8F2D9' : '#FFFFFF';

                                    if ($row['philsys_id_no'] == 0) {
                                        $row['philsys_id_no'] = "N/A";
                                    }

                                    if ($row['tin'] == 0) {
                                        $row['tin'] = "N/A";
                                    }

                                    if ($row['home_phone_no'] == 0) {
                                        $row['home_phone_no'] = "N/A";
                                    }

                                    if ($row['business_directline'] == 0) {
                                        $row['business_directline'] = "N/A";
                                    }
                                    
                                    if ($row['pra_srrv_no'] == 0) {
                                        $row['pra_srrv_no'] = "N/A";
                                    }
                                    
                                    if ($row['acr_icard_no'] == 0) {
                                        $row['acr_icard_no'] = "N/A";
                                    }
                                    
                                    if ($row['pwd_id_no'] == 0) {
                                        $row['pwd_id_no'] = "N/A";
                                    }
                                    
                                    echo "
                                        <div class='sql-info simple-2' style='background-color: $backgroundColor;'>
                                            <p style='margin: auto;'>$row[pin]</p>
                                            <p>$row[name]</p>
                                            <p>$row[mother_mdn_name]</p>
                                            <p>$row[spouse]</p>
                                            <p style='margin: auto;'>$row[birth_date]</p>
                                            <p>$row[birth_place]</p>
                                            <p style='margin: auto;'>$row[sex]</p>
                                            <p style='margin: auto;'>$row[civil_status]</p>
                                            <p style='margin: auto;'>$row[citizenship]</p>
                                            <p>$row[philsys_id_no]</p>
                                            <p>$row[tin]</p>
                                            <p>$row[perm_adrs]</p>
                                            <p>$row[mailing_adrs]</p>
                                            <p>$row[home_phone_no]</p>
                                            <p style='margin: auto;'>$row[mobile_no]</p>
                                            <p>$row[business_directline]</p>
                                            <p>$row[email]</p>
                                            <p style='margin: auto;'>$row[contributor]</p>
                                            <p>$row[contributor_type]</p>
                                            <p>$row[pra_srrv_no]</p>
                                            <p>$row[acr_icard_no]</p>
                                            <p>$row[pwd_id_no]</p>
                                            <p>$row[profession]</p>
                                            <p>$row[monthly_income]</p>
                                            <p>$row[income_proof]</p>
                                        </div>
                                    ";
                                    $counter++; // Increment the counter
                                }
                            } else {
                                echo "
                                    <div class='no-record' style='position: relative;'>
                                        <img src='/infoman/infoman-project/images/no-record.png' alt='no-record' style='display: block; margin-left: auto; margin-right: auto;' height='300px'>
                                        <p class='text-center' style='position: absolute; margin: 0 auto; left: 0; right: 0; bottom: 45px;'>No records found.</p>
                                    </div>
                                ";
                            }
                            ?>    
                        </div>
                    </div>
                    <div class="sql-statement">
                        <p class="sql-description">3. Display all records of dependents who are sons or daughters and have no permanent disability.</p>
                        <div class="sql-codes">
                            <p class="m-0"><b>SELECT</b> *<br><b>FROM</b> dependent<br><b>WHERE</b> relationship <b>IN</b> ('Son', 'Daughter') <b>AND</b> dep_perm_disability = 'N';</p>
                        </div>
                        <div id="simple-3" class="sql-output">
                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $database = "philhealth";

                            // Create connection
                            $connection = new mysqli( $servername, $username, $password, $database );

                            // Check connection
                            if ($connection->connect_error) {
                                die("Connection failed". $connection->connect_error);
                            }

                            $sql = "SELECT * FROM dependent WHERE relationship IN ('SON', 'DAUGHTER') AND dep_perm_disability = 'N'";
                            $result = $connection->query($sql);
                            
                            if ($result->num_rows > 0) {
                                echo "
                                    <div class='sql-label simple-1'>
                                        <label style='margin: auto;'>pin</label>
                                        <label style='margin: auto;'>dep_id</label>
                                        <label>dep_name</label>
                                        <label style='margin: auto;'>dep_birth_date</label>
                                        <label style='margin: auto;'>dep_citizenship</label>
                                        <label style='margin: auto;'>dep_perm_disability</label>
                                        <label>relationship</label>
                                    </div>
                                ";

                                // Read data of each row
                                $counter = 0; // Initialize a counter
                                while ($row = $result->fetch_assoc()) {
                                    // Determine the background color based on the counter
                                    $backgroundColor = ($counter % 2 == 0) ? '#E8F2D9' : '#FFFFFF';
                                    echo "
                                        <div class='sql-info simple-1' style='background-color: $backgroundColor;'>
                                            <p style='margin: auto;'>$row[pin]</p>
                                            <p style='margin: auto;'>$row[dep_id]</p>
                                            <p>$row[dep_name]</p>
                                            <p style='margin: auto;'>$row[dep_birth_date]</p>
                                            <p style='margin: auto;'>$row[dep_citizenship]</p>
                                            <p style='margin: auto;'>$row[dep_perm_disability]</p>
                                            <p>$row[relationship]</p>
                                        </div>
                                    ";
                                    $counter++; // Increment the counter
                                }
                            } else {
                                echo "
                                    <div class='no-record' style='position: relative;'>
                                        <img src='../images/no-record.png' alt='no-record' draggable='false'>
                                        <p class='text-center'>No records found.</p>
                                    </div>
                                ";
                            }
                            ?>  
                        </div>
                    </div>
                </section>
                <a href="admin-home.php" class="philhealth-logo">
                    <img src="../images/logo-name.png" alt="philhealth-logo" draggable="false">
                </a>  
            </div> 
        </div>
    </div>

    <script>
        function updateWidth() {
            const screenWidth = window.innerWidth;
            const simple1 = document.getElementById('simple-1');
            const simple2 = document.getElementById('simple-2');
            const simple3 = document.getElementById('simple-3');
            
            if (screenWidth <= 580) {
                simple1.style.width = `calc(${screenWidth}px - 60px)`;
                simple2.style.width = `calc(${screenWidth}px - 60px)`;
                simple3.style.width = `calc(${screenWidth}px - 60px)`;
            } else {
                simple1.style.width = '';
                simple2.style.width = '';
                simple3.style.width = '';
            }
        }
        updateWidth();
        window.addEventListener('resize', updateWidth);
    </script>
</body>
</html>