<?php
require ('../config.php');

    $query = 'SELECT * 
        FROM maintenance
        ORDER BY maintenance_id';
    $statement = $db->prepare($query);
    $statement->execute();
    $maintenance_array = $statement->fetchAll();
    $statement->closeCursor();
?>
<?php include "header_navigation.php";?>
<?php include "../table_format.php";?>
            <thead>
                        <tr>
                            <td colspan="15"><h3><b>Maintenance Records</b></h3></td>
                        </tr>
                    </thead>
                    <tr>
                        <th>Vendor</th>
                        <th>Vendor Address</th>
                        <th>Vendor Phone Number</th> 
                        <th>Maintenance Description</th>                       
                        <th>Cost</th>
                        <th>Mileage</th>
                        <th>Date Created</th>
                        <th>Date Modified</th>
                        <th colspan="2">
                            <form method="GET" action="maintenance_add_form.php">
                                <button type="SUBMIT">Add Record</button>
                            </form>
                        </th>
                    </tr>
                    <?php foreach ($maintenance_array as $maintenance) : ?>

                    <!-- Formatting phone number from database to display in table-->
                    <?php 
                    $number = $maintenance['maintenance_vendor_phone_number'];
                    $maintenance['maintenance_vendor_phone_number'] = "($number[0]$number[1]$number[2])-$number[3]$number[4]$number[5]-$number[6]$number[7]$number[8]$number[9]";
                    
                    // Formatting dates from database-->
                    $empty_date = '0000-00-00 00:00:00';

                    if ($maintenance['maintenance_date'] === $empty_date){
                        $maintenance['maintenance_date'] = "";
                    }
                    else {
                        $maintenance_date = $maintenance['maintenance_date'];
                        $maintenance['maintenance_date'] = date_create("$maintenance_date");
                        $maintenance['maintenance_date'] = date_format($maintenance['maintenance_date'],"D M j Y g:i:s A");
                    }

                    if ($maintenance['maintenance_date_modified'] === $empty_date){
                        $maintenance['maintenance_date_modified'] = "";
                    } 
                    else {
                        $maintenance_date_modified = $maintenance['maintenance_date_modified'];
                        $maintenance['maintenance_date_modified'] = date_create("$maintenance_date_modified");
                        $maintenance['maintenance_date_modified'] = date_format($maintenance['maintenance_date_modified'],"D M j Y g:i:s A");
                    }
                ?>
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
                                <?php echo $maintenance['maintenance_vendor_address']; ?>
                            </td>
                            <td>
                                <?php echo $maintenance['maintenance_vendor_phone_number']; ?>
                            </td>
                            <td>
                                <?php echo $maintenance['maintenance_description']; ?>
                            </td>
                            <td>
                                $<?php echo number_format($maintenance['maintenance_cost'],2); ?>
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
                                <?php include "maintenance_edit_button.php"; ?>
                            </td>
                            <td>
                                <?php include "maintenance_delete_button.php"; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                </table>
            </div>
            <?php include "../footer.php";?>
        </div>
   </body>

    </html>