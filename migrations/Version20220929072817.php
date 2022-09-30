<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220929072817 extends AbstractMigration
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
        $this->addSql('CREATE TABLE heros (id INT AUTO_INCREMENT NOT NULL, class_heros_id INT NOT NULL, name VARCHAR(50) NOT NULL, birth_date DATE NOT NULL, level INT NOT NULL, experience INT NOT NULL, description LONGTEXT NOT NULL, healt_point INT NOT NULL, INDEX IDX_1F842770B66E9373 (class_heros_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE class_skills ADD CONSTRAINT FK_1A6D54C8B66E9373 FOREIGN KEY (class_heros_id) REFERENCES class_heros (id)');
        $this->addSql('ALTER TABLE heros ADD CONSTRAINT FK_1F842770B66E9373 FOREIGN KEY (class_heros_id) REFERENCES class_heros (id)');
        $this->addSql('ALTER TABLE plante DROP FOREIGN KEY FK_517A6947C35E566A');
        $this->addSql('DROP TABLE plant_family');
        $this->addSql('DROP TABLE plante');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE plant_family (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE plante (id INT AUTO_INCREMENT NOT NULL, family_id INT DEFAULT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, date_semis DATE DEFAULT NULL, date_floraison DATE DEFAULT NULL, INDEX IDX_517A6947C35E566A (family_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE plante ADD CONSTRAINT FK_517A6947C35E566A FOREIGN KEY (family_id) REFERENCES plant_family (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE class_skills DROP FOREIGN KEY FK_1A6D54C8B66E9373');
        $this->addSql('ALTER TABLE heros DROP FOREIGN KEY FK_1F842770B66E9373');
        $this->addSql('DROP TABLE class_heros');
        $this->addSql('DROP TABLE class_skills');
        $this->addSql('DROP TABLE heros');
    }
}
