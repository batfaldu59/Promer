<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201231151740 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(25) NOT NULL, numsiret VARCHAR(14) NOT NULL, telephone INT NOT NULL, fax INT NOT NULL, statutjuridique VARCHAR(4) NOT NULL, code_ape VARCHAR(8) NOT NULL, num_voie INT NOT NULL, rue VARCHAR(50) NOT NULL, complementadresse VARCHAR(50) DEFAULT NULL, codepostal INT NOT NULL, ville VARCHAR(25) NOT NULL, pays VARCHAR(25) NOT NULL, UNIQUE INDEX UNIQ_D19FA60E7927C74 (email), UNIQUE INDEX UNIQ_D19FA604AB23A87 (numsiret), UNIQUE INDEX UNIQ_D19FA60450FF010 (telephone), UNIQUE INDEX UNIQ_D19FA609123CD68 (fax), UNIQUE INDEX UNIQ_D19FA604C93A38E (code_ape), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE entreprise');
    }
}
