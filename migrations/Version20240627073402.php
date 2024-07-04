<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240627073402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE director (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, nationality VARCHAR(30) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE movie (id SERIAL NOT NULL, director_id INT NOT NULL, title VARCHAR(100) NOT NULL, note DOUBLE PRECISION NOT NULL, release_date DATE NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1D5EF26F899FB366 ON movie (director_id)');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26F899FB366 FOREIGN KEY (director_id) REFERENCES director (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie DROP CONSTRAINT FK_1D5EF26F899FB366');
        $this->addSql('DROP TABLE director');
        $this->addSql('DROP TABLE movie');
    }
}
