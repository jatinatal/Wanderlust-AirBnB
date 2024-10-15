<nav class="navbar navbar-expand-md bg-body-light border-bottom sticky-top">
  <div class="container-fluid px-4">
    <a class="navbar-brand" href="index.php"><i class="fa-regular fa-compass"></i><span
        class="brand-name">airbnb</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../listings/index.php">All Listings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../listings/new.php">Add New Listing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../listings/search.php">Search<i class="fa-solid fa-magnifying-glass ps-2"></i></a>
        </li>
        <?php
        if (isset($_SESSION["admin_login"])) { ?>
          <li class="nav-item dropdown ms-3">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Admin Dashboard
            </a>
            <ul class="dropdown-menu">
              <li class="nav-item">
                <a class="dropdown-item" href="../admin/manage_listings.php">Manage Listings</a>
              </li>
              <li class="nav-item">
                <a class="dropdown-item" href="../admin/manage_reviews.php">Manage Reviews</a>
              </li>
              <li class="nav-item">
                <a class="dropdown-item" href="../admin/manage_users.php">Manage users</a>
              </li>
            </ul>
          </li>
        <?php } ?>
      </ul>
      <?php
      if (isset($_SESSION["username"])) { ?>
        <ul class="navbar-nav align-self-end ms-auto">
          <li class="nav-item">
            <a href="../users/logout.php" class="nav-link">Logout</a>
          </li>
        </ul>
      <?php } else { ?>
        <ul class="navbar-nav align-self-end ms-auto">
          <li class="nav-item">
            <a href="../users/signup.php" class="nav-link">Signup</a>
          </li>
          <li class="nav-item">
            <a href="../users/login.php" class="nav-link">Login</a>
          </li>
        </ul>
      <?php } ?>
    </div>
  </div>
</nav>