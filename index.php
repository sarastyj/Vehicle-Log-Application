<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// if(session_id()===null) {
//     session_start();
// }
//session_unset();
// echo "Username: " .$_SESSION["username"];
// echo "Password: " .$_SESSION["password"];
 // echo "Access: " .$_SESSION["access_granted"];
   require_once ('config.php');

//   if (isset($_SESSION["access_granted"])) {
//      $login_error = true;
//      echo "True";
//      }
//      else{
//       $login_error = false;
//       echo "False";
//      }
   ?>
<!DOCTYPE html>

<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content "IE=edge">
      <meta name="viewport" content="width"=device_width, initial-scale=1>
      <!--  -->
      <title>Vehicle Log Application</title>
      <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /> -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="css/modal.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <script src="js/script.js">
      //validLogin();
      </script>


      <!-- <?php
      //validLogin($_SESSION["access"]);
       ?> -->
   </head>
   <body onload="validLogin('<?php echo $_SESSION['access_granted'] ?>')">
     <!--onload="validLogin(<?php echo $_SESSION['login_error'] ?>)" -->
      <div class="container">
         <!-- </div> -->
         <div class="jumbotron">
               <img class="mx-auto d-block" src="images/vehicleApp_logo.png" alt="vehicle app logo">
            <p>
               <em>Vehicle Log Application</em> will keep track of all of your fleet's critical records. Users will be able to search and access the fleet's Vehicle, Maintenance, Maintenance Types and Fuel information. </br></br>
               To get started, simply log into your profile or create a new one.
            </p>

            <div class="row justify-content-center">
               <div class="btn-group btn-group-lg">
                 <button type="button" class="btn btn-primary" onclick="document.getElementById('login').style.display='block'">Login</button>
                  <button type="button" class="btn btn-primary" onclick="document.getElementById('register').style.display='block'">Register</button>
               </div>
            </div>
            <div id="login_error"></div>
         </div>
      </div>
      <div id="login" class="modal">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
         <form class="modal-content animate" action="login.php" method="post">
           <!-- Modal Header -->
           <div class="modal-header">
             <h4 class="modal-title">Login</h4>
           </div>
            <div>
               <span onclick="document.getElementById('login').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>
            <div class="modal-body">
               <label for="username"><b>Username</b></label>
               <input type="text" placeholder="Enter Username" name="username" required>
               <label for="password"><b>Password</b></label>
               <input type="password" placeholder="Enter Password" name="password" required>
               <button type="submit" value="Submit" class="btn btn-primary">Login</button>
               <label>
               <!-- <input type="checkbox" checked="checked" name="remember"> Remember me
             </label><br> -->
               <!-- <label>
                 <p class="psw">Forgot <a href="#">password?</a></p>
               </label> -->
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="document.getElementById('login').style.display='none'" class="cancelbtn">Cancel</button>
            </div>
            <table class="table table-bordered table-hover table-sm">
                <tbody>
                  <th>Username</th>
                  <th>Password</th>
                  <tr>
                    <td>guest_user</td>
                    <td>password123</td>
                  </tr>
                  <tr>
                    <td>authenticated_user</td>
                    <td>password123</td>
                  </tr>
                  <tr>
                    <td>manager_user</td>
                    <td>password123</td>
                  </tr>
                </tbody>
              </table>
         </form>
      </div>
    </div>
    <div id="register" class="modal">
      <div class="modal-dialog modal-dialog-scrollable modal-lg">
       <form class="modal-content animate" action="add_user.php" method="post">
         <!-- Modal Header -->
         <div class="modal-header">
           <h4 class="modal-title">Register</h4>
         </div>
           <div>
             <span onclick="document.getElementById('register').style.display='none'" class="close" title="Close Modal">&times;</span>
          </div>
          <div class="modal-body">
             <label for="first_name"><b>First Name</b></label><span id="m.first_name" style='color:green;'></span></br>
             <span id="e.first_name" class="error" style='color:red;'></span>
             <input type="text" placeholder="Enter First Name" name="first_name" required onblur="allLetters(this,'m.first_name','e.first_name')">

             <label for="last_name"><b>Last Name</b></label><span id="m.last_name" style='color:green;'></span></br>
             <span id="e.last_name" class="error" style='color:red;'></span>
             <input type="text" placeholder="Enter Last Name" name="last_name" required onblur="allLetters(this,'m.last_name','e.last_name')">

             <label for="add_username"><b>Username</b></label><span id="m.add_username" style='color:green;'></span></br>
             <span id="e.add_username" class="error" style='color:red;'></span>
             <input type="text" placeholder="Create Username" name="add_username" required onblur="alphaNumeric(this,'m.add_username','e.add_username')">

             <label for="add_user_password"><b>Password</b></label>
             <input type="password" placeholder="Enter Password" name="add_user_password" required>

             <label for="email"><b>Email</b></label><span id="m.email" style='color:green;'></span></br>
             <span id="e.email" class="error" style='color:red;'></span>
             <input type="text" placeholder="Enter Email" name="email" required onblur="validEmail(this,'m.email','e.email')">

             <label for="phone_number"><b>Phone Number</b></label><span id="m.phone_number" style='color:green;'></span></br>
             <span id="e.phone_number" class="error" style='color:red;'></span>
             <input type="text" placeholder="Enter Phone Number" name="phone_number" required onblur="validPhoneNumber(this,'m.phone_number','e.phone_number')">
             <button type="submit" Value="Submit" class="btn btn-primary">Create</button>
          </div>
          <div class="modal-footer" style="background-color:#f1f1f1">
               <button type="button" class="btn btn-danger" onclick="document.getElementById('register').style.display='none'" class="cancelbtn">Cancel</button>
          </div>
       </form>
  </div>
</div>
</body>
</html>
