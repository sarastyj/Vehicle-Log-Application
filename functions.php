<?php
function dateCustomFormat($_recordCreated) {
  // Formatting dates from database-->
  $empty_date = '0000-00-00 00:00:00';

  if ($_recordCreated == $empty_date){
      $_recordCreated = "N/A";
      return $_recordCreated;
  }
  else {
      $_recordCreated = date_create($_recordCreated);
      $_recordCreated = date_format($_recordCreated,"D, M j, Y");
      return $_recordCreated;
    }
}
function dateModifiedCustomFormat($_recordModified) {
  // Formatting dates from database-->
  $empty_date = '0000-00-00 00:00:00';

  if ($_recordModified == $empty_date){
      $_recordModified = "N/A";
      return $_recordModified;
  }
  else {
    $_recordModified = date_create($_recordModified);
    $_recordModified = date_format($_recordModified,"D, M j, Y");
    return $_recordModified;
    }
}
function phoneNumberFormat($number){
      if(strlen($number) === 10){
        $formatted_number = "($number[0]$number[1]$number[2])-$number[3]$number[4]$number[5]-$number[6]$number[7]$number[8]$number[9]";
        return $formatted_number;
      }
      if(strlen($number) === 11){
        $formatted_number = "$number[0]($number[1]$number[2]$number[3])-$number[4]$number[5]$number[6]-$number[7]$number[8]$number[9]$number[10]";
        return $formatted_number;
      }
}
 ?>
