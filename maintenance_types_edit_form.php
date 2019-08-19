<?php
require('config.php');

$maintenance_types_id = filter_input(INPUT_POST, 'maintenance_types_id');
//$vehicle_id = filter_input(INPUT_POST, 'vehicle_id');
$redirect = filter_input(INPUT_POST, 'redirect');

$query = 'SELECT *
          FROM maintenance_type
          WHERE maintenance_types_id = :maintenance_types_id';
    $statement = $db->prepare($query);
    $statement->bindValue(":maintenance_types_id", $maintenance_types_id);
    $statement->execute();
    $maintenance_types = $statement->fetch();
    $statement->closeCursor();

?>
        <?php include "header_navigation.php";?>
        <?php include "table_format.php";?>
                            <thead>
                                <tr>
                                    <td colspan="15"><h3><b>Editing Maintenance Type Record</b></h3></td>
                                </tr>
                            </thead>

                            <form action="maintenance_types_edit.php" method="post">
            <input type="hidden" name="maintenance_types_id" value= '<?php echo $maintenance_types['maintenance_types_id'];?>'>
            <input type="hidden" name="redirect" value='<?php echo $redirect; ?>'>

            <tr>
            <td align="right"><strong>Maintenance Type:</strong></td>
            <td><input type="text" name="type" value= '<?php echo $maintenance_types['type']; ?>'></td>
            </tr>
            <td align="center"colspan = "2"><input type="submit" value="Update">
            </td>
                    </form>
                    <tr>
                        <td align= "center"colspan = "2"><form action='<?php echo $redirect ?>' method="POST">
                        <!--<input type="hidden" name="vehicle_id" value='<?php echo $vehicle_id;?>' />-->
<input type="submit" value="Cancel" />
</form>
</td>
</tr>
                </table>


        </div>
            <?php include "footer.php";?>
        </div>

    </body>
</html>
