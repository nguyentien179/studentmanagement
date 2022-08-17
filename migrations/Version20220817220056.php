<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220817220056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classes (id INT AUTO_INCREMENT NOT NULL, class_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, course_name_id INT DEFAULT NULL, course_info VARCHAR(255) NOT NULL, grade DOUBLE PRECISION NOT NULL, INDEX IDX_169E6FB979D4993A (course_name_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_student (course_id INT NOT NULL, student_id INT NOT NULL, INDEX IDX_BFE0AADF591CC992 (course_id), INDEX IDX_BFE0AADFCB944F1A (student_id), PRIMARY KEY(course_id, student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_subject (course_id INT NOT NULL, subject_id INT NOT NULL, INDEX IDX_F30D3B96591CC992 (course_id), INDEX IDX_F30D3B9623EDC87 (subject_id), PRIMARY KEY(course_id, subject_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE major (id INT AUTO_INCREMENT NOT NULL, major_name VARCHAR(255) NOT NULL, major_info VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semester (id INT AUTO_INCREMENT NOT NULL, semester_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, major_id_id INT DEFAULT NULL, class_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_B723AF33312DAEDA (major_id_id), INDEX IDX_B723AF339993BF61 (class_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id INT AUTO_INCREMENT NOT NULL, subject_id_id INT DEFAULT NULL, subject_info VARCHAR(255) NOT NULL, INDEX IDX_FBCE3E7A6ED75F8F (subject_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB979D4993A FOREIGN KEY (course_name_id) REFERENCES semester (id)');
        $this->addSql('ALTER TABLE course_student ADD CONSTRAINT FK_BFE0AADF591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_student ADD CONSTRAINT FK_BFE0AADFCB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_subject ADD CONSTRAINT FK_F30D3B96591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_subject ADD CONSTRAINT FK_F30D3B9623EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33312DAEDA FOREIGN KEY (major_id_id) REFERENCES major (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF339993BF61 FOREIGN KEY (class_id_id) REFERENCES classes (id)');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7A6ED75F8F FOREIGN KEY (subject_id_id) REFERENCES major (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB979D4993A');
        $this->addSql('ALTER TABLE course_student DROP FOREIGN KEY FK_BFE0AADF591CC992');
        $this->addSql('ALTER TABLE course_student DROP FOREIGN KEY FK_BFE0AADFCB944F1A');
        $this->addSql('ALTER TABLE course_subject DROP FOREIGN KEY FK_F30D3B96591CC992');
        $this->addSql('ALTER TABLE course_subject DROP FOREIGN KEY FK_F30D3B9623EDC87');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33312DAEDA');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF339993BF61');
        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7A6ED75F8F');
        $this->addSql('DROP TABLE classes');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE course_student');
        $this->addSql('DROP TABLE course_subject');
        $this->addSql('DROP TABLE major');
        $this->addSql('DROP TABLE semester');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE subject');
    }
}
