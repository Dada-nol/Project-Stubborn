<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240905065521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B3656606F4B9F4A');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660AE945C60');
        $this->addSql('DROP INDEX IDX_4B3656606F4B9F4A ON stock');
        $this->addSql('DROP INDEX IDX_4B365660AE945C60 ON stock');
        $this->addSql('ALTER TABLE stock ADD sweat_shirt_id INT NOT NULL, ADD size_id INT NOT NULL, DROP sweat_shirt_id_id, DROP size_id_id');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660B8E23E05 FOREIGN KEY (sweat_shirt_id) REFERENCES sweat_shirts (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660498DA827 FOREIGN KEY (size_id) REFERENCES sizes (id)');
        $this->addSql('CREATE INDEX IDX_4B365660B8E23E05 ON stock (sweat_shirt_id)');
        $this->addSql('CREATE INDEX IDX_4B365660498DA827 ON stock (size_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660B8E23E05');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660498DA827');
        $this->addSql('DROP INDEX IDX_4B365660B8E23E05 ON stock');
        $this->addSql('DROP INDEX IDX_4B365660498DA827 ON stock');
        $this->addSql('ALTER TABLE stock ADD sweat_shirt_id_id INT NOT NULL, ADD size_id_id INT NOT NULL, DROP sweat_shirt_id, DROP size_id');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656606F4B9F4A FOREIGN KEY (sweat_shirt_id_id) REFERENCES sweat_shirts (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660AE945C60 FOREIGN KEY (size_id_id) REFERENCES sizes (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_4B3656606F4B9F4A ON stock (sweat_shirt_id_id)');
        $this->addSql('CREATE INDEX IDX_4B365660AE945C60 ON stock (size_id_id)');
    }
}
