<?php
if ($is_admin) {
	include 'admin_header.php';
} else {
	include 'club_header.php';
}
?>
	<main class="flex-shrink-0">
		<div class="container mt-5">
			<div class="card mt-3">
				<div class="card-header">
					<h3>Leader Boards</h3>
				</div>
				<div class="card-body">
					<div class="d-flex flex-column">
						<br/>
						<br/>
						<a href="<?php echo base_url('Welcome/batting_leaderboard/4'); ?>"
						   class="list-group-item list-group-item-action bg-success text-light">Batting Leaderboard</a>
						<br/>
						<br/>
						<a href="<?php echo base_url('Welcome/bowling_leaderboard/7'); ?>"
						   class="list-group-item list-group-item-action bg-danger text-light">Bowling Leaderboard</a>
						<br/>
						<br/>
					</div>
				</div>
			</div>
	</main>
<?php include 'admin_footer.php';
