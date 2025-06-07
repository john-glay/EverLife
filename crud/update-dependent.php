<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "philhealth";

// Create connection
$connection = new mysqli( $servername, $username, $password, $database );

$dep_id = "";
$dep_name = "";
$dep_birth_date = "";
$dep_citizenship = "";
$dep_perm_disability = "";
$relationship = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
    // GET method: Show the data

    if ( !isset( $_GET['dep_id'] ) ) {
        header("location: ../admin/admin-dependents.php");
        exit;
    }

    $dep_id = $_GET["dep_id"];

    // Read data
    $sql = "SELECT * FROM dependent WHERE dep_id = $dep_id";
    $result = $connection->query( $sql );
    $row = $result->fetch_assoc();

    if ( !$row ) {
        header("location: ../admin/admin-dependents.php");
        exit;
    }

    $dep_name = $row["dep_name"];
    $dep_birth_date = $row["dep_birth_date"];
    $dep_citizenship = $row["dep_citizenship"];
    $dep_perm_disability = $row["dep_perm_disability"];
    $relationship = $row["relationship"];
} else {
    // POST method: Update the data

    $dep_id = $_POST["dep_id"];
    $dep_name = $_POST["dep_name"];
    $dep_birth_date = $_POST["dep_birth_date"];
    $dep_citizenship = $_POST["dep_citizenship"];
    $dep_perm_disability = $_POST["dep_perm_disability"];
    $relationship = $_POST["relationship"];

    do {
        // Add new client to database
        $sqlDependents= "UPDATE dependent " . 
                        "SET dep_name = '$dep_name', dep_birth_date = '$dep_birth_date', dep_citizenship = '$dep_citizenship', dep_perm_disability = '$dep_perm_disability', relationship = '$relationship' " . 
                        "WHERE dep_id = $dep_id";
        $result = $connection->query( $sqlDependents );

        header("location: ../admin/admin-dependents.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Links -->
    <link rel="icon" type="image/x-icon" href="../images/logo-icon.jpg">
    <link rel="stylesheet" href="../styles/css/registration.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="../script/registration.js"></script>
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
                    <a href="../admin/admin-about.php"><i class="bi bi-people"></i><span>About</span></a>
                </li>
                <li class="nav-item">
                    <a href="../admin/admin-registration.php"><i class="bi bi-plus-circle"></i><span>Registration</span></a>
                </li>
                <li class="nav-item">
                    <a href="../admin/admin-members.php"><i class="bi bi-database"></i><span>Database</span></a>
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
                    <h2 class="title">Update Dependent</h2>
                    <div class="instructions">
                        <p>Please update all records with current information.</p>  
                    </div>
                </header>

                <form id="registration-form" method="post" class="form">
                    <input type="hidden" name="dep_id" value="<?php echo $dep_id; ?>">
                    <!-- Declaration of Dependents -->
                    <h3 class="sub-title">III. Declaration of Dependents</h3>
                    <div id="alert-dependents" class='register-warning alert alert-warning alert-dismissible fade show' role='alert'>
                        <p class='m-0'>Kindly fill out all fields, except for those that are marked as optional.</p>
                    </div>
                    <div id="dependent-forms-container">
                        <div class="container-form dep-base">
                            <div>
                                <label class="label-form d-block">Name<small>&nbsp;*</small></label>
                                <input id="input-depName" type="text" class="input-form" name="dep_name" value="<?php echo $dep_name; ?>">
                            </div>
                            <div>
                                <label class="label-form d-block">Relationship<small>&nbsp;*</small></label>
                                <input id="input-depRelationship" type="text" class="input-form" name="relationship" value="<?php echo $relationship; ?>">
                            </div>
                            <div>
                                <label class="label-form d-block">Date of Birth<small>&nbsp;*</small></label>
                                <input id="input-depBday" type="date" class="input-form" name="dep_birth_date" value="<?php echo $dep_birth_date; ?>">
                            </div>
                            <div>
                                <label class="label-form">With Permanent Disability<small>&nbsp;*</small></label>
                                <div class="with-radio-btn">
                                    <div class="d-flex align-items-center">
                                        <input type="radio" class="radio-form" name="dep_perm_disability" <?php if ($dep_perm_disability=="Y") echo "checked";?> onclick="depRadioValue()" value="Y">
                                        <label>Yes</label>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <input type="radio" class="radio-form" name="dep_perm_disability" <?php if ($dep_perm_disability=="N") echo "checked";?> onclick="depRadioValue()" value="N">
                                        <label>No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="column-2">
                                <label class="label-form">Citizenship<small>&nbsp;*</small></label>
                                <div class="with-radio-btn">
                                    <div class="d-flex align-items-center">
                                        <input type="radio" class="radio-form" name="dep_citizenship" <?php if ($dep_citizenship=="F") echo "checked";?> onclick="depRadioValue()" value="F">
                                        <label>Filipino</label>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <input type="radio" class="radio-form" name="dep_citizenship" <?php if ($dep_citizenship=="FN") echo "checked";?> onclick="depRadioValue()" value="FN">
                                        <label>Foreign National</label>
                                    </div>
                                    <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="dep_citizenship" <?php if ($dep_citizenship=="DC") echo "checked";?> onclick="depRadioValue()" value="DC">
                                        <label>Dual Citizen</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="registration-btns dependents-btn">
                        <a id="clearButton" type="button" class="clear-btn text-decoration-none" href="../admin/admin-dependents.php">Cancel</a>
                        <button id="checkButton" type="button" class="submit-btn" onclick="displayDepValue()">Update</button>
                    </div>

                    <!-- Modal -->
                    <div class='modal fade' id='reviewInfo' tabindex="-1" aria-labelledby="reviewInfoLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modalContent">
                                <div class="modalBody">
                                    <div class="d-block w-100 text-end">
                                        <i class="bi bi-x-lg modal-close-btn" data-bs-dismiss="modal" aria-label="Close"></i>
                                    </div>
                                    <div class="modal-title review">
                                        <h4>Check Your Information</h4>
                                    </div>
                                    <div class="modal-text review">
                                        <h5 class="review-title">III. Declaration of Dependents</h5>
                                        <div class="container-review dependents">
                                            <label>Name:</label>
                                            <p id="display-depName"></p>
                                            <label>Relationship:</label>
                                            <p id="display-depRelationship"></p>
                                            <label>Date of Birth:</label>
                                            <p id="display-depBday"></p>
                                            <label>With Permanent Disability:</label>
                                            <p id="display-depDisability"></p>
                                            <label>Citizenship:</label>
                                            <p id="display-depCitizenship"></p>
                                        </div>
                                    </div>
                                    <div class="review-btns">
                                        <button type="button" class="clear-btn" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="submit-btn" onclick="dependentUpdated(<?php echo $dep_id; ?>)">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <a href="../admin/admin-home.php" class="org-logo">
                    <img src="../images/logo-name.png" alt="org-logo" draggable="false">
                </a>   
            </div>  
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', depRadioValue());

        // Pressing the Enter key in any input field does not submit the form
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registration-form');

            form.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                }
            });
        });

        // Check Required Fields
        document.getElementById('checkButton').addEventListener('click', function() {
            let alertDependets = document.getElementById('alert-dependents');
            let isDependents = false;

            // Declaration of Dependents
            let name = document.getElementById('input-depName');
            let relationship = document.getElementById('input-depRelationship');
            let bday = document.getElementById('input-depBday');
            let sex = document.getElementsByName('dep_perm_disability');
            let citizenship = document.getElementsByName('dep_citizenship');
            let isSex = false;
            let isCitizenship = false;

            for (var i = 0; i < sex.length; i++) {
                if (sex[i].checked) {
                    isSex = true;
                    break;
                }
            }

            for (var i = 0; i < citizenship.length; i++) {
                if (citizenship[i].checked) {
                    isCitizenship = true;
                    break;
                }
            }

            if (name.value.trim() == "" || relationship.value.trim() == "" || bday.value.trim() == "" || !isSex || !isCitizenship) {
                alertDependets.style.display = "block";
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } else {
                alertDependets.style.display = "none";
                isDependents = true;
            }
            
            // Required
            if (isDependents == true) {
                new bootstrap.Modal(document.getElementById('reviewInfo')).show();
            }
        });

        // Submitting the form
        function dependentUpdated(id) {
            // Set the localStorage item
            localStorage.setItem('dependentUpdated', id);
        }

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