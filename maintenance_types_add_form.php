<?php 

    include "header_navigation.php";
    include "table_format.php";

    $vehicle_id = filter_input(INPUT_POST, 'vehicle_id');
    $redirect = filter_input(INPUT_POST, 'redirect');

?>
                    <thead>
                <tr>
                    <tr>
                            <td colspan="15"><h3><b>Add Maintenance Type Record</b></h3></td>
                        </tr>
                    </thead>
                    <form action="maintenance_types_add.php" method="POST">
                    <input type="hidden" name="vehicle_id" value= '<?php echo $vehicle_id?>'>
                    <input type="hidden" name="redirect" value='<?php echo $redirect; ?>'>

                    <tr>
                    <td align="right"><strong>Type:</strong></td>
                    <td><input type="text" name="type" placeholder = 'Oil Change'> <input type="submit" value="Add Record"></td>
                </tr>
                    </form>
            </table>
                
    <br />
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>
