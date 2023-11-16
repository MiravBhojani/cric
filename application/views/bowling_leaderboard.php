<?php

if ($is_admin) {
	include 'admin_header.php';
} else {
	include 'club_header.php';
}
?>

<main class="flex-shrink-0">
	<div class="container mt-4">
		<div class="card mt-4">
			<div class="card-header">
				<h3>Leaderboard Bowling Report</h3>
			</div>
			<div class="card-body">
				<a href="<?php echo base_url('Welcome/leaderboard'); ?>" class="btn btn-success">Leaderboard Menu</a>
				<a href="<?php echo base_url('Welcome/exportCSV'); ?>" class="btn btn-primary">Export Data</a>
				<hr/>
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<thead>
						<tr>
							<th>#</th>
							<th>Player Name</th>
							<th>Matches</th>
							<th>Overs Bowled</th>
							<th>Bowls</th>
							<th>Runs Given</th>
							<th>Wickets Taken</th>
							<th>Economy</th>
							<th>Average</th>
							<th>Performance Wickets 5</th>
							<th>Performance Wickets 4</th>
							<th>Performance Wickets 3</th>
							<th>Performance Wickets 2</th>
							<th>Performance Wickets 1</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$count = 1;
						foreach ($reports as $report) : ?>
							<tr>
								<td><?= $count++ ?></td>
								<td><?= $report['player_name'] ?></td>
								<td><?= $report['matches'] ?></td>
								<td><?= $report['oversbowled'] ?></td>
								<td><?= $report['bowls'] ?></td>
								<td><?= $report['runsgiven'] ?></td>
								<td><?= $report['wicketstaken'] ?></td>
								<td><?= $report['economy'] ?></td>
								<td><?= $report['average'] ?></td>
								<td><?= $report['performancewickets5'] > 0 ? $report['performancewickets5'] : '-' ?></td>
								<td><?= $report['performancewickets4'] > 0 ? $report['performancewickets4'] : '-' ?></td>
								<td><?= $report['performancewickets3'] > 0 ? $report['performancewickets3'] : '-' ?></td>
								<td><?= $report['performancewickets2'] > 0 ? $report['performancewickets2'] : '-' ?></td>
								<td><?= $report['performancewickets1'] > 0 ? $report['performancewickets1'] : '-' ?></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
</main>

<?php include 'admin_footer.php'; ?>
