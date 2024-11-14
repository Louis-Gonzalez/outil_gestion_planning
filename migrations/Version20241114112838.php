<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241114112838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company_activity (company_id INT NOT NULL, activity_id INT NOT NULL, INDEX IDX_B4E31C37979B1AD6 (company_id), INDEX IDX_B4E31C3781C06096 (activity_id), PRIMARY KEY(company_id, activity_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company_activity ADD CONSTRAINT FK_B4E31C37979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_activity ADD CONSTRAINT FK_B4E31C3781C06096 FOREIGN KEY (activity_id) REFERENCES activity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F81C06096');
        $this->addSql('DROP INDEX IDX_4FBF094F81C06096 ON company');
        $this->addSql('ALTER TABLE company ADD user_info_id INT DEFAULT NULL, DROP activity_id');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F586DFF2 FOREIGN KEY (user_info_id) REFERENCES user_info (id)');
        $this->addSql('CREATE INDEX IDX_4FBF094F586DFF2 ON company (user_info_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company_activity DROP FOREIGN KEY FK_B4E31C37979B1AD6');
        $this->addSql('ALTER TABLE company_activity DROP FOREIGN KEY FK_B4E31C3781C06096');
        $this->addSql('DROP TABLE company_activity');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F586DFF2');
        $this->addSql('DROP INDEX IDX_4FBF094F586DFF2 ON company');
        $this->addSql('ALTER TABLE company ADD activity_id INT NOT NULL, DROP user_info_id');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_4FBF094F81C06096 ON company (activity_id)');
    }
}
