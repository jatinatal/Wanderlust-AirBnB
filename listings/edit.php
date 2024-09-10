<?php
session_start();
include("../connection/connect.php");
include("../misc/redirect.php");
if (!isset($_SESSION["username"])) {
  redirect("../users/login.php");
}
if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $getListingByID = "select * from listings where id = $id";
  $result = $con->query($getListingByID);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate
          class="needs-validation">
          <div class="row mt-3">
            <div class="col-8 offset-2">
              <h3 class="mb-3">Edit your Listing</h3>
              <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <div class="input-group has-validation">
                  <input type="text" placeholder="Title" name="title" value="<?= $row["title"] ?>" id="title"
                    class="form-control" required />
                  <div class="invalid-feedback">Please Provide a Title</div>
                </div>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" placeholder="Description"
                  class="form-control"><?= $row["description"] ?></textarea>
              </div>
              <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <div class="input-group has-validation">
                  <input type="url" name="image" id="image" placeholder="URL/Link" value="<?= $row["image"] ?>"
                    class="form-control" required />
                  <div class="valid-feedback">Looks Good.</div>
                  <div class="invalid-feedback">Please provide a Image</div>
                </div>
              </div>

              <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <div class="input-group has-validation">
                  <span class="input-group-text"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                  <input type="number" placeholder="price" name="price" value="<?= $row["price"] ?>" id="price"
                    class="form-control" required />
                  <div class="invalid-feedback">Please Provide Price</div>
                </div>
              </div>
              <div class="row">
                <div class="mb-3 col-md-4">
                  <label for="location" class="form-label">Location</label>
                  <div class="input-group mb-3 col-md-4 has-validation">
                    <input type="text" placeholder="location" name="location" value="<?= $row["location"] ?>" id="location"
                      class="form-control" required />
                    <div class="invalid-feedback">Please Provide Location</div>
                  </div>
                </div>
                <div class="mb-3 col-md-8">
                  <label for="country" class="form-label">Country</label>
                  <div class="input-group mb-3 col-md-8 has-validation">
                    <input type="text" placeholder="country" name="country" value="<?= $row["country"] ?>"
                      class="form-control" id="country" required />
                    <div class="invalid-feedback">Please Provide Country</div>
                  </div>
                </div>
              </div>
              <input type="hidden" name="id" value="<?= $row["id"] ?>">
              <button type="submit" class="btn btn-secondary edit-btn mb-3" name="updateBtn">
                Update
              </button>
            </div>
          </div>
        </form>
      <?php }
} ?>
  </div>
  <?php include("../includes/foo.php") ?>

  <script src="../public/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>

<?php
// Updation Code to Update Data of Listings
if (isset($_POST["updateBtn"])) {
  $id = $_POST["id"];
  $title = $_POST["title"];
  $description = $_POST["description"];
  $image = $_POST["image"];
  $price = $_POST["price"];
  $location = $_POST["location"];
  $country = $_POST["country"];

  $updateListing = "update listings set title = '$title', description = '$description', image = '$image', price = $price, location = '$location', country = '$country'  where id = $id;";

  if (!$con->query($updateListing)) {
    echo "Updation Failed" . $con->error;
  } else {
    redirect("show.php?id=$id");
  }
}
?>