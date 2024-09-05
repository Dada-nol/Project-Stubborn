<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240905065013 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sizes (id INT AUTO_INCREMENT NOT NULL, size VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, sweat_shirt_id_id INT NOT NULL, size_id_id INT NOT NULL, quantité INT DEFAULT NULL, INDEX IDX_4B3656606F4B9F4A (sweat_shirt_id_id), INDEX IDX_4B365660AE945C60 (size_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656606F4B9F4A FOREIGN KEY (sweat_shirt_id_id) REFERENCES sweat_shirts (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660AE945C60 FOREIGN KEY (size_id_id) REFERENCES sizes (id)');
        $this->addSql('DROP TABLE taille_sweat');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE taille_sweat (id INT AUTO_INCREMENT NOT NULL, size VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B3656606F4B9F4A');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660AE945C60');
        $this->addSql('DROP TABLE sizes');
        $this->addSql('DROP TABLE stock');
    }
}
