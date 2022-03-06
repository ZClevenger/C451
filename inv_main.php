<!DOCTYPE html>
<html>

<head>
<!--
	Zach Clevenger
	INFO-C451
	Spring 22
	Project
	Household Inventory Tracker
-->
    <title>Household Inventory Tracker</title>
    <meta name="keywords" content="Inventory, household, tracker, homestead, insurance">
	<meta name="author" content="Zach Clevenger">
	<meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	
    <style>
     .wrapper
		{
            width: auto;
            margin: 0 auto;
			
        }
        table tr td:last-child
		{
            width: 120px;
        }
		.btn
		{
			background-color:blue;
			padding: 10px;
			margin: 20px;
		}
		.btn:hover 
		{
			color: blue;
			background-color: white;
			text-decoration: underline;
		}
		h1
		{
			font-family: "Times New Roman", Times, serif;
			text-align: center;
		}
		h4
		{
			font-family: "Times New Roman", Times, serif;
			text-align: center;
		}
		#sep_bar
		{
			background-color:green; 
			margin-top: 0; 
			margin-bottom: 0;
			height: 5px; 
			width: auto;			
			float:top;
		}
		#top_section
		{
			background-color:mediumSeaGreen;
			color:Black;
			height:100px;
			width:auto;
			text-align:center;
			padding: 25px;
			margin: auto;
		}
		#center_section 
		{
			background-color:#00FA9A;
			height:auto;
			width:auto;
			float:auto;
			text-align:center;
			margin: auto;
			padding:5px;
		}
		#footer
		{
			background-color: green;
			color:white;
			font-size:20px;
			width:auto;
			height:50px;
			padding: 2px;
			text-align:center;	
		}
		a
		{
			padding: 1px;
		}
		a:hover 
		{
			color: white;
			background-color: transparent;
		}
	</style>
		
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
	
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
		
		<div id="sep_bar"></div>
		<div id="top_section">
			<h1 id="mainTitle" style="color:black">Household Inventory Tracker</h1>
		</div>
		<div id="sep_bar"></div>
		
		<div id="center_section";>
			
            <div class="row">
                <div class="col-md-12">
                    
						<a href="inv_new.php" class="btn btn-success pull-left" ><i class="fa fa-plus"></i> Add Item</a>
                    
					<h2 class="pull-center">Item List</h2>
					<?php
                    // config file
                    require_once "inv_config.php";
                    // Attempt select query execution
                    $sql = "SELECT * FROM my_stuff";
                    if($result = mysqli_query($con, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Description</th>";
                                        echo "<th>SN</th>";
                                        echo "<th>Cost</th>";
										echo "<th>Location</th>";
										echo "<th>Category</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['Name'] . "</td>";
                                        echo "<td>" . $row['Description'] . "</td>";
                                        echo "<td>" . $row['SN'] . "</td>";
										echo "<td>" . $row['Cost'] . "</td>";
										echo "<td>" . $row['Location'] . "</td>";
										echo "<td>" . $row['Category'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="inv_view.php?id='. $row['id'] .'" class="mr-3" title="View Item" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="inv_update.php?id='. $row['id'] .'" class="mr-3" title="Update Item" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="inv_delete.php?id='. $row['id'] .'" title="Delete Item" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Unable to perform the action.";
                    }
 
                    // Close connection
                    mysqli_close($con);
                    ?>
                </div>
            </div>  
			
			<div id="footer">
			<h4 style="margin:13px">
			&copy Copyright 2022 by Zach Clevenger
			</h4>
			</div>
			
		</div>	
	</div>
   </div>
</body>
</html>