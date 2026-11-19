-- Base du projet QCM. À importer dans une base qcm sans tables.
CREATE DATABASE IF NOT EXISTS qcm CHARACTER SET utf8mb4;
USE qcm;

CREATE TABLE classe (
    idClasse INT AUTO_INCREMENT PRIMARY KEY,
    nomClasse VARCHAR(100) NOT NULL,
    anneeScolaire CHAR(9) NOT NULL,
    UNIQUE (nomClasse, anneeScolaire)
) ENGINE=InnoDB;

CREATE TABLE matiere (
    idMatiere INT AUTO_INCREMENT PRIMARY KEY,
    nomMatiere VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE mot_cle (
    idMotCle INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE utilisateur (
    idUtilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(254) NOT NULL UNIQUE,
    mdpHash VARCHAR(255) NOT NULL,
    `role` VARCHAR(20) NOT NULL,
    idClasse INT NULL,
    FOREIGN KEY (idClasse) REFERENCES classe (idClasse)
) ENGINE=InnoDB;

CREATE TABLE habilitation (
    idUtilisateur INT NOT NULL,
    idMatiere INT NOT NULL,
    PRIMARY KEY (idUtilisateur, idMatiere),
    FOREIGN KEY (idUtilisateur) REFERENCES utilisateur (idUtilisateur),
    FOREIGN KEY (idMatiere) REFERENCES matiere (idMatiere)
) ENGINE=InnoDB;

CREATE TABLE enseignement (
    idEnseignement INT AUTO_INCREMENT PRIMARY KEY,
    idUtilisateur INT NOT NULL,
    idMatiere INT NOT NULL,
    idClasse INT NOT NULL,
    UNIQUE (idUtilisateur, idMatiere, idClasse),
    FOREIGN KEY (idUtilisateur) REFERENCES utilisateur (idUtilisateur),
    FOREIGN KEY (idMatiere) REFERENCES matiere (idMatiere),
    FOREIGN KEY (idClasse) REFERENCES classe (idClasse)
) ENGINE=InnoDB;

CREATE TABLE qcm (
    idQcm INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(150) NOT NULL,
    dateDebut DATETIME NOT NULL,
    dateFin DATETIME NOT NULL,
    nombreQuestions INT NOT NULL,
    idEnseignement INT NOT NULL,
    FOREIGN KEY (idEnseignement) REFERENCES enseignement (idEnseignement)
) ENGINE=InnoDB;

CREATE TABLE question (
    idQuestion INT AUTO_INCREMENT PRIMARY KEY,
    enonce TEXT NOT NULL,
    typeQuestion VARCHAR(20) NOT NULL,
    commentaireCorrection TEXT NULL
) ENGINE=InnoDB;

CREATE TABLE proposition (
    idProposition INT AUTO_INCREMENT PRIMARY KEY,
    texte TEXT NOT NULL,
    estCorrect BOOLEAN NOT NULL DEFAULT FALSE,
    ordreCorrect SMALLINT NULL,
    idQuestion INT NOT NULL,
    FOREIGN KEY (idQuestion) REFERENCES question (idQuestion),
    UNIQUE (idQuestion, ordreCorrect)
) ENGINE=InnoDB;

CREATE TABLE question_mot_cle (
    idQuestion INT NOT NULL,
    idMotCle INT NOT NULL,
    PRIMARY KEY (idQuestion, idMotCle),
    FOREIGN KEY (idQuestion) REFERENCES question (idQuestion),
    FOREIGN KEY (idMotCle) REFERENCES mot_cle (idMotCle)
) ENGINE=InnoDB;

CREATE TABLE qcm_question (
    idQcm INT NOT NULL,
    idQuestion INT NOT NULL,
    PRIMARY KEY (idQcm, idQuestion),
    FOREIGN KEY (idQcm) REFERENCES qcm (idQcm),
    FOREIGN KEY (idQuestion) REFERENCES question (idQuestion)
) ENGINE=InnoDB;

-- Mots-clés utilisés comme critères de tirage du QCM.
CREATE TABLE qcm_mot_cle (
    idQcm INT NOT NULL,
    idMotCle INT NOT NULL,
    PRIMARY KEY (idQcm, idMotCle),
    FOREIGN KEY (idQcm) REFERENCES qcm (idQcm),
    FOREIGN KEY (idMotCle) REFERENCES mot_cle (idMotCle)
) ENGINE=InnoDB;

CREATE TABLE tentative (
    idTentative INT AUTO_INCREMENT PRIMARY KEY,
    dateValidation DATETIME NULL,
    score DECIMAL(5, 2) NULL,
    idQcm INT NOT NULL,
    idUtilisateur INT NOT NULL,
    UNIQUE (idQcm, idUtilisateur),
    FOREIGN KEY (idQcm) REFERENCES qcm (idQcm),
    FOREIGN KEY (idUtilisateur) REFERENCES utilisateur (idUtilisateur)
) ENGINE=InnoDB;

CREATE TABLE selection (
    idTentative INT NOT NULL,
    idProposition INT NOT NULL,
    ordreSaisi SMALLINT NULL,
    PRIMARY KEY (idTentative, idProposition),
    FOREIGN KEY (idTentative) REFERENCES tentative (idTentative),
    FOREIGN KEY (idProposition) REFERENCES proposition (idProposition)
) ENGINE=InnoDB;

-- Jeu de données de test. Mot de passe des trois comptes : QcmTest2027!
-- Comptes réservés à l'environnement de développement et de tests.
START TRANSACTION;

INSERT INTO classe (idClasse, nomClasse, anneeScolaire) VALUES
    (1, 'SLAM 2', '2026-2027');

INSERT INTO matiere (idMatiere, nomMatiere) VALUES
    (1, 'Bases de données');

INSERT INTO mot_cle (idMotCle, libelle) VALUES
    (1, 'SQL');

INSERT INTO utilisateur (idUtilisateur, nom, prenom, email, mdpHash, `role`, idClasse) VALUES
    (1, 'Test', 'Admin', 'admin@qcm.test', '$2y$10$J14udBl.P6lcyfU8/Q3JqOLBkrrgSQsHBykgyg64rCjvX.6yg42gi', 'admin', NULL),
    (2, 'Test', 'Formateur', 'formateur@qcm.test', '$2y$10$zmcOb5h6bHMHYmzWUGgoH.OncNEB1GJwBvpSC8RHEXVnjWPrKR/2S', 'formateur', NULL),
    (3, 'Test', 'Étudiant', 'etudiant@qcm.test', '$2y$10$eGBAHX0xEq6HII./iUFE2eJWM5Nu.HafiSVBzPncHBNhstkaMi6/.', 'etudiant', 1);

INSERT INTO habilitation (idUtilisateur, idMatiere) VALUES (2, 1);

INSERT INTO enseignement (idEnseignement, idUtilisateur, idMatiere, idClasse) VALUES
    (1, 2, 1, 1);

INSERT INTO question (idQuestion, enonce, typeQuestion, commentaireCorrection)
VALUES (1, 'Quelle commande lit des données ?', 'unique', 'SELECT lit les données.');

INSERT INTO proposition (texte, estCorrect, idQuestion) VALUES
    ('SELECT', TRUE, 1),
    ('DELETE', FALSE, 1);

INSERT INTO question_mot_cle (idQuestion, idMotCle) VALUES (1, 1);

INSERT INTO qcm (idQcm, titre, dateDebut, dateFin, nombreQuestions, idEnseignement)
VALUES (1, 'Révisions SQL', NOW(), NOW() + INTERVAL 30 DAY, 1, 1);

INSERT INTO qcm_mot_cle (idQcm, idMotCle) VALUES (1, 1);

INSERT INTO qcm_question (idQcm, idQuestion) VALUES (1, 1);

COMMIT;
