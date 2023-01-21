<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230121175527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asset (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', category_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', type_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', risk_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', parent VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, note TINYTEXT DEFAULT NULL, extra_data JSON DEFAULT NULL, INDEX IDX_2AF5A5C12469DE2 (category_id), INDEX IDX_2AF5A5CC54C8C93 (type_id), INDEX IDX_2AF5A5C235B6D1 (risk_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, note TINYTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE risk (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, note TINYTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, note TINYTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
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
