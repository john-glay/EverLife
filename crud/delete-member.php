<?php
    if ( isset( $_GET["pin"])) {
        $pin = $_GET["pin"];
    
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "philhealth";

        // Create connection
        $connection = new mysqli( $servername, $username, $password, $database );

        // Delete member
        $members = "DELETE FROM member WHERE pin=$pin";
        $result = $connection->query( $members );

        // Delete dependents
        $dependents = "DELETE FROM dependent WHERE pin=$pin";
        $result = $connection->query( $dependents );
    }

    header("location: ../admin/admin-members.php");
    exit;
