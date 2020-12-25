<?php
declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20201225223736 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'added date updated and date added columns to question table';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE question ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('UPDATE question SET created_at = NOW(), updated_at = NOW()');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE question DROP created_at, DROP updated_at');
    }
}
