<?php
require ('config.php');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $result = $conn->prepare("SELECT * FROM maintenance ORDER BY maintenance_id"); 
      $result->execute();
      $maintenance_types = $result->fetchAll();

    $redirect = 'maintenance_types.php'
?>
<?php include "header_navigation.php";?>
<?php include "table_format.php";?>
            <thead>
                        <tr>
                            <td colspan="15"><h3><b>Maintenance Types</b></h3></td>
                        </tr>
                    </thead>
                    <tr>
                        <th>Maintenance Type ID</th>
                        <!--<th>Maintenance ID</th>
                        <th>Vehicle ID</th>-->
                        <th>Maintenance Type</th>
                        <th>Date Created</th>
                        <th>Date Modified</th>
                        <th colspan="2">
                            <form method="POST" action="maintenance_types_add_form.php">
                                <input type="hidden" name="redirect" value='<?php echo $redirect; ?>'>
                                <button type="SUBMIT">Add Maintenance Record</button>
                            </form>
                        </th>
                        
                    </tr>
                    <?php foreach ($maintenance_types as $maintenance) : 

                    // Formatting dates from database-->
                    $empty_date = '0000-00-00 00:00:00';

                    if ($maintenance['date_created'] === $empty_date){
                        $maintenance['date_created'] = "";
                    }
                    else {
                        $date_created = $maintenance['date_created'];
                        $maintenance['date_created'] = date_create("$date_created");
                        $maintenance['date_created'] = date_format($maintenance['date_created'],"D M j Y g:i:s A");
                    }

                    if ($maintenance['date_modified'] === $empty_date){
                        $maintenance['date_modified'] = "";
                    } 
                    else {
                        $date_modified = $maintenance['date_modified'];
                        $maintenance['date_modified'] = date_create("$date_modified");
                        $maintenance['date_modified'] = date_format($maintenance['date_modified'],"D M j Y g:i:s A");
                    }
                ?>
                        <tr>
                            
                            <td>
                                <?php echo $maintenance['maintenance_types_id']; ?>
                            </td>
                            <!--<td>
                                <?php echo $maintenance['maintenance_id']; ?>
                            </td>
                            <td>
                                <?php echo $maintenance['vehicle_id']; ?>
                            </td>-->
                            <td>
                                <?php echo $maintenance['mainteance_type_id']; ?>
                            </td>
                            <td>
                                <?php echo $maintenance['date_created']; ?>
                            </td>
                            <td>
                                <?php echo $maintenance['date_modified']; ?>
                            </td>
                            <td>
                                <?php include "maintenance_types_edit_button.php"; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                </table>
            </div>
            <?php include "footer.php";?>
        </div>
   </body>

    </html>