<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
   try{
      require('config.php');
   }
   catch(PDOException $e) {
            echo "Error'$ " . $e->getMessage();
        }

      $maintenance_id = filter_input(INPUT_POST,'maintenance_id');
      $maintenance_vendor =  ucwords(strtolower(filter_input(INPUT_POST,'maintenance_vendor')));
      $maintenance_description =  ucwords(strtolower(filter_input(INPUT_POST,'maintenance_description')));
      $street_address =  ucwords(strtolower(filter_input(INPUT_POST,'street_address')));
      $address_line_2 =  strtoupper(filter_input(INPUT_POST,'address_line_2'));
      $city =  ucwords(strtolower(filter_input(INPUT_POST,'city')));
      $state =  (filter_input(INPUT_POST,'state'));
      $zipCode =  filter_input(INPUT_POST,'zipCode');
      $maintenance_cost = filter_input(INPUT_POST,'maintenance_cost');
      $maintenance_mileage = filter_input(INPUT_POST,'maintenance_mileage');
      $maintenance_vendor_phone_number = filter_input(INPUT_POST,'maintenance_vendor_phone_number');
      $vehicle_id = filter_input(INPUT_POST,'vehicle_id');
      $maintenance_vendor_address = $street_address." ".$address_line_2." ".$city.", ".$state." ".$zipCode;
      $user_id = $_SESSION['user_id'];

      $formattedPhoneExp = '[\(|\)|-|\. |\s+]';
      $maintenance_vendor_phone_number = preg_replace("$formattedPhoneExp", "",$maintenance_vendor_phone_number);
      echo "Phone Number: ".$maintenance_vendor_phone_number;


//maintenance_vendor = ucwords(strtolower($maintenance_vendor));
      // Validate inputs
      if ($maintenance_vendor == null || $maintenance_description == null ||
              $maintenance_vendor_address == null || $maintenance_cost == null || $maintenance_mileage == null || $maintenance_vendor_phone_number == null)  {
                ?>
                <div class="alert alert-danger alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Access Denied:</strong> User must login to proceed!
                </div><?php
                include('index.php');
                die();
              }
      else {

          //Add to Database
        try{
        //Add into Database
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $conn->prepare("INSERT INTO maintenance
                      (user_id, vehicle_id,maintenance_vendor, maintenance_description, maintenance_vendor_address,maintenance_cost, maintenance_mileage, maintenance_vendor_phone_number)
        VALUES
                          ('$user_id', '$vehicle_id','$maintenance_vendor', '$maintenance_description', '$maintenance_vendor_address', '$maintenance_cost', '$maintenance_mileage', '$maintenance_vendor_phone_number')");

                       $result->execute();
                         // Display the maintenance page
          ?>
          <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> Maintenance Record Added.
          </div>
          <?php
          include('maintenance.php');
        }
        catch(PDOException $e) {
            echo "Error'$ " . $e->getMessage();
        }
      }
      ?>
