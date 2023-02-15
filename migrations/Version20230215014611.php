<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230215014611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'creation table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories_of_plat (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formule_in_menu (id INT AUTO_INCREMENT NOT NULL, type_of_menu_id INT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_1585E8472CA1CE86 (type_of_menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hours (id INT AUTO_INCREMENT NOT NULL, restaurant_id INT DEFAULT NULL, day VARCHAR(255) NOT NULL, start_hour VARCHAR(255) DEFAULT NULL, end_hour VARCHAR(255) DEFAULT NULL, INDEX IDX_8A1ABD8DB1E7706E (restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, image_name VARCHAR(255) NOT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plat_of_restaurant (id INT AUTO_INCREMENT NOT NULL, categories_of_plat_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_2FAD2DC08BC604D9 (categories_of_plat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, hour VARCHAR(255) NOT NULL, name_of_client VARCHAR(255) NOT NULL, nb_couvert INT NOT NULL, allergns LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, capacity_max INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_of_menu (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_client (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, allergns LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', nb_couvert_default INT NOT NULL, UNIQUE INDEX UNIQ_A2161F68A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formule_in_menu ADD CONSTRAINT FK_1585E8472CA1CE86 FOREIGN KEY (type_of_menu_id) REFERENCES type_of_menu (id)');
        $this->addSql('ALTER TABLE hours ADD CONSTRAINT FK_8A1ABD8DB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE plat_of_restaurant ADD CONSTRAINT FK_2FAD2DC08BC604D9 FOREIGN KEY (categories_of_plat_id) REFERENCES categories_of_plat (id)');
        $this->addSql('ALTER TABLE user_client ADD CONSTRAINT FK_A2161F68A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formule_in_menu DROP FOREIGN KEY FK_1585E8472CA1CE86');
        $this->addSql('ALTER TABLE hours DROP FOREIGN KEY FK_8A1ABD8DB1E7706E');
        $this->addSql('ALTER TABLE plat_of_restaurant DROP FOREIGN KEY FK_2FAD2DC08BC604D9');
        $this->addSql('ALTER TABLE user_client DROP FOREIGN KEY FK_A2161F68A76ED395');
        $this->addSql('DROP TABLE categories_of_plat');
        $this->addSql('DROP TABLE formule_in_menu');
        $this->addSql('DROP TABLE hours');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE plat_of_restaurant');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('DROP TABLE type_of_menu');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_client');
    }
}
