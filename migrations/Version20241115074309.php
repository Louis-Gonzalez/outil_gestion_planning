<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241115074309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE schedule ADD date_id INT NOT NULL');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FBB897366B FOREIGN KEY (date_id) REFERENCES date (id)');
        $this->addSql('CREATE INDEX IDX_5A3811FBB897366B ON schedule (date_id)');
        // ici ajoute moi un rename de la colonne schedule_id_id en schedule_id de la table reservation
        $this->addSql('ALTER TABLE reservation RENAME COLUMN schedule_id_id TO schedule_id');
        // ici ajoute moi un rename de la colonne company_id_id en company_id de la table reservation
        $this->addSql('ALTER TABLE reservation RENAME COLUMN company_id_id TO company_id');
        // ici ajoute moi un rename de la colonne user_id_id en user_id de la table reservation
        $this->addSql('ALTER TABLE reservation RENAME COLUMN user_id_id TO user_id');
        // ici ajoute moi un rename de la colonne day_id_id en day_id de la table date
        $this->addSql('ALTER TABLE date RENAME COLUMN day_id_id TO day_id');
        // ici ajoute moi un rename de la colonne week_id_id en week_id de la table date
        $this->addSql('ALTER TABLE date RENAME COLUMN week_id_id TO week_id');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FBB897366B');
        $this->addSql('DROP INDEX IDX_5A3811FBB897366B ON schedule');
        $this->addSql('ALTER TABLE schedule DROP date_id');
        // Inverser le renommage de la colonne schedule_id dans la table reservation
        $this->addSql('ALTER TABLE reservation RENAME COLUMN schedule_id TO schedule_id_id');
        // Inverser le renommage de la colonne company_id dans la table reservation
        $this->addSql('ALTER TABLE reservation RENAME COLUMN company_id TO company_id_id');
        // Inverser le renommage de la colonne user_id dans la table reservation
        $this->addSql('ALTER TABLE reservation RENAME COLUMN user_id TO user_id_id');
        // Inverser le renommage de la colonne day_id dans la table date
        $this->addSql('ALTER TABLE date RENAME COLUMN day_id TO day_id_id');
        // Inverser le renommage de la colonne week_id dans la table date
        $this->addSql('ALTER TABLE date RENAME COLUMN week_id TO week_id_id');
    }
}
