<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250505062304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE lieu_convalescence');
        $this->addSql('DROP TABLE infirmiere_badge');
        $this->addSql('ALTER TABLE administrateur ADD CONSTRAINT FK_32EB52E8BF396750 FOREIGN KEY (id) REFERENCES personne_login (id)');
        $this->addSql('DROP INDEX `primary` ON indisponibilite');
        $this->addSql('ALTER TABLE indisponibilite ADD PRIMARY KEY (infirmiere)');
        $this->addSql('ALTER TABLE infirmiere DROP FOREIGN KEY infirmiere_ibfk_1');
        $this->addSql('ALTER TABLE infirmiere CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY patient_ibfk_1');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY patient_ibfk_2');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY patient_ibfk_3');
        $this->addSql('ALTER TABLE patient ADD personne_login_id INT NOT NULL');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB9F60E118 FOREIGN KEY (personne_login_id) REFERENCES personne_login (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1ADAD7EB9F60E118 ON patient (personne_login_id)');
        $this->addSql('ALTER TABLE personne_login DROP nb_tentative_erreur, CHANGE mp mp VARCHAR(64) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BEE9DA79AA08CB10 ON personne_login (login)');
        $this->addSql('ALTER TABLE soins_visite ADD CONSTRAINT FK_A462A02C80E45D67 FOREIGN KEY (id_soins) REFERENCES soins (id)');
        $this->addSql('ALTER TABLE type_soins DROP FOREIGN KEY type_soins_ibfk_1');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB1ADAD7EB FOREIGN KEY (patient) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB5DD89D27 FOREIGN KEY (infirmiere) REFERENCES infirmiere (id)');
        $this->addSql('ALTER TABLE visite RENAME INDEX patient TO IDX_B09C8CBB1ADAD7EB');
        $this->addSql('ALTER TABLE visite RENAME INDEX infirmiere TO IDX_B09C8CBB5DD89D27');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lieu_convalescence (id INT NOT NULL, titre TEXT CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, ad1 VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, ad2 VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, cp CHAR(5) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, ville VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, tel_fixe CHAR(10) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, contact INT DEFAULT NULL, INDEX contact (contact), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE infirmiere_badge (id_infirmiere INT NOT NULL, id_badge INT NOT NULL, date_deb DATE NOT NULL, date_fin DATE DEFAULT NULL, INDEX id_badge (id_badge), PRIMARY KEY(id_infirmiere, id_badge, date_deb)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE administrateur DROP FOREIGN KEY FK_32EB52E8BF396750');
        $this->addSql('DROP INDEX UNIQ_BEE9DA79AA08CB10 ON personne_login');
        $this->addSql('ALTER TABLE personne_login ADD nb_tentative_erreur INT NOT NULL, CHANGE mp mp CHAR(32) NOT NULL');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EB9F60E118');
        $this->addSql('DROP INDEX UNIQ_1ADAD7EB9F60E118 ON patient');
        $this->addSql('ALTER TABLE patient DROP personne_login_id');
        $this->addSql('ALTER TABLE soins_visite DROP FOREIGN KEY FK_A462A02C80E45D67');
        $this->addSql('ALTER TABLE infirmiere CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE infirmiere ADD CONSTRAINT infirmiere_ibfk_1 FOREIGN KEY (id) REFERENCES personne (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP INDEX `PRIMARY` ON indisponibilite');
        $this->addSql('ALTER TABLE indisponibilite ADD PRIMARY KEY (infirmiere, date_debut)');
        $this->addSql('ALTER TABLE type_soins ADD CONSTRAINT type_soins_ibfk_1 FOREIGN KEY (id_categ_soins) REFERENCES categ_soins (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB1ADAD7EB');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB5DD89D27');
        $this->addSql('ALTER TABLE visite RENAME INDEX idx_b09c8cbb5dd89d27 TO infirmiere');
        $this->addSql('ALTER TABLE visite RENAME INDEX idx_b09c8cbb1adad7eb TO patient');
    }
}
