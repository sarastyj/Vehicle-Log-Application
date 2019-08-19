<?php
$type = filter_input(INPUT_POST, 'type');
$vehicle_id = filter_input(INPUT_POST,'vehicle_id');
$redirect = filter_input(INPUT_POST, 'redirect');


//echo "vehicle_id: $vehicle_id";
//echo "maintenance_vendor: $maintenance_vendor";


// Validate inputs
if ($type == null)  {
    
    include('header_navigation.php');
    include('../empty_field.php');
    include('footer.php');
    echo "</div>";
    die;  
    
}

//Checking for a valid Maintenance Type
$pattern = '[\-|\s|\.|\,]';
$maintenance_type = preg_replace("$pattern","", $type);

//Checking for alphanumeric value
if (!ctype_alnum($maintenance_type) === true){
    
    include('header_navigation.php');
    echo '  <div class="container">
    <div class="alert alert-warning">  <!-- Bootstrap class for warning alert -->
    <strong>Error!</strong> Invalid <b>Maintenance Type<br><br><button type="button" onclick="history.back();">Back</button></a>
    </div>';
    include('footer.php');
    echo "</div>";
    die;
}
    require('config.php');
     //Add to Database
        try{
        //Add into Database
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $conn->prepare("INSERT INTO maintenance_type 
                      (type)
        VALUES 
                          ('$type')");
      
                       $result->execute();
                         // Display the maintenance page
          include('maintenance_types.php');
        }
        catch(PDOException $e) {
            echo "Error'$ " . $e->getMessage();
        }
/*
   // Add the driver to the database  
        $query = 'INSERT INTO maintenance_type 
                (type)
                VALUES 
                    (:type)';


    $statement = $db->prepare($query);
    $statement->bindValue(':type' ,$type);
    $statement->execute();
    $statement->closeCursor();
*/
    include 'maintenance_types.php';
    
?>
