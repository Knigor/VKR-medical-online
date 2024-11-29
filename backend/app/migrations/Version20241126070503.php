<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241126070503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chats (chats_id SERIAL NOT NULL, user_id INT DEFAULT NULL, created_at DATE DEFAULT NULL, updated_at DATE DEFAULT NULL, status_chats BOOLEAN DEFAULT NULL, PRIMARY KEY(chats_id))');
        $this->addSql('CREATE INDEX IDX_2D68180FA76ED395 ON chats (user_id)');
        $this->addSql('CREATE TABLE diseases (diseases_id SERIAL NOT NULL, doctor_id INT DEFAULT NULL, type_diseases VARCHAR(255) DEFAULT NULL, PRIMARY KEY(diseases_id))');
        $this->addSql('CREATE INDEX IDX_F762064787F4FB17 ON diseases (doctor_id)');
        $this->addSql('CREATE TABLE doctors (doctor_id SERIAL NOT NULL, user_id INT DEFAULT NULL, bio VARCHAR(255) DEFAULT NULL, education VARCHAR(200) DEFAULT NULL, shchedule DATE DEFAULT NULL, PRIMARY KEY(doctor_id))');
        $this->addSql('CREATE INDEX IDX_B67687BEA76ED395 ON doctors (user_id)');
        $this->addSql('CREATE TABLE messages (messages_id SERIAL NOT NULL, chats_id INT DEFAULT NULL, user_id INT DEFAULT NULL, message VARCHAR(255) DEFAULT NULL, timestamp DATE DEFAULT NULL, messages_image VARCHAR(200) DEFAULT NULL, PRIMARY KEY(messages_id))');
        $this->addSql('CREATE INDEX IDX_DB021E96AC6FF313 ON messages (chats_id)');
        $this->addSql('CREATE INDEX IDX_DB021E96A76ED395 ON messages (user_id)');
        $this->addSql('CREATE TABLE pacient (patient_id SERIAL NOT NULL, user_id INT DEFAULT NULL, fio VARCHAR(200) DEFAULT NULL, PRIMARY KEY(patient_id))');
        $this->addSql('CREATE INDEX IDX_C81A9C79A76ED395 ON pacient (user_id)');
        $this->addSql('CREATE TABLE specializations (specialization_id SERIAL NOT NULL, name_specialization VARCHAR(255) NOT NULL, experience INT NOT NULL, doctor INT NOT NULL, PRIMARY KEY(specialization_id))');
        $this->addSql('CREATE TABLE users (user_id SERIAL NOT NULL, fio VARCHAR(200) NOT NULL, username VARCHAR(200) NOT NULL, email VARCHAR(200) NOT NULL, password VARCHAR(255) NOT NULL, role JSON DEFAULT NULL, PRIMARY KEY(user_id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9F85E0677 ON users (username)');
        $this->addSql('ALTER TABLE chats ADD CONSTRAINT FK_2D68180FA76ED395 FOREIGN KEY (user_id) REFERENCES users (user_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE diseases ADD CONSTRAINT FK_F762064787F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctors (doctor_id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE doctors ADD CONSTRAINT FK_B67687BEA76ED395 FOREIGN KEY (user_id) REFERENCES users (user_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96AC6FF313 FOREIGN KEY (chats_id) REFERENCES chats (chats_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96A76ED395 FOREIGN KEY (user_id) REFERENCES users (user_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pacient ADD CONSTRAINT FK_C81A9C79A76ED395 FOREIGN KEY (user_id) REFERENCES users (user_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE chats DROP CONSTRAINT FK_2D68180FA76ED395');
        $this->addSql('ALTER TABLE diseases DROP CONSTRAINT FK_F762064787F4FB17');
        $this->addSql('ALTER TABLE doctors DROP CONSTRAINT FK_B67687BEA76ED395');
        $this->addSql('ALTER TABLE messages DROP CONSTRAINT FK_DB021E96AC6FF313');
        $this->addSql('ALTER TABLE messages DROP CONSTRAINT FK_DB021E96A76ED395');
        $this->addSql('ALTER TABLE pacient DROP CONSTRAINT FK_C81A9C79A76ED395');
        $this->addSql('DROP TABLE chats');
        $this->addSql('DROP TABLE diseases');
        $this->addSql('DROP TABLE doctors');
        $this->addSql('DROP TABLE messages');
        $this->addSql('DROP TABLE pacient');
        $this->addSql('DROP TABLE specializations');
        $this->addSql('DROP TABLE users');
    }
}
