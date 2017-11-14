<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171003111448 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE kp_local_calls_daily (id INT AUTO_INCREMENT NOT NULL, day_num INT NOT NULL, calls_locals INT NOT NULL, month INT NOT NULL, year INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kp_organic_apps_daily (id INT AUTO_INCREMENT NOT NULL, day_num INT NOT NULL, organic_apps INT NOT NULL, state VARCHAR(50) NOT NULL, month INT NOT NULL, year INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kp_organic_calls_daily (id INT AUTO_INCREMENT NOT NULL, day_num INT NOT NULL, organic_calls INT NOT NULL, state VARCHAR(50) NOT NULL, month INT NOT NULL, year INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kp_ppc_apps_daily (id INT AUTO_INCREMENT NOT NULL, day_num INT NOT NULL, ppc_apps INT NOT NULL, state VARCHAR(50) NOT NULL, month INT NOT NULL, year INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE kp_local_calls_daily');
        $this->addSql('DROP TABLE kp_organic_apps_daily');
        $this->addSql('DROP TABLE kp_organic_calls_daily');
        $this->addSql('DROP TABLE kp_ppc_apps_daily');
    }
}
