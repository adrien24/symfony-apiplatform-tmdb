<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221215181315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(255) NOT NULL, synopsis CLOB NOT NULL, name VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, episode_count INTEGER NOT NULL, poster CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('CREATE TABLE memes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, url VARCHAR(255) NOT NULL, width INTEGER NOT NULL, height INTEGER NOT NULL, box_count INTEGER NOT NULL, captions INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE posts (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE series (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, languages VARCHAR(255) DEFAULT NULL, episode_time INTEGER DEFAULT NULL, backdrop_path VARCHAR(255) DEFAULT NULL, number_episodes INTEGER NOT NULL, description CLOB NOT NULL)');
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
        $this->addSql('DROP TABLE animes');
        $this->addSql('DROP TABLE memes');
        $this->addSql('DROP TABLE posts');
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
