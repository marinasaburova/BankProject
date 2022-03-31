<html>
    <head>
        <title>Bank Project</title>
    </head>
    <body>
    <h1>Bank Project Transactions</h1>
    <?php
    //create short variable names
    $searchtype=$_POST['searchtype'];
  $searchterm=trim($_POST['searchterm']);    
if (!$searchtype || !$searchterm) {
     echo 'The account number entered does not match our records. Please go back and try again.';
     exit; }
if (!get_magic_quotes_gpc()){
    $searchtype = addslashes($searchtype);
    $searchterm = addslashes($searchterm);}
    @$db= new mysqli('localhost','elzomom1_mennaelz','Bankproject123','elzomom1_bankproject');  
    if(mysqli_connect_errno()){
        echo'Error: Could not connect to database. Please try again later.';
        exit; }
   $query = "select * from Transaction where ".$searchtype." like '%".$searchterm."%'";
  $result = $db->query($query);
  $num_results = $result->num_rows;
  echo "<p>Number of transactions found: ".$num_results."</p>";
  for ($i=0; $i <$num_results; $i++) {
     $row = $result->fetch_assoc();
     echo "<p><strong>".($i+1).". Transaction: ";
     echo htmlspecialchars(stripslashes($row['Transaction']));
     echo "</strong><br />Amount: ";
     echo stripslashes($row['Amount']);
     echo "<br />Year: ";
     echo stripslashes($row['Type']);
     echo "<br />Color: ";
     echo stripslashes($row['Timestamp']);
     echo "<br />Product_ID: ";
     echo stripslashes($row['Vendor']);
         echo "<br />Quantity: ";
     echo stripslashes($row['Account Number']);
     echo "</p>"; }
  $result->free();
  $db->close();
?>
</body>
</html>