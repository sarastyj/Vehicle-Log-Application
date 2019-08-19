<!--Landing Page-->
<?php
require_once ('config.php');
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content "IE=edge">
        <meta name="viewport" content="width"=device_width, initial-scale=1>

        <title>Vehicle Log Application</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/style.css">

    </head>

    <body>

        <div class="container" style=background-color:#0099ff;>

            <div class="page-header">
                <header style=color:#FFFFFF;>
                    <h1>Vehicle Log Application</h1></header>
            </div>

            <div class="jumbotron" style=background-color:black;>

                <a href="vehicles.php" class="btn btn-default btn-lg" role="button">Vehicles</a>
                <a href="maintenance.php" class="btn btn-default btn-lg" role="button">Maintenance Records</a>
                <a href="maintenance_types.php" class="btn btn-default btn-lg" role="button">Maintenance Types</a>
                <a href="fuel.php" class="btn btn-default btn-lg" role="button">Fuel</a>

                <p style="border:1px solid black;padding:2px;margin:30px;">
                    <em>Vehicle Log Application</em> will keep track of all of your fleet's critical records. Users will be able to search and access the fleet's Vehicle, Maintenance, Maintenance Types and Fuel information. </br></br>
			To get started, simply click on one of the links above.

		</p>


            </div>

        </div>
    </body>

    </html>
