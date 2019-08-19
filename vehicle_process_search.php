<?php
session_start();
require('config.php');

// $search_string = $_POST['search_string'];
$search_category = filter_input(INPUT_POST, 'search_category');
$search_string = $_SESSION['search_string'];


//echo "Search Category:  $search_category<br>";
//echo "Search String:  $search_string";


$query = 'SELECT * from vehicles 
	WHERE vehicle_make LIKE :search_string
	OR vehicle_model LIKE :search_string
	OR vehicle_year LIKE :search_string
	OR vehicle_color LIKE :search_string
	OR vehicle_year_purchased LIKE :search_string
	OR vehicle_vin LIKE :search_string 
	OR vehicle_license_tag LIKE :search_string
    OR vehicle_license_state LIKE :search_string
    OR vehicle_purchase_price LIKE :search_string 
    OR vehicle_purchase_mileage LIKE :search_string  
	ORDER BY vehicle_make ASC';
	$statement1 = $db->prepare($query);
	$search_string = "%".$search_string."%";
	$statement1->bindValue(':search_string', $search_string);
	$statement1->execute();
	$vehicles = $statement1->fetchAll();
	$statement1->closeCursor();
?>
<div class="container">
<?php include("header_navigation.php"); ?>
<div class="container">
<h3>Search Results</h3>
</div>
<br />

<?php include("table_format.php");?>
        <thead>
            <tr>
                <td colspan="15"><h3><b>Vehicle Search Results</b></h3></td>
            </tr>
        </thead>
        <tr>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
            <th>Color</th>
            <th>Year Purchased</th>
            <th>VIN</th>
            <th>License Tag</th>
            <th>License State</th>
            <th>Purchase Price</th>
            <th>Purchase Mileage</th>
            <th colspan="2">
                <form method="GET" action="vehicle_add_form.php">
                    <button type="SUBMIT">Add Record</button>
                </form>
            </th>
        </tr>
      		

<?php foreach ($vehicles as $vehicle) : ?>
                        <tr>
                            <td>
                                <?php echo $vehicle['vehicle_make']; ?>
                            </td>
                            <td>
                                <?php echo $vehicle['vehicle_model']; ?>
                            </td>
                            <td>
                                <?php echo $vehicle['vehicle_year']; ?>
                            </td>
                            <td>
                                <?php echo $vehicle['vehicle_color']; ?>
                            </td>
                            <td>
                                <?php echo $vehicle['vehicle_year_purchased']; ?>
                            </td>
                            <td>
                                <?php echo $vehicle['vehicle_vin']; ?>
                            </td>
                            <td>
                                <?php echo $vehicle['vehicle_license_tag']; ?>
                            </td>
                            <td>
                                <?php echo $vehicle['vehicle_license_state']; ?>
                            </td>
                            <td>
                                $<?php echo number_format($vehicle['vehicle_purchase_price'],2); ?>
                            </td>
                            <td>
                                <?php echo number_format($vehicle['vehicle_purchase_mileage']); ?>
                            </td>
                            <td>
                                <?php include "vehicle_edit_button.php"; ?>
                            </td>
                            <td><?php include "vehicle_delete_button.php"; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
    </table>

    <a href="search.php" style: text-decoration: none;><h4><b>Search Again?</b></h4></a>


<?php include "footer.php"; ?>

</div> <!-- Close container div -->
</body>
</html>