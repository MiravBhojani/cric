<?php

if ($is_admin) {
	include 'admin_header.php';
} else {
	include 'club_header.php';
}
?>

<!-- Begin page content -->
<main class="flex-shrink-0">
	<div class="container mt-3">
		<div class="card">
			<div class="card-header">
				<h3>Match Info</h3>
			</div>
			<div class="card-body">
				<form action="<?php echo base_url('Welcome/process_s2'); ?>" method="post">
					<div class="mb-3">
						<input type="hidden" name="away_team_id" value="<?= $away_club_id ?>">
						<input type="hidden" name="home_team_id" value="<?= $home_club_id ?>">
						<input type="hidden" name="home_club_name" value="<?= $home_club_name ?>">
						<input type="hidden" name="away_club_name" value="<?= $away_club_name ?>">

						<label for="players1" class="form-label">
							Select Players (Team A - <?php echo $home_club_name; ?>)
						</label>
						<select name="home_team[]" class="form-select" multiple>
							<?php foreach ($home_players as $player) : ?>
								<option value="<?= $player['id'] ?>"><?= $player['name'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="mb-3">
						<label class="form-label">Select Players (Team B - <?php echo $away_club_name; ?>)</label>
						<select name="away_team[]" class="form-select" multiple>
							<?php foreach ($away_players as $player) : ?>
								<option value="<?= $player['id'] ?>"><?= $player['name'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="mb-3">
						<label for="tossWinner" class="form-label">Toss Winner</label>
						<select name="toss_winner" class="form-select">
							<option value="<?= $home_club_id ?>"><?= $home_club_name ?></option>
							<option value="<?= $away_club_id ?>"><?= $away_club_name ?></option>
						</select>
					</div>
					<div class="mb-3">
						<label for="afterToss" class="form-label">After Toss</label>
						<select name="after_toss" class="form-select">
							<option value="1">Bat</option>
							<option value="0">Bowl</option>
						</select>
					</div>
					<button type="submit" class="btn btn-primary" name="match_id" value="<?= $match_id ?>">Submit</button>
				</form>
			</div>
		</div>
	</div>
</main>

<?php include 'admin_footer.php'; ?>
