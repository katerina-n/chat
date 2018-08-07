<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180321171842 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE chat_user (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, name VARCHAR(40) NOT NULL, email VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chat_message (id INT AUTO_INCREMENT NOT NULL, text VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chat_service (id INT AUTO_INCREMENT NOT NULL, visitor VARCHAR(40) NOT NULL, agents LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chat CHANGE Obj Obj VARCHAR(40) NOT NULL, CHANGE Subj Subj VARCHAR(40) NOT NULL, CHANGE Date Date DATETIME NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE chat_user');
        $this->addSql('DROP TABLE chat_message');
        $this->addSql('DROP TABLE chat_service');
        $this->addSql('ALTER TABLE chat CHANGE Obj Obj VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE Subj Subj VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE Date Date DATETIME NOT NULL');
    }
}
