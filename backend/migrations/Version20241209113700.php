<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241209113700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Room and it\'s relation to Surface';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE main.room (
        id SERIAL NOT NULL, 
        name VARCHAR(255) NOT NULL, 
        PRIMARY KEY(id)
    )');

        $this->addSql('ALTER TABLE main.surface ADD room_id INT NOT NULL');

        $this->addSql('ALTER TABLE main.surface ADD CONSTRAINT FK_SURFACE_ROOM FOREIGN KEY (room_id) REFERENCES main.room (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE main.surface DROP CONSTRAINT FK_SURFACE_ROOM');

        $this->addSql('ALTER TABLE main.surface DROP room_id');

        $this->addSql('DROP TABLE main.room');
    }
}
