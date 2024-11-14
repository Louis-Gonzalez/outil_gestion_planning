<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241114153040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE date (id INT AUTO_INCREMENT NOT NULL, day_id_id INT NOT NULL, week_id_id INT NOT NULL, date DATETIME NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_AA9E377AC68922B3 (day_id_id), INDEX IDX_AA9E377AB4EF57D4 (week_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE day (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, schedule_id_id INT NOT NULL, company_id_id INT NOT NULL, user_id_id INT NOT NULL, status VARCHAR(80) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_42C84955831D5E0B (schedule_id_id), INDEX IDX_42C8495538B53C32 (company_id_id), INDEX IDX_42C849559D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schedule (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(10) NOT NULL, start_time DATETIME NOT NULL, end_time DATETIME NOT NULL, using_time DATETIME NOT NULL, is_free TINYINT(1) NOT NULL, status VARCHAR(80) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE week_nbr (id INT AUTO_INCREMENT NOT NULL, name INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE date ADD CONSTRAINT FK_AA9E377AC68922B3 FOREIGN KEY (day_id_id) REFERENCES day (id)');
        $this->addSql('ALTER TABLE date ADD CONSTRAINT FK_AA9E377AB4EF57D4 FOREIGN KEY (week_id_id) REFERENCES week_nbr (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955831D5E0B FOREIGN KEY (schedule_id_id) REFERENCES schedule (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495538B53C32 FOREIGN KEY (company_id_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE place ADD reservation_id INT NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE type type VARCHAR(80) NOT NULL');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CDB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_741D53CDB83297E7 ON place (reservation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CDB83297E7');
        $this->addSql('ALTER TABLE date DROP FOREIGN KEY FK_AA9E377AC68922B3');
        $this->addSql('ALTER TABLE date DROP FOREIGN KEY FK_AA9E377AB4EF57D4');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955831D5E0B');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495538B53C32');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559D86650F');
        $this->addSql('DROP TABLE date');
        $this->addSql('DROP TABLE day');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE schedule');
        $this->addSql('DROP TABLE week_nbr');
        $this->addSql('DROP INDEX IDX_741D53CDB83297E7 ON place');
        $this->addSql('ALTER TABLE place DROP reservation_id, DROP created_at, DROP updated_at, CHANGE type type VARCHAR(255) NOT NULL');
    }
}
