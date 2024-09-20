CREATE DATABASE member_intro;

USE member_intro;

CREATE TABLE tblMember {
	id int PRIMARY_KEY,
	fName VARCHAR(50),
	lName VARCHAR(50),
	bday DATE,
	hobbies VARCHAR(255),
	quote VARCHAR(255)
}

ALTER TABLE tblMember AUTO_INCREMENT = 1111;

CREATE TABLE tblhobbies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT,
    hobby VARCHAR(50),
    FOREIGN KEY (member_id) REFERENCES tblMember(id)
);


INSERT INTO tblmember (fName, lName, bday, quote, image_path) 
VALUES ("Ralph Bryan", "Carlos", "2004-07-25", "Always trust the process", "ralph_pic.png"),
("Jomar", "Dueñas", "2002-09-03", "Never forgive twice on the same mistake, and only forgive but never forget.", "jomar_pic.png"),
("John Renan", "Ramales", "2004-11-16", "Unable to perceive the shape of you, I find you all around me.
Your presence fills my eyes, in humbles my heart, for you are everywhere", "renan_pic.jpg"),
("Regan", "Jusi", "2002-04-06", "If you cannot do great things, do small things in a great way.", "regan_pic.jpg"),
("Alvarez", "Reymund", "2004-05-21", "As long as you're looking down, You cannot see something that is above you.", "reymund_pic.jpg");

INSERT INTO tblhobbies(member_id, hobby) 
VALUES (1111, "Playing Video Games"),
(1111, "Watching Video Games"),
(1112, "Gaming on mobile and PC"),
(1112, "Reading manga/manhwa"),
(1112, "watching anime/movies"),
(1113, "Watching movies"),
(1113, "Playing games"),
(1113, "Listening to music"),
(1114, "Listening to music"),
(1114, "Playing musical instrument"),
(1114, "Making music"),
(1115, "Listening to music"),
(1115, "Playing games");