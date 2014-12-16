<?php include("db_connection.php") ?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Intro Test Screen</title>
</head>
<body>
  <h2>Heading!</h2>
  <p>
    <?php

    $sql = "SELECT * FROM PATIENT ";

	if($mysqli = connect_db()) {
	 	
		$result = $mysqli->query($sql);
		print_r($mysqli->error);
	}

    echo '<table cellpadding="6" border="1">';
    echo "<tr>";
    echo "<th>Personnummer</th>";
    echo "<th>Förnamn</th>";
    echo "<th>Efternamn</th>";
    echo "<th>Epostadress</th>";
    echo "</tr>";

    while($myRow = $result->fetch_array()){
    	echo "<tr>";
      echo "<td>" . $myRow['p_number'] . "</td>";
      echo "<td>" . $myRow['p_firstname'] . "</td>";
      echo "<td>" . $myRow['p_lastname'] . "</td>";
      echo "<td>" . $myRow['p_email'] . "</td>";
      echo "</tr>";
    }
    echo "</table>";

?>

  </p>
  <p>Here be more dragons</p>
</body>
<footer>
  <p>Powered by Aguel and friends</p>
  <p>hur funkar commits?</p>
  <p>Foot</p>
</footer>
