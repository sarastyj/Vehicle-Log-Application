<?php include "header_navigation.php";
$user_id = $_SESSION['user_id'];
      if($_SESSION['user_level'] ==='administrator' || $_SESSION['user_level'] ==='manager'){
      $result = $conn->prepare("SELECT * FROM vehicles ORDER BY vehicle_id");
    }
    else {
      $result = $conn->prepare("SELECT * FROM vehicles WHERE user_id = '$user_id' ORDER BY vehicle_id");
    }
      $result->execute();
      $vehicles = $result->fetchAll();
?>
                    <div class="container-fluid">
                       <div class="table-responsive">
                          <table class="table table-bordered table-striped table-hover" style="overflow-x:auto;">
                             <thead class="thead-light">
                                <tr>
                                   <th align="center"colspan="15">
                                      <h3><b>Vehicles</b></h3>
                                   </th>
                                </tr>
                             </thead>
                    <tbody>
                      <tr>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Color</th>
                        <th>VIN</th>
                        <th>License Tag</th>
                        <th>License State</th>
                        <th>Year Purchased</th>
                        <th>Price</th>
                        <th>Mileage</th>
                        <th colspan="3">
                            <form method="POST" action="vehicle_add_form.php">
                                <button class="btn btn-primary" type="SUBMIT">Add Vehicle</button>
                            </form>
                        </th>
                    </tr>
                    <?php
                    //echo "Count: ".count($vehicles);
                    if(count($vehicles)=== 0){
                    ?>
                  <div class="alert alert-warning alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Info!</strong> No vehicle records found under this profile. Please <b><a href="vehicle_add_form.php">add</a></b> a vehicle record.
                  </div>
                  <?php
                    }
                   ?>

                    <?php foreach ($vehicles as $vehicle) :
                         ?>
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
                                <?php echo $vehicle['vehicle_vin']; ?>
                            </td>
                            <td>
                                <?php echo $vehicle['vehicle_license_tag']; ?>
                            </td>
                            <td>
                                <?php echo $vehicle['vehicle_license_state']; ?>
                            </td>
                            <td>
                                <?php echo $vehicle['vehicle_year_purchased']; ?>
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
                            <td>
                                <?php include "reports_button.php"; ?>
                            </td>
                              <?php if($_SESSION['user_level'] ==='administrator' || $_SESSION['user_level'] ==='manager'){ ?>

                                <td><?php include "vehicle_delete_button.php";?>

                                </td>
                              <?php } ?>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
            <?php include "footer.php";?>
