

CREATE TABLE `accounts` (
  `id` INT(255) UNSIGNED AUTO_INCREMENT NOT NULL,
  `username` VARCHAR (255) NOT NULL ,
  `password` VARCHAR (255) NOT NULL ,
  `name` TEXT NOT NULL ,
  `age` INT(255) UNSIGNED NOT NULL ,
  `gender` ENUM('male', 'female') NOT NULL ,
  `account_type` ENUM('passenger', 'operator', 'driver', 'admin')NOT NULL ,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `accounts` ADD UNIQUE (`username`);

CREATE TABLE `operators` (
  `account_id`      INT(255) UNSIGNED NOT NULL,
  `case_number`     VARCHAR (255) NOT NULL ,
  `business_permit` INT(255) UNSIGNED NOT NULL ,
  FOREIGN KEY (`account_id`) REFERENCES accounts(`id`)
) ENGINE = InnoDB;

CREATE TABLE `driver` (
  `account_id` INT(255) UNSIGNED NOT NULL,
  `prof_driver_license` VARCHAR (255)NOT NULL ,
  `vehicle_or` INT(255) UNSIGNED NOT NULL ,
  `taxi_plate_num` VARCHAR (255) NOT NULL ,
  FOREIGN KEY (`account_id`) REFERENCES accounts(`id`)
) ENGINE = InnoDB;

