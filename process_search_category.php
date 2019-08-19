<?php 
session_start();
$search_category = filter_input(INPUT_POST, 'search_category');
$search_string = filter_input(INPUT_POST, 'search_string');
$_SESSION['search_string'] = $search_string;

//echo "Search String:  $search_string";

// Validate search string

if (empty($search_string)) {
		
	include('header_navigation.php');

	echo '<div class="container">';
	echo '<div class="alert alert-warning">'; // Bootstrap class for warning alert
	echo '<strong>Error!</strong> There is nothing to search. Please try again.<br><br> <a href="search.php" style: text-decoration: none;><b>Search Again?</b></a>';
	echo "</div>";
    	include('./footer.php');
	echo "</div>";
	die;
} 
else 
{

switch ($search_category) {
    case "drivers":
        header("Location: drivers_process_search.php");
            break;
    case "vehicles":
        header("Location: vehicle_process_search.php");
			break;
    case "maintenance":
        header("Location: maintenance_process_search.php");
        	break;
    case "maintenance_types":
        header("Location: maintenance_types_process_search.php");
            break;
    default:
        header("Location: search.php");
}

}
?>