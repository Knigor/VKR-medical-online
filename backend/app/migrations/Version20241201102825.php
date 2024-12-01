<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241201102825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pacient ADD blood_type VARCHAR(200) DEFAULT NULL');
        $this->addSql('ALTER TABLE pacient ADD allergies VARCHAR(200) DEFAULT NULL');
        $this->addSql('ALTER TABLE pacient ADD chronic_conditions VARCHAR(200) DEFAULT NULL');
        $this->addSql('ALTER TABLE pacient RENAME COLUMN fio TO policy_number');
        $this->addSql('ALTER TABLE users ADD gender VARCHAR(200) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE users DROP gender');
        $this->addSql('ALTER TABLE pacient ADD fio VARCHAR(200) DEFAULT NULL');
        $this->addSql('ALTER TABLE pacient DROP policy_number');
        $this->addSql('ALTER TABLE pacient DROP blood_type');
        $this->addSql('ALTER TABLE pacient DROP allergies');
        $this->addSql('ALTER TABLE pacient DROP chronic_conditions');
    }
}
