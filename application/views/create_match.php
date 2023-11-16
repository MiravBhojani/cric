<?php

if ($is_admin) {
	include 'admin_header.php';
} else {
	include 'club_header.php';
}
?>
<main class="flex-shrink-0">
	<div class="container">
		<!-- Begin page content -->
		<main class="flex-shrink-0">
			<div class="container">
				<div class="card">
					<div class="card-header">
						<h3>Create Match</h3>
					</div>
					<div class="card-body">
						<form action="<?php echo base_url('Welcome/creatematchpost'); ?>" method="post">
							<div class="mb-3">
								<label for="homeTeam" class="form-label">Home Team</label>
								<select class="form-select home_team" id="homeTeam" name="homeTeam" required>
									<!-- Options for Home Team -->
									<?php foreach ($clubs as $club) : ?>
										<option value="<?= $club['id'] ?>"><?= $club['clubname'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>

							<div class="mb-3">
								<label for="awayTeam" class="form-label">Away Team</label>
								<select class="form-select" id="awayTeam" name="awayTeam" required>
									<!-- Options for Home Team -->
									<?php foreach ($clubs as $club) : ?>
										<option value="<?= $club['id'] ?>"><?= $club['clubname'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>

							<div class="mb-3">
								<label for="datePlayed" class="form-label">Date Played</label>
								<input type="date" class="form-control" id="datePlayed" name="datePlayed" required>
							</div>

							<div class="mb-3">
								<label for="homeGround" class="form-label">Home Ground</label>
								<input type="text" class="form-control home_ground" disabled>
								<input type="hidden" class="home_ground" name="homeGround"/>
							</div>
							<button type="submit" class="btn btn-success">Submit</button>
						</form>
					</div>
				</div>
		</main>
	</div>
</main>
<?php include 'club_footer.php'; ?>

<script>
	getHomeTeam();

	$('.home_team').on('change',function () {
		getHomeTeam()
	})

	function getHomeTeam(){
		$.ajax({
			url: "<?php echo base_url('Welcome/get_home_ground') ?>",
			type: 'GET',
			data: {
				home_team: $('.home_team').val()
			},
			dataType: 'json',
			success: function (res) {
				$('.home_ground').val(res.home_ground);
			},
			error: function (xhr) {
				alert("An error occurred. try again later");
			}
		}, 'json');
	}

</script>
