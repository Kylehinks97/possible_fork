<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241209160055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Building and it\'s relation to Room';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE main.building (
        id SERIAL NOT NULL,
        name VARCHAR(255) NOT NULL,
        PRIMARY KEY(id)
    )');

        $this->addSql('ALTER TABLE main.room ADD building_id INT NOT NULL');

        $this->addSql('ALTER TABLE main.room ADD CONSTRAINT FK_ROOM_BUILDING FOREIGN KEY (building_id) REFERENCES main.building (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE main.room DROP CONSTRAINT FK_ROOM_BUILDING');

        $this->addSql('ALTER TABLE main.room DROP building_id');

        $this->addSql('DROP TABLE main.building');
    }
}
