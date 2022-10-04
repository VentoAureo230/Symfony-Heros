<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221004210509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE class_heros (id INT AUTO_INCREMENT NOT NULL, class_name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE class_skills (id INT AUTO_INCREMENT NOT NULL, class_heros_id INT DEFAULT NULL, skill_name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_1A6D54C8B66E9373 (class_heros_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE heros (id INT AUTO_INCREMENT NOT NULL, class_heros_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, birth_date DATE NOT NULL, level INT NOT NULL, experience INT NOT NULL, description LONGTEXT NOT NULL, healt_point INT NOT NULL, INDEX IDX_1F842770B66E9373 (class_heros_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, full_name VARCHAR(50) NOT NULL, pseudo VARCHAR(50) NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE class_skills ADD CONSTRAINT FK_1A6D54C8B66E9373 FOREIGN KEY (class_heros_id) REFERENCES class_heros (id)');
        $this->addSql('ALTER TABLE heros ADD CONSTRAINT FK_1F842770B66E9373 FOREIGN KEY (class_heros_id) REFERENCES class_heros (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE class_skills DROP FOREIGN KEY FK_1A6D54C8B66E9373');
        $this->addSql('ALTER TABLE heros DROP FOREIGN KEY FK_1F842770B66E9373');
        $this->addSql('DROP TABLE class_heros');
        $this->addSql('DROP TABLE class_skills');
        $this->addSql('DROP TABLE heros');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
