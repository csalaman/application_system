<?php
/**
 * Created by PhpStorm.
 * User: csalaman
 * Date: 3/22/2018
 * Time: 9:37 PM
 */
require_once "DatabaseInstance.php";


$html_admin_main = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Projecto 4</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .border{border-style: outset;}
    </style>
</head>
<body>
<br>
    <div class="container border">
            <p style="font-size: 50px"><strong>Applications</strong></p>
            <form action="{$_SERVER['PHP_SELF']}" method="POST">
               
                <!--Selecting fields to display-->
                <div class="form-group">
                    <label for="field_display">Select fields to display:</label><br>
                <select multiple class="form-control" name="field_display[]">
                    <option value="name" name="name_display">name</option>
                    <option value="email" name="email_display">email</option>
                    <option value="year" name="year_display">year</option>
                    <option value="gender" name="gender_display">gender</option>              
                </select>
                </div>
                
                <!--Select field to sort applications-->
                <div class="form-group">
                <label for="sort_by">Select field to sort applications:</label>
                <select class="form-control" name="sort_by">
                    <option value="name" name="name_sort">name</option>
                    <option value="email" name="email_sort">email</option>
                    <option value="year" name="year_sort">year</option>
                    <option value="gender" name="gender_sort">gender</option>              
                </select>
                </div>
                
                <!--Filter Condition-->
                 <label for="filter">Filter Condition:</label>
                 <input type="text" name="filter"> <br><br>
                 
                 <input type="submit" value="Display Applications" name="display_request"><br>
            </form><br>
            <form action="main.html">
                <input type="submit" value="Return to main menu" />
            </form><br>
        </div>

    </div>



<!-- jQuery (needed for Bootstrap's JS plugins) -->
<script src="bootstrap/jquery-3.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
HTML;

ob_start();
echo $html_admin_main;

if(isset($_POST['display_request'])){
    $fields = null;
    $sort_by = $_POST['sort_by'];
    $filter = null;

    if(isset($_POST['field_display'])){
       $fields = $_POST['field_display'];
    }
    if(isset($_POST['filter'])){
        $filter = $_POST['filter'];
    }
    $table = $db->getTableInformation($fields,$sort_by,$filter);

    $html_table = "
<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>Projecto 4</title>
    <link href=\"bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">
    <style>
    .border{border-style: outset;}
    </style>
</head>
<body>
<br>
    <div class=\"container border\">
            <p style=\"font-size: 50px\"><strong>Applications</strong></p>
            ".$table."
            <br><form action=\"main.html\">
                <input type=\"submit\" value=\"Return to main menu\" />
            </form><br>
        </div>

    </div>



<!-- jQuery (needed for Bootstrap's JS plugins) -->
<script src=\"bootstrap/jquery-3.2.1.min.js\"></script>
<script src=\"bootstrap/js/bootstrap.min.js\"></script>
</body>
</html>
";
    ob_end_clean();
    echo $html_table;

}









?>