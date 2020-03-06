<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200305152829 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE card (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image LONGTEXT DEFAULT NULL, life INT NOT NULL, attack INT NOT NULL, INDEX IDX_161498D312469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE card_user (card_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_61A0D4EB4ACC9A20 (card_id), INDEX IDX_61A0D4EBA76ED395 (user_id), PRIMARY KEY(card_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE card_user ADD CONSTRAINT FK_61A0D4EB4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE card_user ADD CONSTRAINT FK_61A0D4EBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card_user DROP FOREIGN KEY FK_61A0D4EB4ACC9A20');
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D312469DE2');
        $this->addSql('ALTER TABLE card_user DROP FOREIGN KEY FK_61A0D4EBA76ED395');
        $this->addSql('DROP TABLE card');
        $this->addSql('DROP TABLE card_user');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE user');
    }
}
