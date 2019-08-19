<?php
session_start();
require('config.php');

// $search_string = $_POST['search_string'];
$search_category = filter_input(INPUT_POST, 'search_category');
$search_string = $_SESSION['search_string'];


//echo "Search Category:  $search_category<br>";
//echo "Search String:  $search_string";


$query = 'SELECT * from maintenance 
	WHERE maintenance_vendor LIKE :search_string
	OR maintenance_description LIKE :search_string
	OR maintenance_vendor_address LIKE :search_string
	OR maintenance_cost LIKE :search_string
	OR maintenance_mileage LIKE :search_string
	OR maintenance_date LIKE :search_string 
	OR maintenance_date_modified LIKE :search_string
    OR maintenance_vendor_phone_number LIKE :search_string  
	ORDER BY maintenance_vendor ASC';
	$statement1 = $db->prepare($query);
	$search_string = "%".$search_string."%";
	$statement1->bindValue(':search_string', $search_string);
	$statement1->execute();
	$maintenance_array = $statement1->fetchAll();
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
                <td colspan="15"><h3><b>Maintenance Records Search Results</b></h3></td>
            </tr>
        </thead>
        <tr>
            <th>Vendor</th>
            <th>Description</th>
            <th>Vendor Address</th>
            <th>Cost</th>
            <th>Mileage</th>
            <th>Date</th>
            <th>Date Modified</th>
            <th>Vendor Phone Number</th>
            <th colspan="2">
                <form method="GET" action="maintenance_add_form.php">
                    <button type="SUBMIT">Add Record</button>
                </form>
            </th>
        </tr>
      		

<?php foreach ($maintenance_array as $maintenance) : ?>
                        <tr>
                            <!--
                            <td>
                                <?php echo $maintenance['maintenance_type_id']; ?>
                            </td>
                            <td>
                                <?php echo $maintenance['vehicle_id']; ?>
                            </td> -->
                            <td>
                                <?php echo $maintenance['maintenance_vendor']; ?>
                            </td>
                            <td>
                                <?php echo $maintenance['maintenance_description']; ?>
                            </td>
                            <td>
                                <?php echo $maintenance['maintenance_vendor_address']; ?>
                            </td>
                            <td>
                                <?php echo number_format($maintenance['maintenance_cost'],2); ?>
                            </td>
                            <td>
                                <?php echo number_format($maintenance['maintenance_mileage']); ?>
                            </td>
                            <td>
                                <?php echo $maintenance['maintenance_date']; ?>
                            </td>
                            <td>
                                <?php echo $maintenance['maintenance_date_modified']; ?>
                            </td>
                            <td>
                                <?php echo $maintenance['maintenance_vendor_phone_number']; ?>
                            </td>
                            <td>
                                <?php include "maintenance_edit_button.php"; ?>
                            </td>
                            <td>
                                <?php include "maintenance_delete_button.php"; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
    </table>

    <a href="search.php" style: text-decoration: none;><h4><b>Search Again?</b></h4></a>


<?php include "footer.php"; ?>

</div> <!-- Close container div -->
</body>
</html>