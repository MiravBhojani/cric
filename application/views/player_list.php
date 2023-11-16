<?php
if ($is_admin) {
	include 'admin_header.php';
} else {
	include 'club_header.php';
}
?>

<!-- Begin page content -->
<main class="flex-shrink-0">
	<div class="container mt-5">
		<div class="card">
			<div class="card-header">
				<h3>Current Players</h3>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Club</th>
							<th>Date of Birth</th>
							<th>Batting Style</th>
							<th>Bowling Style</th>
						</tr>
						</thead>
						<tbody>
						<?php $count = 1; ?>
						<?php foreach ($players as $player) : ?>
							<tr>
								<td><?= $count++ ?></td>
								<td><?= $player['name'] ?></td>
								<td><?= $player['club_name'] ?></td>
								<td><?= date('F j, Y', strtotime($player['dob'])) ?></td>
								<td><?= $player['batting_style'] ?></td>
								<td><?= $player['bowling_style'] ?></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
</main>

<footer class="footer mt-auto py-3 bg-light">
	<div class="container">
		<span class="text-muted">Cricket Machine Learning Project. &copy; 2023</span>
	</div>
</footer>

<?php include 'club_footer.php'?>
