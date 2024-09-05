<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240905100327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, sweat_shirt_id INT NOT NULL, size_id INT NOT NULL, quantité INT DEFAULT NULL, INDEX IDX_4B365660B8E23E05 (sweat_shirt_id), INDEX IDX_4B365660498DA827 (size_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sweat_shirts (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taille_sweat (id INT AUTO_INCREMENT NOT NULL, size VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660B8E23E05 FOREIGN KEY (sweat_shirt_id) REFERENCES sweat_shirts (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660498DA827 FOREIGN KEY (size_id) REFERENCES taille_sweat (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660B8E23E05');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660498DA827');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE sweat_shirts');
        $this->addSql('DROP TABLE taille_sweat');
    }
}
