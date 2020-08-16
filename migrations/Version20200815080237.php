<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200815080237 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE setting (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, keywords VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, company VARCHAR(255) DEFAULT NULL, adress VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, fax VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, smtpserver VARCHAR(255) DEFAULT NULL, smtpemail VARCHAR(255) DEFAULT NULL, smtppassword VARCHAR(255) DEFAULT NULL, smtpport VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, instagram VARCHAR(255) DEFAULT NULL, twitter VARCHAR(255) DEFAULT NULL, aboutus LONGTEXT DEFAULT NULL, contact LONGTEXT DEFAULT NULL, reference LONGTEXT DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE setting');
    }
}
