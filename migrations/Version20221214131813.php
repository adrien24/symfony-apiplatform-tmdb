<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221214131813 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__series AS SELECT id, name, languages, episode_time, backdrop_path, number_episodes, description FROM series');
        $this->addSql('DROP TABLE series');
        $this->addSql('CREATE TABLE series (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, languages VARCHAR(255) DEFAULT NULL, episode_time INTEGER DEFAULT NULL, backdrop_path VARCHAR(255) DEFAULT NULL, number_episodes INTEGER DEFAULT NULL, description CLOB NOT NULL)');
        $this->addSql('INSERT INTO series (id, name, languages, episode_time, backdrop_path, number_episodes, description) SELECT id, name, languages, episode_time, backdrop_path, number_episodes, description FROM __temp__series');
        $this->addSql('DROP TABLE __temp__series');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__series AS SELECT id, name, languages, episode_time, backdrop_path, number_episodes, description FROM series');
        $this->addSql('DROP TABLE series');
        $this->addSql('CREATE TABLE series (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, languages CLOB DEFAULT NULL --(DC2Type:array)
        , episode_time CLOB DEFAULT NULL --(DC2Type:array)
        , backdrop_path VARCHAR(255) DEFAULT NULL, number_episodes INTEGER NOT NULL, description CLOB NOT NULL, origin_country CLOB NOT NULL --(DC2Type:array)
        )');
        $this->addSql('INSERT INTO series (id, name, languages, episode_time, backdrop_path, number_episodes, description) SELECT id, name, languages, episode_time, backdrop_path, number_episodes, description FROM __temp__series');
        $this->addSql('DROP TABLE __temp__series');
    }
}
