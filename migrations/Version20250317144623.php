<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250317144623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBEBA6D43E');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY patient_ibfk_1');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY patient_ibfk_2');
        $this->addSql('DROP TABLE soins_visite');
        $this->addSql('DROP TABLE infirmiere');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE indisponibilite');
        $this->addSql('DROP TABLE badge');
        $this->addSql('DROP TABLE personne_login');
        $this->addSql('DROP TABLE soins');
        $this->addSql('DROP TABLE convalescence');
        $this->addSql('DROP TABLE categorie_indisponibilite');
        $this->addSql('DROP TABLE visite');
        $this->addSql('DROP TABLE categ_soins');
        $this->addSql('DROP TABLE type_soins');
        $this->addSql('DROP TABLE temoignage');
        $this->addSql('DROP TABLE token');
        $this->addSql('DROP TABLE chambre_forte');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE soins_visite (visite INT NOT NULL, id_categ_soins INT NOT NULL, id_type_soins INT NOT NULL, id_soins INT NOT NULL, prevu TINYINT(1) NOT NULL, realise TINYINT(1) NOT NULL, INDEX FK1 (id_categ_soins, id_type_soins, id_soins), INDEX id_categ_soins (id_categ_soins), INDEX id_soins (id_soins), INDEX id_type_soins (id_type_soins), INDEX visite (visite), PRIMARY KEY(visite, id_categ_soins, id_type_soins, id_soins)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE infirmiere (id INT AUTO_INCREMENT NOT NULL, fichier_photo VARCHAR(250) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE patient (id INT NOT NULL, personne_de_confiance INT DEFAULT NULL, infirmiere_souhait INT DEFAULT NULL, informations_medicales TEXT CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, INDEX personne_de_confiance (personne_de_confiance), INDEX infirmiere_souhait (infirmiere_souhait), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, prenom VARCHAR(100) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, sexe CHAR(1) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, date_naiss DATE DEFAULT NULL, date_deces DATE DEFAULT NULL, ad1 VARCHAR(100) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, ad2 VARCHAR(100) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, cp INT DEFAULT NULL, ville VARCHAR(100) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, tel_fixe VARCHAR(15) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, tel_port VARCHAR(15) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, mail VARCHAR(30) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE indisponibilite (infirmiere INT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, heure_deb TIME DEFAULT NULL, heure_fin TIME DEFAULT NULL, categorie INT NOT NULL, INDEX categorie (categorie), INDEX infirmiere (infirmiere), PRIMARY KEY(infirmiere, date_debut)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE badge (id INT AUTO_INCREMENT NOT NULL, uid VARCHAR(25) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, actif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE personne_login (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(25) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, mp CHAR(32) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, derniere_connexion DATE DEFAULT NULL, nb_tentative_erreur INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE soins (id_categ_soins INT NOT NULL, id_type_soins INT NOT NULL, id INT NOT NULL, libel TEXT CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, description TEXT CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, coefficient DOUBLE PRECISION NOT NULL, date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX id_categ_soins (id_categ_soins), INDEX id_type_soins (id_type_soins), PRIMARY KEY(id_categ_soins, id_type_soins, id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE convalescence (id_patient INT NOT NULL, id_lieux INT NOT NULL, date_deb DATE NOT NULL, date_fin DATE DEFAULT NULL, chambre VARCHAR(50) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, tel_directe CHAR(10) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, INDEX id_lieux (id_lieux), PRIMARY KEY(id_patient, id_lieux, date_deb)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categorie_indisponibilite (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(250) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE visite (id INT AUTO_INCREMENT NOT NULL, patient INT NOT NULL, infirmiere INT NOT NULL, date_prevue DATETIME NOT NULL, date_reelle DATETIME DEFAULT NULL, duree INT NOT NULL, compte_rendu_infirmiere TEXT CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, compte_rendu_patient TEXT CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, INDEX infirmiere (infirmiere), INDEX patient (patient), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categ_soins (id INT AUTO_INCREMENT NOT NULL, libel TEXT CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, description MEDIUMTEXT CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE type_soins (id_categ_soins INT NOT NULL, id_type_soins INT NOT NULL, libel TEXT CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, description TEXT CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, INDEX id_categ_soins (id_categ_soins), INDEX id_type_soins (id_type_soins), PRIMARY KEY(id_categ_soins, id_type_soins)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE temoignage (id INT AUTO_INCREMENT NOT NULL, personne_login INT NOT NULL, contenu MEDIUMTEXT CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, date DATETIME NOT NULL, valide TINYINT(1) NOT NULL, INDEX personne_login (personne_login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE token (id INT AUTO_INCREMENT NOT NULL, id_login INT NOT NULL, date DATETIME NOT NULL, jeton TEXT CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, INDEX id_login (id_login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE chambre_forte (badge VARCHAR(25) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, acces_ok TINYINT(1) NOT NULL, PRIMARY KEY(badge, date)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBEBA6D43E FOREIGN KEY (infirmiere_souhait) REFERENCES infirmiere (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT patient_ibfk_1 FOREIGN KEY (id) REFERENCES personne (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT patient_ibfk_2 FOREIGN KEY (personne_de_confiance) REFERENCES personne (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
