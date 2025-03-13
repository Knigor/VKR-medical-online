<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250313145530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chats DROP CONSTRAINT FK_2D68180F6B899279');
        $this->addSql('ALTER TABLE chats DROP CONSTRAINT FK_2D68180F87F4FB17');
        $this->addSql('ALTER TABLE chats ADD CONSTRAINT FK_2D68180F6B899279 FOREIGN KEY (patient_id) REFERENCES pacient (patient_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chats ADD CONSTRAINT FK_2D68180F87F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctors (doctor_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE chats DROP CONSTRAINT fk_2d68180f6b899279');
        $this->addSql('ALTER TABLE chats DROP CONSTRAINT fk_2d68180f87f4fb17');
        $this->addSql('ALTER TABLE chats ADD CONSTRAINT fk_2d68180f6b899279 FOREIGN KEY (patient_id) REFERENCES users (user_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chats ADD CONSTRAINT fk_2d68180f87f4fb17 FOREIGN KEY (doctor_id) REFERENCES users (user_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
