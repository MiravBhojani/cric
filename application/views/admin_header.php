<!doctype html>
<html lang="en" class="h-100">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<title>Cricket AI</title>



	<!-- Bootstrap core CSS -->
	<link href="<?php echo  base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" >



	<style>
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			user-select: none;
		}

		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}
		}
	</style>

	<script src="https://unpkg.com/htmx.org@1.9.7"></script>

	<!-- Custom styles for this template -->
	<link href="<?php echo base_url('assets/css/sticky-footer-navbar.css'); ?> " rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">

<header>
	<!-- Fixed navbar -->
	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?php echo base_url('Welcome/admin'); ?>">Admin Panel</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav me-auto mb-2 mb-md-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="<?php echo base_url('Welcome/admin'); ?>">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url('Welcome/create_club'); ?>">Create Club</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url('Welcome/clubs'); ?>">Clubs</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url('Welcome/create_match'); ?>">Create Match</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url('Welcome/matches'); ?>">Matches</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url('Welcome/leaderboard'); ?>">Leaderboard</a>
					</li>
				</ul>
				<div class="d-flex">
					<button class="btn btn-outline-danger"  onclick="window.location.href = '<?php echo base_url('Auth/logout'); ?>'">Logout</button>
				</div>
			</div>
		</div>
	</nav>
</header>
