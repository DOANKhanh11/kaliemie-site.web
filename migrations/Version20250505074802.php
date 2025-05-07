<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250505074802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE infirmiere CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE patient ADD personne_login_id INT NOT NULL');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB9F60E118 FOREIGN KEY (personne_login_id) REFERENCES personne_login (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1ADAD7EB9F60E118 ON patient (personne_login_id)');
        $this->addSql('DROP INDEX idx_soins_id ON soins');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE INDEX idx_soins_id ON soins (id)');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EB9F60E118');
        $this->addSql('DROP INDEX UNIQ_1ADAD7EB9F60E118 ON patient');
        $this->addSql('ALTER TABLE patient DROP personne_login_id');
        $this->addSql('ALTER TABLE infirmiere CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
