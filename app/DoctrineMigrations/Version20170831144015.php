<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170831144015 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE apps_organic_daily CHANGE date date VARCHAR(50) NOT NULL, CHANGE state state VARCHAR(50) NOT NULL, CHANGE type type INT NOT NULL, CHANGE referrer referrer VARCHAR(150) NOT NULL, CHANGE count count INT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE apps_organic_daily CHANGE date date VARCHAR(50) DEFAULT NULL COLLATE utf8_general_ci, CHANGE state state VARCHAR(50) DEFAULT NULL COLLATE utf8_general_ci, CHANGE type type INT DEFAULT NULL, CHANGE referrer referrer VARCHAR(150) DEFAULT NULL COLLATE utf8_general_ci, CHANGE count count INT DEFAULT NULL');
    }
}
