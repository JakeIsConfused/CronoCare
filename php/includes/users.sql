-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
-- Host: localhost
-- Gegenereerd op: 29 nov 2023 om 17:49
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `reservering_database`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

-- Maak de gebruikerstabel
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
                         `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                         `first_name` varchar(50) NOT NULL,
                         `last_name` varchar(50) NOT NULL,
                         birthdate DATE NOT NULL,
                         `email` varchar(255) NOT NULL,
                         password VARCHAR(255) NOT NULL,
                         PRIMARY KEY (`id`)
);

-- Maak de adresstabel
DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
                             `id` INT AUTO_INCREMENT PRIMARY KEY,
                             `user_id` bigint(20) UNSIGNED NOT NULL,
                             `street` VARCHAR(255),
                             `house_number` VARCHAR(10),
                             `extension` VARCHAR(10),
                             `postal_code` VARCHAR(10),
                             `city` VARCHAR(255),
                             `province` VARCHAR(255),
                             `country` VARCHAR(255),
                             FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);
