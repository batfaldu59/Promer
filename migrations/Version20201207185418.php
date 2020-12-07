<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201207185418 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create Produits';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Produits (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, composition LONGTEXT NOT NULL, mod_emploi LONGTEXT NOT NULL, precaution_emploi LONGTEXT NOT NULL, conditionnement VARCHAR(50) NOT NULL, poids_brut NUMERIC(10, 2) NOT NULL, poids_net NUMERIC(10, 2) NOT NULL, nb_unite_colis INT NOT NULL, nb_unite_palette INT NOT NULL, densite VARCHAR(5) NOT NULL, p_h VARCHAR(255) NOT NULL, couleur VARCHAR(255) NOT NULL, dimension_unite_produit VARCHAR(50) NOT NULL, dimension_unite_colis VARCHAR(50) NOT NULL, dimension_palette VARCHAR(50) NOT NULL, reference VARCHAR(25) NOT NULL, image_produit VARCHAR(255) NOT NULL, nom_chimique VARCHAR(50) NOT NULL, prix_colis INT NOT NULL, prix_palette INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE Produits');
    }
}
