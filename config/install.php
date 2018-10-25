<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "camagru";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS camagru";
    $sql2 = "CREATE TABLE IF NOT EXISTS `camagru`.`u_comments` (
        `c_id` INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `u_id` INT(6),
        `p_id` INT(6),
        `u_name` VARCHAR(225) NOT NULL,
        `u_comment` VARCHAR(225) NOT NULL,
        `c_date` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6)
        )";
        
    $sql3 = "CREATE TABLE IF NOT EXISTS `camagru`.`c_users` (
        `u_id` INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `f_name` VARCHAR(225),
        `l_name` VARCHAR(225),
        `thum` VARCHAR(225),
        `email` VARCHAR(225),
        `password` VARCHAR(225),
        `verified` INT(6) NOT NULL DEFAULT '0',
        `u_date` TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
        )";

    $sql4 = "CREATE TABLE IF NOT EXISTS `camagru`.`u_images` (
        `p_id` INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `u_id` INT(6),
        `f_name` VARCHAR(225),
        `image` VARCHAR(225),
        `post` INT(6) NOT NULL DEFAULT '0',
        `l_count` INT(6) NOT NULL DEFAULT '0',
        `c_count` INT(6) NOT NULL DEFAULT '0',
        `p_date` TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
        )";

    $sql5 = "CREATE TABLE IF NOT EXISTS `camagru`.`u_likes` (
        `l_id` INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `pic_id` INT(6),
        `u_id` INT(6),
        `f_name` VARCHAR(225),
        `u_date` TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
        )"; 
    $conn->exec($sql);
    $conn->exec($sql2);
    $conn->exec($sql3);
    $conn->exec($sql4);
    $conn->exec($sql5);
}   catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    $conn = null;
    die();
}

?>