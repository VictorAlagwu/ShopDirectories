<?php $title= "Welcome Page"; ?>

<?php include "include/header.php"; ?>
<div class="container"> 
	<div class="row jumbotron">
		<div class="">
			<h2 class="display-3">Store Directory</h2>
			<p class="lead">It contains all the different stores</p>
		</div>
	</div>

	<div class="row">
	<?php
$query = "SELECT * FROM stores";

foreach ($con->query($query) as $row) {
	$store_name = $row['store_name'];
	$store_address = $row['store_address'];
	$store_user = $row['user_id'];
	$time_updated = $row['time_updated'];



	?>
	<p>
		<div class="col-lg-3 col-md-6 col-sm-6 d-flex align-items">
			<div class="card">
				<div class="card-block">
					<h4 class="card-header"><?php echo $store_name; ?></h4>
					<div class="card-body">
						<h6 class="card-subtitle mb-2 text-muted">Added by: <?php echo $store_user; ?></h6>
						<p class="card-text">Address: <?php echo $store_address; ?></p>
						<p class="card-text">Date Updated: <?php echo $time_updated; ?></p>
					</div>					
				</div>
			</div>
		</div>
	</p>
		
		<?php }?>
	</div>

</div>

  <!-- Bootstrap JavaScript================================= -->
  	
  	<script src="assets/js/jquery.min.js"></script>
  	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>
</html>