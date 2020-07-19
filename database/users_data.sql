/***
    Creating the table for each user with table name after their username
    Table is stored under users database

    Users Table Content:
    id, date submitted, random text, comment
***/

CREATE TABLE $username (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `time_submitted` TIMESTAMP,
    `random_text` VARCHAR(255),
    `comment` VARCHAR(255)
)