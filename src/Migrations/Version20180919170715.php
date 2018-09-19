<?php

declare(strict_types=1);

/*
 * This file is part of the feedback project.
 *
 * (c) Florian Moser <git@famoser.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180919170715 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE semester (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name CLOB NOT NULL, creation_date DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE event (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, semester_id INTEGER DEFAULT NULL, name CLOB NOT NULL, date CLOB NOT NULL, feedback_start_time CLOB NOT NULL, feedback_end_time CLOB NOT NULL, template CLOB NOT NULL, template_name CLOB NOT NULL, has_lecture BOOLEAN NOT NULL, has_exercise BOOLEAN NOT NULL, final_template_version_loaded BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA74A798B6F ON event (semester_id)');
        $this->addSql('CREATE TABLE participant (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, event_id INTEGER DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_D79F6B1171F7E88B ON participant (event_id)');
        $this->addSql('CREATE TABLE answer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, participant_id INTEGER DEFAULT NULL, question_number INTEGER NOT NULL, value CLOB NOT NULL)');
        $this->addSql('CREATE INDEX IDX_DADD4A259D1C3019 ON answer (participant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE semester');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP TABLE answer');
    }
}
