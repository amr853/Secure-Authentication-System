
CREATE DATABASE IF NOT EXISTS `secure_auth_db`;
USE `secure_auth_db`;

-- Table for roles
CREATE TABLE IF NOT EXISTS `roles` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL UNIQUE
);

-- Insert default roles
INSERT IGNORE INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Manager'),
(3, 'User');

-- Table for users
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password_hash` VARCHAR(255) NOT NULL,
    `role_id` INT NOT NULL,
    `two_factor_secret` VARCHAR(255) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`)
);
