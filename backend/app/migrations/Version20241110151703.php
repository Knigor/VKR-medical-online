<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241110151703 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE diseases (diseases_id SERIAL NOT NULL, doctor_id INT DEFAULT NULL, type_diseases VARCHAR(255) DEFAULT NULL, PRIMARY KEY(diseases_id))');
        $this->addSql('CREATE INDEX IDX_F762064787F4FB17 ON diseases (doctor_id)');
        $this->addSql('ALTER TABLE diseases ADD CONSTRAINT FK_F762064787F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctors (doctor_id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE diseases DROP CONSTRAINT FK_F762064787F4FB17');
        $this->addSql('DROP TABLE diseases');
    }
}
