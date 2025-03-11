<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250311093123 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE doctors ALTER bio TYPE TEXT');
        $this->addSql('ALTER TABLE doctors ALTER education TYPE TEXT');
        $this->addSql('ALTER TABLE doctors ALTER education TYPE TEXT');
        $this->addSql('ALTER TABLE doctors ALTER qualification TYPE TEXT');
        $this->addSql('ALTER TABLE doctors ALTER qualification TYPE TEXT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE doctors ALTER bio TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE doctors ALTER education TYPE VARCHAR(200)');
        $this->addSql('ALTER TABLE doctors ALTER qualification TYPE VARCHAR(200)');
    }
}
