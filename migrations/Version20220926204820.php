<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220926204820 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->connection->executeQuery("INSERT INTO `rooms_properties` (`room_id`, `room_property_id`)
VALUES
	(1, 1),
	(1, 10),
	(1, 17),
	(1, 18),
	(1, 22),
	(1, 23),
	(1, 24),
	(1, 25),
	(1, 30),
	(1, 31),
	(1, 32),
	(1, 40),
	(1, 46);
");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
