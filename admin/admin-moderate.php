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
                    <a href="admin-moderate.php"><i class="bi bi-code-slash"></i><span>SQL Codes</span></a>
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
                <a class="active" href="admin-moderate.php">Moderate</a>
                <a href="admin-difficult.php">Difficult</a>
            </div> 

            <div class="content">
                <header>
                    <h2 class="title">Moderate</h2>
                </header>
                <section>
                    <h3 class="sub-title">SQL Statements</h3>
                    <div class="sql-statement">
                        <p class="sql-description">1. Count the dependents that are an immediate family of the member and group them by their relationship.</p>
                        <div class="sql-codes">
                            <p class="m-0"><b>SELECT</b> relationship, COUNT(*) <b>AS</b> Dep_Immediate_Family_Count<br><b>FROM</b> dependent<br><b>WHERE</b> relationship <b>IN</b> ('Daughter', 'Son', 'Mother', 'Father', 'Brother', 'Sister')<br><b>GROUP BY</b> relationship;</p>
                        </div>
                        <div id="moderate-1" class="sql-output">
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

                            $sql = "SELECT relationship, COUNT(*) AS Dep_Immediate_Family_Count FROM dependent WHERE relationship IN ('Daughter', 'Son', 'Mother', 'Father', 'Brother', 'Sister') GROUP BY relationship";
                            $result = $connection->query($sql);
                            
                            if ($result->num_rows > 0) {
                                echo "
                                    <div class='sql-label moderate-1'>
                                        <label>relationship</label>
                                        <label style='margin: auto;'>Dep_Immediate_Family_Count</label>
                                    </div>
                                ";
                                // Read data of each row
                                $counter = 0; // Initialize a counter
                                while ($row = $result->fetch_assoc()) {
                                    // Determine the background color based on the counter
                                    $backgroundColor = ($counter % 2 == 0) ? '#E8F2D9' : '#FFFFFF';
                                    echo "
                                        <div class='sql-info moderate-1' style='background-color: $backgroundColor;'>
                                            <p>$row[relationship]</p>
                                            <p style='margin: auto;'>$row[Dep_Immediate_Family_Count]</p>
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
                        <p class="sql-description">2. Count the number of dependents for each member, where the number of dependents is 2 or more, and order the results by the number of dependents in descending order.</p>
                        <div class="sql-codes">
                            <p class="m-0"><b>SELECT</b> pin, COUNT(*) <b>AS</b> Dependent_Count<br><b>FROM</b> dependent<br><b>GROUP BY</b> pin<br><b>HAVING</b> COUNT(*) >= 2<br><b>ORDER BY</b> Dependent_Count <b>DESC</b>;</p>
                        </div>
                        <div id="moderate-2" class="sql-output">
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

                            $sql = "SELECT pin, COUNT(*) AS Dependent_Count FROM dependent GROUP BY pin HAVING COUNT(*) >= 2 ORDER BY Dependent_Count DESC;";
                            $result = $connection->query($sql);
                            
                            if ($result->num_rows > 0) {
                                echo "
                                    <div class='sql-label moderate-2'>
                                        <label style='margin: 10px auto;'>pin</label>
                                        <label style='margin: 10px auto;'>Dependent_Count</label>
                                    </div>
                                ";

                                // Read data of each row
                                $counter = 0; // Initialize a counter
                                while ($row = $result->fetch_assoc()) {
                                    // Determine the background color based on the counter
                                    $backgroundColor = ($counter % 2 == 0) ? '#E8F2D9' : '#FFFFFF';
                                    echo "
                                        <div class='sql-info moderate-2' style='background-color: $backgroundColor;'>
                                            <p style='margin: 10px auto;'>$row[pin]</button>
                                            <p style='margin: 10px auto;'>$row[Dependent_Count]</p>
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
                        <p class="sql-description">3. Display the average monthly income for male and female members who were born between the years 1990 and 2003.</p>
                        <div class="sql-codes">
                            <p class="m-0"><b>SELECT</b> sex, AVG(monthly_income) <b>AS</b> Average_of_Male_and_Female<br><b>FROM</b> member<br><b>WHERE</b> YEAR(birth_date) <b>BETWEEN</b> 1990 <b>AND</b> 2003<br><b>GROUP BY</b> sex;</p>
                        </div>
                        <div id="moderate-3" class="sql-output">
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

                            $sql = "SELECT sex, AVG(monthly_income) AS Average_of_Male_and_Female FROM member WHERE YEAR(birth_date) BETWEEN 1990 AND 2003 GROUP BY sex;";
                            $result = $connection->query($sql);
                            
                            if ($result->num_rows > 0) {
                                echo "
                                    <div class='sql-label moderate-3'>
                                        <label style='margin: 10px auto;'>sex</label>
                                        <label style='margin: 10px auto;'>Average_of_Male_and_Female</label>
                                    </div>
                                ";
                                // Read data of each row
                                $counter = 0; // Initialize a counter
                                while ($row = $result->fetch_assoc()) {
                                    // Determine the background color based on the counter
                                    $backgroundColor = ($counter % 2 == 0) ? '#E8F2D9' : '#FFFFFF';
                                    echo "
                                        <div class='sql-info moderate-3' style='background-color: $backgroundColor;'>
                                            <p style='margin: 10px auto;'>$row[sex]</p>
                                            <p style='margin: 10px auto;'>$row[Average_of_Male_and_Female]</p>
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
                        <p class="sql-description">4. Calculate the total monthly income for each month of the year, grouped by the month of birth for members. Display only the results where the total monthly income is more than 30000. Order the results by month in ascending order.</p>
                        <div class="sql-codes">
                            <p class="m-0"><b>SELECT</b> MONTH(birth_date) <b>AS</b> Months, SUM(monthly_income) <b>AS</b> Total_Monthly_Income<br><b>FROM</b> member<br><b>GROUP BY</b> MONTH(birth_date)<br><b>HAVING</b> SUM(monthly_income) > 30000<br><b>ORDER BY</b> MONTH(birth_date) <b>ASC</b>;</p>
                        </div>
                        <div id="moderate-4" class="sql-output">
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

                            $sql = "SELECT MONTH(birth_date) AS Months, SUM(monthly_income) AS Total_Monthly_Income FROM member GROUP BY MONTH(birth_date) HAVING SUM(monthly_income) > 30000 ORDER BY MONTH(birth_date) ASC";
                            $result = $connection->query($sql);
                            
                            if ($result->num_rows > 0) {
                                echo "
                                    <div class='sql-label moderate-4'>
                                        <label style='margin: 10px auto;'>Months</label>
                                        <label style='margin: 10px auto;'>Total_Monthly_Income</label>
                                    </div>
                                ";
                                // Read data of each row
                                $counter = 0; // Initialize a counter
                                while ($row = $result->fetch_assoc()) {
                                    // Determine the background color based on the counter
                                    $backgroundColor = ($counter % 2 == 0) ? '#E8F2D9' : '#FFFFFF';
                                    echo "
                                        <div class='sql-info moderate-4' style='background-color: $backgroundColor;'>
                                            <p style='margin: 10px auto;'>$row[Months]</button>
                                            <p style='margin: 10px auto;'>$row[Total_Monthly_Income]</p>
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
            const moderate1 = document.getElementById('moderate-1');
            const moderate2 = document.getElementById('moderate-2');
            const moderate3 = document.getElementById('moderate-3');
            const moderate4 = document.getElementById('moderate-4');
            
            if (screenWidth <= 580) {
                moderate1.style.width = `calc(${screenWidth}px - 60px)`;
                moderate2.style.width = `calc(${screenWidth}px - 60px)`;
                moderate3.style.width = `calc(${screenWidth}px - 60px)`;
                moderate4.style.width = `calc(${screenWidth}px - 60px)`;
            } else {
                moderate1.style.width = '';
                moderate2.style.width = '';
                moderate3.style.width = '';
                moderate4.style.width = '';
            }
        }
        updateWidth();
        window.addEventListener('resize', updateWidth);
    </script>
</body>
</html>