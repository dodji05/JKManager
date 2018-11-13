<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180620084750 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE approvisionement (id INT AUTO_INCREMENT NOT NULL, date_appro DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE details_appro (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, fournisseur_id INT DEFAULT NULL, approvision_id INT DEFAULT NULL, prix_appro INT NOT NULL, INDEX IDX_D55A07EF347EFB (produit_id), INDEX IDX_D55A07E670C757F (fournisseur_id), INDEX IDX_D55A07E3F88B742 (approvision_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE details_appro ADD CONSTRAINT FK_D55A07EF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE details_appro ADD CONSTRAINT FK_D55A07E670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseurs (id)');
        $this->addSql('ALTER TABLE details_appro ADD CONSTRAINT FK_D55A07E3F88B742 FOREIGN KEY (approvision_id) REFERENCES approvisionement (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE details_appro DROP FOREIGN KEY FK_D55A07E3F88B742');
        $this->addSql('DROP TABLE approvisionement');
        $this->addSql('DROP TABLE details_appro');
    }
}
