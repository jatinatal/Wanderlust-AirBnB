<?php
include("../misc/redirect.php");
include("../connection/connect.php");
// Show Route From Home Page
if (isset($_GET["id"])) {
  $listingID = $_GET["id"];
  $getListingByID = "select * from listings where id = $listingID";
  $result = $con->query($getListingByID);
  if ($result->num_rows > 0)
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
      <?php {
        $row = $result->fetch_assoc();
        ?>
        <div class="row mt-3">
          <div class="col-9 offset-2">
            <h3 class="mb-3">
              <?= $row["title"] ?>
            </h3>
            <div class="card col-8">
              <img src="<?= $row["image"] ?>" class="card-img-top show-img" alt="listing-image" />
              <div class="card-body">
                <div class="card-text">
                  <div>
                    <?= $row["description"] ?>
                  </div>
                  <div>&#8377;<?= $row["price"] ?></div>
                  <div>
                    <?= $row["location"] ?>
                  </div>
                  <div>
                    <?= $row["country"] ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="offset-2 show-btns">
          <button class="btn btn-secondary edit-btn">
            <a href="edit.php?id=<?= $row["id"] ?>">Edit Listing</a>
          </button>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <button type="submit" class="btn btn-dark" name="deleteBtn"
              onclick="return confirm('Are you sure to delete Listing??')">Delete Listing</button>
            <input type="hidden" name="id" value="<?= $row["id"] ?>">
          </form>
        </div>

      </div>
    <?php }
} ?>
  <?php include("../includes/foo.php") ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>
<?php
// Deletion Route to delete Listing and redirect to Home page
if (isset($_POST["deleteBtn"])) {
  $id = $_POST["id"];
  $deleteListing = "delete from listings where id = $id";
  if (!$con->query($deleteListing)) {
    echo "<h1>Deletion Failed</h1>";
  } else {
    redirect("/wanderlust/listings/index.php");
  }
}
?>