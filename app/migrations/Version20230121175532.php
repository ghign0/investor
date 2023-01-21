<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\Uid\Uuid;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230121175532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        # CATEGORIE
        $idContoCorrente = Uuid::v7()->toBinary();
        $idContoDeposito = Uuid::v7()->toBinary();
        $idAzionario = Uuid::v7()->toBinary();
        $idObbligazionario = Uuid::v7()->toBinary();
        $dFondiInvestimento = Uuid::v7()->toBinary();
        $idCripto = Uuid::v7()->toBinary();
        $this->addSql("INSERT INTO category (id, name, code) VALUES ( '$idContoCorrente', 'Conto Corrente', 'conto-corrente' ) ");
        $this->addSql("INSERT INTO category (id, name, code) VALUES ( '$idContoDeposito', 'Conto Deposito', 'conto-deposito' ) ");
        $this->addSql("INSERT INTO category (id, name, code) VALUES ( '$idAzionario', 'Azionario', 'azionario' ) ");
        $this->addSql("INSERT INTO category (id, name, code) VALUES ( '$idObbligazionario', 'Obbligazionario', 'obbligazionario' ) ");
        $this->addSql("INSERT INTO category (id, name, code) VALUES ( '$dFondiInvestimento', 'Fondo Investimento', 'fondo-investimento' ) ");
        $this->addSql("INSERT INTO category (id, name, code) VALUES ( '$idCripto', 'Cripto', 'cripto' ) ");

        #TIPOLOGIE
        $idSaving = Uuid::v7()->toBinary();
        $idInvesting = Uuid::v7()->toBinary();
        $idTrading = Uuid::v7()->toBinary();
        $this->addSql("INSERT INTO type (id, name, code) VALUES ( '$idSaving', 'Saving', 'saving' ) ");
        $this->addSql("INSERT INTO type (id, name, code) VALUES ( '$idInvesting', 'Investing', 'investing' ) ");
        $this->addSql("INSERT INTO type (id, name, code) VALUES ( '$idTrading', 'Trading', 'trading' ) ");


        #RISCHIO
        $idLow = Uuid::v7()->toBinary();
        $idMiddle = Uuid::v7()->toBinary();
        $idHigh = Uuid::v7()->toBinary();
        $this->addSql("INSERT INTO risk (id, name, code) VALUES ( '$idLow', 'Basso', 'basso' ) ");
        $this->addSql("INSERT INTO risk (id, name, code) VALUES ( '$idMiddle', 'Medio', 'medio' ) ");
        $this->addSql("INSERT INTO risk (id, name, code) VALUES ( '$idHigh', 'Alto', 'alto' ) ");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
