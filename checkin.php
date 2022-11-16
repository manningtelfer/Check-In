<?php
$app = parse_ini_file('app.ini');
$servername = $app['db_server'];
$dbengine = $app['db_engine'];
$name = $_POST['name'];
$company = $_POST['company'];
$phone = $_POST['number'];
$checkin = date('Y-m-d H:i:s');

switch ($dbengine) {
     case 0:
          //Define connection string
          $connection = array("Database"=>$app['db_name'], "UID"=>$app['db_user'], "PWD"=>$app['db_pass'], "TrustServerCertificate"=>$app['db_trustcert']);
          
          // Create connection
          $conn = sqlsrv_connect($servername.','.$app['db_port'], $connection);
          if( $conn === false ) {
               die( print_r( sqlsrv_errors(), true));
          }

          // Write data
          $query = "INSERT INTO visitor_log (name, phone, company, checkin, status) VALUES ('$name', '$phone', '$company', '$checkin', '1')";
          $conn = sqlsrv_query($conn, $query,);

          if( $conn === false ) {
               die( print_r( sqlsrv_errors(), true));
          }
          break;
          
     case 1:
          // Define connection string and create connection
          $conn = mysqli_connect($servername, $app['db_user'], $app['db_pass'], $app['db_name'], $app['db_port']);
          if( $conn === false ) {
               die( print_r( mysqli_connect_error(), true));
          }

          // Write data
          $query = "INSERT INTO visitor_log (name, phone, company, checkin, status) VALUES ('$name', '$phone', '$company', '$checkin', '1')";
          $result = mysqli_query($conn, $query);

          if( $result === false ) {
               echo($query);
               die();
          }
          break;
}


?>
<!--Redirect to confirmation page-->
<script type="text/javascript">
window.location = "/confirm-checkin.php";
</script>