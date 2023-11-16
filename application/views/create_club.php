<?php

if ($is_admin) {
	include 'admin_header.php';
} else {
	include 'club_header.php';
}
?>
<main class="flex-shrink-0">
	<div class="container mt-5">
		<div class="card">
			<div class="card-header">
				<h3>Create Club</h3>
			</div>
			<div class="card-body">
				<form action="<?php echo base_url('Welcome/createclubpost'); ?>" method="post">
					<div class="mb-3">
						<label for="clubName" class="form-label">Club Name</label>
						<input type="text" class="form-control" id="clubName" name="clubName" required>
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" class="form-control" id="email" name="email" required>
					</div>
					<div class="mb-3">
						<label for="homeGround" class="form-label">Home Ground</label>
						<input type="text" class="form-control" id="homeGround" name="homeGround" required>
					</div>
					<button type="submit" class="btn btn-primary">Create Club</button>
				</form>
			</div>
		</div>
	</div>
</main>
<?php include 'admin_footer.php'; ?>
