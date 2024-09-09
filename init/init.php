<?php

include("data.php");

$initListing = json_decode($jsonData, true);


include("../connection/connect.php");

// Creating users Table
$createUsersTable = "create table IF NOT EXISTS users(
    userId int AUTO_INCREMENT,
    username varchar(25) unique not null,
    email varchar(50) unique not null,
    password varchar(32) unique not null,
    primary key (userId)
);";

// Creating Listings Table
$createListingsTable = "create table IF NOT EXISTS listings (
    id int AUTO_INCREMENT,
    title varchar(255) not null,
    description varchar(255) not null,
    image varchar(255) not null,
    price int not null CHECK (price>100),
    location varchar(100) not null,
    country varchar(100) not null,
    primary key (id),
    user int not null,
    foreign key (user) references users(userId)
);";

// Creating Review Table
$createReviewTable = "create table IF NOT EXISTS reviews(
    reviewId int AUTO_INCREMENT,
    author varchar(25) not null,
    authorId int not null,
    star int not null,
    comment varchar(255) not null,
    primary key (reviewId),
    listingId int not null,
    foreign key (authorId) references users(userId),
    foreign key (listingId) references listings(id)
);";

$con->query($createUsersTable);
$con->query($createListingsTable);
$con->query($createReviewTable);

// Inserting Users Data
$insertUser = "insert into users values (1,'admin','admin@gmail.com','admin123');";
if (!$con->query($insertUser)) {
    echo "Error Occured" . $con->error;
}

// Inserting Listings Data
for ($i = 0; $i < count($initListing); $i++) {
    $insertListing = "insert into listings (title,description,image,price,location,country,user) values ('" . $initListing[$i]['title'] . "','" . $initListing[$i]['description'] . "','" . $initListing[$i]['image'] . "','" . $initListing[$i]['price'] . "','" . $initListing[$i]['location'] . "','" . $initListing[$i]['country'] . "', 1 );";
    if (!$con->query($insertListing)) {
        echo "Error Occured" . $con->error;
    }
}

echo "<h1>Insertion Successfull</h1><br />";
echo "<h1><a href='/wanderlust/listings/'>Go to Home Page</a></h1>";
