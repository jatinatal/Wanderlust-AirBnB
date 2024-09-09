<?php
session_start();
include("../connection/connect.php");
include("../misc/redirect.php");
include("../misc/alert.php");

if (isset($_POST["submit"])) {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $sql = "insert into users (username, email, password) values ('$username','$email','$password');";

  if (!$con->query($sql)) {
    alert("Signup Failed! Please Try Again...");
  } else {
    $_SESSION["username"] = $username;
    redirect("/wanderlust/listings/");
  }

}
?>

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
<?php include("../includes/nav.php") ?>
<div class="container pt-4">
  <div class="row">
    <div class="col-6 offset-3">
      <h2 class="mb-3">Signup on Wanderlust</h2>

      <!-- Sign Up Form -->
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate
        class="needs-validation">
        <div class="mb-3">
          <label for="username" class="form-label">Username: </label>
          <div class="input-group has-validation">
            <div class="input-group-text">@</div>
            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required
              minlength="2" />
            <div class="valid-feedback">Looks Good.</div>
            <div class="invalid-feedback">Username is Required</div>
          </div>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email: </label>
          <div class="input-group has-validation">
            <input type="email" name="email" id="email" class="form-control" placeholder="someone@gmail.com" required />
            <div class="valid-feedback">Looks Good.</div>
          </div>
        </div>
        <div class="mb-3">
          <label for="pass" class="form-label">Password: </label>
          <div class="input-group has-validation">
            <input type="password" name="password" id="pass" class="form-control" placeholder="********" required
              minlength="8" />
          </div>
        </div>
        <button type="submit" class="btn btn-secondary mb-3 add-btn" name="submit">
          Signup
        </button>
      </form>
    </div>
  </div>
</div>

<?php include("../includes/foo.php") ?>
<script src="../public/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>