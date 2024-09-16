<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240916162346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_item ADD size_id INT NOT NULL');
        $this->addSql('ALTER TABLE cart_item ADD CONSTRAINT FK_F0FE2527498DA827 FOREIGN KEY (size_id) REFERENCES taille_sweat (id)');
        $this->addSql('CREATE INDEX IDX_F0FE2527498DA827 ON cart_item (size_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_item DROP FOREIGN KEY FK_F0FE2527498DA827');
        $this->addSql('DROP INDEX IDX_F0FE2527498DA827 ON cart_item');
        $this->addSql('ALTER TABLE cart_item DROP size_id');
    }
}
