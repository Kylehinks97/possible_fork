<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241209172250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add User and it\'s relation to Project';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE main.user (
            id SERIAL NOT NULL,
            first_name VARCHAR(255) NOT NULL,
            surname VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            PRIMARY KEY(id)
        )');

        $this->addSql('CREATE TABLE main.user_project (
            user_id INT NOT NULL,
            project_id INT NOT NULL,
            PRIMARY KEY(user_id, project_id),
            CONSTRAINT FK_USER_PROJECT_USER FOREIGN KEY (user_id) REFERENCES main.user (id) ON DELETE CASCADE,
            CONSTRAINT FK_USER_PROJECT_PROJECT FOREIGN KEY (project_id) REFERENCES main.project (id) ON DELETE CASCADE
        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE main.user_project');

        $this->addSql('DROP TABLE main.user');
    }
}
