CREATE TABLE Movie (
    id INT,
    title VARCHAR(100),
    year INT,
    rating VARCHAR(10),
    company VARCHAR(50),
    PRIMARY KEY(id)
) ENGINE = InnoDB;
-- Primary key constraint: a movie should have its id not null and unique


CREATE TABLE Actor (
    id INT,
    last VARCHAR(20),
    first VARCHAR(20),
    sex VARCHAR(6),
    dob DATE,
    dod DATE,
    PRIMARY KEY(id),
    CHECK (sex='Male' OR sex='Female'),
    CHECK (dob IS NOT NULL),
    CHECK (dod IS NULL OR dod > dob)
) ENGINE = INNODB;
-- Primary key constraint: a actor should have its id not null and unique
-- Check: sex must be 'male' or 'female' (assuming no transgender)
-- Check: date of birth cannot be null
-- Check: a person is either alive or died later than his/her birth


CREATE TABLE Sales (
    mid INT,
    ticketsSold INT,
    totalIncome INT,
    PRIMARY KEY(mid),
    FOREIGN KEY(mid) REFERENCES Movie(id)
    	    ON DELETE CASCADE
	    ON UPDATE CASCADE,
    CHECK (tickersSold>=0)
) ENGINE = INNODB;
-- Primary key constraint: a sales should have its mid not null and unique
-- Referential integrity constraint: a sales movie id should have a corresponding entry in Movie table; when movie is deleted or updated the action should be cascaded
-- Check: ticketsSold cannot be negative


CREATE TABLE Director (
    id INT,
    last VARCHAR(20),
    first VARCHAR(20),
    dob DATE,
    dod DATE,
    PRIMARY KEY(id),
    CHECK (dob IS NOT NULL),
    CHECK (dod IS NULL OR dod > dob)
) ENGINE = INNODB;
-- Primary key constraint: a direct should have its id not null and unique
-- Check: date of birth cannot be null
-- Check: a person is either alive or died later than his/her birth


CREATE TABLE MovieGenre (
    mid INT,
    genre VARCHAR(20),
    FOREIGN KEY(mid) REFERENCES Movie(id)
    	    ON DELETE CASCADE
	    ON UPDATE CASCADE
) ENGINE = INNODB;
-- Referential integrity constraint: a movie genre mid should have a corresponding entry in Movie table; when movie is deleted or updated the action should be cascaded


CREATE TABLE MovieDirector (
    mid INT,
    did INT,
    PRIMARY KEY(mid, did),
    FOREIGN KEY(mid) REFERENCES Movie(id)
    	    ON DELETE CASCADE
	    ON UPDATE CASCADE,
    FOREIGN KEY(did) REFERENCES Director(id)
    	    ON DELETE CASCADE
	    ON UPDATE CASCADE
) ENGINE = INNODB;
-- Primary key constraint: a movie director should have the movie id and director id not null and unique
-- Referential integrity constraint: a movie director mid should have a corresponding entry in Movie table; when movie is deleted or updated the action should be cascaded
-- Referential integrity constraint: a movie director did should have a corresponding entry in Director table; when director is deleted or updated the action should be cascaded


CREATE TABLE MovieActor (
    mid INT,
    aid INT,
    role VARCHAR(50),
    PRIMARY KEY(mid, aid),
    FOREIGN KEY(mid) REFERENCES Movie(id)
    	    ON DELETE CASCADE
	    ON UPDATE CASCADE,
    FOREIGN KEY(aid) REFERENCES Actor(id)
    	    ON DELETE CASCADE
	    ON UPDATE CASCADE
) ENGINE = INNODB;
-- Primary key constraint: a movie actor should have the movie id and director id not null and unique
-- Referential integrity constraint: a movie actor mid should have a corresponding entry in Movie table; when movie is deleted or updated the action should be cascaded
-- Referential integrity constraint: a movie actor aid should have a corresponding entry in Actor table; when actor is deleted or updated the action should be cascaded


CREATE TABLE MovieRating (
    mid INT,
    imdb INT,
    rot INT,
    PRIMARY KEY(mid),
    FOREIGN KEY(mid) REFERENCES Movie(id)
    	    ON DELETE CASCADE
	    ON UPDATE CASCADE
) ENGINE = INNODB;
-- Primary key constraint: a movie rating should have the movie id not null and unique
-- Referential integrity constraint: a movie rating mid should have a corresponding entry in Movie table; when movie is deleted or updated the action should be cascaded


CREATE TABLE Review (
    name VARCHAR(20),
    time TIMESTAMP,
    mid INT,
    rating INT,
    comment VARCHAR(500)
) ENGINE = INNODB;

CREATE TABLE MaxPersonID (
    id INT
) ENGINE = INNODB;

CREATE TABLE MaxMovieID (
    id INT
) ENGINE = INNODB;


DELIMITER $$

CREATE TRIGGER NewActorMaxId
    AFTER INSERT ON Actor
    FOR EACH ROW
BEGIN
    DECLARE x INT;
    DECLARE e INT;
    SET x = (select max(id) from Actor) + 1;
    SET e = (select max(id) from MaxPersonID);
    IF (e IS NULL) THEN
        INSERT INTO MaxPersonID VALUES (x);
    ELSEIF (x > e) THEN
        UPDATE MaxPersonID SET id = x;
    END IF;
END
$$

CREATE TRIGGER NewDirectorMaxId
    AFTER INSERT ON Director
    FOR EACH ROW
BEGIN
    DECLARE x INT;
    DECLARE e INT;
    SET x = (select max(id) from Director) + 1;
    SET e = (select max(id) from MaxPersonID);
    IF (e IS NULL) THEN
        INSERT INTO MaxPersonID VALUES (x);
    ELSEIF (x > e) THEN
        UPDATE MaxPersonID SET id = x;
    END IF;
END
$$

CREATE TRIGGER NewMovieMaxId
    AFTER INSERT ON Movie
    FOR EACH ROW
BEGIN
    DECLARE x INT;
    DECLARE e INT;
    SET x = (select max(id) from Movie) + 1;
    SET e = (select max(id) from MaxMovieID);
    IF (e IS NULL) THEN
        INSERT INTO MaxMovieID VALUES (x);
    ELSEIF (x > e) THEN
        UPDATE MaxMovieID SET id = x;
    END IF;
END
$$

DELIMITER ;