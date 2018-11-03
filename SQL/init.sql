CREATE TABLE IF NOT EXISTS `category` (
  `id` INT(8) NOT NULL PRIMARY KEY auto_increment,
  `catName` VARCHAR(52) NOT NULL,
  `parentId` INT(8),
  FOREIGN KEY (parentId) REFERENCES category (id) ON DELETE CASCADE
);

ALTER TABLE `category` AUTO_INCREMENT=1001;

INSERT INTO category(catName)
VALUES	("test1"),
		("test2"),
        ("test3");