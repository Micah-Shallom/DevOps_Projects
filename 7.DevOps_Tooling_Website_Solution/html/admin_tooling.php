<?php 
include('functions.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="tooling_stylesheets.css">
	<style>
	.header {
		background: #003366;
	}
	button[name=register_btn] {
		background: #003366;
	}
	</style>
</head>
<body>
	<div class="header">
		<h2>Admin - Home Page</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<div class="profile_info">
		<!--	<img src="../images/admin_profile.png"  > -->

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="admin_tooling.php?logout='1'" style="color: red;">logout</a>
                       &nbsp; <a href="create_user.php" target="_blank"> + add user</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>


	<div class="Logo">

<a href="">
	<img src="img/logo-propitix.png" alt="" width="220" height="150">
	</a>
</div>


<h1> PROPITIX TOOLING WEBSITE </h1>
<h2 id="test">Propitix.io</h2>



<div class="container">
<div class="box">
	<a href="https://jenkins.infra.zooto.io/" target="_blank">
		<img src="img/jenkins.png" alt="Snow" width="400" height="150">
	</a>
</div>

<div class="box">
	<a href="https://grafana.infra.zooto.io/" target="_blank">
		<img src="img/grafana.png" alt="Snow2" width="400" height="150">
	</a>


</div>

<div class="box">
	<a href="https://rancher.infra.zooto.io/" target="_blank">
		<img src="img/rancher.png" alt="Snow" width="400" height="150">
	</a>
</div>


</div>
<div class="container">
<div class="box">
	<a href="https://prometheus.infra.zooto.io/" target="_blank">
		<img src="img/prometheus.png" alt="Snow" width="400" height="150">
	</a>
</div>

<div class="box">
	<a href="https://k8s-metrics.infra.zooto.io/" target="_blank">
		<img src="img/kubernetes.png" alt="Snow" width="400" height="120">
	</a>

</div>

<div class="box">
	<a href="https://kibana.infra.zooto.io/" target="_blank">
		<img src="img/kibana.png" alt="Snow" width="400" height="100">
	</a>
</div>


</div>

<div class="container">
<div class="box">
	<a href="https://artifactory.infra.zooto.io/" target="_blank">
		<img src="img/jfrog.png" alt="snow" width="400" height="100">
	</a>

</div>

</div>

</div>

</section>
</body>
</html>