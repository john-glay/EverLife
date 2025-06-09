<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "everlife";

// Create connection
$connection = new mysqli( $servername, $username, $password, $database );

$pin = "";
$name = "";
$mother_mdn_name = "";
$spouse = "";
$birth_date = "";
$birth_place = "";
$sex = "";
$civil_status = "";
$citizenship = "";
$philsys_id_no = "";
$tin = "";
$perm_adrs = "";
$mailing_adrs = "";
$home_phone_no = "";
$mobile_no = "";
$business_directline = "";
$email = "";
$dependents = "";
$contributor = "";
$contributor_type = "";
$self_earning_indi = "";
$self_earning_other = "";
$migrant_worker = "";
$pra_srrv_no = "";
$acr_icard_no = "";
$pwd_id_no = "";
$profession = "";
$monthly_income = "";
$income_proof = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $name = $_POST["name"];
    $mother_mdn_name = $_POST["mother_mdn_name"];
    $spouse = !empty($_POST["spouse"]) ? $_POST["spouse"] : "N/A";
    $birth_date = $_POST["birth_date"];
    $birth_place = $_POST["birth_place"];
    $sex = $_POST["sex"];
    $civil_status = $_POST["civil_status"];
    $citizenship = $_POST["citizenship"];
    $philsys_id_no = $_POST["philsys_id_no"];
    $tin = $_POST["tin"];
    $perm_adrs = $_POST["perm_adrs"];
    $mailing_adrs = $_POST["mailing_adrs"];
    $home_phone_no = $_POST["home_phone_no"];
    $mobile_no = $_POST["mobile_no"];
    $business_directline = $_POST["business_directline"];
    $email = $_POST["email"];
    $dependents = isset($_POST['dependents']);
    $contributor = $_POST["contributor"];
    $self_earning_indi = isset($_POST["self_earning_indi"]);
    $self_earning_other = $_POST["self_earning_other"];
    $migrant_worker = isset($_POST["migrant_worker"]);
    $pra_srrv_no = $_POST["pra_srrv_no"];
    $acr_icard_no = $_POST["acr_icard_no"];
    $pwd_id_no = $_POST["pwd_id_no"];
    $profession = !empty($_POST["profession"]) ? $_POST["profession"] : "N/A";
    $monthly_income = $_POST["monthly_income"];
    $income_proof = $_POST["income_proof"];

    if (!empty($self_earning_indi)) {
        $contributor_type = $_POST["self_earning_indi"];
    } else if (!empty($self_earning_other)) {
        $contributor_type = $_POST["self_earning_other"];
    } else if (!empty($migrant_worker)) { 
        $contributor_type = $_POST["migrant_worker"];
    } else {
        $contributor_type = "N/A";
    }

    function random12DigitInteger() {
        $min = 100000000000; // Smallest 12-digit number
        $max = 999999999999; // Largest 12-digit number
        return random_int($min, $max);
    }
    
    $pin = random12DigitInteger();
    $dbpin = "SELECT pin FROM members";
    $result = $connection->query($dbpin);

    // Read data of each row
    while ($row = $result->fetch_assoc()) {
        if ($row['pin'] == $pin) {
            $pin = random12DigitInteger();
        }
    }

    if (isset($_POST['dependents']) && is_array($_POST['dependents'])) {
        $dependents = $_POST['dependents'];
        foreach ($dependents as $dependent) {
            $dep_name = htmlspecialchars($dependent['name']);
            $dep_birthdate = htmlspecialchars($dependent['birthdate']);
            $dep_citizenship = htmlspecialchars($dependent['citizenship']);
            $disability = htmlspecialchars($dependent['disability']);
            $relationship = htmlspecialchars($dependent['relationship']);
    
            $sqlDependents =    "INSERT INTO dependents (pin, dep_name, dep_birth_date, dep_citizenship, dep_perm_disability, relationship) " .
                                "VALUES ('$pin', '$dep_name', '$dep_birthdate', '$dep_citizenship', '$disability', '$relationship')";
    
            $dep_result = $connection->query($sqlDependents);
        }
    } 

    do {
        // Add new client to database
        $sqlMembers =   "INSERT INTO members (pin, name, mother_mdn_name, spouse, birth_date, birth_place, sex, civil_status, citizenship, philsys_id_no, tin, perm_adrs, mailing_adrs, home_phone_no, mobile_no, business_directline,  email, contributor, contributor_type, pra_srrv_no, acr_icard_no, pwd_id_no, profession, monthly_income, income_proof) " . 
                        "VALUES ('$pin', '$name', '$mother_mdn_name', '$spouse', '$birth_date', '$birth_place', '$sex', '$civil_status', '$citizenship', '$philsys_id_no', '$tin', '$perm_adrs', '$mailing_adrs', '$home_phone_no', '$mobile_no', '$business_directline', '$email', '$contributor', '$contributor_type', '$pra_srrv_no', '$acr_icard_no', '$pwd_id_no', '$profession', '$monthly_income', '$income_proof')";
                        
        $member_result = $connection->query($sqlMembers);

        $pin = "";
        $name = "";
        $mother_mdn_name = "";
        $spouse = "";
        $birth_date = "";
        $birth_place = "";
        $sex = "";
        $civil_status = "";
        $citizenship = "";
        $philsys_id_no = "";
        $tin = "";
        $perm_adrs = "";
        $mailing_adrs = "";
        $home_phone_no = "";
        $mobile_no = "";
        $business_directline = "";
        $email = "";
        $dependents = "";
        $contributor = "";
        $contributor_type = "";
        $self_earning_indi = "";
        $self_earning_other = "";
        $migrant_worker = "";
        $pra_srrv_no = "";
        $acr_icard_no = "";
        $pwd_id_no = "";
        $profession = "";
        $monthly_income = "";
        $income_proof = "";

        header("location: user-registration.php");
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
                    <a href="user-home.php"><i class="bi bi-house"></i><span>Home</span></a>
                </li>
                <li class="nav-item">
                    <a href="user-about.php"><i class="bi bi-people"></i><span>About</span></a>
                </li>
                <li class="nav-item active">
                    <a href="user-registration.php"><i class="bi bi-plus-circle-fill"></i><span>Registration</span></a>
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
                    <h2 class="title">Member Registration</h2>
                    <div class="instructions">
                        <p>Please read the <button type="button" data-bs-toggle="modal" data-bs-target="#instructionsModal">instructions</button> before filling out this form.</p>  
                    </div>

                    <!-- Instructions Modal -->
                    <div class="modal fade" id="instructionsModal" tabindex="-1" aria-labelledby="instructionsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modalContent">
                                <div class="modalBody">
                                    <div class="d-block w-100 text-end">
                                        <i class="bi bi-x-lg modal-close-btn" data-bs-dismiss="modal" aria-label="Close"></i>
                                    </div>
                                    <div class="modal-title">
                                        <h4>Instructions</h4>
                                    </div>
                                    <ol class="modal-text">
                                        <li>All fields are mandatory unless indicated as optional. If the information is not applicable, write "N/A."</li>
                                        <li>Indicate registrant's/member's name as it appears in the birth certificate.</li>
                                        <li>The full mother's maiden name of registrant/member must be indicated as it appears in the birth certificate.</li>
                                        <li>Indicate the full name of spouse if registrant/member is married.</li>
                                        <li>Indicate the complete permanent and mailing addresses and contact numbers.</li>
                                        <li>For MEMBER TYPE, check the appropriate box which best describes your current membership status</li>
                                        <li>For Direct Contributors, except employed, sea-based migrant workers and lifetime members, indicate the profession, monthly income and proof of income to be submitted</li>
                                        <li>For Self-earning individuals, Kasambahays and Family Drivers, indicate the actual monthly income in the space provided</li>
                                        <li>In declaring dependents, provide the full name of the living spouse, children below 21 years old, and parents who are 60 years old and above totally dependent to the member.</li>
                                        <li>Dependents with disabilities shall be registered as principal members in accordance with Republic Act 11228, which mandates health coverage for all persons with disabilities (PWDs).</li>
                                    </ol>
                                    <button type="button" class="modalClose" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                
                <form id="registration-form" method="post" class="form">
                    <!-- Personal Details -->
                    <h3 class="sub-title">I. Personal Details</h3>
                    <div id="alert-personal" class='register-warning alert alert-warning alert-dismissible fade show' role='alert'>
                        <p class='m-0'>Kindly fill out all fields, except for those that are marked as optional.</p>
                    </div>
                    <div class="container-form">
                        <div>
                            <label class="label-form">Name<small>&nbsp;*</small></label>
                            <input id="input-name" type="text" class="input-form" name="name" value="">
                        </div>
                        <div>
                            <label class="label-form">Mother's Maiden Name<small>&nbsp;*</small></label>
                            <input id="input-mother" type="text" class="input-form" name="mother_mdn_name" value="">
                        </div>
                        <div>
                            <label class="label-form d-block">Spouse <span>(if Married)</span></label>
                            <input id="input-spouse" type="text" class="input-form" name="spouse" value="">
                        </div>
                        <div>
                            <label class="label-form d-block">Date of Birth<small>&nbsp;*</small></label>
                            <input id="input-bday" type="date" class="input-form" name="birth_date" value="">
                        </div>
                        <div>
                            <label class="label-form d-block">Place of Birth<small>&nbsp;*</small> <span>(City/Municipality/Province/Country)</span></label>
                            <input id="input-bplace" type="text" class="input-form" name="birth_place" value="">
                        </div>
                        <div>
                            <label class="label-form">Sex<small>&nbsp;*</small></label>
                            <div class="with-radio-btn">
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="sex" onclick="displayRadioValue()" value="M">
                                    <label>Male</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="sex" onclick="displayRadioValue()" value="F">
                                    <label>Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="column-2">
                            <label class="label-form d-block">Civil Status<small>&nbsp;*</small></label>
                            <div class="with-radio-btn">
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="civil_status" onclick="displayRadioValue()" value="S">
                                    <label>Single</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="civil_status" onclick="displayRadioValue()" value="A">
                                    <label>Annulled</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input id="civilStatus-married" type="radio" class="radio-form" name="civil_status" onclick="displayRadioValue()" value="M">
                                    <label>Married</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="civil_status" onclick="displayRadioValue()" value="W">
                                    <label>Widow/er</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="civil_status" onclick="displayRadioValue()" value="LS">
                                    <label>Legally Separated</label>
                                </div>
                            </div>
                        </div>
                        <div class="column-2">
                            <label class="label-form d-block">Citizenship<small>&nbsp;*</small></label>
                            <div class="with-radio-btn">
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="citizenship" onclick="displayRadioValue()" value="F">
                                    <label>Filipino</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="citizenship" onclick="displayRadioValue()" value="FN">
                                    <label>Foreign National</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="citizenship" onclick="displayRadioValue()" value="DC">
                                    <label>Dual Citizen</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="label-form d-block">PhilSys ID Number <span>(Optional)</span></label>
                            <input id="input-philsys"  type="number" class="input-form" name="philsys_id_no" value="">
                        </div>
                        <div>
                            <label class="label-form d-block">Taxpayer Identification Number <span>(Optional)</span></label>
                            <input id="input-tin" type="number" class="input-form" name="tin" value="">
                        </div>
                    </div>

                    <!-- Address and Contact Details -->
                    <h3 class="sub-title">II. Address and Contact Details</h3>
                    <div id="alert-address" class='register-warning alert alert-warning alert-dismissible fade show' role='alert'>
                        <p class='m-0'>Kindly fill out all fields, except for those that are marked as optional.</p>
                    </div>
                    <div class="container-form">
                        <div class="column-2">
                            <label class="label-form d-block">Permanent Address<small>&nbsp;*</small></label>
                            <input id="input-permAdrs" type="text" class="input-form" name="perm_adrs" value="">    
                        </div>
                        <div class="column-2">
                            <div class="d-flex align-items-center flex-wrap" style="column-gap: 10px;">
                                <label class="label-form d-block">Mailing Address<small>&nbsp;*</small></label>
                                <div class="d-flex align-items-center" style="margin-bottom: 5px;">
                                    <input id="same_mailing_adrs" type="checkbox" class="checkbox-form" name="same_mailing_adrs" value="Same as Permanent Home Address">
                                    <label class="label">Same as Permanent Home Address</label>    
                                </div>
                            </div>
                            <input id="input-mailAdrs" type="text" class="input-form" name="mailing_adrs" value="">
                        </div>
                        <div>
                            <label class="label-form d-block">Home Phone Number</label>
                            <input id="input-homePhone" type="number" class="input-form" name="home_phone_no" value="">
                        </div>
                        <div>
                            <label class="label-form d-block">Mobile Number<small>&nbsp;*</small></label>
                            <input id="input-mobile" type="number" class="input-form" name="mobile_no" value="">
                        </div>
                        <div>
                            <label class="label-form d-block">Business <span>(Direct Line)</span></label>
                            <input id="input-business" type="number" class="input-form" name="business_directline" value="">
                        </div>
                        <div>
                            <label class="label-form d-block">Email Address<small>&nbsp;*</small></label>
                            <input id="input-email" type="email" class="input-form" name="email" value="">
                        </div>
                    </div>

                    <!-- Declaration of Dependents -->
                    <h3 class="sub-title">III. Declaration of Dependents</h3>
                    <div id="alert-dependents" class='register-warning alert alert-warning alert-dismissible fade show' role='alert'>
                        <p class='m-0'>Kindly fill out all fields, except for those that are marked as optional.</p>
                    </div>
                    <div id="dependent-forms-container"></div>
                    <div class="container-form">
                        <button type="button" id="add-dependent-btn" class="add-dep-btn column-2">Add Dependent</button>    
                    </div>

                    <!-- Member Type -->
                    <h3 class="sub-title">VI. Member Type</h3>
                    <div id="alert-member" class='register-warning alert alert-warning alert-dismissible fade show' role='alert'>
                        <p class='m-0'>Kindly fill out all fields, except for those that are marked as optional.</p>
                    </div>
                    <div class="container-form contributors">
                        <div class="column-2">
                            <label class="label-form d-block">Contributor<small>&nbsp;*</small></label>
                            <div class="container-contributor">
                                <label class="contributor-label">DIRECT</label>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="contributor" onclick="showConType(this.value)" value="LM">
                                    <label>Lifetime Member</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="contributor" onclick="showConType(this.value)" value="FD">
                                    <label>Family Driver</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="contributor" onclick="showConType(this.value)" value="EP">
                                    <label>Employed Private</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="contributor" onclick="showConType(this.value)" value="K">
                                    <label>Kasambahay</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="contributor" onclick="showConType(this.value)" value="SI">
                                    <label>Self-Earning Individual</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="contributor" onclick="showConType(this.value)" value="MW">
                                    <label>Migrant Worker</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="contributor" onclick="showConType(this.value)" value="EG">
                                    <label>Employed Government</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="contributor" onclick="showConType(this.value)" value="FN">
                                    <label>Foreign National</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="contributor" onclick="showConType(this.value)" value="PP">
                                    <label>Professional Practitioner</label>
                                </div>
                                <div class="d-flex align-items-center column-2">
                                    <input type="radio" class="radio-form" name="contributor" onclick="showConType(this.value)" value="FDL">
                                    <label>Filipinos with Dual Citizenship</label>
                                </div>
                            </div>
                        </div>
                        <div class="column-2">
                            <div class="container-contributor">
                                <label class="contributor-label">INDIRECT</label>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="contributor" onclick="showConType(this.value)" value="SC">
                                    <label>Senior Citizen</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="contributor" onclick="showConType(this.value)" value="P">
                                    <label>PAMANA</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="contributor" onclick="showConType(this.value)" value="LGU">
                                    <label>LGU-sponsored</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="contributor" onclick="showConType(this.value)" value="L">
                                    <label>Listahanan</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="contributor" onclick="showConType(this.value)" value="NGA">
                                    <label>NGA-sponsored</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="contributor" onclick="showConType(this.value)" value="KK">
                                    <label>KIA/KIKO</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="contributor" onclick="showConType(this.value)" value="PS">
                                    <label>Private-sponsored</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="contributor" onclick="showConType(this.value)" value="PM">
                                    <label>4Ps/MCCT</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="radio-form" name="contributor" onclick="showConType(this.value)" value="PWD">
                                    <label>Person with Disability</label>
                                </div>
                                <div class="d-flex align-items-center column-2">
                                    <input type="radio" class="radio-form" name="contributor" onclick="showConType(this.value)" value="BN">
                                    <label>Bangsamoro/Normalization</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-form member-type">
                        <!-- Contributor Types -->
                        <div id="type-SI" class="hidden column-2">
                            <label class="label-form">Contributor Type<small>&nbsp;*</small></label>
                            <div class="container-type">
                                <label>For Self-Earning Individual</label>
                                <div class='no-grid with-radio-btn'>
                                    <div class='d-flex align-items-center'>
                                        <input type='radio' class='radio-form' name='self_earning_indi' onclick="forConType(this.value)" value='Individual'>
                                        <label>Individual</label>
                                    </div>
                                    <div class='d-flex align-items-center'>
                                        <input type='radio' class='radio-form' name='self_earning_indi' onclick="forConType(this.value)" value='Sole Proprietor'>
                                        <label>Sole Proprietor</label>
                                    </div>
                                    <div class='d-flex align-items-center'>
                                        <input type='radio' class='radio-form' name='self_earning_indi' onclick="forConType(this.value)" value='Group Enrollment Scheme'>
                                        <label>Group Enrollment Scheme</label>
                                    </div>
                                </div>
                                <div class='with-grid'>
                                    <div class='d-flex align-items-center'>
                                        <label>Other</label>
                                        <input id="input-SIOther" type='text' class='input-form' name='self_earning_other' value=''>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="type-MW" class="hidden column-2">
                            <label class="label-form">Contributor Type<small>&nbsp;*</small></label>
                            <div class="container-type">
                                <label>For Migrant Worker</label>
                                <div class="no-grid with-radio-btn">
                                    <div class="d-flex align-items-center">
                                        <input type="radio" class="radio-form" name="migrant_worker"  onclick="forConType(this.value)" value="Land-Based">
                                        <label>Land-Based</label>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <input type="radio" class="radio-form" name="migrant_worker"  onclick="forConType(this.value)" value="Sea-Based">
                                        <label>Sea-Based</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="type-FN" class="hidden column-2">
                            <label class="label-form">For Foreign National<small>&nbsp;*</small></label>
                            <div class="container-type">
                                <div class="with-grid">
                                    <div class="d-flex align-items-center">
                                        <label>PRA SRRV No.</label>
                                        <input id="input-praSSRV" type="number" class="input-form" name="pra_srrv_no" value="">
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <label>ACR I-Card No.</label>
                                        <input id="input-acrICard" type="number" class="input-form" name="acr_icard_no" value="">
                                    </div>    
                                </div>
                            </div>
                        </div>
                        <div id="type-PWD" class="hidden column-2">
                            <label class="label-form">For Person with Disability<small>&nbsp;*</small></label>
                            <div class="container-type">
                                <div class="with-grid">
                                    <div class="d-flex align-items-center">
                                        <label>PWD ID No.</label>
                                        <input id="input-pwdID" type="number" class="input-form" name="pwd_id_no" value="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="profession" class="column-2">
                            <label class="label-form">Profession<small>&nbsp;*</small> <span>(Except Employed, Lifetime Members, and Sea-based Migrant Worker)</span></label>
                            <input id="input-profession" type="text" class="input-form" name="profession" value="">
                        </div>
                        <div>
                            <label class="label-form">Monthly Income<small>&nbsp;*</small></label>
                            <input id="input-income" type="number" class="input-form" name="monthly_income" value="">
                        </div>
                        <div>
                            <label class="label-form">Proof of Income<small>&nbsp;*</small></label>
                            <input id="input-incomeProof" type="text" class="input-form" name="income_proof" value="">
                        </div>
                    </div>
                    <div class="registration-btns">
                        <button id="clearButton" type="button" class="clear-btn">Clear All</button>
                        <button id="checkButton" type="button" class="submit-btn" onclick="displayInputValue()">Register</button>
                    </div>

                    <!-- Modal -->
                    <div class='modal fade' id='reviewInfo' data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                        <h5 class="review-title">I. Personal Details</h5>
                                        <div class="container-review">
                                            <label>Name:</label>
                                            <p id="display-name"></p>
                                            <label>Mother's Maiden Name:</label>
                                            <p id="display-mother"></p>
                                            <label>Spouse:</label>
                                            <p id="display-spouse"></p>
                                            <label>Date of Birth:</label>
                                            <p id="display-bday"></p>
                                            <label>Place of Birth:</label>
                                            <p id="display-bplace"></p>
                                            <label>Sex:</label>
                                            <p id="display-sex"></p>
                                            <label>Civil Status:</label>
                                            <p id="display-civilStatus"></p>
                                            <label>Citizenship:</label>
                                            <p id="display-citizenship"></p>
                                            <label>PhilSys ID Number:</label>
                                            <p id="display-philsys"></p>
                                            <label>Taxpayer Identification Number:</label>
                                            <p id="display-tin"></p>
                                        </div>
                                        <h5 class="review-title">II. Address and Contact Details</h5>
                                        <div class="container-review">
                                            <label>Permanent Home Address:</label>
                                            <p id="display-permAdrs"></p>
                                            <label>Mailing Address:</label>
                                            <p id="display-mailAdrs"></p>
                                            <label>Home Phone Number:</label>
                                            <p id="display-homePhone"></p>
                                            <label>Mobile Number:</label>
                                            <p id="display-mobile"></p>
                                            <label>Business Direct Line:</label>
                                            <p id="display-business"></p>
                                            <label>E-mail Address:</label>
                                            <p id="display-email"></p>
                                        </div>
                                        <h5 id="depTitle" class="review-title" style="display: none;">III. Declaration of Dependents</h5>
                                        <div id="dep-review"></div>
                                        <h5 class="review-title">VI. Member Type</h5>
                                        <div class="container-review">
                                            <label>Contributor:</label>
                                            <p id="display-contributor"></p>  
                                            <div id="conType" class="span-2 hidden">
                                                <label>Contributor Type:</label>
                                                <p id="display-conType"></p>    
                                            </div>
                                            <div id="praSSRV" class="span-2 hidden">
                                                <label>PRA SRRV Number:</label>
                                                <p id="display-praSSRV"></p>
                                            </div>
                                            <div id="acrICard" class="span-2 hidden">
                                                <label>ACR I-Card Number:</label>
                                                <p id="display-acrICard"></p>
                                            </div>
                                            <div id="pwdID" class="span-2 hidden">
                                                <label>PWD ID Number:</label>
                                                <p id="display-pwdID"></p>
                                            </div>
                                            <div id="prof" class="span-2">
                                                <label>Profession:</label>
                                                <p id="display-profession"></p>    
                                            </div>
                                            <label>Monthly Income:</label>
                                            <p id="display-income"></p>
                                            <label>Proof of Income:</label>
                                            <p id="display-incomeProof"></p>
                                        </div>
                                    </div>
                                    <div class="review-btns">
                                        <button type="button" class="clear-btn" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="submit-btn" onclick="successfulRegistration()">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                        <div class="modal-dialog success modal-dialog-centered">
                            <div class="modalContent">
                                <div class="modalBody">
                                    <div class="d-block w-100 text-end">
                                        <i class="bi bi-x-lg modal-close-btn" data-bs-dismiss="modal" aria-label="Close"></i>
                                    </div>
                                    <div class="modal-title">
                                        <h4>Congratulations!</h4>
                                    </div>
                                    <p class="modal-text">Your EverLife registration has been <mark>successfully completed.</mark> If you have any questions, feel free to <a href="https://www.everlife.gov.ph/" target="_blank">contact us.</a> Thank you!</p>
                                    <button type="button" class="modalClose" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <a href="user-home.php" class="org-logo">
                    <img src="../images/logo-name.png" alt="org-logo" draggable="false">
                </a>   
            </div>  
        </div>
    </div>

    <script>
        // Submitting the form
        function successfulRegistration() {
            // Set the localStorage item
            localStorage.setItem('successfulRegistration', 'true');
        }

        // Check if the registration has been successful
        if (localStorage.getItem('successfulRegistration') === 'true') {
            // If not, show the modal and set the flag
            new bootstrap.Modal(document.getElementById('successModal')).show();
            localStorage.setItem('successfulRegistration', 'false');
        }

        // Pressing the Enter key in any input field does not submit the form
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registration-form');

            form.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                }
            });
        });

        // Spouse and Civil Status (Married)
        document.addEventListener('DOMContentLoaded', function() {
            const spouseInput = document.getElementById('input-spouse');
            const marriedRadio = document.getElementById('civilStatus-married');
            const civilStatusRadios = document.querySelectorAll('input[name="civil_status"]');

            spouseInput.addEventListener('input', function() {
                if (spouseInput.value.trim() !== '') {
                    marriedRadio.checked = true;
                } else {
                    marriedRadio.checked = false;
                }
            });

            civilStatusRadios.forEach(function(radio) {
                radio.addEventListener('change', function() {
                    if (radio.id !== 'married' && radio.checked) {
                        spouseInput.value = '';
                    }
                });
            });
        });

        // Mailing Address
        document.getElementById('same_mailing_adrs').addEventListener('change', function() {
            const permAdrsInput = document.getElementById('input-permAdrs');
            const mailingAdrsInput = document.getElementById('input-mailAdrs');

            if (this.checked) {
                mailingAdrsInput.value = permAdrsInput.value;
                mailingAdrsInput.readOnly = true;
            } else {
                mailingAdrsInput.readOnly = false;
            }
        });

        // Contributor Type
        function showConType(con) {
            let conType = document.getElementById("conType");
            let praSSRV = document.getElementById("praSSRV");
            let acrICard = document.getElementById("acrICard");
            let pwdID = document.getElementById("pwdID");
            let prof = document.getElementById("prof");
            let SI = document.getElementById("type-SI");
            let MW = document.getElementById("type-MW");
            let FN = document.getElementById("type-FN");
            let PWD = document.getElementById("type-PWD");
            let profession = document.getElementById("profession");
            let inputProf = document.getElementById("input-profession");
            let inputPRA = document.getElementById('input-praSSRV');
            let inputACR = document.getElementById('input-acrICard');
            let inputPWD = document.getElementById('input-pwdID');
            let inputSIOther = document.getElementById('input-SIOther');
            const radioMW = document.getElementsByName('migrant_worker');
            const radioSI = document.getElementsByName('self_earning_indi');
            
            if (con == "SI") {
                conType.classList.remove("hidden");
                praSSRV.classList.add("hidden");
                acrICard.classList.add("hidden");
                pwdID.classList.add("hidden");
                SI.classList.remove("hidden");
                MW.classList.add("hidden");
                FN.classList.add("hidden");
                PWD.classList.add("hidden");
                inputPRA.value = "";
                inputACR.value = "";
                inputPWD.value = "";

                radioMW.forEach(radio => {
                    radio.checked = false;
                });
            } else if (con == "MW") {
                conType.classList.remove("hidden");
                praSSRV.classList.add("hidden");
                acrICard.classList.add("hidden");
                pwdID.classList.add("hidden");
                SI.classList.add("hidden");
                MW.classList.remove("hidden");
                FN.classList.add("hidden");
                PWD.classList.add("hidden");
                inputPRA.value = "";
                inputACR.value = "";
                inputPWD.value = "";
                inputSIOther.value = "";

                radioSI.forEach(radio => {
                    radio.checked = false;
                });
            } else if (con == "FN") {
                conType.classList.add("hidden");
                praSSRV.classList.remove("hidden");
                acrICard.classList.remove("hidden");
                pwdID.classList.add("hidden");
                SI.classList.add("hidden");
                MW.classList.add("hidden");
                FN.classList.remove("hidden");
                PWD.classList.add("hidden");
                inputPWD.value = "";
                inputSIOther.value = "";

                radioSI.forEach(radio => {
                    radio.checked = false;
                });

                radioMW.forEach(radio => {
                    radio.checked = false;
                });
            } else if (con == "PWD") {
                conType.classList.add("hidden");
                praSSRV.classList.add("hidden");
                acrICard.classList.add("hidden");
                pwdID.classList.remove("hidden");
                SI.classList.add("hidden");
                MW.classList.add("hidden");
                FN.classList.add("hidden");
                PWD.classList.remove("hidden");
                inputPRA.value = "";
                inputACR.value = "";
                inputSIOther.value = "";

                radioSI.forEach(radio => {
                    radio.checked = false;
                });

                radioMW.forEach(radio => {
                    radio.checked = false;
                });
            } else {
                conType.classList.add("hidden");
                praSSRV.classList.add("hidden");
                acrICard.classList.add("hidden");
                pwdID.classList.add("hidden");
                SI.classList.add("hidden");
                MW.classList.add("hidden");
                FN.classList.add("hidden");
                PWD.classList.add("hidden");
                inputPRA.value = "";
                inputACR.value = "";
                inputPWD.value = "";
                inputSIOther.value = "";

                radioSI.forEach(radio => {
                    radio.checked = false;
                });
                
                radioMW.forEach(radio => {
                    radio.checked = false;
                });
            }

            if (con == "EP" || con == "EG" || con == "LM") {
                prof.classList.add("hidden");
                profession.classList.add("hidden");
                inputProf.value = "";
            } else {
                prof.classList.remove("hidden");
                profession.classList.remove("hidden");
            }

            displayConType(con);
        }

        // Profession
        function forConType(forConType) {
            let profession = document.getElementById("profession");
            let input = document.getElementById("input-profession");

            if (forConType == "Sea-Based") {
                prof.classList.add("hidden");
                profession.classList.add("hidden");
                input.value = "";
            } else {
                prof.classList.replace('hidden', 'd-flex');
                profession.classList.remove("hidden");
            }
            
            displayMigrantWorker(forConType);
        }

        // SI Contributor Type
        function handleRadioButtonChange() {
            const SIOther = document.getElementById('input-SIOther');
            if (SIOther.value !== '') {
                SIOther.value = '';
            }
        }

        function handleTextFieldFocus() {
            const radioButtons = document.getElementsByName('self_earning_indi');
            radioButtons.forEach(radio => {
                radio.checked = false;
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const radioButtons = document.getElementsByName('self_earning_indi');
            const textField = document.getElementById('input-SIOther');

            radioButtons.forEach(radio => {
                radio.addEventListener('change', handleRadioButtonChange);
            });

            textField.addEventListener('focus', handleTextFieldFocus);
        });

        // For Declaration of Dependents
        document.getElementById('add-dependent-btn').addEventListener('click', function() {
            let alertDependets = document.getElementById('alert-dependents');
            const container = document.getElementById('dependent-forms-container');
            const depTitle = document.getElementById('depTitle');
            const formCount = container.children.length + 1;
            const form = document.createElement('div');
            form.className = 'container-form dep-base';

            form.innerHTML = `
                <div>
                    <label for="name-${formCount}" class="label-form d-block">Name<small>&nbsp;*</small></label>
                    <input id="name-${formCount}" type="text" class="input-form" name="dependents[${formCount}][name]">
                </div>
                <div>
                    <label for="relationship-${formCount}" class="label-form d-block">Relationship<small>&nbsp;*</small></label>
                    <input id="relationship-${formCount}" type="text" class="input-form" name="dependents[${formCount}][relationship]">
                </div>
                <div>
                    <label for="birthdate-${formCount}" class="label-form d-block">Date of Birth<small>&nbsp;*</small></label>
                    <input id="birthdate-${formCount}" type="date" class="input-form" name="dependents[${formCount}][birthdate]">
                </div>
                <div>
                    <label class="label-form">With Permanent Disability<small>&nbsp;*</small></label>
                    <div class="with-radio-btn">
                        <div class="d-flex align-items-center">
                            <input id="disability-yes-${formCount}" type="radio" class="radio-form" name="dependents[${formCount}][disability]" value="Y">
                            <label for="disability-yes-${formCount}">Yes</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <input id="disability-no-${formCount}" type="radio" class="radio-form" name="dependents[${formCount}][disability]" value="N">
                            <label for="disability-no-${formCount}">No</label>
                        </div>
                    </div>
                </div>
                <div class="column-2">
                    <label class="label-form">Citizenship<small>&nbsp;*</small></label>
                    <div class="with-radio-btn">
                        <div class="d-flex align-items-center">
                            <input id="citizenship-F-${formCount}" type="radio" class="radio-form" name="dependents[${formCount}][citizenship]" value="F">
                            <label for="citizenship-F-${formCount}">Filipino</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <input id="citizenship-FN-${formCount}" type="radio" class="radio-form" name="dependents[${formCount}][citizenship]" value="FN">
                            <label for="citizenship-FN-${formCount}">Foreign National</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <input id="citizenship-DC-${formCount}" type="radio" class="radio-form" name="dependents[${formCount}][citizenship]" value="DC">
                            <label for="citizenship-DC-${formCount}">Dual Citizen</label>
                        </div>
                    </div>
                </div>
                <button type="button" class="delete-btn">Remove</button>
            `;

            form.querySelector('.delete-btn').addEventListener('click', function() {
                depTitle.style.display = "none";
                form.remove();
                
                if (container.children.length < 1) {
                    alertDependets.style.display = "none";
                }
            });

            container.appendChild(form);
        });

        // Check Required Fields
        document.getElementById('checkButton').addEventListener('click', function() {
            let alertPersonal = document.getElementById('alert-personal');
            let alertAddress = document.getElementById('alert-address');
            let alertDependets = document.getElementById('alert-dependents');
            let alertMember = document.getElementById('alert-member');
            let isPersonal = false;
            let isAddress = false;
            let isDependents = false;
            let isMember = false;

            // Declaration of Dependents
            const container = document.getElementById('dependent-forms-container');
            const dependents = container.getElementsByClassName('dep-base');
            const confirmList = document.getElementById('dep-review');
            const depTitle = document.getElementById('depTitle');
            let allFieldsFilled = true;
            let dep_citizenshipText = "";

            confirmList.innerHTML = '';

            for (let i = 0; i < dependents.length; i++) {
                const dep_name = dependents[i].querySelector('input[name$="[name]"]').value;
                const relationship = dependents[i].querySelector('input[name$="[relationship]"]').value;
                const dep_birthdate = dependents[i].querySelector('input[name$="[birthdate]"]').value;
                const disability = dependents[i].querySelector('input[name$="[disability]"]:checked') ? dependents[i].querySelector('input[name$="[disability]"]:checked').value : '';
                const dep_citizenship = dependents[i].querySelector('input[name$="[citizenship]"]:checked') ? dependents[i].querySelector('input[name$="[citizenship]"]:checked').value : '';

                if (!dep_name || !relationship || !dep_birthdate || !disability || !dep_citizenship) {
                    allFieldsFilled = false;
                    break;
                }

                depTitle.style.display = "block";

                if (dep_citizenship == "F") {
                    dep_citizenshipText = "Filipino";
                } else if (dep_citizenship == "FN") {
                    dep_citizenshipText = "Foreign National";
                } else if (dep_citizenship == "DC") {
                    dep_citizenshipText = "Dual Citizen";
                }

                confirmList.innerHTML += `
                    <div class="container-review dependents">
                        <label>Name</label>
                        <p class="d-block">${dep_name}</p>
                        <label>Relationship</label>
                        <p class="d-block">${relationship}</p>
                        <label>Date of Birth</label>
                        <p class="d-block">${dep_birthdate}</p>
                        <label>With  Permanent  Disability</label>
                        <p class="d-block">${disability == 'Y' ? 'Yes' : 'No'}</p>
                        <label>Citizenship</label>
                        <p class="d-block">${dep_citizenshipText}</p>
                    </div>
                `;
            }
            
            if (!allFieldsFilled) {
                alertDependets.style.display = "block";
                alertDependets.scrollIntoView({ behavior: 'smooth', block: 'start' });
            } else {
                alertDependets.style.display = "none";
                isDependents = true;
            }

            // Address and Contact Details
            let permAdrs = document.getElementById('input-permAdrs');
            let mailAdrs = document.getElementById('input-mailAdrs');
            let mobile = document.getElementById('input-mobile');
            let email = document.getElementById('input-email');
            let isEmail = false;

            function validateEmail(email) {
                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return regex.test(email);
            }

            if (validateEmail(email.value.trim())) {
                isEmail = true;
            }

            if (permAdrs.value.trim() == "" || mailAdrs.value.trim() == "" || mobile.value.trim() == "" || email.value.trim() == "" || !isEmail) {
                alertAddress.style.display = "block";
                alertAddress.scrollIntoView({ behavior: 'smooth', block: 'start' });
            } else {
                alertAddress.style.display = "none";
                isAddress = true;
            }

            // Personal Details
            let name = document.getElementById('input-name');
            let mother = document.getElementById('input-mother');
            let spouse = document.getElementById('input-spouse');
            let bday = document.getElementById('input-bday');
            let bplace = document.getElementById('input-bplace');
            let sex = document.getElementsByName('sex');
            let civilStatus = document.getElementsByName('civil_status');
            let citizenship = document.getElementsByName('citizenship');
            let married = document.querySelector('input[name="civil_status"]:checked');

            let isSex = false;
            let isCivilStatus = false;
            let isCitizenship = false;

            for (var i = 0; i < sex.length; i++) {
                if (sex[i].checked) {
                    isSex = true;
                    break;
                }
            }

            for (var i = 0; i < civilStatus.length; i++) {
                if (civilStatus[i].checked) {
                    isCivilStatus = true;
                    break;
                }
            }

            for (var i = 0; i < citizenship.length; i++) {
                if (citizenship[i].checked) {
                    isCitizenship = true;
                    break;
                }
            }

            if (name.value.trim() == "" || mother.value.trim() == "" || bday.value.trim() == "" || bplace.value.trim() == "" || !isSex || !isCivilStatus || !isCitizenship) {
                alertPersonal.style.display = "block";
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } else {
                if (married.value == "M") {
                    if (spouse.value.trim() != "") {
                        alertPersonal.style.display = "none";
                        isPersonal = true;
                    } else {
                        alertPersonal.style.display = "block";
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                } else {
                    alertPersonal.style.display = "none";
                    isPersonal = true;
                }
            }

            // Member Type
            let contributor = document.querySelector('input[name="contributor"]:checked');
            let radioMW = document.querySelector('input[name="migrant_worker"]:checked');
            let radioSI = document.querySelector('input[name="self_earning_indi"]:checked');
            let con = document.getElementsByName('contributor');
            let MW = document.getElementsByName('migrant_worker');
            let SI = document.getElementsByName('self_earning_indi');
            let SIOther = document.getElementById('input-SIOther');
            let praSSRV = document.getElementById('input-praSSRV');
            let acrICard = document.getElementById('input-acrICard');
            let pwdID = document.getElementById('input-pwdID');
            let profession = document.getElementById('input-profession');
            let income = document.getElementById('input-income');
            let incomeProof = document.getElementById('input-incomeProof');
            let isCon = false;
            let isMW = false;
            let isSI = false;

            for (var i = 0; i < con.length; i++) {
                if (con[i].checked) {
                    isCon = true;
                    break;
                }
            }

            for (var i = 0; i < MW.length; i++) {
                if (MW[i].checked) {
                    isMW = true;
                    break;
                }
            }

            for (var i = 0; i < SI.length; i++) {
                if (SI[i].checked) {
                    isSI = true;
                    break;
                }
            }

            if (isPersonal == true && isAddress == true) {
                if (!isCon) {
                    alertMember.style.display = "block";
                    alertMember.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }

            if (contributor.value == "LM" || contributor.value == "EP" || contributor.value == "EG") {
                if (income.value.trim() == "" || incomeProof.value.trim() == "") {
                    alertMember.style.display = "block";
                    alertMember.scrollIntoView({ behavior: 'smooth', block: 'start' });
                } else {
                    alertMember.style.display = "none";
                    isMember = true;
                }
            } else if (contributor.value == "SI") {
                if (!isSI && SIOther.value.trim() == "") {
                    alertMember.style.display = "block";
                    alertMember.scrollIntoView({ behavior: 'smooth', block: 'start' });
                } else {
                    if (profession.value.trim() == "" || income.value.trim() == "" || incomeProof.value.trim() == "") {
                        alertMember.style.display = "block";
                        alertMember.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    } else {
                        alertMember.style.display = "none";
                        isMember = true;
                    }
                }
            } else if (contributor.value == "MW") {
                if (!isMW) {
                    alertMember.style.display = "block";
                    alertMember.scrollIntoView({ behavior: 'smooth', block: 'start' });
                } else {
                    if (radioMW.value == "Land-Based") {
                        if (profession.value.trim() == "" || income.value.trim() == "" || incomeProof.value.trim() == "") {
                            alertMember.style.display = "block";
                            alertMember.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        } else {
                            alertMember.style.display = "none";
                            isMember = true;
                        }
                    } else if (radioMW.value == "Sea-Based") {
                        if (income.value.trim() == "" || incomeProof.value.trim() == "") {
                            alertMember.style.display = "block";
                            alertMember.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        } else {
                            alertMember.style.display = "none";
                            isMember = true;
                        }
                    }
                }
            } else if (contributor.value == "FN") {
                if (praSSRV.value.trim() == "" || acrICard.value.trim() == "") {
                    alertMember.style.display = "block";
                    alertMember.scrollIntoView({ behavior: 'smooth', block: 'start' });
                } else {
                    if (profession.value.trim() == "" || income.value.trim() == "" || incomeProof.value.trim() == "") {
                        alertMember.style.display = "block";
                        alertMember.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    } else {
                        alertMember.style.display = "none";
                        isMember = true;
                    }
                }
            } else if (contributor.value == "PWD") {
                if (pwdID.value.trim() == "") {
                    alertMember.style.display = "block";
                    alertMember.scrollIntoView({ behavior: 'smooth', block: 'start' });
                } else {
                    if (profession.value.trim() == "" || income.value.trim() == "" || incomeProof.value.trim() == "") {
                        alertMember.style.display = "block";
                        alertMember.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    } else {
                        alertMember.style.display = "none";
                        isMember = true;
                    }
                }
            } else {
                if (profession.value.trim() == "" || income.value.trim() == "" || incomeProof.value.trim() == "") {
                    alertMember.style.display = "block";
                    alertMember.scrollIntoView({ behavior: 'smooth', block: 'start' });
                } else {
                    alertMember.style.display = "none";
                    isMember = true;
                }
            }
            
            // Required
            if (isPersonal == true && isAddress == true && isDependents == true && isMember == true) {
                new bootstrap.Modal(document.getElementById('reviewInfo')).show();
            }
        });

        // Clear Button
        document.getElementById('clearButton').addEventListener('click', function() {
            let alertPersonal = document.getElementById('alert-personal');
            let alertAddress = document.getElementById('alert-address');
            let alertDependets = document.getElementById('alert-dependents');
            let alertMember = document.getElementById('alert-member');
            var form = document.getElementById('registration-form');
            var conType = document.getElementById("conType");
            var praSSRV = document.getElementById("praSSRV");
            var acrICard = document.getElementById("acrICard");
            var pwdID = document.getElementById("pwdID");
            var profession = document.getElementById("profession");
            var SI = document.getElementById("type-SI");
            var MW = document.getElementById("type-MW");
            var FN = document.getElementById("type-FN");
            var PWD = document.getElementById("type-PWD");
            
            // Clear text, email, number, and date inputs
            var inputs = form.querySelectorAll('input[type="text"], input[type="email"], input[type="number"], input[type="date"]');
            inputs.forEach(function(input) {
                input.value = '';
            });

            // Clear checkboxes
            var checkboxes = form.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });

            // Clear radio buttons
            var radios = form.querySelectorAll('input[type="radio"]');
            radios.forEach(function(radio) {
                radio.checked = false;
            });

            // Reset select elements
            var selects = form.querySelectorAll('select');
            selects.forEach(function(select) {
                select.selectedIndex = 0;
            });

            conType.classList.replace('d-flex', 'hidden');
            praSSRV.classList.replace('d-flex', 'hidden');
            acrICard.classList.replace('d-flex', 'hidden');
            pwdID.classList.replace('d-flex', 'hidden');
            profession.classList.remove("hidden");
            SI.classList.add("hidden");
            MW.classList.add("hidden");
            FN.classList.add("hidden");
            PWD.classList.add("hidden");
            alertPersonal.style.display = "none";
            alertAddress.style.display = "none";
            alertDependets.style.display = "none";
            alertMember.style.display = "none";
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

        // Check if the instructions has been shown before
        if (localStorage.getItem('instructionShown') === 'false') {
            // If not, show the modal and set the flag
            new bootstrap.Modal(document.getElementById('instructionsModal')).show();
            localStorage.setItem('instructionShown', 'true');
        }
    </script>
</body>
</html>