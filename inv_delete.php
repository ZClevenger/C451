<?php

/*
	Zach Clevenger
	INFO-C451
	Spring 22
	Project
	Household Inventory Tracker
*/

// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Config file
    require_once "inv_config.php";
    
    // Delete statement
    $sql = "DELETE FROM my_stuff WHERE id = ?";
    
    if($stmt = mysqli_prepare($con, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["id"]);
        
        // Execute statement
        if(mysqli_stmt_execute($stmt)){
            // Successful deletion. Return to main
            header("location: inv_main.php");
            exit();
        } else{
            echo "There was a system error, please try again";
        }
		// Close statement
		mysqli_stmt_close($stmt);
    }
     
    
    
    // Close connection
    mysqli_close($con);
} else{
    // Check for id parameter
    if(empty(trim($_GET["id"]))){
        // Id parameter not found. Send to error.
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory Tracker</title>
    <meta name="keywords" content="Inventory, household, tracker, homestead, insurance">
	<meta name="author" content="Zach Clevenger">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
			margin: 5px;
		}
		.btn:hover 
		{
			color: blue;
			background-color: white;
			text-decoration: underline;
		}
		.alert
		{
			background-color:white;
			padding: 10px;
			margin: 5px;
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
			padding: 1px;
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
		.row
		{
			margin: auto;
			width: 50%;
			border: 3px solid green;
			padding: 5px;
		}
	</style>
</head>
<body>
    <div class="wrapper">
    <div class="container-fluid">
		<div id="sep_bar"></div>
	<div id="top_section">
		<h1 id="mainTitle" style="color:black">Inventory Tracker</h1>
	</div>
		<div id="sep_bar"></div>
	<div id="center_section";>
		<br>
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Delete Record</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Are you sure you want to delete this employee record?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="inv_main.php" class="btn btn-secondary">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
			<br>
		<div id="footer">
			<p style="margin:13px">&copy Copyright 2022 by Zach Clevenger</p>
		</div>			
        </div>
    </div>
</body>
</html>