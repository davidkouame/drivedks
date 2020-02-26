<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200220114855 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE file CHANGE created created DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, DROP name, DROP surname, DROP tel, DROP created, DROP updated, CHANGE email email VARCHAR(180) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE file CHANGE created created DATETIME DEFAULT NULL');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD surname VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD tel VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD created DATETIME DEFAULT NULL, ADD updated DATETIME DEFAULT NULL, DROP roles, CHANGE email email VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE password password VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
