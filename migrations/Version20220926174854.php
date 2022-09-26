<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220926174854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE class_skills (id INT AUTO_INCREMENT NOT NULL, class_heros_id INT DEFAULT NULL, skill_name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_1A6D54C8B66E9373 (class_heros_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE class_skills ADD CONSTRAINT FK_1A6D54C8B66E9373 FOREIGN KEY (class_heros_id) REFERENCES class_heros (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE class_skills DROP FOREIGN KEY FK_1A6D54C8B66E9373');
        $this->addSql('DROP TABLE class_skills');
    }
}
