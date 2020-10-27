<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201022152808 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE program (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, duration DATE DEFAULT NULL, start_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_exercise DROP FOREIGN KEY FK_4E57311CA76ED395');
        $this->addSql('DROP INDEX IDX_4E57311CA76ED395 ON user_exercise');
        $this->addSql('ALTER TABLE user_exercise CHANGE user_id program_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_exercise ADD CONSTRAINT FK_4E57311C3EB8070A FOREIGN KEY (program_id) REFERENCES program (id)');
        $this->addSql('CREATE INDEX IDX_4E57311C3EB8070A ON user_exercise (program_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_exercise DROP FOREIGN KEY FK_4E57311C3EB8070A');
        $this->addSql('DROP TABLE program');
        $this->addSql('DROP INDEX IDX_4E57311C3EB8070A ON user_exercise');
        $this->addSql('ALTER TABLE user_exercise CHANGE program_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_exercise ADD CONSTRAINT FK_4E57311CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4E57311CA76ED395 ON user_exercise (user_id)');
    }
}
