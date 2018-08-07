<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180322130558 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AA71619AAE');
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AAA3867605');
        $this->addSql('DROP INDEX IDX_659DF2AA71619AAE ON chat');
        $this->addSql('DROP INDEX IDX_659DF2AAA3867605 ON chat');
        $this->addSql('ALTER TABLE chat ADD visitor_id INT DEFAULT NULL, ADD agent_id INT DEFAULT NULL, DROP visitor_id_id, DROP agents_id_id');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AA70BEE6D FOREIGN KEY (visitor_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AA3414710B FOREIGN KEY (agent_id) REFERENCES author (id)');
        $this->addSql('CREATE INDEX IDX_659DF2AA70BEE6D ON chat (visitor_id)');
        $this->addSql('CREATE INDEX IDX_659DF2AA3414710B ON chat (agent_id)');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F7E3973CC');
        $this->addSql('DROP INDEX IDX_B6BD307F7E3973CC ON message');
        $this->addSql('ALTER TABLE message CHANGE chat_id_id chat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F1A9A7125 FOREIGN KEY (chat_id) REFERENCES chat (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F1A9A7125 ON message (chat_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AA70BEE6D');
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AA3414710B');
        $this->addSql('DROP INDEX IDX_659DF2AA70BEE6D ON chat');
        $this->addSql('DROP INDEX IDX_659DF2AA3414710B ON chat');
        $this->addSql('ALTER TABLE chat ADD visitor_id_id INT DEFAULT NULL, ADD agents_id_id INT DEFAULT NULL, DROP visitor_id, DROP agent_id');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AA71619AAE FOREIGN KEY (visitor_id_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AAA3867605 FOREIGN KEY (agents_id_id) REFERENCES author (id)');
        $this->addSql('CREATE INDEX IDX_659DF2AA71619AAE ON chat (visitor_id_id)');
        $this->addSql('CREATE INDEX IDX_659DF2AAA3867605 ON chat (agents_id_id)');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F1A9A7125');
        $this->addSql('DROP INDEX IDX_B6BD307F1A9A7125 ON message');
        $this->addSql('ALTER TABLE message CHANGE chat_id chat_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F7E3973CC FOREIGN KEY (chat_id_id) REFERENCES chat (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F7E3973CC ON message (chat_id_id)');
    }
}
