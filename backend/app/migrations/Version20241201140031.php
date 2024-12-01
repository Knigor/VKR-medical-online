<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241201140031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add photo_user and birthdate columns with default values';
    }

    public function up(Schema $schema): void
    {
        // Добавляем колонку photo_user с ограничением NOT NULL и значением по умолчанию
        $this->addSql('ALTER TABLE users ADD photo_user VARCHAR(200) DEFAULT \'default_photo.jpg\' NOT NULL');
        
        // Добавляем колонку birthdate с значением по умолчанию
        // Здесь можно использовать текущую дату как значение по умолчанию
        $this->addSql('ALTER TABLE users ADD birthdate TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
        
        // Обновляем все записи, у которых в поле photo_user или birthdate значение NULL
        $this->addSql("UPDATE users SET photo_user = 'default_photo.jpg' WHERE photo_user IS NULL");
        $this->addSql("UPDATE users SET birthdate = CURRENT_TIMESTAMP WHERE birthdate IS NULL");
    }

    public function down(Schema $schema): void
    {
        // Откатываем изменения
        $this->addSql('ALTER TABLE users ALTER COLUMN photo_user DROP NOT NULL');
        $this->addSql('ALTER TABLE users DROP birthdate');
    }
}
