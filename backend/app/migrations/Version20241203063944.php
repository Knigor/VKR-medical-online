<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241203063944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE doctors ALTER bio DROP NOT NULL');
        $this->addSql('ALTER TABLE doctors ALTER education DROP NOT NULL');
        $this->addSql('ALTER TABLE doctors ALTER qualification DROP NOT NULL');
        $this->addSql('ALTER TABLE doctors ALTER experience SET DEFAULT 0');
        $this->addSql('ALTER TABLE pacient ALTER policy_number DROP NOT NULL');
        $this->addSql('ALTER TABLE pacient ALTER blood_type DROP NOT NULL');
        $this->addSql('ALTER TABLE pacient ALTER allergies DROP NOT NULL');
        $this->addSql('ALTER TABLE pacient ALTER chronic_conditions DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pacient ALTER policy_number SET NOT NULL');
        $this->addSql('ALTER TABLE pacient ALTER blood_type SET NOT NULL');
        $this->addSql('ALTER TABLE pacient ALTER allergies SET NOT NULL');
        $this->addSql('ALTER TABLE pacient ALTER chronic_conditions SET NOT NULL');
        $this->addSql('ALTER TABLE doctors ALTER bio SET NOT NULL');
        $this->addSql('ALTER TABLE doctors ALTER education SET NOT NULL');
        $this->addSql('ALTER TABLE doctors ALTER qualification SET NOT NULL');
        $this->addSql('ALTER TABLE doctors ALTER experience DROP DEFAULT');
    }
}
