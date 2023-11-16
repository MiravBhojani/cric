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
				<h3>Matches</h3>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
						<tr>
							<th>#</th>
							<th>Home Team</th>
							<th>Away Team</th>
							<th>Date</th>

							<?php if (!$is_admin) { ?>
								<th>Action</th>
							<?php } ?>
						</tr>
						</thead>
						<tbody>
						<?php $count = 1; ?>
						<?php foreach ($matches as $match) : ?>
							<tr>
								<td><?= $count++ ?></td>
								<td><?= $match['ht_name'] ?></td>
								<td><?= $match['at_name'] ?></td>
								<td><?= $match['dateplayed'] ?></td>
								<?php if (!$is_admin) { ?>
									<td>
										<?php if ($match['completed'] == '0') { ?>
										<a href="<?= base_url('Welcome/s1/' . $match['match_id']) ?>"
										   class="btn btn-primary">Edit</a>
										   <?php }else { ?>
										   <span class="badge bg-success">Completed</span>
										   <?php } ?>
									</td>
								<?php } ?>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
					<!--					<nav aria-label="Page navigation" class="d-flex justify-content-center">-->
					<!--						<ul class="pagination">-->
					<!--							<li class="page-item"><a class="page-link" href="#">Previous</a></li>-->
					<!--							<li class="page-item"><a class="page-link" href="#">1</a></li>-->
					<!--							<li class="page-item"><a class="page-link" href="#">2</a></li>-->
					<!--							<li class="page-item"><a class="page-link" href="#">3</a></li>-->
					<!--							<li class="page-item"><a class="page-link" href="#">Next</a></li>-->
					<!--						</ul>-->
					<!--					</nav>-->
				</div>
			</div>
		</div>
	</div>
</main>
<?php include 'admin_footer.php'; ?>
