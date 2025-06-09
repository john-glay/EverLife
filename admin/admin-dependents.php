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
        unset($_SESSION['dep_keyword']);
        unset($_SESSION['dep_number']);
        unset($_SESSION['filter_disability']);
        unset($_SESSION['dep_filter_citizenship']);
        unset($_SESSION['dep_birth_from']);
        unset($_SESSION['dep_birth_to']);
        unset($_SESSION['dep_sort']);
    } else {
        // Store form inputs in session variables
        $_SESSION['dep_keyword'] = isset($_POST['dep_keyword']) ? $_POST['dep_keyword'] : '';
        $_SESSION['dep_number'] = isset($_POST['dep_number']) ? $_POST['dep_number'] : '';
        $_SESSION['filter_disability'] = isset($_POST['filter_disability']) ? $_POST['filter_disability'] : [];
        $_SESSION['dep_filter_citizenship'] = isset($_POST['dep_filter_citizenship']) ? $_POST['dep_filter_citizenship'] : '';
        $_SESSION['dep_birth_from'] = isset($_POST['dep_birth_from']) ? $_POST['dep_birth_from'] : '';
        $_SESSION['dep_birth_to'] = isset($_POST['dep_birth_to']) ? $_POST['dep_birth_to'] : '';
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
                <div class='d-flex align-items-center justify-content-end'>
                    <button class='update-btn' data-bs-dismiss='modal' aria-label='Close'>Close</button>
                </div>
            ";
        }
    
        exit; // Exit to prevent further HTML rendering for AJAX requests
    }

    if (isset($_POST['delete'])) {
        $dep_id = $_POST['delete'];

        // Prepare and execute the query
        $sql = "SELECT * FROM dependents WHERE dep_id = $dep_id";
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
                        <a class='delete-btn' type='button' href='../crud/delete-dependent.php?dep_id={$row['dep_id']}' onclick='dependentDeleted($row[dep_id])'>Delete</a>
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
if (isset($_GET['dep_sort'])) {
    $_SESSION['dep_sort'] = $_GET['dep_sort'];
}

// Retrieve form data from session
$dep_keyword = isset($_SESSION['dep_keyword']) ? $_SESSION['dep_keyword'] : '';
$dep_number = isset($_SESSION['dep_number']) ? $_SESSION['dep_number'] : '';
$filter_disability = isset($_SESSION['filter_disability']) ? $_SESSION['filter_disability'] : [];
$dep_filter_citizenship = isset($_SESSION['dep_filter_citizenship']) ? $_SESSION['dep_filter_citizenship'] : '';
$dep_birth_from = isset($_SESSION['dep_birth_from']) ? $_SESSION['dep_birth_from'] : '';
$dep_birth_to = isset($_SESSION['dep_birth_to']) ? $_SESSION['dep_birth_to'] : '';
$dep_sort = isset($_SESSION['dep_sort']) ? $_SESSION['dep_sort'] : '';

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
$count = "SELECT count(*) AS total_count FROM dependents WHERE 1=1";

// Append conditions based on the input
if (!empty($dep_keyword)) {
    $keyword = $connection->real_escape_string($dep_keyword);
    $count .= " AND (dep_name LIKE '%$keyword%' OR relationship LIKE '%$keyword%')";
}

if (!empty($dep_number)) {
    $number = $connection->real_escape_string($dep_number);
    $count .= " AND (pin LIKE '%$number%' OR dep_id LIKE '%$number%')";
}

if (!empty($filter_disability)) {
    $disability = implode("','", array_map([$connection, 'real_escape_string'], $filter_disability));
    $count .= " AND dep_perm_disability IN ('$disability')";
}

if (!empty($dep_filter_citizenship)) {
    $filter_citizenship = $connection->real_escape_string($dep_filter_citizenship);
    $count .= " AND dep_citizenship = '$filter_citizenship'";
}

if (!empty($dep_birth_to) && !empty($dep_birth_from)) {
    $from = $connection->real_escape_string($dep_birth_from);
    $to = $connection->real_escape_string($dep_birth_to);
    $count .= " AND YEAR(dep_birth_date) BETWEEN $from AND $to";
} else if (!empty($dep_birth_to) && empty($dep_birth_from)) {
    $to = $connection->real_escape_string($dep_birth_to);
    $count .= " AND YEAR(dep_birth_date) <= $to";
} else if (empty($dep_birth_to) && !empty($dep_birth_from)) {
    $from = $connection->real_escape_string($dep_birth_from);
    $count .= " AND YEAR(dep_birth_date) >= $from";
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
                    <a href="admin-dependents.php"><i class="bi bi-database-fill"></i><span>Database</span></a>
                </li>
                <li class="nav-item">
                    <a href="../index.php"><i class="bi bi-box-arrow-right"></i><span>Exit</span></a>
                </li>
            </ul>
        </div>

        <!-- Content -->
        <div class="main-content">
            <div class="tables">
                <a href="admin-members.php">Members</a>
                <a class="active" href="admin-dependents.php">Dependents</a>
            </div> 

            <div class="content">
                <header>
                    <h2 class="title">Dependents</h2>
                </header>    

                <header>
                    <h3 class="sub-title">Search Filters</h3>
                </header>  
                <section>
                    <form id="filter-dependent" method="POST" action="" class="filter-container">
                        <div class="filters disability">
                            <input type="text" class="input-form" name="dep_keyword" placeholder="Type a keyword" value="<?php echo htmlspecialchars($dep_keyword); ?>">
                            <input type="number" class="input-form" name="dep_number" placeholder="Type a number" value="<?php echo htmlspecialchars($dep_number); ?>">
                            <div class="filter-birthdate">
                                <label class="filter-label">Birth Year:</label>
                                <div class="d-flex align-items-center">
                                    <input type="number" class="input-form" name="dep_birth_from" placeholder="From" value="<?php echo htmlspecialchars($dep_birth_from); ?>">
                                    <hr class="filter-hr" />
                                    <input type="number" class="input-form" name="dep_birth_to" placeholder="To" value="<?php echo htmlspecialchars($dep_birth_to); ?>">
                                </div>
                            </div>
                            <div class="filter-disability">
                                <label class="filter-label">With Permanent Disability:</label>
                                <div class="flex-disability">
                                    <div class="with-disability d-flex align-items-center">
                                        <input type="checkbox" class="radio-form" name="filter_disability[]" value="Y" <?php echo in_array('Y', $filter_disability) ? 'checked' : ''; ?>>
                                        <label>Yes</label>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <input type="checkbox" class="radio-form" name="filter_disability[]" value="N" <?php echo in_array('N', $filter_disability) ? 'checked' : ''; ?>>
                                        <label>No</label>
                                    </div>    
                                </div>
                            </div>
                            <div class="filter-dep-citizenship">
                                <select id="dep_filter_citizenship" class="filter-select" name="dep_filter_citizenship" onchange="changeColor(this)">
                                    <option value="" <?php echo $dep_filter_citizenship == '' ? 'selected' : ''; ?>>Citizenship</option>
                                    <option value="F" <?php echo $dep_filter_citizenship == 'F' ? 'selected' : ''; ?>>Filipino (F)</option>
                                    <option value="FN" <?php echo $dep_filter_citizenship == 'FN' ? 'selected' : ''; ?>>Foreign National (FN)</option>
                                    <option value="DC" <?php echo $dep_filter_citizenship == 'DC' ? 'selected' : ''; ?>>Dual Citizen (DC)</option>
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
                            <h3 class="sub-title m-0">List of Dependents</h3>
                            <?php echo "<p class='m-0' style='font-size: 12px'>Total records: " . $total_count . "</p>";?> 
                        </div>
                        <form method="GET" class="filter-sort">
                            <div class="position-relative">
                                <select id="dep_filter_sort" class="filter-select" name="dep_sort" onchange="changeColor(this); this.form.submit()">
                                    <option value="" <?php echo $dep_sort == '' ? 'selected' : ''; ?>>Sort by</option>
                                    <option value="asc" <?php echo $dep_sort == 'asc' ? 'selected' : ''; ?>>Name (A-Z)</option>
                                    <option value="desc" <?php echo $dep_sort == 'desc' ? 'selected' : ''; ?>>Name (Z-A)</option>
                                </select>
                                <i class="bi bi-chevron-down select-icon position-absolute"></i>
                            </div>
                        </form>
                    </div>
                </header>
                <section>
                    <div id="list-dependents" class="list-members">
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
                        $sql = "SELECT * FROM dependents WHERE 1=1";

                        // Append conditions based on the input
                        if (!empty($dep_keyword)) {
                            $keyword = $connection->real_escape_string($dep_keyword);
                            $sql .= " AND (dep_name LIKE '%$keyword%' OR relationship LIKE '%$keyword%')";
                        }

                        if (!empty($dep_number)) {
                            $number = $connection->real_escape_string($dep_number);
                            $sql .= " AND (pin LIKE '%$number%' OR dep_id LIKE '%$number%')";
                        }

                        if (!empty($filter_disability)) {
                            $disability = implode("','", array_map([$connection, 'real_escape_string'], $filter_disability));
                            $sql .= " AND dep_perm_disability IN ('$disability')";
                        }

                        if (!empty($dep_filter_citizenship)) {
                            $filter_citizenship = $connection->real_escape_string($dep_filter_citizenship);
                            $sql .= " AND dep_citizenship = '$filter_citizenship'";
                        }

                        if (!empty($dep_birth_to) && !empty($dep_birth_from)) {
                            $from = $connection->real_escape_string($dep_birth_from);
                            $to = $connection->real_escape_string($dep_birth_to);
                            $sql .= " AND YEAR(dep_birth_date) BETWEEN $from AND $to";
                        } else if (!empty($dep_birth_to) && empty($dep_birth_from)) {
                            $to = $connection->real_escape_string($dep_birth_to);
                            $sql .= " AND YEAR(dep_birth_date) <= $to";
                        } else if (empty($dep_birth_to) && !empty($dep_birth_from)) {
                            $from = $connection->real_escape_string($dep_birth_from);
                            $sql .= " AND YEAR(dep_birth_date) >= $from";
                        }

                        // Append sorting condition
                        if ($dep_sort == 'asc') {
                            $sql .= " ORDER BY dep_name ASC";
                        } elseif ($dep_sort == 'desc') {
                            $sql .= " ORDER BY dep_name DESC";
                        }

                        // Execute the query
                        $result = $connection->query($sql);
                        
                        if ($result->num_rows > 0) {
                            echo "
                                <div class='list-label list-dependents'>
                                    <label style='margin: auto;'>Action</label>
                                    <label style='margin: auto;'>Member's PIN</label>
                                    <label style='margin: auto;'>ID</label>
                                    <label>Name</label>
                                    <label style='margin: auto;'>Date of Birth</label>
                                    <label style='margin: auto;'>Citizenship</label>
                                    <label style='margin: auto; text-align: center;'>With Permanent Disability</label>
                                    <label>Relationship</label>
                                </div>
                            ";
                            // Read data of each row
                            $counter = 0; // Initialize a counter
                            while ($row = $result->fetch_assoc()) {
                                // Determine the background color based on the counter
                                $backgroundColor = ($counter % 2 == 0) ? '#E8F2D9' : '#FFFFFF';
                                echo "
                                    <div class='list-info list-dependents' style='background-color: $backgroundColor;'>
                                        <div class='action-buttons'>
                                            <a class='submit-btn' href='../crud/update-dependent.php?dep_id={$row['dep_id']}''><i class='bi bi-pencil-square'></i></a>
                                            <button class='delete-btn' type='button' data-bs-toggle='modal' data-bs-target='#deleteDependentModal' data-pin='{$row['dep_id']}'><i class='bi bi-trash3'></i></button>
                                        </div>
                                        <button type='button' class='list-link' data-bs-toggle='modal' data-bs-target='#viewMember' data-pin='{$row['pin']}' method='post'>$row[pin]</button>
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
                    <div class='modal fade' id='deleteDependentModal' tabindex="-1" aria-labelledby="deleteDependentModalLabel" aria-hidden="true">
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
                                    <p class="modal-text">The record with the id '<span id="idModal"></span>' has been <mark>deleted successfully.</mark> You will no longer see it in your records.</p>
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
                                    <p class="modal-text">The record with the id '<span id="updateModal"></span>' has been <mark>updated successfully.</mark> The new information is now displayed.</p>
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
        function dependentDeleted(id) {
            // Set the localStorage item
            localStorage.setItem('dependentDeleted', id);
        }

        // Check if the deletion has been successful
        if (localStorage.getItem('dependentDeleted') != "null") {
            // Get the value from localStorage
            let idModal = localStorage.getItem("dependentDeleted");
            document.getElementById("idModal").innerHTML = idModal;

            // If not, show the modal and set the flag
            new bootstrap.Modal(document.getElementById('successfulDeletionModal')).show();
            localStorage.setItem('dependentDeleted', null);
        }

        // Updated successfully
        if (localStorage.getItem('dependentUpdated') != "null") {
            // Get the value from localStorage
            let updateModal = localStorage.getItem("dependentUpdated");
            document.getElementById("updateModal").innerHTML = updateModal;

            // If not, show the modal and set the flag
            new bootstrap.Modal(document.getElementById('updatedModal')).show();
            localStorage.setItem('dependentUpdated', null);
        }

        function updateWidth() {
            const screenWidth = window.innerWidth;
            const listMember = document.getElementById('list-dependents');
            
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
            const form = document.getElementById('filter-dependent');

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
            var filter_citizenship = document.getElementById('dep_filter_citizenship');
            var filter_sort = document.getElementById('dep_filter_sort');

            changeColor(filter_citizenship);
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

            $('#deleteDependentModal').on('show.bs.modal', function (event) {
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