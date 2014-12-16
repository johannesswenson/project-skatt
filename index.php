<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Intro Test Screen</title>
</head>
<body>
  <h2>Heading!</h2>
  <p>
    <?php

function dbConnect () {
  $dbconnect = mysqli_connect("typografique.se.mysql", " typografique_se", "N87FWzAL", "typografique_se")
  if (mysqli_connect_errno()) {
    echo "Can't connect to database" . mysqli_connect_error();
  }
  else {
    $sql = "SELECT * FROM PATIENT;";
    $result = mysqli_query($dbconnect,$sql);

    echo "<table cellpadding='6' border='1'>";
    echo "<tr>";
    echo "<th>Personnummer</th>";
    echo "<th>Förnamn</th>";
    echo "<th>Efternamn</th>";
    echo "<th>Epostadress</th>";
    echo "</tr>";
    while($myRow = mysqli_fetch_array($result)){
      echo "<tr>";
      echo "<td>" . $myRow['p_number'] . echo "</td>";
      echo "<td>" . $myRow['p_firstname'] . echo "</td>";
      echo "<td>" . $myRow['p_lastname'] . echo "</td>";
      echo "<td>" . $myRow['p_email'] . echo "</td>";
      echo "</tr>";
    }
    echo "</table>"
  }
  mysqli_close($dbconnect);
}

dbConnect();

?>

  </p>
</body>
<footer>
  <p>Powered by Aguel and friends</p>
  <p>hur funkar commits?</p>
  <p>Foot</p>
</footer>
