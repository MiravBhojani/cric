<?php

if ($is_admin) {
	include 'admin_header.php';
} else {
	include 'club_header.php';
}
?>
<main class="flex-shrink-0 mt-5">
	<div class="container">
		<div class="card">
			<div class="card-header">
				<h3><?= isset($player) ? "Update Player [$player->name]" : 'Register a new player' ?></h3>
			</div>
			<div class="card-body">
				<form action="<?php echo base_url('Welcome/createplayerpost'); ?>" method="post">
					<div class="mb-3">
						<label for="name" class="form-label">Club Name</label>
						<select class="form-select" id="club_id" name="club_id" required>
							<option value="" selected disabled>Select Club Name</option>
							<?php foreach ($clubs as $club) : ?>
								<option value="<?= $club['id'] ?>" <?= isset($player) && $player->club_id == $club['id'] ? "selected" : '' ?>><?= $club['clubname'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="mb-3">
						<label for="name" class="form-label">Name</label>
						<input type="text" class="form-control" id="name" name="name"
							   placeholder="Enter player's name" value="<?= isset($player) ? $player->name : '' ?>"
							   required>
					</div>

					<div class="mb-3">
						<label for="dob" class="form-label">Date of Birth</label>
						<input type="date" class="form-control" id="dob"
							   value="<?= isset($player) ? $player->dob : '' ?>" name="dob" required>
					</div>

					<div class="mb-3">
						<label for="battingStyle" class="form-label">Batting Style</label>
						<select class="form-select" id="battingStyle" name="battingStyle" required>
							<option selected disabled>Select Batting Style</option>
							<option value="Right Hand Batting" <?= isset($player) && $player->batting_style == 'Right Hand Batting' ? "selected" : '' ?>>
								Right Hand Batting
							</option>
							<option value="Left Hand Batting" <?= isset($player) && $player->batting_style == 'Left Hand Batting' ? "selected" : '' ?>>
								Left Hand Batting
							</option>
						</select>
					</div>

					<div class="mb-3">
						<label for="bowlingStyle" class="form-label">Bowling Style</label>
						<select class="form-select" id="bowlingStyle" name="bowlingStyle" required>
							<option selected disabled>Select Bowling Style</option>
							<option value="Left Arm Fast" <?= isset($player) && $player->bowling_style == 'Left Arm Fast' ? "selected" : '' ?>>
								Left Arm Fast
							</option>
							<option value="Right Arm Fast" <?= isset($player) && $player->bowling_style == 'Right Arm Fast' ? "selected" : '' ?>>
								Right Arm Fast
							</option>
							<option value="Left Arm Orthodox" <?= isset($player) && $player->bowling_style == 'Left Arm Orthodox' ? "selected" : '' ?>>
								Left Arm Orthodox
							</option>
							<option value="Left Arm Chinaman" <?= isset($player) && $player->bowling_style == 'Left Arm Chinaman' ? "selected" : '' ?>>
								Left Arm Chinaman
							</option>
							<option value="Right Arm Off-Spin" <?= isset($player) && $player->bowling_style == 'Right Arm Off-Spin' ? "selected" : '' ?>>
								Right Arm Off-Spin
							</option>
							<option value="Right Arm Leg Spin" <?= isset($player) && $player->bowling_style == 'Right Arm Leg Spin' ? "selected" : '' ?>>
								Right Arm Leg Spin
							</option>
						</select>
					</div>

					<button type="submit" class="btn btn-primary" name="type"
							value="<?= isset($player) ? $player->id : 'create' ?>">
						<?= isset($player) ? "Update" : 'Create' ?> Player
					</button>
				</form>
			</div>
		</div>
	</div>
</main>
<?php include 'club_header.php'; ?>
