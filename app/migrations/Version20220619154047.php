<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220619154047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE membership (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_86FFD285A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_language_level (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, language_id INT DEFAULT NULL, level_id INT DEFAULT NULL, INDEX IDX_8E37171BA76ED395 (user_id), INDEX IDX_8E37171B82F1BAF4 (language_id), INDEX IDX_8E37171B5FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE membership ADD CONSTRAINT FK_86FFD285A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_language_level ADD CONSTRAINT FK_8E37171BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_language_level ADD CONSTRAINT FK_8E37171B82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE user_language_level ADD CONSTRAINT FK_8E37171B5FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE payment_method ADD payment_id INT NOT NULL');
        $this->addSql('ALTER TABLE payment_method ADD CONSTRAINT FK_7B61A1F64C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('CREATE INDEX IDX_7B61A1F64C3A3BB ON payment_method (payment_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment_method DROP FOREIGN KEY FK_7B61A1F64C3A3BB');
        $this->addSql('DROP TABLE membership');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE user_language_level');
        $this->addSql('DROP INDEX IDX_7B61A1F64C3A3BB ON payment_method');
        $this->addSql('ALTER TABLE payment_method DROP payment_id');
    }
}
