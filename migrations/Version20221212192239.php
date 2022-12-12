<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221212192239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__movies AS SELECT id, title, description, actors, genre FROM movies');
        $this->addSql('DROP TABLE movies');
        $this->addSql('CREATE TABLE movies (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description CLOB NOT NULL, production_companies CLOB NOT NULL --(DC2Type:array)
        , genre CLOB NOT NULL --(DC2Type:array)
        )');
        $this->addSql('INSERT INTO movies (id, title, description, production_companies, genre) SELECT id, title, description, actors, genre FROM __temp__movies');
        $this->addSql('DROP TABLE __temp__movies');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__movies AS SELECT id, title, description, production_companies, genre FROM movies');
        $this->addSql('DROP TABLE movies');
        $this->addSql('CREATE TABLE movies (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description CLOB NOT NULL, actors CLOB NOT NULL --(DC2Type:array)
        , genre VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO movies (id, title, description, actors, genre) SELECT id, title, description, production_companies, genre FROM __temp__movies');
        $this->addSql('DROP TABLE __temp__movies');
    }
}
