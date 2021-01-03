<?php

declare(strict_types=1);

namespace Src\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210103150523 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Course (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(50) NOT NULL)');
        $this->addSql('CREATE TABLE course_student (course_id INTEGER NOT NULL, student_id INTEGER NOT NULL, PRIMARY KEY(course_id, student_id))');
        $this->addSql('CREATE INDEX IDX_BFE0AADF591CC992 ON course_student (course_id)');
        $this->addSql('CREATE INDEX IDX_BFE0AADFCB944F1A ON course_student (student_id)');
        $this->addSql('DROP INDEX IDX_83DFDFA4A8DFBF62');
        $this->addSql('CREATE TEMPORARY TABLE __temp__Contact AS SELECT id, _student_id, cellphone FROM Contact');
        $this->addSql('DROP TABLE Contact');
        $this->addSql('CREATE TABLE Contact (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, _student_id INTEGER DEFAULT NULL, cellphone VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_83DFDFA4A8DFBF62 FOREIGN KEY (_student_id) REFERENCES Student (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO Contact (id, _student_id, cellphone) SELECT id, _student_id, cellphone FROM __temp__Contact');
        $this->addSql('DROP TABLE __temp__Contact');
        $this->addSql('CREATE INDEX IDX_83DFDFA4A8DFBF62 ON Contact (_student_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE Course');
        $this->addSql('DROP TABLE course_student');
        $this->addSql('DROP INDEX IDX_83DFDFA4A8DFBF62');
        $this->addSql('CREATE TEMPORARY TABLE __temp__Contact AS SELECT id, _student_id, cellphone FROM Contact');
        $this->addSql('DROP TABLE Contact');
        $this->addSql('CREATE TABLE Contact (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, _student_id INTEGER DEFAULT NULL, cellphone VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO Contact (id, _student_id, cellphone) SELECT id, _student_id, cellphone FROM __temp__Contact');
        $this->addSql('DROP TABLE __temp__Contact');
        $this->addSql('CREATE INDEX IDX_83DFDFA4A8DFBF62 ON Contact (_student_id)');
    }
}
