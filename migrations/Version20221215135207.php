<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221215135207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE memes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, url VARCHAR(255) NOT NULL, width INTEGER NOT NULL, height INTEGER NOT NULL, box_count INTEGER NOT NULL, captions INTEGER NOT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__animes AS SELECT id, type, synopsis, name, status, image, episode_count, poster FROM animes');
        $this->addSql('DROP TABLE animes');
        $this->addSql('CREATE TABLE animes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(255) NOT NULL, synopsis CLOB NOT NULL, name VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, episode_count INTEGER NOT NULL, poster CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO animes (id, type, synopsis, name, status, image, episode_count, poster) SELECT id, type, synopsis, name, status, image, episode_count, poster FROM __temp__animes');
        $this->addSql('DROP TABLE __temp__animes');
        $this->addSql('CREATE TEMPORARY TABLE __temp__series AS SELECT id, name, languages, episode_time, backdrop_path, number_episodes, description FROM series');
        $this->addSql('DROP TABLE series');
        $this->addSql('CREATE TABLE series (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, languages VARCHAR(255) DEFAULT NULL, episode_time INTEGER DEFAULT NULL, backdrop_path VARCHAR(255) DEFAULT NULL, number_episodes INTEGER NOT NULL, description CLOB NOT NULL)');
        $this->addSql('INSERT INTO series (id, name, languages, episode_time, backdrop_path, number_episodes, description) SELECT id, name, languages, episode_time, backdrop_path, number_episodes, description FROM __temp__series');
        $this->addSql('DROP TABLE __temp__series');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE memes');
        $this->addSql('CREATE TEMPORARY TABLE __temp__animes AS SELECT id, type, synopsis, name, status, image, episode_count, poster FROM animes');
        $this->addSql('DROP TABLE animes');
        $this->addSql('CREATE TABLE animes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(255) NOT NULL, synopsis CLOB NOT NULL, name VARCHAR(255) NOT NULL, status INTEGER NOT NULL, image VARCHAR(255) NOT NULL, episode_count INTEGER NOT NULL, poster CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO animes (id, type, synopsis, name, status, image, episode_count, poster) SELECT id, type, synopsis, name, status, image, episode_count, poster FROM __temp__animes');
        $this->addSql('DROP TABLE __temp__animes');
        $this->addSql('CREATE TEMPORARY TABLE __temp__series AS SELECT id, name, languages, episode_time, backdrop_path, number_episodes, description FROM series');
        $this->addSql('DROP TABLE series');
        $this->addSql('CREATE TABLE series (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, languages VARCHAR(255) NOT NULL, episode_time INTEGER NOT NULL, backdrop_path VARCHAR(255) NOT NULL, number_episodes INTEGER NOT NULL, description CLOB NOT NULL)');
        $this->addSql('INSERT INTO series (id, name, languages, episode_time, backdrop_path, number_episodes, description) SELECT id, name, languages, episode_time, backdrop_path, number_episodes, description FROM __temp__series');
        $this->addSql('DROP TABLE __temp__series');
    }
}
