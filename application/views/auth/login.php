<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<!-- Bootstrap CSS from CDN (jsDelivr) -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
	<div class="card">
		<div class="card-header">
			<h1><?php echo lang('login_heading'); ?></h1>
			<p><?php echo lang('login_subheading'); ?></p>
		</div>
		<div class="card-body">
			<?php if (isset($message)) { ?>
				<div id="infoMessage" class="alert alert-danger">
					<?php echo $message; ?>
				</div>
			<?php } ?>

			<?php echo form_open("auth/login", 'class="mt-4"'); ?>

			<div class="mb-3">
				<?php echo lang('login_identity_label', 'identity'); ?>
				<?php echo form_input($identity, '', 'class="form-control"'); ?>
			</div>

			<div class="mb-3">
				<?php echo lang('login_password_label', 'password'); ?>
				<?php echo form_input($password, '', 'class="form-control"'); ?>
			</div>

			<div class="mb-3 form-check">
				<?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>
				<?php echo lang('login_remember_label', 'remember'); ?>
			</div>

			<div class="mb-3">
				<?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-primary"'); ?>
			</div>

			<?php echo form_close(); ?>

			<p>
				<a href="forgot_password"><?php echo lang('login_forgot_password'); ?></a>
			</p>
		</div>
	</div>

	<!-- Bootstrap JS from CDN (jsDelivr) -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
