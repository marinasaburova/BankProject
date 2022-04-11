

<html>
    <head>
        <title>Bank Project Transaction</title>
    </head>
    
    <body>
    <h1>Bank Transaction Results</h1>
<?php    
    //create short variable names
     $Customer_Name=$_POST['Customer_Name'];
     $Transaction_Amount=$_POST['Transaction_Amount'];
     $Transfer_Description=$_POST['Transfer_Description'];
    
        if(!$Customer_Name || !$Transaction_Amount || !$Transfer_Description){
        echo "You have not completed a transaction. Please go back and try again.";
        exit;
    }
    

        if (!get_magic_quotes_gpc()){
     $Customer_Name= addslashes($Customer_Name);
     $Transaction_Amount= addslashes($Transaction_Amount);
     $Transfer_Description= addslashes($Transfer_Description);
    }
    
    
    @$db= new mysqli('localhost','elzomom1_carphotos','Electriccars123','elzomom1_Elzomom1_SQL_Project');
    
    if(mysqli_connect_errno()){
        echo'Error: Could not connect to database. Please try again later.';
        exit;
    }
    
  $query = "insert into Transfer values
            ('".$Customer_Name."', '".$Transaction_Amount."', '".$Transfer_Description."')";
  $result = $db->query($query);


  if ($result) {
      echo "".$_POST['Customer_Name'].", your transaction was completed.";
  } else {
  	  echo "An error has occurred.  The transaction was not completed.";
  }



  $db->close();
?>
</body>
</html>