<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240620122327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE workout_exercise ADD workouts_id INT NOT NULL');
        $this->addSql('ALTER TABLE workout_exercise ADD CONSTRAINT FK_76AB38AA56F0BFE FOREIGN KEY (workouts_id) REFERENCES workout (id)');
        $this->addSql('CREATE INDEX IDX_76AB38AA56F0BFE ON workout_exercise (workouts_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE workout_exercise DROP FOREIGN KEY FK_76AB38AA56F0BFE');
        $this->addSql('DROP INDEX IDX_76AB38AA56F0BFE ON workout_exercise');
        $this->addSql('ALTER TABLE workout_exercise DROP workouts_id');
    }
}
