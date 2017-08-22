<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170613200040 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE metiers (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, remote_id INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier_user (metier_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_2C121269ED16FA20 (metier_id), INDEX IDX_2C121269A76ED395 (user_id), PRIMARY KEY(metier_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, task VARCHAR(255) NOT NULL, estimation VARCHAR(255) NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', is_scientist TINYINT(1) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, avatar_uri VARCHAR(255) DEFAULT NULL, university_name VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE metier_user ADD CONSTRAINT FK_2C121269ED16FA20 FOREIGN KEY (metier_id) REFERENCES metiers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metier_user ADD CONSTRAINT FK_2C121269A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE metier_user DROP FOREIGN KEY FK_2C121269ED16FA20');
        $this->addSql('ALTER TABLE metier_user DROP FOREIGN KEY FK_2C121269A76ED395');
        $this->addSql('DROP TABLE metiers');
        $this->addSql('DROP TABLE metier_user');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE user');
    }
}
