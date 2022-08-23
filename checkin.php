<?php
$ini = parse_ini_file('app.ini');
$servername = $ini['db_server'];
$connection = array( "Database"=>$ini['db_name'], "UID"=>$ini['db_user'], "PWD"=>$ini['db_pass']);
$name = $_POST['name'];
$company = $_POST['company'];
$phone = $_POST['number'];
$checkin = date('Y-m-d H:i:s');

// Create connection
$conn = sqlsrv_connect($servername, $connection);
if( $conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}

 // Write data
$sql = "INSERT INTO visitor_log (name, phone, company, checkin, status) VALUES (?, ?, ?, ?, 1)";
$params = array($name, $phone, $company, $checkin);
$stmt = sqlsrv_query( $conn, $sql, $params);

if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}
?>


<!--Redirect to confirmation page-->
<script type="text/javascript">
window.location = "/confirm-checkin.php";
</script>