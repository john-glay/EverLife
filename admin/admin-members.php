<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "everlife";

// Create connection
$connection = new mysqli( $servername, $username, $password, $database );

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['clear'])) {
        // Clear session variables
        unset($_SESSION['keyword']);
        unset($_SESSION['number']);
        unset($_SESSION['filter_sex']);
        unset($_SESSION['filter_citizenship']);
        unset($_SESSION['filter_civil_status']);
        unset($_SESSION['filter_contributor']);
        unset($_SESSION['min_income']);
        unset($_SESSION['max_income']);
        unset($_SESSION['birth_from']);
        unset($_SESSION['birth_to']);
        unset($_SESSION['sort']);
    } else {
        // Store form inputs in session variables
        $_SESSION['keyword'] = isset($_POST['keyword']) ? $_POST['keyword'] : '';
        $_SESSION['number'] = isset($_POST['number']) ? $_POST['number'] : '';
        $_SESSION['filter_sex'] = isset($_POST['filter_sex']) ? $_POST['filter_sex'] : [];
        $_SESSION['filter_citizenship'] = isset($_POST['filter_citizenship']) ? $_POST['filter_citizenship'] : '';
        $_SESSION['filter_civil_status'] = isset($_POST['filter_civil_status']) ? $_POST['filter_civil_status'] : '';
        $_SESSION['filter_contributor'] = isset($_POST['filter_contributor']) ? $_POST['filter_contributor'] : '';
        $_SESSION['min_income'] = isset($_POST['min_income']) ? $_POST['min_income'] : '';
        $_SESSION['max_income'] = isset($_POST['max_income']) ? $_POST['max_income'] : '';
        $_SESSION['birth_from'] = isset($_POST['birth_from']) ? $_POST['birth_from'] : '';
        $_SESSION['birth_to'] = isset($_POST['birth_to']) ? $_POST['birth_to'] : '';
    }

    if (isset($_POST['pin'])) {
        $pin = $_POST['pin'];

        // Prepare and execute the query
        $sql = "SELECT * FROM members WHERE pin = $pin";
        $result = $connection->query($sql);

        if ($row = $result->fetch_assoc()) {
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

            echo "
                <div class='d-block w-100 text-end'>
                    <i class='bi bi-x-lg modal-close-btn' data-bs-dismiss='modal' aria-label='Close'></i>
                </div>
                <div class='modal-title review'>
                    <h4>Member's Information</h4>
                </div>
                <div class='modal-text review'>
                    <h5 class='review-title'>I. Personal Details</h5>
                    <div class='container-review'>
                        <label>Pin:</label>
                        <p>$row[pin]</p>
                        <label>Name:</label>
                        <p>$row[name]</p>
                        <label>Mother's Maiden Name:</label>
                        <p>$row[mother_mdn_name]</p>
                        <label>Spouse:</label>
                        <p>$row[spouse]</p>
                        <label>Date of Birth:</label>
                        <p>$row[birth_date]</p>
                        <label>Place of Birth:</label>
                        <p>$row[birth_place]</p>
                        <label>Sex:</label>
                        <p>$row[sex]</p>
                        <label>Civil Status:</label>
                        <p>$row[civil_status]</p>
                        <label>Citizenship:</label>
                        <p>$row[citizenship]</p>
                        <label>PhilSys ID Number:</label>
                        <p>$row[philsys_id_no]</p>
                        <label>Taxpayer Identification Number:</label>
                        <p>$row[tin]</p>
                    </div>
                    <h5 class='review-title'>II. Address and Contact Details</h5>
                    <div class='container-review'>
                        <label>Permanent Home Address:</label>
                        <p>$row[perm_adrs]</p>
                        <label>Mailing Address:</label>
                        <p>$row[mailing_adrs]</p>
                        <label>Home Phone Number:</label>
                        <p>$row[home_phone_no]</p>
                        <label>Mobile Number:</label>
                        <p>$row[mobile_no]</p>
                        <label>Business Direct Line:</label>
                        <p>$row[business_directline]</p>
                        <label>E-mail Address:</label>
                        <p>$row[email]</p>
                    </div>
                    <h5 id='depTitle' class='review-title'>III. Declaration of Dependents</h5>
            ";
        } 

        // Prepare and execute the query
        $sql = "SELECT * FROM dependents WHERE pin = $pin";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                    <div class='container-review dependents'>
                        <label>ID</label>
                        <p class='d-block'>$row[dep_id]</p>
                        <label>Name</label>
                        <p class='d-block'>$row[dep_name]</p>
                        <label>Relationship</label>
                        <p class='d-block'>$row[relationship]</p>
                        <label>Date of Birth</label>
                        <p class='d-block'>$row[dep_birth_date]</p>
                        <label>With  Permanent  Disability</label>
                        <p class='d-block'>$row[dep_perm_disability]</p>
                        <label>Citizenship</label>
                        <p class='d-block'>$row[dep_citizenship]</p>
                    </div>
                ";
            } 
        } else {
            echo "
                <p style='font-weight: 300; margin: 40px auto; text-align: center;'>This member has no declared dependents.</p>
            ";
        }

        // Prepare and execute the query
        $sql = "SELECT * FROM members WHERE pin = $pin";
        $result = $connection->query($sql);

        if ($row = $result->fetch_assoc()) {
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
                    <h5 class='review-title'>VI. Member Type</h5>
                    <div class='container-review'>
                        <label>Contributor:</label>
                        <p>$row[contributor]</p>
                        <label>Contributor Type:</label>
                        <p>$row[contributor_type]</p>    
                        <label>PRA SRRV Number:</label>
                        <p>$row[pra_srrv_no]</p>
                        <label>ACR I-Card Number:</label>
                        <p>$row[acr_icard_no]</p>
                        <label>PWD ID Number:</label>
                        <p>$row[pwd_id_no]</p>
                        <label>Profession:</label>
                        <p>$row[profession]</p>    
                        <label>Monthly Income:</label>
                        <p>$row[monthly_income]</p>
                        <label>Proof of Income:</label>
                        <p>$row[income_proof]</p>
                    </div>
                </div>
                <div class='d-flex align-items-center justify-content-between' style='margin: 15px;'>
                    <button class='modalClose' data-bs-dismiss='modal' aria-label='Close'>Close</button>
                    <div class='d-flex align-items-center'>
                        <a class='update-btn' type='button' href='../crud/update-member.php?pin={$row['pin']}''>Update</a>
                        <button class='delete-btn' type='button' data-bs-toggle='modal' data-bs-target='#deleteMemberModal' data-pin='{$row['pin']}'>Delete</button>
                    </div> 
                </div>
            ";
        }

        exit; // Exit to prevent further HTML rendering for AJAX requests
    }

    if (isset($_POST['delete'])) {
        $pin = $_POST['delete'];

        // Prepare and execute the query
        $sql = "SELECT * FROM members WHERE pin = $pin";
        $result = $connection->query($sql);

        if ($row = $result->fetch_assoc()) {
            echo "
                <div class='modalBody'>
                    <div class='d-block w-100 text-end'>
                        <i class='bi bi-x-lg modal-close-btn' data-bs-dismiss='modal' aria-label='Close'></i>
                    </div>
                    <div class='modal-title delete'>
                        <h4>Delete Record</h4>
                    </div>
                    <p class='modal-text'>This action is <mark>permanent and irreversible.</mark> Please confirm if you're certain you want to proceed with this deletion.</p>
                    <div class='d-flex justify-content-end'>
                        <a class='delete-btn' type='button' href='../crud/delete-member.php?pin={$row['pin']}' onclick='memberDeleted($row[pin])'>Delete</a>
                    </div>
                </div>
            ";
        }

        exit; // Exit to prevent further HTML rendering for AJAX requests
    }

    // Redirect to the same page to avoid resubmission on refresh
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Handle sorting option
if (isset($_GET['sort'])) {
    $_SESSION['sort'] = $_GET['sort'];
}

// Retrieve form data from session
$keyword = isset($_SESSION['keyword']) ? $_SESSION['keyword'] : '';
$number = isset($_SESSION['number']) ? $_SESSION['number'] : '';
$filter_sex = isset($_SESSION['filter_sex']) ? $_SESSION['filter_sex'] : [];
$filter_citizenship = isset($_SESSION['filter_citizenship']) ? $_SESSION['filter_citizenship'] : '';
$filter_civil_status = isset($_SESSION['filter_civil_status']) ? $_SESSION['filter_civil_status'] : '';
$filter_contributor = isset($_SESSION['filter_contributor']) ? $_SESSION['filter_contributor'] : '';
$min_income = isset($_SESSION['min_income']) ? $_SESSION['min_income'] : '';
$max_income = isset($_SESSION['max_income']) ? $_SESSION['max_income'] : '';
$birth_from = isset($_SESSION['birth_from']) ? $_SESSION['birth_from'] : '';
$birth_to = isset($_SESSION['birth_to']) ? $_SESSION['birth_to'] : '';
$sort = isset($_SESSION['sort']) ? $_SESSION['sort'] : '';

// Connect to the database and retrieve filtered data
$servername = "localhost";
$username = "root";
$password = "";
$database = "everlife";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Initialize the base query
$count = "SELECT count(*) AS total_count FROM members WHERE 1=1";

// Append conditions based on the input
if (!empty($keyword)) {
    $keyword = $connection->real_escape_string($keyword);
    $count .= " AND (name LIKE '%$keyword%' OR mother_mdn_name LIKE '%$keyword%' OR spouse LIKE '%$keyword%' OR birth_place LIKE '%$keyword%' OR perm_adrs LIKE '%$keyword%' OR mailing_adrs LIKE '%$keyword%' OR email LIKE '%$keyword%' OR contributor_type LIKE '%$keyword%' OR profession LIKE '%$keyword%' OR income_proof LIKE '%$keyword%')";
}

if (!empty($number)) {
    $number = $connection->real_escape_string($number);
    $count .= " AND (pin LIKE '%$number%' OR philsys_id_no LIKE '%$number%' OR tin LIKE '%$number%' OR home_phone_no LIKE '%$number%' OR mobile_no LIKE '%$number%' OR business_directline LIKE '%$number%' OR pra_srrv_no LIKE '%$number%' OR acr_icard_no LIKE '%$number%' OR pwd_id_no LIKE '%$number%')";
}

if (!empty($filter_sex)) {
    $sex_values = implode("','", array_map([$connection, 'real_escape_string'], $filter_sex));
    $count .= " AND sex IN ('$sex_values')";
}

if (!empty($filter_citizenship)) {
    $filter_citizenship = $connection->real_escape_string($filter_citizenship);
    $count .= " AND citizenship = '$filter_citizenship'";
}

if (!empty($filter_civil_status)) {
    $filter_civil_status = $connection->real_escape_string($filter_civil_status);
    $count .= " AND civil_status = '$filter_civil_status'";
}

if (!empty($filter_contributor)) {
    $filter_contributor = $connection->real_escape_string($filter_contributor);
    $count .= " AND contributor = '$filter_contributor'";
}

if (!empty($max_income) && !empty($min_income)) {
    $min = $connection->real_escape_string($min_income);
    $max = $connection->real_escape_string($max_income);
    $count .= " AND monthly_income BETWEEN $min AND $max";
} else if (!empty($max_income) && empty($min_income)) {
    $max = $connection->real_escape_string($max_income);
    $count .= " AND monthly_income <= $max";
} else if (empty($max_income) && !empty($min_income)) {
    $min = $connection->real_escape_string($min_income);
    $count .= " AND monthly_income >= $min";
}

if (!empty($birth_to) && !empty($birth_from)) {
    $from = $connection->real_escape_string($birth_from);
    $to = $connection->real_escape_string($birth_to);
    $count .= " AND YEAR(birth_date) BETWEEN $from AND $to";
} else if (!empty($birth_to) && empty($birth_from)) {
    $to = $connection->real_escape_string($birth_to);
    $count .= " AND YEAR(birth_date) <= $to";
} else if (empty($birth_to) && !empty($birth_from)) {
    $from = $connection->real_escape_string($birth_from);
    $count .= " AND YEAR(birth_date) >= $from";
}

// Execute the count query to fetch the total count
$result = $connection->query($count);
$total_count = $result->fetch_assoc()['total_count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Links -->
    <link rel="icon" type="image/x-icon" href="../images/logo-icon.jpg">
    <link rel="stylesheet" href="../styles/css/database.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                <li class="nav-item active">
                    <a href="admin-members.php"><i class="bi bi-database-fill"></i><span>Database</span></a>
                </li>
                <li class="nav-item">
                    <a href="../index.php"><i class="bi bi-box-arrow-right"></i><span>Exit</span></a>
                </li>
            </ul>
        </div>

        <!-- Content -->
        <div class="main-content">
            <div class="tables">
                <a class="active" href="admin-members.php">Members</a>
                <a href="admin-dependents.php">Dependents</a>
            </div> 

            <div class="content">
                <header>
                    <h2 class="title">Members</h2>
                </header>

                <header>
                    <h3 class="sub-title">Search Filters</h3>
                </header>  
                <section>
                    <form id="filter-member" method="POST" class="filter-container">
                        <div class="filters">
                            <input type="text" class="input-form column-2" name="keyword" placeholder="Type a keyword" value="<?php echo htmlspecialchars($keyword); ?>">
                            <input type="number" class="input-form" name="number" placeholder="Type a number" value="<?php echo htmlspecialchars($number); ?>">
                            <div class="row-2">
                                <label class="filter-label">Birth Year:</label>
                                <div class="d-flex align-items-center">
                                    <input type="number" class="input-form" name="birth_from" placeholder="From" value="<?php echo htmlspecialchars($birth_from); ?>">
                                    <hr class="filter-hr" />
                                    <input type="number" class="input-form" name="birth_to" placeholder="To" value="<?php echo htmlspecialchars($birth_to); ?>">    
                                </div>
                            </div>
                            <div class="row-2">
                                <label class="filter-label">Monthly Income:</label>
                                <div class="d-flex align-items-center">
                                    <input type="number" class="input-form" name="min_income" placeholder="Min" value="<?php echo htmlspecialchars($min_income); ?>">
                                    <hr class="filter-hr" />
                                    <input type="number" class="input-form" name="max_income" placeholder="Max" value="<?php echo htmlspecialchars($max_income); ?>">
                                </div>
                            </div>
                            <div class="filter-sex">
                                <label class="filter-label m-0">Sex:</label>
                                <div class="with-radio-btn">
                                    <div class="d-flex align-items-center">
                                        <input type="checkbox" class="radio-form" name="filter_sex[]" value="M" <?php echo in_array('M', $filter_sex) ? 'checked' : ''; ?>>
                                        <label>Male</label>    
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <input type="checkbox" class="radio-form" name="filter_sex[]" value="F" <?php echo in_array('F', $filter_sex) ? 'checked' : ''; ?>>
                                        <label>Female</label>    
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative">
                                <select id="filter_civil_status" class="filter-select" name="filter_civil_status" onchange="changeColor(this)">
                                    <option value="" <?php echo $filter_civil_status == '' ? 'selected' : ''; ?>>Civil Status</option>
                                    <option value="S" <?php echo $filter_civil_status == 'S' ? 'selected' : ''; ?>>Single (S)</option>
                                    <option value="A" <?php echo $filter_civil_status == 'A' ? 'selected' : ''; ?>>Annulled (A)</option>
                                    <option value="M" <?php echo $filter_civil_status == 'M' ? 'selected' : ''; ?>>Married (M)</option>
                                    <option value="W" <?php echo $filter_civil_status == 'W' ? 'selected' : ''; ?>>Widow/er (W)</option>
                                    <option value="LS" <?php echo $filter_civil_status == 'LS' ? 'selected' : ''; ?>>Legally Separated (LS)</option>
                                </select>
                                <i class="bi bi-chevron-down select-icon position-absolute"></i>
                            </div>
                            <div class="position-relative column-2">
                                <select id="filter_contributor" class="filter-select" name="filter_contributor" onchange="changeColor(this)">
                                    <option value="" <?php echo $filter_contributor == '' ? 'selected' : ''; ?>>Contributor</option>
                                    <option disabled style="text-align:center;">---------------&nbsp;&nbsp;&nbsp;Direct Contributor&nbsp;&nbsp;&nbsp;---------------</option>
                                    <option value="EG" <?php echo $filter_contributor == 'EG' ? 'selected' : ''; ?>>Employed Government (EG)</option>
                                    <option value="EP" <?php echo $filter_contributor == 'EP' ? 'selected' : ''; ?>>Employed Private (EP)</option>
                                    <option value="FD" <?php echo $filter_contributor == 'FD' ? 'selected' : ''; ?>>Family Driver (FD)</option>
                                    <option value="FDL" <?php echo $filter_contributor == 'FDL' ? 'selected' : ''; ?>>Filipinos with Dual Citizenship/Living Abroad (FDL)</option>
                                    <option value="FN" <?php echo $filter_contributor == 'FN' ? 'selected' : ''; ?>>Foreign National (FN)</option>
                                    <option value="K" <?php echo $filter_contributor == 'K' ? 'selected' : ''; ?>>Kasambahay (K)</option>
                                    <option value="LM" <?php echo $filter_contributor == 'LM' ? 'selected' : ''; ?>>Lifetime Member (LM)</option>
                                    <option value="MW" <?php echo $filter_contributor == 'MW' ? 'selected' : ''; ?>>Migrant Worker (MW)</option>
                                    <option value="PP" <?php echo $filter_contributor == 'PP' ? 'selected' : ''; ?>>Professional Practitioner (PP)</option>
                                    <option value="SI" <?php echo $filter_contributor == 'SI' ? 'selected' : ''; ?>>Self-Earning Individual (SI)</option>
                                    <option disabled style="text-align:center;">---------------&nbsp;&nbsp;&nbsp;Indirect Contributor&nbsp;&nbsp;&nbsp;---------------</option>
                                    <option value="PM" <?php echo $filter_contributor == 'PM' ? 'selected' : ''; ?>>4Ps/MCCT (PM)</option>
                                    <option value="BN" <?php echo $filter_contributor == 'BN' ? 'selected' : ''; ?>>Bangsamoro/Normalization (BN)</option>
                                    <option value="KK" <?php echo $filter_contributor == 'KK' ? 'selected' : ''; ?>>KIA/KIPO (KK)</option>
                                    <option value="LGU" <?php echo $filter_contributor == 'LGU' ? 'selected' : ''; ?>>LGU-sponsored (LGU)</option>
                                    <option value="L" <?php echo $filter_contributor == 'L' ? 'selected' : ''; ?>>Listahanan (L)</option>
                                    <option value="NGA" <?php echo $filter_contributor == 'NGA' ? 'selected' : ''; ?>>NGA-sponsored (NGA)</option>
                                    <option value="P" <?php echo $filter_contributor == 'P' ? 'selected' : ''; ?>>PAMANA (P)</option>
                                    <option value="PWD" <?php echo $filter_contributor == 'PWD' ? 'selected' : ''; ?>>Person with Disability (PWD)</option>
                                    <option value="PS" <?php echo $filter_contributor == 'PS' ? 'selected' : ''; ?>>Private-sponsored (PS)</option>
                                    <option value="SC" <?php echo $filter_contributor == 'SC' ? 'selected' : ''; ?>>Senior Citizen (SC)</option>
                                </select>
                                <i class="bi bi-chevron-down select-icon position-absolute"></i>
                            </div>
                            <div class="filter-citizenship">
                                <select id="filter_citizenship" class="filter-select" name="filter_citizenship" onchange="changeColor(this)">
                                    <option value="" <?php echo $filter_citizenship == '' ? 'selected' : ''; ?>>Citizenship</option>
                                    <option value="F" <?php echo $filter_citizenship == 'F' ? 'selected' : ''; ?>>Filipino (F)</option>
                                    <option value="FN" <?php echo $filter_citizenship == 'FN' ? 'selected' : ''; ?>>Foreign National (FN)</option>
                                    <option value="DC" <?php echo $filter_citizenship == 'DC' ? 'selected' : ''; ?>>Dual Citizen (DC)</option>
                                </select>
                                <i class="bi bi-chevron-down select-icon position-absolute"></i>
                            </div>
                        </div>
                        <div class="filter-buttons"> 
                            <button type="submit" name="clear" class="clear-btn">Clear All</button>
                            <button type="submit" class="submit-btn">Apply</button>
                        </div>
                    </form>
                </section> 

                <header>
                    <div class="list-header">
                        <div>
                            <h3 class="sub-title m-0">List of Members</h3>
                            <?php echo "<p class='m-0' style='font-size: 12px'>Total records: " . $total_count . "</p>";?> 
                        </div>
                        <form method="GET" class="filter-sort">
                            <div class="position-relative">
                                <select id="filter_sort" class="filter-select" name="sort" onchange="changeColor(this); this.form.submit()">
                                    <option value="" <?php echo $sort == '' ? 'selected' : ''; ?>>Sort by</option>
                                    <option value="asc" <?php echo $sort == 'asc' ? 'selected' : ''; ?>>Name (A-Z)</option>
                                    <option value="desc" <?php echo $sort == 'desc' ? 'selected' : ''; ?>>Name (Z-A)</option>
                                </select>
                                <i class="bi bi-chevron-down select-icon position-absolute"></i>    
                            </div>
                        </form>    
                    </div>
                </header>
                <section>
                    <div id="list-members" class="list-members">
                        <?php
                        // Connect to the database and retrieve filtered data
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $database = "everlife";

                        // Create connection
                        $connection = new mysqli($servername, $username, $password, $database);

                        // Check connection
                        if ($connection->connect_error) {
                            die("Connection failed: " . $connection->connect_error);
                        }

                        // Initialize the base query
                        $sql = "SELECT * FROM members WHERE 1=1";

                        // Append conditions based on the input
                        if (!empty($keyword)) {
                            $keyword = $connection->real_escape_string($keyword);
                            $sql .= " AND (name LIKE '%$keyword%' OR mother_mdn_name LIKE '%$keyword%' OR spouse LIKE '%$keyword%' OR birth_place LIKE '%$keyword%' OR perm_adrs LIKE '%$keyword%' OR mailing_adrs LIKE '%$keyword%' OR email LIKE '%$keyword%' OR contributor_type LIKE '%$keyword%' OR profession LIKE '%$keyword%' OR income_proof LIKE '%$keyword%')";
                        }

                        if (!empty($number)) {
                            $number = $connection->real_escape_string($number);
                            $sql .= " AND (pin LIKE '%$number%' OR philsys_id_no LIKE '%$number%' OR tin LIKE '%$number%' OR home_phone_no LIKE '%$number%' OR mobile_no LIKE '%$number%' OR business_directline LIKE '%$number%' OR pra_srrv_no LIKE '%$number%' OR acr_icard_no LIKE '%$number%' OR pwd_id_no LIKE '%$number%')";
                        }

                        if (!empty($filter_sex)) {
                            $sex_values = implode("','", array_map([$connection, 'real_escape_string'], $filter_sex));
                            $sql .= " AND sex IN ('$sex_values')";
                        }

                        if (!empty($filter_citizenship)) {
                            $filter_citizenship = $connection->real_escape_string($filter_citizenship);
                            $sql .= " AND citizenship = '$filter_citizenship'";
                        }

                        if (!empty($filter_civil_status)) {
                            $filter_civil_status = $connection->real_escape_string($filter_civil_status);
                            $sql .= " AND civil_status = '$filter_civil_status'";
                        }

                        if (!empty($filter_contributor)) {
                            $filter_contributor = $connection->real_escape_string($filter_contributor);
                            $sql .= " AND contributor = '$filter_contributor'";
                        }

                        if (!empty($max_income) && !empty($min_income)) {
                            $min = $connection->real_escape_string($min_income);
                            $max = $connection->real_escape_string($max_income);
                            $sql .= " AND monthly_income BETWEEN $min AND $max";
                        } else if (!empty($max_income) && empty($min_income)) {
                            $max = $connection->real_escape_string($max_income);
                            $sql .= " AND monthly_income <= $max";
                        } else if (empty($max_income) && !empty($min_income)) {
                            $min = $connection->real_escape_string($min_income);
                            $sql .= " AND monthly_income >= $min";
                        }

                        if (!empty($birth_to) && !empty($birth_from)) {
                            $from = $connection->real_escape_string($birth_from);
                            $to = $connection->real_escape_string($birth_to);
                            $sql .= " AND YEAR(birth_date) BETWEEN $from AND $to";
                        } else if (!empty($birth_to) && empty($birth_from)) {
                            $to = $connection->real_escape_string($birth_to);
                            $sql .= " AND YEAR(birth_date) <= $to";
                        } else if (empty($birth_to) && !empty($birth_from)) {
                            $from = $connection->real_escape_string($birth_from);
                            $sql .= " AND YEAR(birth_date) >= $from";
                        }

                        // Append sorting condition
                        if ($sort == 'asc') {
                            $sql .= " ORDER BY name ASC";
                        } elseif ($sort == 'desc') {
                            $sql .= " ORDER BY name DESC";
                        }

                        // Execute the query
                        $result = $connection->query($sql);

                        if ($result->num_rows > 0) {
                            echo "
                                <div class='list-label'>
                                    <label style='margin: auto;'>Action</label>
                                    <label style='margin: auto;'>PIN</label>
                                    <label>Name</label>
                                    <label>Mother's Maiden Name</label>
                                    <label>Spouse</label>
                                    <label style='margin: auto;'>Date of Birth</label>
                                    <label>Place of Birth</label>
                                    <label style='margin: auto;'>Sex</label>
                                    <label style='margin: auto;'>Civil Status</label>
                                    <label style='margin: auto;'>Citizenship</label>
                                    <label>PhilSys ID Number</label>
                                    <label>TIN</label>
                                    <label>Permanent Home Address</label>
                                    <label>Mailing Address</label>
                                    <label>Home Phone Number</label>
                                    <label>Mobile Number</label>
                                    <label>Business Direct Line</label>
                                    <label>Email</label>
                                    <label style='margin: auto;'>Contributor</label>
                                    <label>Contributor Type</label>
                                    <label>PRA SRRV No.</label>
                                    <label>ACR I-Card No.</label>
                                    <label>PWD ID No.</label>
                                    <label>Profession</label>
                                    <label>Monthly Income</label>
                                    <label>Proof of Income</label>
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
                                    <div class='list-info' style='background-color: $backgroundColor;'>
                                        <div class='action-buttons'>
                                            <a class='submit-btn' href='../crud/update-member.php?pin={$row['pin']}''><i class='bi bi-pencil-square'></i></a>
                                            <button class='delete-btn' type='button' data-bs-toggle='modal' data-bs-target='#deleteMemberModal' data-pin='{$row['pin']}'><i class='bi bi-trash3'></i></button>
                                        </div>
                                        <button type='button' class='list-link' data-bs-toggle='modal' data-bs-target='#viewMember' data-pin='{$row['pin']}' method='post'>$row[pin]</button>
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
                                        <p>$row[mobile_no]</p>
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
                                    <img src='../images/no-record.png' alt='no-record' draggable='false'>
                                    <p class='text-center'>No records found.</p>
                                </div>
                            ";
                        }

                        $connection->close();
                        ?>
                    </div>

                    <!-- View Member -->
                    <div class='modal fade' id='viewMember' tabindex="-1" aria-labelledby="viewMemberLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modalContent">
                                <div id='modalBody' class="modalBody">
                                        <!-- Modal Content -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class='modal fade' id='deleteMemberModal' tabindex="-1" aria-labelledby="deleteMemberModalLabel" aria-hidden="true">
                        <div class='modal-dialog delete modal-dialog-centered'>
                            <div id="deleteModal" class='modalContent'>
                                <!-- Delete Content -->
                            </div>
                        </div>
                    </div>

                    <!-- Successful Deletion -->
                    <div class="modal fade" id="successfulDeletionModal" tabindex="-1" aria-labelledby="successfulDeletionModalLabel" aria-hidden="true">
                        <div class="modal-dialog success modal-dialog-centered">
                            <div class="modalContent">
                                <div class="modalBody">
                                    <div class="d-block w-100 text-end">
                                        <i class="bi bi-x-lg modal-close-btn" data-bs-dismiss="modal" aria-label="Close"></i>
                                    </div>
                                    <div class="modal-title">
                                        <h4>Deleted Successfully</h4>
                                    </div>
                                    <p class="modal-text">The record with the pin '<span id="pinModal"></span>' has been <mark>deleted successfully.</mark> You will no longer see it in your records.</p>
                                    <button type="button" class="update-btn" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Updated Successfully -->
                    <div class="modal fade" id="updatedModal" tabindex="-1" aria-labelledby="updatedModalLabel" aria-hidden="true">
                        <div class="modal-dialog success modal-dialog-centered">
                            <div class="modalContent">
                                <div class="modalBody">
                                    <div class="d-block w-100 text-end">
                                        <i class="bi bi-x-lg modal-close-btn" data-bs-dismiss="modal" aria-label="Close"></i>
                                    </div>
                                    <div class="modal-title">
                                        <h4>Updated Successfully</h4>
                                    </div>
                                    <p class="modal-text">The record with the pin '<span id="updateModal"></span>' has been <mark>updated successfully.</mark> The new information is now displayed.</p>
                                    <button type="button" class="update-btn" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <a href="admin-home.php" class="org-logo">
                    <img src="../images/logo-name.png" alt="org-logo" draggable="false">
                </a>  
            </div>
        </div>
    </div>

    <script>
        // Deleting a record
        function memberDeleted(pin) {
            // Set the localStorage item
            localStorage.setItem('memberDeleted', pin);
        }

        // Check if the deletion has been successful
        if (localStorage.getItem('memberDeleted') != "null") {
            // Get the value from localStorage
            let pinModal = localStorage.getItem("memberDeleted");
            document.getElementById("pinModal").innerHTML = pinModal;

            // If not, show the modal and set the flag
            new bootstrap.Modal(document.getElementById('successfulDeletionModal')).show();
            localStorage.setItem('memberDeleted', null);
        }

        // Updated successfully
        if (localStorage.getItem('memberUpdated') != "null") {
            // Get the value from localStorage
            let updateModal = localStorage.getItem("memberUpdated");
            document.getElementById("updateModal").innerHTML = updateModal;

            // If not, show the modal and set the flag
            new bootstrap.Modal(document.getElementById('updatedModal')).show();
            localStorage.setItem('memberUpdated', null);
        }

        function updateWidth() {
            const screenWidth = window.innerWidth;
            const listMember = document.getElementById('list-members');
            
            if (screenWidth <= 580) {
                listMember.style.width = `calc(${screenWidth}px - 60px)`;
            } else {
                listMember.style.width = '';
            }
        }
        updateWidth();
        window.addEventListener('resize', updateWidth);
        
        // Pressing the Enter key in any input field does not submit the form
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('filter-member');

            form.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                }
            });
        });

        function changeColor(selectElement) {
            var selectedOption = selectElement.options[selectElement.selectedIndex].value;

            if (selectedOption === "") {
                selectElement.style.color = "#757575";
            } else {
                selectElement.style.color = "black";
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var filter_citizenship = document.getElementById('filter_citizenship');
            var filter_civil_status = document.getElementById('filter_civil_status');
            var filter_contributor = document.getElementById('filter_contributor');
            var filter_sort = document.getElementById('filter_sort');

            changeColor(filter_citizenship);
            changeColor(filter_civil_status);
            changeColor(filter_contributor);
            changeColor(filter_sort);
        });

        // For Modal
        $(document).ready(function(){
            $('#viewMember').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var pin = button.data('pin');
                
                // AJAX request to fetch data
                $.ajax({
                    url: '', // Same page
                    type: 'post',
                    data: {pin: pin},
                    success: function(response){
                        // Update modal body with the response
                        $('#modalBody').html(response);
                    }
                });
            });

            $('#deleteMemberModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var deletePin = button.data('pin');
                
                // AJAX request to fetch data
                $.ajax({
                    url: '', // Same page
                    type: 'post',
                    data: {delete: deletePin},
                    success: function(response){
                        // Update modal body with the response
                        $('#deleteModal').html(response);
                    }
                });
            });
        });

        // Number Input Validation
        function validateNumberInput(event) {
            const validKeys = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight'];
            const key = event.key;
            const keyCode = event.code;

            // Allow control keys and prevent others
            if (validKeys.includes(keyCode) || (!isNaN(Number(key)) && keyCode !== 'Space')) {
                return true;
            } else {
                event.preventDefault();
                return false;
            }
        }

        function setupValidation() {
            const numberInputs = document.querySelectorAll('input[type="number"]');

            numberInputs.forEach(input => {
                // Prevent 'e', 'E', '-', '+', and any non-numeric input
                input.addEventListener('keydown', validateNumberInput);

                // Ensure value is 0 or greater on input change
                input.addEventListener('input', function() {
                    if (input.value < 0) {
                        input.value = 0;
                    }
                });
            });
        }
        document.addEventListener('DOMContentLoaded', setupValidation);

        // Prevents users from inputting the special characters 
        document.querySelectorAll('input[type="text"], input[type="email"]').forEach(function(input) {
            input.addEventListener('input', function(event) {
                let value = event.target.value;
                // Remove ' and $ and " from the input
                value = value.replace(/[!"'$%#^&*()_+\=\[\]{}\\|~`:;:/?<>]/g, '');
                event.target.value = value;
            });
        });
    </script>
</body>
</html>