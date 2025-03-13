<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250313121932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chats DROP CONSTRAINT fk_2d68180fa76ed395');
        $this->addSql('DROP INDEX idx_2d68180fa76ed395');
        $this->addSql('ALTER TABLE chats ADD patient_id INT NOT NULL');
        $this->addSql('ALTER TABLE chats ADD doctor_id INT NOT NULL');
        $this->addSql('ALTER TABLE chats DROP user_id');
        $this->addSql('ALTER TABLE chats ADD CONSTRAINT FK_2D68180F6B899279 FOREIGN KEY (patient_id) REFERENCES users (user_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chats ADD CONSTRAINT FK_2D68180F87F4FB17 FOREIGN KEY (doctor_id) REFERENCES users (user_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2D68180F6B899279 ON chats (patient_id)');
        $this->addSql('CREATE INDEX IDX_2D68180F87F4FB17 ON chats (doctor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE chats DROP CONSTRAINT FK_2D68180F6B899279');
        $this->addSql('ALTER TABLE chats DROP CONSTRAINT FK_2D68180F87F4FB17');
        $this->addSql('DROP INDEX IDX_2D68180F6B899279');
        $this->addSql('DROP INDEX IDX_2D68180F87F4FB17');
        $this->addSql('ALTER TABLE chats ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE chats DROP patient_id');
        $this->addSql('ALTER TABLE chats DROP doctor_id');
        $this->addSql('ALTER TABLE chats ADD CONSTRAINT fk_2d68180fa76ed395 FOREIGN KEY (user_id) REFERENCES users (user_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_2d68180fa76ed395 ON chats (user_id)');
    }
}
