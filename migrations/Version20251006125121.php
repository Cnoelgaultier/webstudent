<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251006125121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE baguette (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, taille DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composition (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composition_baguette (composition_id INT NOT NULL, baguette_id INT NOT NULL, INDEX IDX_89A60F2287A2E12 (composition_id), INDEX IDX_89A60F22513FF34B (baguette_id), PRIMARY KEY(composition_id, baguette_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, code INT NOT NULL, libelle VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE composition_baguette ADD CONSTRAINT FK_89A60F2287A2E12 FOREIGN KEY (composition_id) REFERENCES composition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composition_baguette ADD CONSTRAINT FK_89A60F22513FF34B FOREIGN KEY (baguette_id) REFERENCES baguette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve ADD promotion_id INT DEFAULT NULL, ADD baguette_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7513FF34B FOREIGN KEY (baguette_id) REFERENCES baguette (id)');
        $this->addSql('CREATE INDEX IDX_ECA105F7139DF194 ON eleve (promotion_id)');
        $this->addSql('CREATE INDEX IDX_ECA105F7513FF34B ON eleve (baguette_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7513FF34B');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7139DF194');
        $this->addSql('ALTER TABLE composition_baguette DROP FOREIGN KEY FK_89A60F2287A2E12');
        $this->addSql('ALTER TABLE composition_baguette DROP FOREIGN KEY FK_89A60F22513FF34B');
        $this->addSql('DROP TABLE baguette');
        $this->addSql('DROP TABLE composition');
        $this->addSql('DROP TABLE composition_baguette');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP INDEX IDX_ECA105F7139DF194 ON eleve');
        $this->addSql('DROP INDEX IDX_ECA105F7513FF34B ON eleve');
        $this->addSql('ALTER TABLE eleve DROP promotion_id, DROP baguette_id');
    }
}
