<?php
$ini = parse_ini_file('app.ini');
$servername = $ini['db_server'];
$connection = array( "Database"=>$ini['db_name'], "UID"=>$ini['db_user'], "PWD"=>$ini['db_pass']);
$checkout = date('Y-m-d H:i:s');
$id = $_POST['id'];

// Create connection
$conn = sqlsrv_connect($servername, $connection);
if( $conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}

 // Write data
$sql = ("UPDATE visitor_log set status = '2', checkout = '$checkout' where id = '$id'");
$stmt = sqlsrv_query($conn, $sql);

if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}
?>


<!--Redirect to confirmation page-->
<script type="text/javascript">
window.location = "/confirm-checkout.php";
</script>