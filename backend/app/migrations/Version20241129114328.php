<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241129114328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ScheduleDoctors (schedule_doctors_id SERIAL NOT NULL, doctor_id INT DEFAULT NULL, time_schedule TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(schedule_doctors_id))');
        $this->addSql('CREATE INDEX IDX_6A1C232087F4FB17 ON ScheduleDoctors (doctor_id)');
        $this->addSql('ALTER TABLE ScheduleDoctors ADD CONSTRAINT FK_6A1C232087F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctors (doctor_id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE doctors DROP shchedule');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE ScheduleDoctors DROP CONSTRAINT FK_6A1C232087F4FB17');
        $this->addSql('DROP TABLE ScheduleDoctors');
        $this->addSql('ALTER TABLE doctors ADD shchedule TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
    }
}
