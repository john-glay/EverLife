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

    <title>PhilHealth SQL Project</title>
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
                    <a href="admin-difficult.php"><i class="bi bi-code-slash"></i><span>SQL Codes</span></a>
                </li>
                <li class="nav-item">
                    <a href="../index.php"><i class="bi bi-box-arrow-right"></i><span>Exit</span></a>
                </li>
            </ul>
        </div>

        <!-- Content -->
        <div class="main-content">
            <div class="tables">
                <a href="admin-simple.php">Simple</a>
                <a href="admin-moderate.php">Moderate</a>
                <a class="active" href="admin-difficult.php">Difficult</a>
            </div> 

            <div class="content">
                <header>
                    <h2 class="title">Difficult</h2>
                </header>
                <section>
                    <h3 class="sub-title">SQL Statements</h3>
                    <div class="sql-statement">
                        <p class="sql-description">1. Display the pins and names of members, along with the names and IDs of their dependents who have a permanent disability and were born in 2000 or later.</p>
                        <div class="sql-codes">
                            <p class="m-0"><b>SELECT</b> M.pin, name, dep_id, dep_name<br><b>FROM</b> member <b>AS</b> M, dependent <b>AS</b> D<br><b>WHERE</b> M.pin = D.pin <b>AND</b> dep_perm_disability = 'Y' <b>AND</b> YEAR(dep_birth_date) >= 2000;</p>
                        </div>
                        <div id="difficult-1" class="sql-output">
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

                            $sql = "SELECT M.pin, name, dep_id, dep_name FROM member AS M, dependent AS D WHERE M.pin = D.pin AND dep_perm_disability = 'Y' AND YEAR(dep_birth_date) >= 2000;";
                            $result = $connection->query($sql);
                            
                            if ($result->num_rows > 0) {
                                echo "
                                    <div class='sql-label difficult-1'>
                                        <label style='margin: auto;'>pin</label>
                                        <label>name</label>
                                        <label style='margin: auto;'>dep_id</label>
                                        <label>dep_name</label>
                                    </div>
                                ";
                                // Read data of each row
                                $counter = 0; // Initialize a counter
                                while ($row = $result->fetch_assoc()) {
                                    // Determine the background color based on the counter
                                    $backgroundColor = ($counter % 2 == 0) ? '#E8F2D9' : '#FFFFFF';
                                    echo "
                                        <div class='sql-info difficult-1' style='background-color: $backgroundColor;'>
                                            <p style='margin: auto;'>$row[pin]</p>
                                            <p>$row[name]</p>
                                            <p style='margin: auto;'>$row[dep_id]</p>
                                            <p>$row[dep_name]</p>
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
                        <p class="sql-description">2. Display the permanent disability status of dependents of male and female members, along with the minimum and maximum monthly income of members who are associated with them. The results should be grouped by the sex of members and the permanent disability status of dependents, and ordered by sex.</p>
                        <div class="sql-codes">
                            <p class="m-0"><b>SELECT</b> sex, dep_perm_disability, MIN(monthly_income) <b>AS</b> Minimum_Monthly_Income, MAX(monthly_income) <b>AS</b> Maximum_Monthly_Income<br><b>FROM</b> member <b>AS</b> M, dependent <b>AS</b> D<br><b>WHERE</b> M.pin = D.pin<br><b>GROUP BY</b> sex, dep_perm_disability<br><b>ORDER BY</b> sex;</p>
                        </div>
                        <div id="difficult-2" class="sql-output">
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

                            $sql = "SELECT sex, dep_perm_disability, MIN(monthly_income) AS Minimum_Monthly_Income, MAX(monthly_income) AS Maximum_Monthly_Income FROM member AS M, dependent AS D WHERE M.pin = D.pin GROUP BY sex, dep_perm_disability ORDER BY sex;";
                            $result = $connection->query($sql);
                            
                            if ($result->num_rows > 0) {
                                echo "
                                <div class='sql-label difficult-2'>
                                    <label style='margin: 10px auto;'>sex</label>
                                    <label style='margin: 10px auto;'>dep_perm_disability</label>
                                    <label style='margin: 10px auto;'>Minimum_Monthly_Income</label>
                                    <label style='margin: 10px auto;'>Maximum_Monthly_Income</label>
                                </div>
                                ";
                                // Read data of each row
                                $counter = 0; // Initialize a counter
                                while ($row = $result->fetch_assoc()) {
                                    // Determine the background color based on the counter
                                    $backgroundColor = ($counter % 2 == 0) ? '#E8F2D9' : '#FFFFFF';
                                    echo "
                                        <div class='sql-info difficult-2' style='background-color: $backgroundColor;'>
                                            <p style='margin: 10px auto;'>$row[sex]</p>
                                            <p style='margin: 10px auto;'>$row[dep_perm_disability]</p>
                                            <p style='margin: 10px auto;'>$row[Minimum_Monthly_Income]</p>
                                            <p style='margin: 10px auto;'>$row[Maximum_Monthly_Income]</p>
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
                        <p class="sql-description">3. Display the contributors of each member and the count of their dependents who are Filipino. Display only those contributors who have at least two dependents, and order the results by the name of the contributor.</p>
                        <div class="sql-codes">
                            <p class="m-0"><b>SELECT</b> contributor, COUNT(dep_citizenship) <b>AS</b> Dep_Citizenship_Count<br><b>FROM</b> member <b>AS</b> M, dependent <b>AS</b> D<br><b>WHERE</b> M.pin = D.pin <b>AND</b> dep_citizenship = 'F'<br><b>GROUP BY</b> contributor<br><b>HAVING</b> COUNT(dep_citizenship) >= 2<br><b>ORDER BY</b> contributor;</p>
                        </div>
                        <div id="difficult-3" class="sql-output">
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

                            $sql = "SELECT contributor, COUNT(dep_citizenship) AS Dep_Citizenship_Count FROM member AS M, dependent AS D WHERE M.pin = D.pin AND dep_citizenship = 'F' GROUP BY contributor HAVING COUNT(dep_citizenship) >= 2 ORDER BY contributor;";
                            $result = $connection->query($sql);
                            
                            if ($result->num_rows > 0) {
                                echo "
                                <div class='sql-label difficult-3'>
                                    <label style='margin: 10px auto;'>contributor</label>
                                    <label style='margin: 10px auto;'>Dep_Citizenship_Count</label>
                                </div>
                                ";
                                // Read data of each row
                                $counter = 0; // Initialize a counter
                                while ($row = $result->fetch_assoc()) {
                                    // Determine the background color based on the counter
                                    $backgroundColor = ($counter % 2 == 0) ? '#E8F2D9' : '#FFFFFF';
                                    echo "
                                        <div class='sql-info difficult-3' style='background-color: $backgroundColor;'>
                                            <p style='margin: 10px auto;'>$row[contributor]</p>
                                            <p style='margin: 10px auto;'>$row[Dep_Citizenship_Count]</p>
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
        const difficult1 = document.getElementById('difficult-1');
        const difficult2 = document.getElementById('difficult-2');
        const difficult3 = document.getElementById('difficult-3');
        
        if (screenWidth <= 580) {
            difficult1.style.width = `calc(${screenWidth}px - 60px)`;
            difficult2.style.width = `calc(${screenWidth}px - 60px)`;
            difficult3.style.width = `calc(${screenWidth}px - 60px)`;
        } else {
            difficult1.style.width = '';
            difficult2.style.width = '';
            difficult3.style.width = '';
        }
    }
    updateWidth();
    window.addEventListener('resize', updateWidth);
</script>
</body>
</html>