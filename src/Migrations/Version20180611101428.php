<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180611101428 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, nom_client VARCHAR(255) DEFAULT NULL, prenom_client VARCHAR(255) DEFAULT NULL, telephone1 VARCHAR(255) NOT NULL, telephone2 VARCHAR(255) DEFAULT NULL, zone_geographique VARCHAR(255) NOT NULL, sexe VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, codeproduit VARCHAR(255) NOT NULL, libelle_produit VARCHAR(255) NOT NULL, prix_vente INT NOT NULL, image_produits VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock_produits (id INT AUTO_INCREMENT NOT NULL, produits_id INT DEFAULT NULL, qte_en_stock INT NOT NULL, UNIQUE INDEX UNIQ_F1EB8BCECD11A2CF (produits_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stock_produits ADD CONSTRAINT FK_F1EB8BCECD11A2CF FOREIGN KEY (produits_id) REFERENCES produit (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE stock_produits DROP FOREIGN KEY FK_F1EB8BCECD11A2CF');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE stock_produits');
    }
}
