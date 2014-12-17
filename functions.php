<?php
// ----- Random Password function -----
function randomPassword() {
   $alphabet = "ABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
   $pass = array(); //remember to declare $pass as an array
   $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
   for ($i = 0; $i < 6; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
   }
   return implode($pass); //turn the array into a string
}

// ----- Send module - Index-formuläret -----
function firstForm() {
   echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
   echo '<label for="patient_number">Personnummer: </label>';
   echo '<input name="patient_number" type="text"> <br />';
   echo '<label for="patient_firstname">Förnamn: </label>';
   echo '<input name="patient_firstname" type="text"> <br />';
   echo '<label for="patient_lastname">Efternamn: </label>';
   echo '<input name="patient_lastname" type="text"> <br />';
   echo '<label for="patient_email">Epostadress: </label>';
   echo '<input name="patient_email" type="text"> <br /><br />';

   $sqlForms = "SELECT f_key, f_code, f_name FROM FORM;";

   if ($mysqli = connect_db()) {
      $result = $mysqli->query($sqlForms);
      print_r($mysqli->error);
   }

   while($myRow = $result->fetch_array()) {
      echo '<input name="form[ ]" type="checkbox" value="' . $myRow['f_key'] . '">';
      echo $myRow['f_code'] . ' / ' . $myRow['f_name'] . '<br />';
   }
   echo '<br />';
   echo '<input name="generate" type="submit" value="Skicka skattning">';
   echo '</form>';
}

// ----- SQL for sending to SKATTNING -----
function sqlSkattning() {
   $n = count($formsToSend);
   for ($i=0; $i < $n; $i++) {
      $sqlSkattning = "INSERT INTO SKATTNING (f_key) VALUES ('$formsToSend[$i]');";
      $mysqli->query($sqlSkattning);
   }
}
// -----   ------
function getTkey($p_n) {
   $sqlGetDataTempLogin = "SELECT t_key FROM TEMPLOGIN WHERE p_number = '$p_n';";

   if ($mysqli = connect_db()) {
      $result = $mysqli->query($sqlGetDataTempLogin);
      print_r($mysqli->error);
   }
   $data = $result->fetch_array(MYSQLI_NUM);
   return $data;
   $mysqli->close();
}

// -----   ------
function sendToSkattning($formToSend, $tKey) {
   $n = count($formToSend);
   for ($i=0; $i < $n; $i++) {
      $sqlSkattning = "INSERT INTO SKATTNING (f_key, t_key) VALUES ('$formToSend[$i]', '$tKey[0]');";
      $mysqli->query($sqlSkattning);
   }
}
?>
