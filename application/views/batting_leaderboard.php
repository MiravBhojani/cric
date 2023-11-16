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
				<h3>Leaderboard Batting Report</h3>
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
							<th>Runs</th>
							<th>Bowls</th>
							<th>Outs</th>
							<th>Average</th>
							<th>Performance <br>Runs 5</th>
							<th>Performance <br>Runs 4</th>
							<th>Performance <br>Runs 3</th>
							<th>Performance <br>Runs 2</th>
							<th>Performance <br>Runs 1</th>
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
								<td><?= $report['runs'] ?></td>
								<td><?= $report['bowls'] ?></td>
								<td><?= $report['outs'] ?></td>
								<td><?= $report['average'] ?></td>
								<td><?= $report['performanceruns5'] > 0 ? $report['performanceruns5'] : '-' ?></td>
								<td><?= $report['performanceruns4'] > 0 ? $report['performanceruns4'] : '-' ?></td>
								<td><?= $report['performanceruns3'] > 0 ? $report['performanceruns3'] : '-' ?></td>
								<td><?= $report['performanceruns2'] > 0 ? $report['performanceruns2'] : '-' ?></td>
								<td><?= $report['performanceruns1'] > 0 ? $report['performanceruns1'] : '-' ?></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
</main>

<?php include 'admin_footer.php'; ?>
