<!DOCTYPE html>
<html>

<head>
    <title>ACRA Search Results</title>
    <link rel="stylesheet" href="../css/gapAnalysis.css">
    <link rel="icon" href="../images/swords-crossed.png">
</head>

<body class="bg">
    <div class="transbox">
        <div class="thisText">
            <?php
                
                $serverName = "db736790258.db.1and1.com"; //serverName\instanceName
                $connectionInfo = array( "Database"=>"db736790258", "UID"=>"dbo736790258", "PWD"=>"Harry2010!");
                $conn = sqlsrv_connect( $serverName, $connectionInfo);

                if( $conn ) {
                    //echo "Connection established.<br />";
                }else{
                     echo "Connection to database could not be established.<br />";
                     die( print_r( sqlsrv_errors(), true));
                }
            
                $entityName = $uen = $sql = $searchTitle = "";
                $params = array();

                if (isset($_POST["submitCompanyName"])) {
                    $entityName = $_POST['entityName'];    
                    $params = array($entityName);
                    $sql = "EXEC sp_blacksmith_companyName_GETLIST @entityName=?";
                    $searchTitle = $entityName;
                } elseif (isset($_POST["submitUen"])) {
                    $uen = $_POST['uen'];    
                    $params = array($uen);
                    $sql = "EXEC sp_blacksmith_companyUEN_GET @uen=?";
                    $searchTitle = $uen;
                } else {
                    $sql = "EXEC sp_blacksmith_statusCheck_GETLIST";
                    $searchTitle = "Foreign Companies";
                }
            
                $stmt = sqlsrv_query( $conn, $sql, $params);

                if( $stmt === false ) {
                    die( print_r( sqlsrv_errors(), true));
                }
            
                echo "<h3>Showing results for: " . $searchTitle . "</h3>";

                echo "<table>";
                echo "<tr>";
                echo "<th class='outcomeHeader'>Registration Number (UEN)</th>";
                echo "<th class='outcomeHeader'>Entity Name</th>";
                echo "<th class='outcomeHeader'>Entity Type</th>";
                echo "<th class='outcomeHeader'>Status</th>";
                echo "<th class='outcomeHeader'>Incorporation Date</th>";
                echo "<th class='outcomeHeader'>Registered Address</th>";
                echo "</tr>";

                while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
                {
                    $uen = $row["uen"];
                    $entity_name = $row["entity_name"];
                    $entity_type = $row["entity_type_description"];
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
        </div>
    </div>
</body>

</html>