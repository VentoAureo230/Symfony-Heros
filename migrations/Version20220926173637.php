<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220926173637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE class_heros (id INT AUTO_INCREMENT NOT NULL, class_name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE heros (id INT AUTO_INCREMENT NOT NULL, class_heros_id INT NOT NULL, name VARCHAR(50) NOT NULL, birth_date DATE NOT NULL, level INT NOT NULL, experience INT NOT NULL, description LONGTEXT NOT NULL, healt_point INT NOT NULL, INDEX IDX_1F842770B66E9373 (class_heros_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE heros ADD CONSTRAINT FK_1F842770B66E9373 FOREIGN KEY (class_heros_id) REFERENCES class_heros (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE heros DROP FOREIGN KEY FK_1F842770B66E9373');
        $this->addSql('DROP TABLE class_heros');
        $this->addSql('DROP TABLE heros');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
