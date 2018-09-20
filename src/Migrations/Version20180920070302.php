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
final class Version20180920070302 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_D79F6B1171F7E88B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__participant AS SELECT id, event_id FROM participant');
        $this->addSql('DROP TABLE participant');
        $this->addSql('CREATE TABLE participant (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, event_id INTEGER DEFAULT NULL, identifier CLOB NOT NULL, time_needed_in_minutes INTEGER DEFAULT NULL, CONSTRAINT FK_D79F6B1171F7E88B FOREIGN KEY (event_id) REFERENCES event (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO participant (id, event_id) SELECT id, event_id FROM __temp__participant');
        $this->addSql('DROP TABLE __temp__participant');
        $this->addSql('CREATE INDEX IDX_D79F6B1171F7E88B ON participant (event_id)');
        $this->addSql('DROP INDEX IDX_DADD4A259D1C3019');
        $this->addSql('CREATE TEMPORARY TABLE __temp__answer AS SELECT id, participant_id, question_number, value FROM answer');
        $this->addSql('DROP TABLE answer');
        $this->addSql('CREATE TABLE answer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, participant_id INTEGER DEFAULT NULL, question_number INTEGER NOT NULL, value CLOB NOT NULL COLLATE BINARY, private BOOLEAN NOT NULL, CONSTRAINT FK_DADD4A259D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO answer (id, participant_id, question_number, value) SELECT id, participant_id, question_number, value FROM __temp__answer');
        $this->addSql('DROP TABLE __temp__answer');
        $this->addSql('CREATE INDEX IDX_DADD4A259D1C3019 ON answer (participant_id)');
        $this->addSql('DROP INDEX IDX_3BAE0AA74A798B6F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__event AS SELECT id, semester_id, name, date, feedback_start_time, feedback_end_time, template, template_name, has_lecture, has_exercise, final_template_version_loaded FROM event');
        $this->addSql('DROP TABLE event');
        $this->addSql('CREATE TABLE event (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, semester_id INTEGER DEFAULT NULL, name CLOB NOT NULL COLLATE BINARY, date CLOB NOT NULL COLLATE BINARY, feedback_start_time CLOB NOT NULL COLLATE BINARY, feedback_end_time CLOB NOT NULL COLLATE BINARY, template CLOB NOT NULL COLLATE BINARY, template_name CLOB NOT NULL COLLATE BINARY, has_lecture BOOLEAN NOT NULL, has_exercise BOOLEAN NOT NULL, final_template_version_loaded BOOLEAN NOT NULL, CONSTRAINT FK_3BAE0AA74A798B6F FOREIGN KEY (semester_id) REFERENCES semester (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO event (id, semester_id, name, date, feedback_start_time, feedback_end_time, template, template_name, has_lecture, has_exercise, final_template_version_loaded) SELECT id, semester_id, name, date, feedback_start_time, feedback_end_time, template, template_name, has_lecture, has_exercise, final_template_version_loaded FROM __temp__event');
        $this->addSql('DROP TABLE __temp__event');
        $this->addSql('CREATE INDEX IDX_3BAE0AA74A798B6F ON event (semester_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_DADD4A259D1C3019');
        $this->addSql('CREATE TEMPORARY TABLE __temp__answer AS SELECT id, participant_id, question_number, value FROM answer');
        $this->addSql('DROP TABLE answer');
        $this->addSql('CREATE TABLE answer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, participant_id INTEGER DEFAULT NULL, question_number INTEGER NOT NULL, value CLOB NOT NULL)');
        $this->addSql('INSERT INTO answer (id, participant_id, question_number, value) SELECT id, participant_id, question_number, value FROM __temp__answer');
        $this->addSql('DROP TABLE __temp__answer');
        $this->addSql('CREATE INDEX IDX_DADD4A259D1C3019 ON answer (participant_id)');
        $this->addSql('DROP INDEX IDX_3BAE0AA74A798B6F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__event AS SELECT id, semester_id, name, date, feedback_start_time, feedback_end_time, template, template_name, has_lecture, has_exercise, final_template_version_loaded FROM event');
        $this->addSql('DROP TABLE event');
        $this->addSql('CREATE TABLE event (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, semester_id INTEGER DEFAULT NULL, name CLOB NOT NULL, date CLOB NOT NULL, feedback_start_time CLOB NOT NULL, feedback_end_time CLOB NOT NULL, template CLOB NOT NULL, template_name CLOB NOT NULL, has_lecture BOOLEAN NOT NULL, has_exercise BOOLEAN NOT NULL, final_template_version_loaded BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO event (id, semester_id, name, date, feedback_start_time, feedback_end_time, template, template_name, has_lecture, has_exercise, final_template_version_loaded) SELECT id, semester_id, name, date, feedback_start_time, feedback_end_time, template, template_name, has_lecture, has_exercise, final_template_version_loaded FROM __temp__event');
        $this->addSql('DROP TABLE __temp__event');
        $this->addSql('CREATE INDEX IDX_3BAE0AA74A798B6F ON event (semester_id)');
        $this->addSql('DROP INDEX IDX_D79F6B1171F7E88B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__participant AS SELECT id, event_id FROM participant');
        $this->addSql('DROP TABLE participant');
        $this->addSql('CREATE TABLE participant (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, event_id INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO participant (id, event_id) SELECT id, event_id FROM __temp__participant');
        $this->addSql('DROP TABLE __temp__participant');
        $this->addSql('CREATE INDEX IDX_D79F6B1171F7E88B ON participant (event_id)');
    }
}
