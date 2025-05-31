<?php
    if ( isset( $_GET["dep_id"])) {
        $dep_id = $_GET["dep_id"];
    
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "philhealth";

        // Create connection
        $connection = new mysqli( $servername, $username, $password, $database );

        // Delete dependents
        $dependents = "DELETE FROM dependent WHERE dep_id=$dep_id";
        $result = $connection->query( $dependents );
    }

    header("location: ../admin/admin-dependents.php");
    exit;