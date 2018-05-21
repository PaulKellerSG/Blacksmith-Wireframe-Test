<!DOCTYPE html>
<html>

<head>
    <title>Blacksmith</title>
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>
    <?php
    
        $entityName = $_POST['entityName'];
        
        $serverName = "db736790258.db.1and1.com"; //serverName\instanceName
        $connectionInfo = array( "Database"=>"db736790258", "UID"=>"dbo736790258", "PWD"=>"Harry2010!");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);

        if( $conn ) {
            //echo "Connection established.<br />";
        }else{
             echo "Connection to database could not be established.<br />";
             die( print_r( sqlsrv_errors(), true));
        }

        $sql = "EXEC sp_blacksmith_companyName_GETLIST @entityName=?";
        $params = array($entityName);
        $stmt = sqlsrv_query( $conn, $sql, $params);

        if( $stmt === false ) {
            die( print_r( sqlsrv_errors(), true));
        }

        echo "<table>";
        echo "<tr>";
        echo "<th>Registration Number (UEN)</th>";
        echo "<th>Entity Name</th>";
        echo "<th>Entity Type</th>";
        echo "<th>Status</th>";
        echo "<th>Incorporation Date</th>";
        echo "<th>Registered Address</th>";
        echo "</tr>";

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
        {
            $uen = $row["uen"];
            $entity_name = $row["entity_name"];
            $entity_type = $row["entity_type"];
            $status = $row["entity_status_description"];
            $incorp_date = $row["registration_incorporation_date"];
            $address = $row["full_address"];
            
            echo "<tr>";
            echo "<td>$uen</td>";
            echo "<td>$entity_name</td>";
            echo "<td>$entity_type</td>";
            echo "<td>$status</td>";
            echo "<td>$incorp_date</td>";
            echo "<td>$address</td>";
            echo "</tr>";

        }
        
        echo "</table>";
        
        ?>
</body>

</html>