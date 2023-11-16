<?php

if ($is_admin) {
	include 'admin_header.php';
} else {
	include 'club_header.php';
}
?>

<main class="flex-shrink-0">
	<div class="container">
		<div class="card mt-4">
			<div class="card-header">
				<h3>First Bowling - <?php echo ucfirst($club_name); ?></h3>
			</div>
			<div class="card-body">
				<form action="<?php echo base_url('Welcome/s4/'. $s1_id .''); ?>" method="post">
					<div class="mb-3">
						<table class="table table-striped">
							<thead>
							<tr>
								<th>Player</th>
								<th>Bowled</th>
								<th>Overs <br>Bowled</th>
								<th>Runs <br>Given</th>
								<th>Wickets <br>Taken</th>
								<th>Economy</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($players as $player) : ?>
								<tr>
									<th><?= $player['name'] ?></th>
									<td>
										<select name="bowled_<?= $player['player_id'] ?>"
												id="bowled_<?= $player['player_id'] ?>" class="form-select"
												onchange="bowlings(this.value,'<?= $player['player_id'] ?>')">
											<option value="1">Bowled</option>
											<option value="0">Did Not Bowl</option>
										</select>
									</td>
									<td>
										<input class="form-control" name="overs_bowled_<?= $player['player_id'] ?>"
											   onkeyup="economy(<?= $player['player_id'] ?>)" id="overs_bowled_<?= $player['player_id'] ?>" required>
									</td>
									<td>
										<input class="form-control" name="runs_given_<?= $player['player_id'] ?>"
											   onkeyup="economy(<?= $player['player_id'] ?>)" id="runs_given_<?= $player['player_id'] ?>" required>
									</td>
									<td>
										<input class="form-control" name="wickets_taken_<?= $player['player_id'] ?>"
											   id="wickets_taken_<?= $player['player_id'] ?>" required>
									</td>
									<td>
										<input class="form-control economy_<?= $player['player_id'] ?> "  disabled>
										<input type="hidden" class="form-control economy_<?= $player['player_id'] ?> " name="economy_<?= $player['player_id'] ?>"
											   id="economy_<?= $player['player_id'] ?>">
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</main>

<?php include 'admin_footer.php'; ?>

<script>
	function bowlings(value,playerID){
		$('#overs_bowled_' + playerID).prop("disabled", value != 1);
		$('#runs_given_' + playerID).prop("disabled", value != 1);
		$('#wickets_taken_' + playerID).prop("disabled", value != 1);
		$('#economy_' + playerID).prop("disabled", value != 1);


		if (value === 1) {
			$('#overs_bowled_' + playerID).prop("required",'');
			$('#runs_given_' + playerID).prop("required",'');
			$('#wickets_taken_' + playerID).prop("required",'');
			$('#economy_' + playerID).prop("required",'');
		}else{
			$('#overs_bowled_' + playerID).removeAttr("required");
			$('#runs_given_' + playerID).removeAttr("required");
			$('#wickets_taken_' + playerID).removeAttr("required");
			$('#economy_' + playerID).removeAttr("required");

			$('#overs_bowled_' + playerID).val('');
			$('#runs_given_' + playerID).val('');
			$('#wickets_taken_' + playerID).val('');
			$('#economy_' + playerID).val('');
		}
	}

	function economy(playerID){
		let economy = $('.economy_' + playerID);
		let overs_bowled =  $('#overs_bowled_' + playerID).val();
		if (overs_bowled <= 0){
			return;
		}

		let calculateEconomy = $('#runs_given_' + playerID).val()/overs_bowled;
		economy.val(calculateEconomy.toFixed(2));
	}

	$(document).ready(function () {
		$('.player-stats').on('input', '.rg, .ob', function () {
			var $playerStats = $(this).closest('.player-stats');
			var runsGiven = parseFloat($playerStats.find('.rg').val());
			var oversBowled = parseFloat($playerStats.find('.ob').val());

			if (!isNaN(runsGiven) && !isNaN(oversBowled) && oversBowled !== 0) {
				var economy = (runsGiven / oversBowled).toFixed(2);
				$playerStats.find('.econ').val(economy);
			} else {
				$playerStats.find('.econ').val('N/A');
			}
		});
	});
</script>
