<?php
require_once('config.php');
?>
<?php include('header_navigation.php'); ?>
<div class = "container"?>

<h3>Search the Database</h3>
<p><b>Please Select a Table to Search:</b></p>


 <form action="process_search_category.php" method = "post">
  <select name="search_category">
    <option value="vehicles">Vehicles</option>
    <option value="maintenance">Maintenance</option>
    <option value="maintenance_types">Maintenance Types</option>
    <option value="fuel">Fuel</option>
  </select>
</br></br>
<div style = width:500px;>
<input class="form-control input-md" id="searchfor" type="input" name="search_string" placeholder="Search Field: Please Type in your Search" />
</div>
</br>


  <input type="submit" value="Search">
</form> 
<?php include "footer.php"; ?>

</div> <!-- Close container -->

</body>
</html>
