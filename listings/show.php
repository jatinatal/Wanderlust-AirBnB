<?php
session_start();
include("../misc/redirect.php");
include("../connection/connect.php");
global $listingID;
// Show Route From Home Page
if (isset($_GET["id"])) {
  $listingID = $_GET["id"];
  $getListingByID = "select * from listings join users on listings.user=users.userId where id = $listingID";
  $result = $con->query($getListingByID);
  if ($result->num_rows > 0)
  ?>

  <!DOCTYPE html>
  <html lang="en">
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
  <link rel="stylesheet" href="../public/rating.css">
  </head>

  <body>
    <?php include("../includes/nav.php") ?>
    <div class="container pt-4">
      <?php {
        $row = $result->fetch_assoc(); ?>
        <div class="row mt-3">
          <div class="col-9 offset-2">
            <h3 class="mb-3">
              <?= $row["title"] ?>
            </h3>
            <div class="card col-9">
              <img src="<?= $row["image"] ?>" class="card-img-top show-img" alt="listing-image" />
              <div class="card-body">
                <div class="card-text">
                  <div class="mb-2">
                    Hosted by <b><i> @<?= $row["username"] ?></i></b>
                  </div>
                  <div class="mb-2">
                    <?= $row["description"] ?>
                  </div>
                  <div class="mb-2">&#8377;<?= $row["price"] ?></div>
                  <div class="mb-2">
                    <?= $row["location"] ?>
                  </div>
                  <div class="mb-2">
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
      <?php }
} ?>
    <hr />
    <!-- Review Add Form -->
    <div class="col-9 offset-2 mt-3">
      <h5>Leave a Review</h5>
      <div class="row">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?= $listingID ?>" method="post"
          class="needs-validation" novalidate>
          <div class="rating mt-2 col-4">
            <fieldset class="starability-slot">
              <input type="radio" id="no-rate" class="input-no-rate" name="rating" value="1" checked />
              <input type="radio" id="first-rate1" name="rating" value="1" />
              <label for="first-rate1" title="Terrible">1 star</label>
              <input type="radio" id="first-rate2" name="rating" value="2" />
              <label for="first-rate2" title="Not good">2 stars</label>
              <input type="radio" id="first-rate3" name="rating" value="3" />
              <label for="first-rate3" title="Average">3 stars</label>
              <input type="radio" id="first-rate4" name="rating" value="4" />
              <label for="first-rate4" title="Very good">4 stars</label>
              <input type="radio" id="first-rate5" name="rating" value="5" />
              <label for="first-rate5" title="Amazing">5 stars</label>
            </fieldset>
          </div>
          <div class="comment col-7">
            <label for="comment" class="form-label">Comment</label>
            <textarea name="comment" id="comment" class="form-control" required></textarea>
            <div class="invalid-feedback">Comment Can't be Empty</div>
          </div>
          <div class="review-btn mt-3">
            <button class="btn btn-secondary edit-btn" name="reviewSubmit">Submit</button>
          </div>
        </form>
      </div>
    </div>
    <hr />
    <!-- review Display -->
    <div class="col-9 offset-2">
      <div class="row">
        <?php
        $result = $con->query("select * from reviews where listingId = $listingID;");
        if (!$result->num_rows > 0) {
          echo "<h6>No Reviews Yet!</h6>";
        }
        if ($result->num_rows > 0) {
          echo '<h4 class="mb-4">All Reviews</h4>';
          while ($row = $result->fetch_assoc()) { ?>
            <div class="card me-5 col-5">
              <div class="card-body">
                <h5 class="card-title mb-3">
                  <b><i>@<?= $row["author"] ?></i></b>
                </h5>
                <p class="starability-result" data-rating="<?= $row["star"] ?>"></p>
                <p class=" card-text">Comment:~<b><?= $row["comment"] ?></b></p>
                <?php if (isset($_SESSION["userId"]) && $_SESSION["userId"] == $row["authorId"]) { ?>
                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?= $listingID ?>" method="post">
                    <button class="btn btn-sm btn-dark" name="reviewDelete">Delete</button>
                    <input type="hidden" name="reviewId" value="<?= $row["reviewId"] ?>">
                  </form>
                <?php } ?>
              </div>
            </div>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
  </div>
  </div>
  <?php include("../includes/foo.php") ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="../public/script.js"></script>
</body>

</html>
<?php
// Deletion Route to delete Listing and redirect to Home page
if (isset($_POST["deleteBtn"])) {
  if (!isset($_SESSION["username"])) {
    redirect("../users/login.php");
  }
  $id = $_POST["id"];
  $deleteListing = "delete from listings where id = $id";
  if (!$con->query($deleteListing)) {
    echo "<h1>Deletion Failed</h1>";
  } else {
    redirect("/wanderlust/listings/index.php");
  }
}
?>

<?php
// Review Add to Db 
if (isset($_POST["reviewSubmit"])) {
  if (!isset($_SESSION["userId"])) {
    redirect("../users/login.php");
  }
  $star = $_POST["rating"];
  $comment = $_POST["comment"];
  $author = $_SESSION["username"];
  $authorId = $_SESSION["userId"];
  $sql = "insert into reviews (author, authorId, star, comment, listingId) values 
  ('$author', $authorId, $star, '$comment', $listingID);";
  if (!$con->query($sql)) {
    echo "Error in reviews" . $con->error;
  } else {
    redirect("show.php?id=$listingID");
  }
} ?>

<?php
// Review Delete
if (isset($_POST["reviewDelete"])) {
  $reviewId = $_POST["reviewId"];
  $sql = "delete from reviews where reviewId = $reviewId;";
  if (!$con->query($sql)) {
    echo "Deletion Failed";
  }
  redirect("./show.php?id=$listingID");

}
?>