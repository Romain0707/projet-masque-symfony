<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260127091927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, note INT NOT NULL, masque_id INT NOT NULL, INDEX IDX_CFBDFA14EE50B206 (masque_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14EE50B206 FOREIGN KEY (masque_id) REFERENCES masque (id)');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CAEE50B206 FOREIGN KEY (masque_id) REFERENCES masque (id)');
        $this->addSql('ALTER TABLE masque ADD CONSTRAINT FK_E2D3F6ABA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE masque_colors ADD CONSTRAINT FK_FC9D5B6EE50B206 FOREIGN KEY (masque_id) REFERENCES masque (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE masque_colors ADD CONSTRAINT FK_FC9D5B65C002039 FOREIGN KEY (colors_id) REFERENCES colors (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14EE50B206');
        $this->addSql('DROP TABLE note');
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CAA76ED395');
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CAEE50B206');
        $this->addSql('ALTER TABLE masque DROP FOREIGN KEY FK_E2D3F6ABA76ED395');
        $this->addSql('ALTER TABLE masque_colors DROP FOREIGN KEY FK_FC9D5B6EE50B206');
        $this->addSql('ALTER TABLE masque_colors DROP FOREIGN KEY FK_FC9D5B65C002039');
    }
}
