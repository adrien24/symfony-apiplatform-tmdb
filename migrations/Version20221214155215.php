<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221214155215 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__animes AS SELECT id, type, synopsis, name, status, image, episode_count, poster FROM animes');
        $this->addSql('DROP TABLE animes');
        $this->addSql('CREATE TABLE animes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(255) NOT NULL, synopsis CLOB NOT NULL, name VARCHAR(255) NOT NULL, status INTEGER NOT NULL, image VARCHAR(255) NOT NULL, episode_count INTEGER NOT NULL, poster CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO animes (id, type, synopsis, name, status, image, episode_count, poster) SELECT id, type, synopsis, name, status, image, episode_count, poster FROM __temp__animes');
        $this->addSql('DROP TABLE __temp__animes');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__animes AS SELECT id, type, synopsis, name, status, image, episode_count, poster FROM animes');
        $this->addSql('DROP TABLE animes');
        $this->addSql('CREATE TABLE animes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(255) NOT NULL, synopsis CLOB NOT NULL, name VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, episode_count INTEGER NOT NULL, poster CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO animes (id, type, synopsis, name, status, image, episode_count, poster) SELECT id, type, synopsis, name, status, image, episode_count, poster FROM __temp__animes');
        $this->addSql('DROP TABLE __temp__animes');
    }
}
