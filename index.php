<?php
include('db_connection.php');
require('functions.php');
?>

<!DOCTYPE html PUBLIC "-//w3c//DTD XHTMLm 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmnlns="http://www.w3.org/1999/xhtml" xml:lang="sv" lang="sv">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Webbskattningsportalen</title>
</head>
<body>
   <div id="main">
      <div class="container">
         <h2>Heading!</h2>
            <p>
               <?php
               if (isset($_POST['generate'])) {

                  // Definiera sessions-variabler
                     $formToSend = $_POST['form'];
                     $_SESSION['form'] = $formToSend;

                     $patientToSendTo = $_POST['patient_number'];
                     $_SESSION['patient_number'] = $patientToSendTo;

                  // Om knapp är tryckt
                  // ...och minst ett formulär valt
                  if(empty($formToSend)) {
                     echo "Du valde inga formulär att skicka med i skattningen!";
                  }

                  // Om minst ett formulär ifyllt...
                  else {
                     // SQL Error message
                     if ($mysqli = connect_db()) {
                        $result = $mysqli->query($sqlSend);
                        print_r($mysqli->error);
                     }
                     // Skicka till TEMPLOGIN

                     $randPass = randomPassword();
                     $sqlTemp  = "INSERT INTO TEMPLOGIN (p_number, p_pass) VALUES ('$patientToSendTo', '$randPass');";
                     $mysqli->query($sqlTemp);

                     // Hämta t_key
                     $tKey = getTkey($patientToSendTo);

                     // Skicka till SKATTNING

                     // FUNKAR EJ?
                     // sendToSkattning($formToSend, $tKey);

                     $n = count($formToSend);
                     for ($i=0; $i < $n; $i++) {
                        $sqlSkattning = "INSERT INTO SKATTNING (f_key, t_key) VALUES ('$formToSend[$i]', '$tKey[0]');";
                        $mysqli->query($sqlSkattning);
                     }

                  }

               }
               else {
                  session_start();
                  firstForm();
               } ?>

               <?php

               $sql = 'SELECT * FROM PATIENT ';

	            if($mysqli = connect_db()) {

                  $result = $mysqli->query($sql);
		            print_r($mysqli->error);
	            }

               echo '<table cellpadding="6" border="1">';
               echo '<tr>';
               echo '<th>Personnummer</th>';
               echo '<th>Förnamn</th>';
               echo '<th>Efternamn</th>';
               echo '<th>Epostadress</th>';
               echo '</tr>';

               while($myRow = $result->fetch_array()){
    	             echo '<tr>';
                   echo '<td>' . $myRow['p_number'] . '</td>';
                   echo '<td>' . $myRow['p_firstname'] . '</td>';
                   echo '<td>' . $myRow['p_lastname'] . '</td>';
                   echo '<td>' . $myRow['p_email'] . '</td>';
                   echo '</tr>';
               }
               echo '</table>';

               ?>
            </p>
         </div>
     </div>
    </body>
    <footer>
        <p>Skapad av oss</p>
    </footer>

</html>
