  
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
