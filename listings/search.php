<?php
session_start();
include("../connection/connect.php");
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
    <div class="main">

        <?php include("../includes/nav.php") ?>

        <div class="container pt-4">
            <div class="row col-8 offset-2">
                <!-- Seaching Form -->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate
                    class="needs-validation">
                    <div class="input-group mb-3 has-validation">
                        <input type="text" class="form-control" placeholder="Search Listing By Title" name="search"
                            required>

                        <button class="btn btn-outline-secondary" type="submit" name="submit">
                            <i class="fa-solid fa-magnifying-glass search"></i>
                        </button>
                        <div class="invalid-feedback">Searchbox Can't be Empty!!</div>
                    </div>
                </form>
            </div>
            <!-- Display result -->
            <?php if (isset($_POST["submit"])) {
                $input = $_POST["search"];
                $getListings = "select * from listings where title like '%$input%';";
                $result = $con->query($getListings);

                if ($result->num_rows > 0) { ?>
                    <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-1 mt-4">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <div class="card">
                                <a href="show.php?id=<?= $row["id"] ?>" class="listing-link">
                                    <img src="<?= $row["image"] ?>" class="card-img-top" alt="listing-image"
                                        style="height: 20rem" />
                                    <div class="card-img-overlay"></div>
                                    <div class="card-body">
                                        <p class="card-text">
                                        <div>
                                            <b><?= $row["title"] ?></b>
                                        </div>
                                        <div>
                                            &#8377;<?= $row["price"] ?>/Night
                                        </div>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <div class='container mt-5'>
                        <div class="row col-8 offset-2">
                            <h2 style='color:red;'>No Results Found!</h2>
                        </div>
                    </div>
                <?php }
            } ?>
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