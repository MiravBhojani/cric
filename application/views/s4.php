<?php

if ($is_admin) {
	include 'admin_header.php';
} else {
	include 'club_header.php';
}
?>

<!-- Begin page content -->
<main class="flex-shrink-0">
	<div class="container">
		<div class="card mt-4">
			<div class="card-header">
				<h3>Second Batting - <?php echo ucfirst($club_name); ?></h3>
			</div>
			<div class="card-body">
				<form action="<?= base_url('Welcome/s5/' . $s1_id . '') ?>" method="POST">
					<div class="mb-3">
						<table class="table table-striped">
							<thead>
							<tr>
								<th>Player</th>
								<th>Batting</th>
								<th>Runs</th>
								<th>Balls Faced</th>
								<th>Out/In</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($players as $player) : ?>
								<tr>
									<th><?= $player['name'] ?></th>
									<td>
										<select name="batting_<?= $player['player_id'] ?>"
												id="batting_<?= $player['player_id'] ?>" class="form-select"
												onchange="batling(this.value,'<?= $player['player_id'] ?>')">
											<option value="1">Bat</option>
											<option value="0">Did Not Bat</option>
										</select>
									</td>
									<td>
										<input class="form-control" name="runs_<?= $player['player_id'] ?>"
											   id="runs_<?= $player['player_id'] ?>" required>
									</td>
									<td>
										<input class="form-control" name="balls_<?= $player['player_id'] ?>"
											   id="balls_<?= $player['player_id'] ?>" required>
									</td>
									<td>
										<select name="out_not_out_<?= $player['player_id'] ?>"
												id="out_not_out_<?= $player['player_id'] ?>" class="form-select">
											<option value="1">Out</option>
											<option value="0">Not Out</option>
										</select>
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<button type="submit" class="btn btn-primary" name="s1_id" value="<?= $s1_id ?>">Submit</button>
				</form>
			</div>
		</div>
	</div>
</main>

<?php include 'admin_footer.php'; ?>

<script>
	function batling(value, id) {
		$('#runs_' + id).prop("disabled", value != 1);
		$('#balls_' + id).prop("disabled", value != 1);
		$('#out_not_out_' + id).prop("disabled", value != 1);


		if (value === 1) {
			$('#runs_' + id).prop("required", '');
			$('#balls_' + id).prop("required", '');
		}else{
			$('#runs_' + id).removeAttr("required");
			$('#balls_' + id).removeAttr("required");

			$('#runs_' + id).val("");
			$('#balls_' + id).val("");
		}
	}
</script>


