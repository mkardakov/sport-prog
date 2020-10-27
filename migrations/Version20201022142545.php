<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201022142545 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_exercise (id INT AUTO_INCREMENT NOT NULL, exercise_id INT NOT NULL, user_id INT NOT NULL, weight DOUBLE PRECISION DEFAULT NULL, repetition INT DEFAULT NULL, set_total INT DEFAULT NULL, INDEX IDX_4E57311CE934951A (exercise_id), INDEX IDX_4E57311CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_exercise ADD CONSTRAINT FK_4E57311CE934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id)');
        $this->addSql('ALTER TABLE user_exercise ADD CONSTRAINT FK_4E57311CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_exercise');
    }
}
