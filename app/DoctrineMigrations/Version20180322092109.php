<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180322092109 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chat ADD visitor_id_id INT DEFAULT NULL, ADD agents_id_id INT DEFAULT NULL, DROP visitorId, DROP agentsId');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AA71619AAE FOREIGN KEY (visitor_id_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AAA3867605 FOREIGN KEY (agents_id_id) REFERENCES author (id)');
        $this->addSql('CREATE INDEX IDX_659DF2AA71619AAE ON chat (visitor_id_id)');
        $this->addSql('CREATE INDEX IDX_659DF2AAA3867605 ON chat (agents_id_id)');
        $this->addSql('ALTER TABLE message ADD chat_id_id INT DEFAULT NULL, DROP chatId');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F7E3973CC FOREIGN KEY (chat_id_id) REFERENCES chat (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F7E3973CC ON message (chat_id_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AA71619AAE');
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AAA3867605');
        $this->addSql('DROP INDEX IDX_659DF2AA71619AAE ON chat');
        $this->addSql('DROP INDEX IDX_659DF2AAA3867605 ON chat');
        $this->addSql('ALTER TABLE chat ADD visitorId INT NOT NULL, ADD agentsId LONGTEXT NOT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:array)\', DROP visitor_id_id, DROP agents_id_id');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F7E3973CC');
        $this->addSql('DROP INDEX IDX_B6BD307F7E3973CC ON message');
        $this->addSql('ALTER TABLE message ADD chatId INT NOT NULL, DROP chat_id_id');
    }
}
