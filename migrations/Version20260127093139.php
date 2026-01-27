<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260127093139 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CAEE50B206 FOREIGN KEY (masque_id) REFERENCES masque (id)');
        $this->addSql('ALTER TABLE masque ADD CONSTRAINT FK_E2D3F6ABA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE masque_colors ADD CONSTRAINT FK_FC9D5B6EE50B206 FOREIGN KEY (masque_id) REFERENCES masque (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE masque_colors ADD CONSTRAINT FK_FC9D5B65C002039 FOREIGN KEY (colors_id) REFERENCES colors (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE note ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14EE50B206 FOREIGN KEY (masque_id) REFERENCES masque (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CFBDFA14A76ED395 ON note (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CAA76ED395');
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CAEE50B206');
        $this->addSql('ALTER TABLE masque DROP FOREIGN KEY FK_E2D3F6ABA76ED395');
        $this->addSql('ALTER TABLE masque_colors DROP FOREIGN KEY FK_FC9D5B6EE50B206');
        $this->addSql('ALTER TABLE masque_colors DROP FOREIGN KEY FK_FC9D5B65C002039');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14EE50B206');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14A76ED395');
        $this->addSql('DROP INDEX IDX_CFBDFA14A76ED395 ON note');
        $this->addSql('ALTER TABLE note DROP user_id');
    }
}
