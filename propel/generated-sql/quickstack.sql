
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `uuid` CHAR(36) NOT NULL,
    `username` VARCHAR(128) NOT NULL,
    `email` VARCHAR(128) NOT NULL,
    `password` VARCHAR(128) NOT NULL,
    `role` TINYINT NOT NULL,
    `visible` TINYINT NOT NULL,
    `status` TINYINT NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- profile
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `profile`;

CREATE TABLE `profile`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `uuid` CHAR(36) NOT NULL,
    `user_id` INTEGER NOT NULL,
    `dealer_id` INTEGER NOT NULL,
    `first_name` VARCHAR(128),
    `last_name` VARCHAR(128),
    `gender` TINYINT,
    `date_of_birth` DATE,
    `phone_number` VARCHAR(30),
    `mobile_number` VARCHAR(30),
    `image` TEXT,
    `company_name` VARCHAR(128),
    `primary_address_street` VARCHAR(255),
    `primary_address_street_2` VARCHAR(255),
    `primary_address_city` VARCHAR(128),
    `primary_address_state` VARCHAR(128),
    `primary_address_post_code` VARCHAR(20),
    `primary_address_country` VARCHAR(128),
    `billing_address_street` VARCHAR(255),
    `billing_address_city` VARCHAR(128),
    `billing_address_state` VARCHAR(128),
    `billing_address_post_code` VARCHAR(20),
    `billing_address_country` VARCHAR(128),
    `security_question_1` VARCHAR(128),
    `security_answer_1` VARCHAR(128),
    `security_question_2` VARCHAR(128),
    `security_answer_2` VARCHAR(128),
    `security_question_custom` VARCHAR(128),
    `security_answer_custom` VARCHAR(128),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `profile_FI_1` (`user_id`),
    CONSTRAINT `profile_FK_1`
        FOREIGN KEY (`user_id`)
        REFERENCES `user` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
