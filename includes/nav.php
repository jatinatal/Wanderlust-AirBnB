<nav class="navbar navbar-expand-sm bg-body-light border-bottom sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><i class="fa-regular fa-compass"></i><span
        class="brand-name">airbnb</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../listings/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../listings/index.php">View all Listing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../listings/new.php">Add New Listing</a>
        </li>
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