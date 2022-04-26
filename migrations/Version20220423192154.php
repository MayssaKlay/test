<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220423192154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE participation');
        $this->addSql('ALTER TABLE evenement ADD nbrparticiMax INT NOT NULL, CHANGE event_date event_date DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participation (id_participation INT AUTO_INCREMENT NOT NULL, id_event INT NOT NULL, id_participant INT NOT NULL, PRIMARY KEY(id_participation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE evenement DROP nbrparticiMax, CHANGE event_date event_date DATE NOT NULL');
    }
}
