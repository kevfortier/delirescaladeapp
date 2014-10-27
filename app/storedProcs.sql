//

CREATE PROCEDURE insert_user(IN _pseudo VARCHAR(40),IN _nom VARCHAR(100),
IN _prenom VARCHAR(100),IN _password VARCHAR(64),IN _dateNaissance DATE,
IN _type VARCHAR(30),IN _email VARCHAR(255),IN _telephone VARCHAR(14),
IN _cellulaire VARCHAR(14),IN _noCivique VARCHAR(10),IN _rue VARCHAR(80),
IN _ville VARCHAR(80),IN _codePostal VARCHAR(7),IN _avatar VARCHAR(255),
IN _points INT(11),IN _intervalNotification INT(13),IN _textNotification tinyint(1),
IN _emailNotification tinyint(1))

INSERT INTO users (pseudo, nom, prenom, password,dateNaissance,type,
email,telephone,cellulaire,noCivique,rue, ville, codePostal,avatar,
points,intervalNotification,textNotification,emailNotification)

VALUES (_pseudo, _nom, _prenom, _password,_dateNaissance,_type,
_email,_telephone,_cellulaire,_noCivique,_rue,_ville, _codePostal,
_avatar,_points,_intervalNotification,_textNotification,_emailNotification);

return LAST_INSERT_ID();
//