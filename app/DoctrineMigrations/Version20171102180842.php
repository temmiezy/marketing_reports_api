<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171102180842 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE kp_organic_apps_daily CHANGE data_date data_date VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE kp_organic_calls_daily CHANGE data_date data_date VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE kp_ppc_apps_daily CHANGE data_date data_date VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE apps_organic_daily CHANGE data_id data_id INT NOT NULL');
        $this->addSql('ALTER TABLE ppc_type_state CHANGE data_id data_id INT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE apps_organic_daily CHANGE data_id data_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE kp_organic_apps_daily CHANGE data_date data_date VARCHAR(50) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE kp_organic_calls_daily CHANGE data_date data_date VARCHAR(50) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE kp_ppc_apps_daily CHANGE data_date data_date VARCHAR(50) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE ppc_type_state CHANGE data_id data_id INT DEFAULT NULL');
    }
}
