<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180322092905 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(20) NOT NULL, name VARCHAR(20) NOT NULL, email VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE account');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AA71619AAE FOREIGN KEY (visitor_id_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AAA3867605 FOREIGN KEY (agents_id_id) REFERENCES author (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AA71619AAE');
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AAA3867605');
        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(20) NOT NULL COLLATE utf8_unicode_ci, name VARCHAR(20) NOT NULL COLLATE utf8_unicode_ci, email VARCHAR(40) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE author');
    }
}
