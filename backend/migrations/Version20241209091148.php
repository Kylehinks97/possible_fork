<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241209091148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add first iteration of architecture to the main schema';
    }

    public function up(Schema $schema): void
    {
        // Create the "main" schema
        $this->addSql('CREATE SCHEMA main');

        // Create tables in the "main" schema
        $this->addSql('CREATE TABLE main.edge (id SERIAL NOT NULL, surface_id INT NOT NULL, length INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7506D366CA11F534 ON main.edge (surface_id)');

        $this->addSql('CREATE TABLE main.surface (id SERIAL NOT NULL, type_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BC419E6EC54C8C93 ON main.surface (type_id)');

        $this->addSql('CREATE TABLE main.surface_type (id SERIAL NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_934E7ECA5E237E06 ON main.surface_type (name)');

        $this->addSql('CREATE TABLE main.vertex (id SERIAL NOT NULL, surface_id INT NOT NULL, x INT NOT NULL, y INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E9F17935CA11F534 ON main.vertex (surface_id)');

        // Add foreign key constraints
        $this->addSql('ALTER TABLE main.edge ADD CONSTRAINT FK_7506D366CA11F534 FOREIGN KEY (surface_id) REFERENCES main.surface (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE main.surface ADD CONSTRAINT FK_BC419E6EC54C8C93 FOREIGN KEY (type_id) REFERENCES main.surface_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE main.vertex ADD CONSTRAINT FK_E9F17935CA11F534 FOREIGN KEY (surface_id) REFERENCES main.surface (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // Drop the tables and schema
        $this->addSql('ALTER TABLE main.edge DROP CONSTRAINT FK_7506D366CA11F534');
        $this->addSql('ALTER TABLE main.surface DROP CONSTRAINT FK_BC419E6EC54C8C93');
        $this->addSql('ALTER TABLE main.vertex DROP CONSTRAINT FK_E9F17935CA11F534');

        $this->addSql('DROP TABLE main.edge');
        $this->addSql('DROP TABLE main.surface');
        $this->addSql('DROP TABLE main.surface_type');
        $this->addSql('DROP TABLE main.vertex');

        $this->addSql('DROP SCHEMA main');
    }
}
