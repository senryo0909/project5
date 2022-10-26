CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT, 
    name VARCHAR(50) NOT NULL, 
    password VARCHAR(255) NOT NULL, 
    time TIMESTAMP, 
    PRIMARY KEY(id)
    )DEFAULT CHARSET=utf8;

CREATE TABLE books (
      id INT NOT NULL AUTO_INCREMENT,
      title VARCHAR(50),
      date date,
      stock INT,
      PRIMARY KEY (id)
    )DEFAULT CHARSET=utf8;

INSERT INTO `books` (`title`, `date`, `stock`) VALUES
    ('メロンブックス', '2020-07-23', 2),
    ('りんごブックス', '2020-07-24', 1);