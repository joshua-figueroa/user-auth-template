/***
    Creating the table called users under the admin database

    Users Table Content:
    id, username, email, password
***/

CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` varchar(255),
    `email` varchar(255),
    `password` varchar(255)
)