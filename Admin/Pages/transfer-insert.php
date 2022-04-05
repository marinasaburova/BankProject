

<html>
    <head>
        <title>Bank Project Transaction</title>
    </head>
    
    <body>
    <h1>Bank Transaction Results</h1>
<?php    
    //create short variable names
     $Customer_Name=$_POST['Customer_Name'];
     $Transfer_Amount=$_POST['Transfer_Amount'];
     $Transfer_Description=$_POST['Transfer_Description'];
     $Origin_Route=$_POST['Origin_Route'];
     $Origin_Account=$_POST['Origin_Account'];
     $Destination_Route=$_POST['Destination_Route'];
     $Destination_Account=$_POST['Destination_Account'];

    
        if(!$Customer_Name || !$Transfer_Amount || !$Transfer_Description
        || !$Origin_Route || !$Origin_Account  || !$Destination_Route || !$Destination_Account){
        echo "You have not completed a transfer. Please go back and try again.";
        exit;
    }
 
        if (!get_magic_quotes_gpc()){
     $Customer_Name= addslashes($Customer_Name);
     $Transfer_Amount= addslashes($Transfer_Amount);
     $Transfer_Description= addslashes($Transfer_Description);
     $Origin_Route= addslashes($Origin_Route);
     $Origin_Account= addslashes($Origin_Account);
     $Destination_Route= addslashes($Destination_Route);
     $Destination_Account= addslashes($Destination_Account);
    }
    
    
    @$db= new mysqli('localhost','elzomom1_carphotos','Electriccars123','elzomom1_Elzomom1_SQL_Project');
    
    if(mysqli_connect_errno()){
        echo'Error: Could not connect to database. Please try again later.';
        exit;
    }
    
  $query = "insert into Transaction values
('".$Customer_Name."', '".$Transfer_Amount."', '".$Transfer_Description."', '".$Origin_Route."', '".$Origin_Account."', '".$Destination_Route."','".$Destination_Account."' )";
            
         
            
  $result = $db->query($query);


  if ($result) {
      echo "".$_POST['Customer_Name'].", your transfer was completed.";
  } else {
  	  echo "An error has occurred.  The transfer was not completed.";
  }



  $db->close();
?>
</body>
</html>