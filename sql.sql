CREATE DATABASE employees;
CREATE TABLE `employees` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) DEFAULT NULL,
    `description` TEXT DEFAULT NULL,
    `gender` TINYINT(1) DEFAULT 0 COMMENT '0: male, 1:female',
    `salary` INT(11) DEFAULT 0,
    `birthday` DATETIME DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
)
ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;