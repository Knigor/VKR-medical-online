<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241129121404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reviews (reviews_id SERIAL NOT NULL, doctor_id INT DEFAULT NULL, patient_id INT DEFAULT NULL, rating INT NOT NULL, PRIMARY KEY(reviews_id))');
        $this->addSql('CREATE INDEX IDX_6970EB0F87F4FB17 ON reviews (doctor_id)');
        $this->addSql('CREATE INDEX IDX_6970EB0F6B899279 ON reviews (patient_id)');
        $this->addSql('ALTER TABLE reviews ADD CONSTRAINT FK_6970EB0F87F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctors (doctor_id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reviews ADD CONSTRAINT FK_6970EB0F6B899279 FOREIGN KEY (patient_id) REFERENCES pacient (patient_id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chats ALTER created_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE chats ALTER created_at SET NOT NULL');
        $this->addSql('ALTER TABLE chats ALTER updated_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE chats ALTER updated_at SET NOT NULL');
        $this->addSql('ALTER TABLE doctors ADD complete_consultation INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE messages ALTER "timestamp" TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE messages ALTER "timestamp" SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE reviews DROP CONSTRAINT FK_6970EB0F87F4FB17');
        $this->addSql('ALTER TABLE reviews DROP CONSTRAINT FK_6970EB0F6B899279');
        $this->addSql('DROP TABLE reviews');
        $this->addSql('ALTER TABLE chats ALTER created_at TYPE DATE');
        $this->addSql('ALTER TABLE chats ALTER created_at DROP NOT NULL');
        $this->addSql('ALTER TABLE chats ALTER updated_at TYPE DATE');
        $this->addSql('ALTER TABLE chats ALTER updated_at DROP NOT NULL');
        $this->addSql('ALTER TABLE messages ALTER timestamp TYPE DATE');
        $this->addSql('ALTER TABLE messages ALTER timestamp DROP NOT NULL');
        $this->addSql('ALTER TABLE doctors DROP complete_consultation');
    }
}
