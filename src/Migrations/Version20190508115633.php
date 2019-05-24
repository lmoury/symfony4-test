<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190508115633 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_8BF21CDEBCF5E72D ON property (categorie_id)');
        $this->addSql('ALTER TABLE categorie ADD properties_id INT DEFAULT NULL, CHANGE categorie nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD6343691D1CA FOREIGN KEY (properties_id) REFERENCES property (id)');
        $this->addSql('CREATE INDEX IDX_497DD6343691D1CA ON categorie (properties_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD6343691D1CA');
        $this->addSql('DROP INDEX IDX_497DD6343691D1CA ON categorie');
        $this->addSql('ALTER TABLE categorie DROP properties_id, CHANGE nom categorie VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEBCF5E72D');
        $this->addSql('DROP INDEX IDX_8BF21CDEBCF5E72D ON property');
    }
}
