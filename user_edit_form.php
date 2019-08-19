<?php include "header_navigation.php";
   $user_id = $_SESSION['user_id'];
   // echo $_SESSION['username'];
   // echo $_SESSION['password'];
   // echo $_SESSION['user_level'];
   // echo $_SESSION['access_granted'];
   // echo $_SESSION['user_id'];
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $result = $conn->prepare("SELECT * FROM users WHERE user_id = '$user_id'");
         $result->execute();
         $user = $result->fetchAll();
         foreach ($user as $users):
         ?>
<div class="container-fluid">
<div class="table-responsive">
   <table class="table table-bordered table-striped table-hover" style="overflow-x:auto;">
      <thead class="thead-light">
         <tr>
            <td colspan="15">
               <h3>Editing Profile</h3>
               </br>
            </td>
         </tr>
      </thead>
      <tbody>
         <form action="user_edit.php" method="post" id="userEditForm" name="form">
            <input type="hidden" name="vehicle_id" value= '<?php echo $users['user_id']?>'>
            <tr>
               <td align="right"><strong>First Name:</strong></td>
               <td><input id="first_name" required type="text" name="first_name" onblur="allLetters(this,'m.first_name','e.first_name')" value= '<?php echo $users['first_name']?>'><span id="m.first_name" style='color:green;'></span></br>
                  <span id="e.first_name" class="error" style='color:red;'></span>
               </td>
            </tr>
            <tr>
               <td align="right"><strong>Last Name:</strong></td>
               <td><input id="last_name" required type="text" name="last_name" onblur="allLetters(this,'m.last_name','e.last_name')" value= '<?php echo $users['last_name']?>'><span id="m.last_name" style='color:green;'></span></br>
                  <span id="e.last_name" class="error" style='color:red;'></span>
               </td>
            </tr>
            <tr>
               <td align="right"><strong>Current Password:</strong></td>
               <td><input id="current_user_password" required type="password" name="current_user_password" onblur="passwordCheck(this,'<?php echo $users['password']?>','m.current_user_password','e.current_user_password')"</td>
               <span id="m.current_user_password" style='color:green;'></span></br>
               <span id="e.current_user_password" class="error" style='color:red;'></span>
            </tr>
            <tr>
               <td align="right"><strong>New Password:</strong></td>
               <td><input id="new_user_password" type="password" name="new_user_password"</td>
            </tr>
            <tr>
               <td align="right"><strong>Retype Password:</strong></td>
               <td><input id="retyped_new_user_password" type="password" name="retyped_new_user_password" onblur="newPasswordCheck('m.retyped_new_user_password','e.retyped_new_user_password')"</td>
               <span id="m.retyped_new_user_password" style='color:green;'></span></br>
               <span id="e.retyped_new_user_password" class="error" style='color:red;'></span>
            </tr>
            <tr>
               <td align="right"><strong>Email:</strong></td>
               <td><input id="email" required type="text" name="email" onblur="validEmail(this,'m.email','e.email')" value= '<?php echo $users['email']?>'><span id="m.email" style='color:green;'></span></br>
                  <span id="e.email" class="error" style='color:red;'></span>
               </td>
            </tr>
            <tr>
               <td align="right"><strong>Phone Number:</strong></td>
               <td><input id="phone_number" required type="text" name="phone_number" onblur="validPhoneNumber(this,'m.phone_number','e.phone_number')" value= '<?php echo $users['phone_number']?>'><span id="m.phone_number" style='color:green;'></span></br>
                  <span id="e.phone_number" class="error" style='color:red;'></span>
               </td>
            </tr>
            <td align="center"colspan = "2"><input class="btn btn-primary" type="submit" value="Update"></td>
         </form>
         <?php endforeach; ?>
      </tbody>
   </table>
</div>
<?php include "footer.php";?>
