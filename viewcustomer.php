<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phar';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$stmt = $con->prepare('SELECT * FROM CUSTOMER');
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>View Customer</title>
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Pharmacy Management System</h1>
				<a href="admin.php"><i class="fas fa-user-circle"></i>Home</a>
				<a href="addcustomer.php"><i class="fas fa-location-arrow"></i>Add Customer</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>بيانات الزبائن</h2>
			<div class="container">
				<table>
					<tr>
						<th>ID</th>
						<th>اسم الزبون</th>
						<th>رقم الهاتف</th>
						
					</tr>
<?php
while($data = $result->fetch_assoc()) {
?>
					<tr>
						<td><?=$data['CUSTOMER_ID']?></td>
						<td><?=$data['CUSTOMER_NAME']?></td>
						<td><?=$data['CUSTOMER_PHNO']?></td>
						
					</tr>
<?php
}
$stmt->close();
?>
				</table>
			</div>
		</div>
	</body>
</html>