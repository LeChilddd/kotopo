<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220619161054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, service_id INT NOT NULL, total DOUBLE PRECISION NOT NULL, is_payed TINYINT(1) NOT NULL, INDEX IDX_90651744A76ED395 (user_id), INDEX IDX_90651744ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice_payment (id INT AUTO_INCREMENT NOT NULL, payment_id INT NOT NULL, amount DOUBLE PRECISION NOT NULL, INDEX IDX_9FF1B2DE4C3A3BB (payment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesson_invoice (id INT AUTO_INCREMENT NOT NULL, invoice_id INT NOT NULL, session_id INT NOT NULL, number_of_session INT NOT NULL, INDEX IDX_651945E32989F1FD (invoice_id), INDEX IDX_651945E3613FECDF (session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, language_id INT NOT NULL, user_teacher_id INT NOT NULL, INDEX IDX_D044D5D482F1BAF4 (language_id), INDEX IDX_D044D5D4E6E7B8F1 (user_teacher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_session (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, session_id INT NOT NULL, INDEX IDX_8849CBDEA76ED395 (user_id), INDEX IDX_8849CBDE613FECDF (session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE invoice_payment ADD CONSTRAINT FK_9FF1B2DE4C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE lesson_invoice ADD CONSTRAINT FK_651945E32989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
        $this->addSql('ALTER TABLE lesson_invoice ADD CONSTRAINT FK_651945E3613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D482F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4E6E7B8F1 FOREIGN KEY (user_teacher_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_session ADD CONSTRAINT FK_8849CBDEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_session ADD CONSTRAINT FK_8849CBDE613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE membership ADD invoice_id INT NOT NULL');
        $this->addSql('ALTER TABLE membership ADD CONSTRAINT FK_86FFD2852989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
        $this->addSql('CREATE INDEX IDX_86FFD2852989F1FD ON membership (invoice_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesson_invoice DROP FOREIGN KEY FK_651945E32989F1FD');
        $this->addSql('ALTER TABLE membership DROP FOREIGN KEY FK_86FFD2852989F1FD');
        $this->addSql('ALTER TABLE lesson_invoice DROP FOREIGN KEY FK_651945E3613FECDF');
        $this->addSql('ALTER TABLE user_session DROP FOREIGN KEY FK_8849CBDE613FECDF');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE invoice_payment');
        $this->addSql('DROP TABLE lesson_invoice');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE user_session');
        $this->addSql('DROP INDEX IDX_86FFD2852989F1FD ON membership');
        $this->addSql('ALTER TABLE membership DROP invoice_id');
    }
}
