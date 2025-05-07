<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250427233700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE infirmiere ADD CONSTRAINT FK_5DD89D27BF396750 FOREIGN KEY (id) REFERENCES personne_login (id)');
        //$this->addSql('ALTER TABLE soins_visite ADD CONSTRAINT FK_A462A02CB09C8CBB FOREIGN KEY (visite) REFERENCES visite (id)');
        $this->addSql('ALTER TABLE soins_visite ADD CONSTRAINT FK_A462A02C80E45D67 FOREIGN KEY (id_soins) REFERENCES soins (id)');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB1ADAD7EB FOREIGN KEY (patient) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB5DD89D27 FOREIGN KEY (infirmiere) REFERENCES infirmiere (id)');
        $this->addSql('ALTER TABLE visite RENAME INDEX patient TO IDX_B09C8CBB1ADAD7EB');
        $this->addSql('ALTER TABLE visite RENAME INDEX infirmiere TO IDX_B09C8CBB5DD89D27');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE soins_visite DROP FOREIGN KEY FK_A462A02CB09C8CBB');
        $this->addSql('ALTER TABLE soins_visite DROP FOREIGN KEY FK_A462A02C80E45D67');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB1ADAD7EB');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB5DD89D27');
        $this->addSql('ALTER TABLE visite RENAME INDEX idx_b09c8cbb1adad7eb TO patient');
        $this->addSql('ALTER TABLE visite RENAME INDEX idx_b09c8cbb5dd89d27 TO infirmiere');
        //$this->addSql('ALTER TABLE infirmiere DROP FOREIGN KEY FK_5DD89D27BF396750');
    }
}
