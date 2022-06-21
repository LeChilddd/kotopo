<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220619164655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice ADD invoice_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE membership ADD validity_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD expired_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE payment ADD date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE session ADD date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD last_login DATETIME NOT NULL, ADD expired_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E4AF4C20 ON user (card_number)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice DROP invoice_date');
        $this->addSql('ALTER TABLE membership DROP validity_at, DROP expired_at');
        $this->addSql('ALTER TABLE payment DROP date');
        $this->addSql('ALTER TABLE session DROP date');
        $this->addSql('DROP INDEX UNIQ_8D93D649E4AF4C20 ON user');
        $this->addSql('ALTER TABLE user DROP created_at, DROP last_login, DROP expired_at');
    }
}
