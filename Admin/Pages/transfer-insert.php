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
     $AccountNum=$_POST['AccountNum'];


    
        if(!$Customer_Name || !$Transfer_Amount || !$Transfer_Description
        || !$AccountNum){
        echo "You have not completed a transfer. Please go back and try again.";
        exit;
    }
 
        if (!get_magic_quotes_gpc()){
     $Customer_Name= addslashes($Customer_Name);
     $Transfer_Amount= addslashes($Transfer_Amount);
     $Transfer_Description= addslashes($Transfer_Description);
     $AccountNum= addslashes($AccountNum);

    }
    
    
    @$db= new mysqli('localhost','elzomom1_carphotos','Electriccars123','elzomom1_Elzomom1_SQL_Project');
    
    if(mysqli_connect_errno()){
        echo'Error: Could not connect to database. Please try again later.';
        exit;
    }
    
  $query = "insert into Transaction values
('".$Customer_Name."', '".$Transfer_Amount."', '".$Transfer_Description."', '".$AccountNum."')";
            
         
            
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
