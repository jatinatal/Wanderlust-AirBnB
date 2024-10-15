<?php
session_start();
include("../connection/connect.php");
include("../misc/redirect.php");
//Remove Warnings msgs
error_reporting(E_ERROR | E_PARSE);

if (isset($_POST["submit"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $sql = "select * from users where username = '$username' and password = '$password';";
  $result = $con->query($sql);
  $row = $result->fetch_assoc();
  if ($result->num_rows <= 0) {
    $_SESSION["error"] = "Either Username or Password is Incorrect.";
  } else {
    if (isset($_POST["remember"])) {
      $userId = $row["userId"];
      setcookie("username", "$username", time() + 60 * 60 * 24); // Will Expire in 7 Days
      setcookie("userId", "$userId", time() + 60 * 60 * 24);
    }
    if ($row["userId"] == 1) {
      $_SESSION["admin_login"] = true;
    }
    $_SESSION["username"] = $username;
    $_SESSION["userId"] = $row["userId"];
    redirect("../listings/");

  }
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wanderlust | Holiday rentals, cabins, beach houses &amp; more</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon"
    href="https://a0.muscache.com/airbnb/static/icons/android-icon-192x192-c0465f9f0380893768972a31a614b670.png" />
  <link rel="stylesheet" href="../public/style.css">
</head>

<body>
  <?php include("../includes/nav.php") ?>
  <div class="container pt-4">
    <div class="row">
      <div class="col-6 offset-3">
        <h2 class="mb-4">Login with your Credentials</h2>
        <!-- Login form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate
          class="needs-validation">
          <?php if (isset($_SESSION["error"])) { ?>
            <div class="alert alert-danger"><?= $_SESSION["error"]; ?></div>
            <?php unset($_SESSION["error"]);
          } ?>
          <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <div class="input-group has-validation">
              <input type="text" name="username" id="username" class="form-control" required value="<?php if (isset($_COOKIE["username"])) {
                echo $_COOKIE["username"];
              } ?>" />
              <div class="valid-feedback">Looks Good.</div>
            </div>
          </div>
          <div class="mb-3">
            <label for="pass" class="form-label">Password:</label>
            <div class="input-group has-validation">
              <input type="password" name="password" id="pass" class="form-control" minlength="8" required />
            </div>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
            <label class="form-check-label" for="exampleCheck1">Remember Me </label>
          </div>
          <button type="submit" class="btn btn-secondary mb-3 add-btn" name="submit">
            Login
          </button>
        </form>
      </div>
    </div>
  </div>

  <?php include("../includes/foo.php") ?>
  <script src="../public/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>