<?php
// Get the maintenance data
$maintenance_types_id = filter_input(INPUT_POST, 'maintenance_types_id');
$type = filter_input(INPUT_POST, 'type');
$date_modified = date('Y-m-d H:i:s');
$redirect = filter_input(INPUT_POST, 'redirect');



// Validate inputs
if ($type == null)  {
    
    include('header_navigation.php');
    include('empty_field.php');
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

    // Add the maintenance to the database  
    $query = 'UPDATE maintenance_type 
            SET type = :type, date_modified = :date_modified
            WHERE maintenance_types_id = :maintenance_types_id ' ;

    $statement = $db->prepare($query);
    $statement->bindValue(':type' , $type);
    $statement->bindValue(':date_modified' , $date_modified);
    $statement->bindValue(':maintenance_types_id' , $maintenance_types_id);
    $statement->execute();
    $statement->closeCursor();




 //Update Results
$queryEdit = 'SELECT * FROM maintenance_type WHERE maintenance_types_id = :maintenance_types_id';
    $statement2 = $db->prepare($queryEdit);
    $statement2->bindValue(':maintenance_types_id', $maintenance_types_id);
    $statement2->execute();
    $maintenanceEdit = $statement2->fetch();
    $type = $maintenanceEdit['type'];
    $date_modified = $maintenanceEdit['date_modified'];
    $statement2->closeCursor();

    // Formatting dates from database-->

 $date_modified = date_create("$date_modified");
 $date_modified = date_format($date_modified,"D M j Y g:i:s A");
                        
                
 ?>

<?php include "header_navigation.php";?>
<title>Maintenance Type Records Results Page</title> 

<?php include "table_format.php"; ?>
<h3>Update Results</h3><br />
<tr>
<td align="right"><strong>Maintenance Type:</strong></td>
<td><?php echo $type; ?></td>
</tr>
<tr>
<td align="right"><strong>Date Modified:</strong></td>
<td><?php echo $date_modified; ?></td>
</tr>
<tr>
<td>&nbsp;</td>


<!-- Edit the record again? -->
<td>
<form action="maintenance_types_edit_form.php" method="POST">
<input type="hidden" name="maintenance_types_id" value="<?php echo $maintenance_types_id; ?>">
<input type="submit" value="Edit Record Again">
</form>
<form action='<?php echo $redirect ?>'>
<input type="submit" value="Done">
</form>
</td>
</table>

</div>
<?php include "footer.php"; ?>
</div>



</body>
</html>
