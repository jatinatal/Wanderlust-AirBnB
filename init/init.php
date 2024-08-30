<?php

include("data.php");

$initData = json_decode($jsonData, true);

include("../connection/connect.php");

$createTable = "create table IF NOT EXISTS listings (
    id int AUTO_INCREMENT,
    title varchar(255) not null,
    description varchar(255) not null,
    image varchar(255) not null,
    price int not null CHECK (price>100),
    location varchar(100) not null,
    country varchar(100) not null,
    primary key (id)
);";

$con->query($createTable);

for ($i = 0; $i < count($initData); $i++) {
    $insertData = "insert into listings (title,description,image,price,location,country) values ('" . $initData[$i]['title'] . "','" . $initData[$i]['description'] . "','" . $initData[$i]['image'] . "','" . $initData[$i]['price'] . "','" . $initData[$i]['location'] . "','" . $initData[$i]['country'] . "');";
    if (!$con->query($insertData)) {
        echo "Error Occured" . $con->error;
    }

}

echo "<h1>Insertion Successfull</h1>";