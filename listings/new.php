<?php
session_start();
include("../connection/connect.php");
include("../misc/redirect.php");

if (!isset($_SESSION["username"])) {
  redirect("../users/login.php");
}
if (isset($_POST["newBtn"])) {
  $title = $_POST["title"];
  $description = $_POST["description"];
  $image = $_POST["image"];
  if ($image == "" || $image == " ") {
    $image = "https://plus.unsplash.com/premium_vector-1716910450435-5a43a06ba2f4?q=80&w=1480&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D";
  }
  $price = $_POST["price"];
  $location = $_POST["location"];
  $country = $_POST["country"];
  $userId = $_SESSION["userId"];
  $insertListing = "insert into listings (title, description, image, price, location, country, user)values ('$title','$description','$image','$price','$location','$country', '$userId' );";

  if (!$con->query($insertListing)) {
    $_SESSION["error"] = "Some Error Occured.... Please Try again!";
  } else {
    redirect("index.php");
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

<body>
  <?php include("../includes/nav.php") ?>
  <div class="container pt-4">
    <div class="row">
      <div class="col-8 offset-2">
        <h3 class="mb-3">Add New Listing</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate
          class="needs-validation">
          <?php if (isset($_SESSION["error"])) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert"><?= $_SESSION["error"]; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION["error"]);
          } ?>
          <div class="mb-3">
            <label for="title" class="form-label star">Title: </label>
            <div class="input-group has-validation">
              <input type="text" name="title" id="title" class="form-control" placeholder="Add a catchy Title"
                required />
              <div class="valid-feedback">Looks Good.</div>
              <div class="invalid-feedback">Please Provide a Title</div>
            </div>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description: </label>
            <textarea name="description" id="description" class="form-control"></textarea>
          </div>
          <div class="mb-3">
            <label for="image" class="form-label">Image: </label>
            <input type="url" name="image" id="image" placeholder="URL/Link" class="form-control" />
          </div>
          <div class="mb-3 ">
            <label for="price" class="form-label star-price-info">Price: </label>
            <div class="input-group has-validation">
              <span class="input-group-text"><i class="fa-solid fa-indian-rupee-sign"></i></span>
              <input type="number" name="price" id="price" class="form-control" placeholder="7500" required />
              <div class="valid-feedback">Looks Good.</div>
              <div class="invalid-feedback">Please Provide Price</div>
            </div>
          </div>
          <div class="row">
            <div class="mb-3 col-md-4">
              <label for="location" class="form-label star">Location: </label>
              <div class="input-group has-validation">
                <input type="text" name="location" id="location" class="form-control" placeholder="Jaipur" required />
                <div class="valid-feedback">Looks Good.</div>
                <div class="invalid-feedback">Please Provide Location</div>
              </div>
            </div>
            <div class="mb-3 col-md-8">
              <label for="country" class="form-label star">Country: </label>
              <div class="input-group has-validation">
                <input type="text" name="country" id="country" class="form-control" placeholder="India" required />
                <div class="valid-feedback">Looks Good.</div>
                <div class="invalid-feedback">Please Provide Country</div>
              </div>
            </div>
          </div>

          <button type="submit" name="newBtn" class="btn btn-secondary mb-3 add-btn">
            Submit
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