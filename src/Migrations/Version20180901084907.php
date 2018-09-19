<?php

/** @noinspection ALL */

declare(strict_types=1);

/*
 * This file is part of the symfony-template project.
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
final class Version20180901084907 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE frontend_user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, is_administrator BOOLEAN NOT NULL, receives_administrator_mail BOOLEAN NOT NULL, email CLOB NOT NULL, password_hash CLOB NOT NULL, reset_hash CLOB NOT NULL, can_login BOOLEAN NOT NULL, registration_date DATETIME DEFAULT NULL, last_login DATETIME DEFAULT NULL, job_title CLOB DEFAULT NULL, given_name CLOB NOT NULL, family_name CLOB NOT NULL, street CLOB NOT NULL, street_nr CLOB NOT NULL, address_line CLOB DEFAULT NULL, postal_code INTEGER NOT NULL, city CLOB NOT NULL, country CLOB NOT NULL, deleted_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E2D1DEAE7927C74 ON frontend_user (email)');
        $this->addSql('CREATE TABLE setting (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_by_id INTEGER DEFAULT NULL, last_changed_by_id INTEGER DEFAULT NULL, max_show_users_in_list INTEGER NOT NULL, created_at DATETIME DEFAULT NULL, last_changed_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_9F74B898B03A8386 ON setting (created_by_id)');
        $this->addSql('CREATE INDEX IDX_9F74B898EE85B337 ON setting (last_changed_by_id)');
        $this->addSql('CREATE TABLE email (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, receiver CLOB NOT NULL, identifier CLOB NOT NULL, subject CLOB NOT NULL, body CLOB NOT NULL, action_text CLOB DEFAULT NULL, action_link CLOB DEFAULT NULL, carbon_copy CLOB DEFAULT NULL, email_type INTEGER NOT NULL, sent_date_time DATETIME NOT NULL, visited_date_time DATETIME DEFAULT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE frontend_user');
        $this->addSql('DROP TABLE setting');
        $this->addSql('DROP TABLE email');
    }
}
