<?php
$username = "c3_aeg2";
$password = "R35p0NDem398";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");
echo "Connected to MySQL<br>";

//select a database to work with
$selected = mysql_select_db("c3_aeg2",$dbhandle) 
  or die("Could not select examples");
  
//execute the SQL query and return records
$result = mysql_query("SELECT * FROM planols ORDER BY 'id' ASC");
//fetch tha data from the database
while ($row = mysql_fetch_array($result)) {
   //echo "ID:".$row{'id'}." Name:".$row{'model'}." 
   //".$row{'year'}."<br>";
   echo "ID->".$row["id"]." - UPDATE parts_planols SET planol_id=".$row["id"]." WHERE planol_id='".$row["codigo"]."' <br>";
   //print_r( $row );
   //echo "<br>";
   echo mysql_query("UPDATE parts_planols SET planol_id=".$row["id"]." WHERE planol_id='".trim($row["codigo"])."'");
}

//close the connection
mysql_close($dbhandle);
?>