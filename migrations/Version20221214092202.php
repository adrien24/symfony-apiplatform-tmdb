<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221214092202 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE series (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, languages CLOB DEFAULT NULL --(DC2Type:array)
        , episode_time CLOB DEFAULT NULL --(DC2Type:array)
        , backdrop_path VARCHAR(255) DEFAULT NULL, number_episodes INTEGER NOT NULL, origin_country CLOB NOT NULL --(DC2Type:array)
        , description CLOB NOT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__movies AS SELECT id, title, description, production_companies, genre FROM movies');
        $this->addSql('DROP TABLE movies');
        $this->addSql('CREATE TABLE movies (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description CLOB NOT NULL, production_companies CLOB NOT NULL --(DC2Type:json)
        , genre CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO movies (id, title, description, production_companies, genre) SELECT id, title, description, production_companies, genre FROM __temp__movies');
        $this->addSql('DROP TABLE __temp__movies');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE series');
        $this->addSql('CREATE TEMPORARY TABLE __temp__movies AS SELECT id, title, description, production_companies, genre FROM movies');
        $this->addSql('DROP TABLE movies');
        $this->addSql('CREATE TABLE movies (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description CLOB NOT NULL, production_companies CLOB NOT NULL --(DC2Type:array)
        , genre CLOB NOT NULL --(DC2Type:array)
        )');
        $this->addSql('INSERT INTO movies (id, title, description, production_companies, genre) SELECT id, title, description, production_companies, genre FROM __temp__movies');
        $this->addSql('DROP TABLE __temp__movies');
    }
}
