<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241110113521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX chats_pk');
        $this->addSql('ALTER INDEX stores_chats_users_fk RENAME TO IDX_2D68180FA76ED395');
        $this->addSql('DROP INDEX doctors_pk');
        $this->addSql('ALTER INDEX store_specialization_fk RENAME TO IDX_B67687BEFA846217');
        $this->addSql('ALTER INDEX stores_doctors_fk RENAME TO IDX_B67687BEA76ED395');
        $this->addSql('DROP INDEX messages_pk');
        $this->addSql('ALTER INDEX stores_chats_message_fk RENAME TO IDX_DB021E96AC6FF313');
        $this->addSql('ALTER INDEX stores_users_message_fk RENAME TO IDX_DB021E96A76ED395');
        $this->addSql('DROP INDEX pacient_pk');
        $this->addSql('ALTER INDEX stores_pacient_fk RENAME TO IDX_C81A9C79A76ED395');
        $this->addSql('DROP INDEX specialization_pk');
        $this->addSql('DROP INDEX users_pk');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE UNIQUE INDEX messages_pk ON messages (messages_id)');
        $this->addSql('ALTER INDEX idx_db021e96a76ed395 RENAME TO stores_users_message_fk');
        $this->addSql('ALTER INDEX idx_db021e96ac6ff313 RENAME TO stores_chats_message_fk');
        $this->addSql('CREATE UNIQUE INDEX doctors_pk ON doctors (doctor_id)');
        $this->addSql('ALTER INDEX idx_b67687bea76ed395 RENAME TO stores_doctors_fk');
        $this->addSql('ALTER INDEX idx_b67687befa846217 RENAME TO store_specialization_fk');
        $this->addSql('CREATE UNIQUE INDEX pacient_pk ON pacient (patient_id)');
        $this->addSql('ALTER INDEX idx_c81a9c79a76ed395 RENAME TO stores_pacient_fk');
        $this->addSql('CREATE UNIQUE INDEX specialization_pk ON specialization (specialization_id)');
        $this->addSql('CREATE UNIQUE INDEX chats_pk ON chats (chats_id)');
        $this->addSql('ALTER INDEX idx_2d68180fa76ed395 RENAME TO stores_chats_users_fk');
        $this->addSql('CREATE UNIQUE INDEX users_pk ON users (user_id)');
    }
}
