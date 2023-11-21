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
				<h3>Clubs</h3>
			</div>
			<div class="card-body">
				<a href="<?php echo base_url('Welcome/exportClubs'); ?>" class="btn btn-primary">Export Data</a>
				<hr/>

				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Home Ground</th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($clubs as $key => $club) { ?>
							<tr>
								<td><?= $key + 1 ?></td>
								<td><?= $club['clubname'] ?></td>
								<td><?= $club['email'] ?></td>
								<td><?= $club['homeground'] ?></td>
								<td>
									<a href="<?= base_url('Welcome/create_club/' . $club['id']); ?>"
									   class="btn btn-sm btn-primary">Edit</a>
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
</main>
<?php include 'club_footer.php' ?>
