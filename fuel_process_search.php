<?php
//Starting Session to Collect Variabls
session_start();
require('config.php');

$search_category = filter_input(INPUT_POST, 'search_category');
$search_string = $_SESSION['search_string'];


//Searching the Database
$query = 'SELECT * from fuel 
	WHERE fuel_source LIKE :search_string
	OR fuel_gallons LIKE :search_string
	OR fuel_cost LIKE :search_string
	OR fuel_mileage LIKE :search_string 
	OR fuel_date LIKE :search_string
    OR fuel_date_modified LIKE :search_string  
	ORDER BY fuel_source ASC';
	$statement1 = $db->prepare($query);
	$search_string = "%".$search_string."%";
	$statement1->bindValue(':search_string', $search_string);
	$statement1->execute();
	$fuel_array = $statement1->fetchAll();
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
                <td colspan="15"><h3><b>Fuel Records Search Results</b></h3></td>
            </tr>
        </thead>
        <tr>
            <th>Source</th>
            <th>Gallons</th>
            <th>Cost</th>
            <th>Mileage</th>
            <th>Date</th>
            <th colspan="2">
                <form method="GET" action="fuel_add_form.php">
                    <button type="SUBMIT">Add Record</button>
                </form>
            </th>
        </tr>
      		
<!--Populating Table with Array-->
<?php foreach ($fuel_array as $fuel) : ?>
                        <tr>
                            <td>
                                <?php echo $fuel['fuel_source']; ?>
                            </td>
                            <td>
                                <?php echo $fuel['fuel_gallons']; ?>
                            </td>
                            <td>
                                <?php echo number_format($fuel['fuel_cost'],2); ?>
                            </td>
                            <td>
                                <?php echo number_format($fuel['fuel_mileage']); ?>
                            </td>
                            <td>
                                <?php echo $fuel['fuel_date']; ?>
                            </td>
                            <td>
                                <?php include "fuel_edit_button.php"; ?>
                            </td>
                            <td>
                                <?php include "fuel_delete_button.php"; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
    </table>

    <a href="search.php" style: text-decoration: none;><h4><b>Search Again?</b></h4></a>


<?php include "footer.php"; ?>

</div>
</body>
</html>