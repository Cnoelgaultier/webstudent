<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251006125606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, code INT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence_professeur (competence_id INT NOT NULL, professeur_id INT NOT NULL, INDEX IDX_3925EA6E15761DAB (competence_id), INDEX IDX_3925EA6EBAB22EE9 (professeur_id), PRIMARY KEY(competence_id, professeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve_matiere (eleve_id INT NOT NULL, matiere_id INT NOT NULL, INDEX IDX_7CAE6C56A6CC7B2 (eleve_id), INDEX IDX_7CAE6C56F46CD258 (matiere_id), PRIMARY KEY(eleve_id, matiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve_competence (eleve_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_96EE872DA6CC7B2 (eleve_id), INDEX IDX_96EE872D15761DAB (competence_id), PRIMARY KEY(eleve_id, competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, nb_eleves_max INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere_competence (matiere_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_461CE3D1F46CD258 (matiere_id), INDEX IDX_461CE3D115761DAB (competence_id), PRIMARY KEY(matiere_id, competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, date_naiss DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competence_professeur ADD CONSTRAINT FK_3925EA6E15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_professeur ADD CONSTRAINT FK_3925EA6EBAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve_matiere ADD CONSTRAINT FK_7CAE6C56A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve_matiere ADD CONSTRAINT FK_7CAE6C56F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve_competence ADD CONSTRAINT FK_96EE872DA6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve_competence ADD CONSTRAINT FK_96EE872D15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matiere_competence ADD CONSTRAINT FK_461CE3D1F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matiere_competence ADD CONSTRAINT FK_461CE3D115761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competence_professeur DROP FOREIGN KEY FK_3925EA6E15761DAB');
        $this->addSql('ALTER TABLE competence_professeur DROP FOREIGN KEY FK_3925EA6EBAB22EE9');
        $this->addSql('ALTER TABLE eleve_matiere DROP FOREIGN KEY FK_7CAE6C56A6CC7B2');
        $this->addSql('ALTER TABLE eleve_matiere DROP FOREIGN KEY FK_7CAE6C56F46CD258');
        $this->addSql('ALTER TABLE eleve_competence DROP FOREIGN KEY FK_96EE872DA6CC7B2');
        $this->addSql('ALTER TABLE eleve_competence DROP FOREIGN KEY FK_96EE872D15761DAB');
        $this->addSql('ALTER TABLE matiere_competence DROP FOREIGN KEY FK_461CE3D1F46CD258');
        $this->addSql('ALTER TABLE matiere_competence DROP FOREIGN KEY FK_461CE3D115761DAB');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE competence_professeur');
        $this->addSql('DROP TABLE eleve_matiere');
        $this->addSql('DROP TABLE eleve_competence');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE matiere_competence');
        $this->addSql('DROP TABLE professeur');
    }
}
