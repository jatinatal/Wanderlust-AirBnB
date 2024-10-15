<?php
session_start();
include("../connection/connect.php");
include("../misc/redirect.php");
//Remove Warnings msgs
error_reporting(E_ERROR | E_PARSE);
if (!isset($_SESSION['admin_login'])) {
    redirect('../users/login.php');
}
$users = $con->query("SELECT * FROM users");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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
        <?php
        if (isset($_SESSION["info"])) { ?>
            <div class="alert alert-success alert-dismissible fade show col-6" role="alert">
                <?= $_SESSION["info"] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION["info"]);
        }

        if (isset($_SESSION["error"])) { ?>
            <div class="alert alert-danger alert-dismissible fade show col-6" role="alert"><?= $_SESSION["error"]; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION["error"]);
        }
        ?>
        <h2 class="pb-2 text-center">Manage Users</h2>
        <div class="row col-auto">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['userId'] ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                                <button type="submit" class="btn btn-danger" name="deleteBtn">Delete</button>
                                <input type="hidden" name="id" value="<?= $user["userId"] ?>">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <?php include("../includes/foo.php") ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>

<?php
if (isset($_POST["deleteBtn"])) {
    $id = $_POST["id"];
    if ($id == 1) {
        $_SESSION["error"] = "You Cannot delete this User!!";
        redirect("manage_users.php");
        exit();
    }
    $deleteReviews = "DELETE FROM reviews WHERE listingId IN (SELECT id FROM listings WHERE user = $id)";
    $deleteListings = "delete from listings where user = $id";
    $deleteUser = "delete from users where userId = $id";
    if (!$con->query($deleteReviews) or !$con->query($deleteListings) or !$con->query($deleteUser)) {
        $_SESSION["error"] = "Deletion of user is Unsuccessfull";
        redirect("manage_users.php");
    } else {
        $_SESSION["info"] = "User Deleted Successfully";
        redirect("manage_users.php");

    }
}
?>