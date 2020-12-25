<?php
declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20201225190540 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Added new column votes to the question table';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE question ADD votes INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE question DROP votes');
    }
}
