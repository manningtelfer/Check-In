<?php
$app = parse_ini_file('app.ini');
$servername = $app['db_server'];
$dbengine = $app['db_engine'];
$checkout = date('Y-m-d H:i:s');
$id = $_POST['id'];

switch ($dbengine) {
     case 0:
          // Define connection string
          $connection = array("Database"=>$app['db_name'], "UID"=>$app['db_user'], "PWD"=>$app['db_pass'], "TrustServerCertificate"=>$app['db_trustcert']);
          // Create connection
          $conn = sqlsrv_connect($servername.','.$app['db_port'], $connection);
          if( $conn === false ) {
               die( print_r( sqlsrv_errors(), true));
          }

          // Write data
          $query = ("UPDATE visitor_log set status = '2', checkout = '$checkout' where id = '$id'");
          $conn = sqlsrv_query($conn, $query);

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
          $query = ("UPDATE visitor_log set status = '2', checkout = '$checkout' where id = '$id'");
          $conn = mysqli_query($conn, $query);

          if( $conn === false ) {
               die( print_r( mysqli_connect_error(), true));
          }
          break;
}
?>


<!--Redirect to confirmation page-->
<script type="text/javascript">
window.location = "/confirm-checkout.php";
</script>