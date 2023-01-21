<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230121151157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Prime tabelle di base - asset, category, risk, type';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asset (id VARCHAR(255) NOT NULL, category_id VARCHAR(255) DEFAULT NULL, type_id VARCHAR(255) DEFAULT NULL, risk_id VARCHAR(255) DEFAULT NULL, parent VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, note TINYTEXT NOT NULL, extra_data JSON NOT NULL, INDEX IDX_2AF5A5C12469DE2 (category_id), INDEX IDX_2AF5A5CC54C8C93 (type_id), INDEX IDX_2AF5A5C235B6D1 (risk_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, note TINYTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE risk (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, note TINYTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, note TINYTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE asset ADD CONSTRAINT FK_2AF5A5C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE asset ADD CONSTRAINT FK_2AF5A5CC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE asset ADD CONSTRAINT FK_2AF5A5C235B6D1 FOREIGN KEY (risk_id) REFERENCES risk (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asset DROP FOREIGN KEY FK_2AF5A5C12469DE2');
        $this->addSql('ALTER TABLE asset DROP FOREIGN KEY FK_2AF5A5CC54C8C93');
        $this->addSql('ALTER TABLE asset DROP FOREIGN KEY FK_2AF5A5C235B6D1');
        $this->addSql('DROP TABLE asset');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE risk');
        $this->addSql('DROP TABLE type');
    }
}
