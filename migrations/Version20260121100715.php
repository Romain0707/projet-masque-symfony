<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260121100715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE colors (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE commentary (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, user_id INT NOT NULL, masque_id INT DEFAULT NULL, INDEX IDX_1CAC12CAA76ED395 (user_id), INDEX IDX_1CAC12CAEE50B206 (masque_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE masque (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, price INT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE masque_colors (masque_id INT NOT NULL, colors_id INT NOT NULL, INDEX IDX_FC9D5B6EE50B206 (masque_id), INDEX IDX_FC9D5B65C002039 (colors_id), PRIMARY KEY (masque_id, colors_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CAEE50B206 FOREIGN KEY (masque_id) REFERENCES masque (id)');
        $this->addSql('ALTER TABLE masque_colors ADD CONSTRAINT FK_FC9D5B6EE50B206 FOREIGN KEY (masque_id) REFERENCES masque (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE masque_colors ADD CONSTRAINT FK_FC9D5B65C002039 FOREIGN KEY (colors_id) REFERENCES colors (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CAA76ED395');
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CAEE50B206');
        $this->addSql('ALTER TABLE masque_colors DROP FOREIGN KEY FK_FC9D5B6EE50B206');
        $this->addSql('ALTER TABLE masque_colors DROP FOREIGN KEY FK_FC9D5B65C002039');
        $this->addSql('DROP TABLE colors');
        $this->addSql('DROP TABLE commentary');
        $this->addSql('DROP TABLE masque');
        $this->addSql('DROP TABLE masque_colors');
    }
}
