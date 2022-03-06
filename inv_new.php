<?php
/*
	Zach Clevenger
	INFO-C451
	Spring 22
	Project
	Household Inventory Tracker
*/

require_once "inv_config.php";
 
// Variables
$Name = $Description = $SN = $Cost = $Location = $Category = "";
$Name_err = $Description_err = $SN_err = $Cost_err = $Location_err = $Category_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
    // Validation of Name
    $input_Name = trim($_POST["Name"]);
    if(empty($input_Name)){
        $Name_err = "Enter item name.";
    } elseif(!filter_var($input_Name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $Name_err = "Enter a valid item name.";
    } else{
        $Name = $input_Name;
    }
    
    // Validation of Description
    $input_Description = trim($_POST["Description"]);
    if(empty($input_Description)){
        $Description_err = "Enter item description.";     
    } else{
        $Description = $input_Description;
    }
	
	// Validation of Serial Number (SN)
    $input_SN = trim($_POST["SN"]);
    if(empty($input_SN)){
        $SN_err = "Enter item serial number.";     
    } else{
        $SN = $input_SN;
    }
    
    // Validation of Cost
    $input_Cost = trim($_POST["Cost"]);
    if(empty($input_Cost)){
        $Cost_err = "Enter the item's cost or estimated value.";     
    } elseif(!ctype_digit($input_Cost)){
        $Cost_err = "Enter a valid numerical value.";
    } else{
        $Cost = $input_Cost;
    }
	
	// Validation of Location
    $input_Location = trim($_POST["Location"]);
    if(empty($input_Location)){
        $Location_err = "Enter item location in household.";     
    } else{
        $Location = $input_Location;
    }
	
	// Validation of Category
    $input_Category = trim($_POST["Category"]);
    if(empty($input_Category)){
        $Category_err = "Enter item's category.";     
    } else{
        $Category = $input_Category;
    }
    
    // Check for any input errors before trying to insert into database
    if(empty($Name_err) && empty($Description_err) && empty($SN_err) && empty($Cost_err) 
				&& empty($Location_err) && empty($Category_err)){
        // Prep insert statement
        $sql = "INSERT INTO my_stuff (Name, Description, SN, Cost, Location, Category) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_Name, $param_Description, 
					$param_SN, $param_Cost, $param_Location, $param_Category);
            
            // Set parameters
            $param_Name = $Name;
            $param_Description = $Description;
            $param_SN = $SN;
			$param_Cost = $Cost;
			$param_Location = $Location;
			$param_Category = $Category;
            
            // Execute statement
            if(mysqli_stmt_execute($stmt)){
                // Successfully created new item. Back to main.
                header("location: inv_main.php");
                exit();
            } else{
                echo "There was an issue creating a new item, try again.";
            }
			// Close statement
        mysqli_stmt_close($stmt);
        }
         
        
    }
    
    // Close connection
    mysqli_close($con);
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
        .wrapper{
            width: auto;
            margin: auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
	<div id="CSS">
		<link rel="stylesheet"
		type="text/css"
		href="inv_CSS.css"> 
	</div>
</head>

<body>
<div class="wrapper">
<div class="container-fluid">
<div id="sep_bar"></div>
	<div id="top_section">
		<h1 id="mainTitle" style="color:black">Inventory Tracker</h1>
	</div>
	<div id="sep_bar"></div>
	
	<div id="right_section";>
		<div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Add New Item</h2>
                    <p>Fill in the fields and click "submit" to add the new item to your inventory!p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="Name" class="form-control <?php echo (!empty($Name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Name; ?>">
                            <span class="invalid-feedback"><?php echo $Name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="Description" class="form-control <?php echo (!empty($Description_err)) ? 'is-invalid' : ''; ?>"><?php echo $Description; ?></textarea>
                            <span class="invalid-feedback"><?php echo $Description_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Serial Number</label>
                            <input type="text" name="SN" class="form-control <?php echo (!empty($SN_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $SN; ?>">
                            <span class="invalid-feedback"><?php echo $SN_err;?></span>
                        </div>
						<div class="form-group">
                            <label>Cost</label>
                            <input type="text" name="Cost" class="form-control <?php echo (!empty($Cost_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Cost; ?>">
                            <span class="invalid-feedback"><?php echo $Cost_err;?></span>
                        </div>
						<div class="form-group">
                            <label>Location</label>
                            <input type="text" name="Location" class="form-control <?php echo (!empty($Location_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Location; ?>">
                            <span class="invalid-feedback"><?php echo $Location_err;?></span>
                        </div>
						<div class="form-group">
                            <label>Category</label>
                            <input type="text" name="Category" class="form-control <?php echo (!empty($Category_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Category; ?>">
                            <span class="invalid-feedback"><?php echo $Category_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="inv_main.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>		
		<div id="footer">
			<p style="margin:13px">
			&copy Copyright 2022 by Zach Clevenger
			</p>
		</div>
	</div>
</div>
</div>
</body>
</html>


