<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180618154109 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE fournisseurs (id INT AUTO_INCREMENT NOT NULL, nom_fournisseur VARCHAR(255) NOT NULL, prenom_fournisseur VARCHAR(255) DEFAULT NULL, situation_geographique VARCHAR(255) DEFAULT NULL, telephone_fournisseur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits_fournisseurs (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, fournisseur_id INT NOT NULL, prix INT NOT NULL, INDEX IDX_407B2DC3F347EFB (produit_id), INDEX IDX_407B2DC3670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produits_fournisseurs ADD CONSTRAINT FK_407B2DC3F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produits_fournisseurs ADD CONSTRAINT FK_407B2DC3670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseurs (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produits_fournisseurs DROP FOREIGN KEY FK_407B2DC3670C757F');
        $this->addSql('DROP TABLE fournisseurs');
        $this->addSql('DROP TABLE produits_fournisseurs');
    }
}
