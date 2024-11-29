<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241126073109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE specializations ADD doctor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE specializations DROP doctor');
        $this->addSql('ALTER TABLE specializations ADD CONSTRAINT FK_B6F79EBF87F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctors (doctor_id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B6F79EBF87F4FB17 ON specializations (doctor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE specializations DROP CONSTRAINT FK_B6F79EBF87F4FB17');
        $this->addSql('DROP INDEX IDX_B6F79EBF87F4FB17');
        $this->addSql('ALTER TABLE specializations ADD doctor INT NOT NULL');
        $this->addSql('ALTER TABLE specializations DROP doctor_id');
    }
}
