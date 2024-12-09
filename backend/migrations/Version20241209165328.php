<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241209165328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Project and it\'s relation to Building';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE main.project (
        id SERIAL NOT NULL,
        name VARCHAR(255) NOT NULL,
        PRIMARY KEY(id)
    )');

        $this->addSql('ALTER TABLE main.building ADD project_id INT NOT NULL');

        $this->addSql('ALTER TABLE main.building ADD CONSTRAINT FK_BUILDING_PROJECT FOREIGN KEY (project_id) REFERENCES main.project (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE main.building DROP CONSTRAINT FK_BUILDING_PROJECT');

        $this->addSql('ALTER TABLE main.building DROP project_id');

        $this->addSql('DROP TABLE main.project');
    }
}
