
CREATE DATABASE ReservationRealise;

CREATE USER 'RRealise'@'%' IDENTIFIED BY '8i3nvEnv3';

GRANT ALL PRIVILEGES ON ReservationRealise.* TO 'RRealise'@'%';

USE ReservationRealise;

CREATE TABLE user
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR (255) NOT NULL,
    isAdmin BOOLEAN,
    activeUser BOOLEAN,
    validationKey VARCHAR (255),
    lastname VARCHAR (255) NOT NULL,
    firstname VARCHAR (255) NOT NULL
);

CREATE TABLE dish(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR (255) NOT NULL,
    description VARCHAR (255),
    price DECIMAL (6,2) NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE NOT NULL,
    preview BOOLEAN,
    typeOfDish INT
);

CREATE TABLE booking(
    idUser INT,
    FOREIGN KEY (idUser) REFERENCES user (id) ,
    date DATE,
    typeOfDish INT,
    PRIMARY KEY (idUser, date)
);

-- vous pouvez exécuter les lignes de code suivant pour changer au utf8 même si la base de donné a été déjà créé
ALTER DATABASE ReservationRealise
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

ALTER TABLE booking CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE dish CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE user CHARACTER SET utf8 COLLATE utf8_unicode_ci;