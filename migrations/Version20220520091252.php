<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220520091252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, user_commentaire_id INT DEFAULT NULL, event_id INT DEFAULT NULL, message VARCHAR(255) NOT NULL, date_message DATE NOT NULL, INDEX IDX_67F068BCD1190EC9 (user_commentaire_id), INDEX IDX_67F068BC71F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, user_creation_id INT DEFAULT NULL, sport_id INT DEFAULT NULL, niveau_id INT DEFAULT NULL, titre VARCHAR(50) NOT NULL, nb_places INT DEFAULT NULL, descriptif VARCHAR(255) NOT NULL, date_event DATE NOT NULL, heure_debut VARCHAR(10) NOT NULL, heure_fin VARCHAR(10) NOT NULL, adresse VARCHAR(30) NOT NULL, ville VARCHAR(50) NOT NULL, cp VARCHAR(15) NOT NULL, INDEX IDX_3BAE0AA79DE46F0F (user_creation_id), INDEX IDX_3BAE0AA7AC78BCF8 (sport_id), INDEX IDX_3BAE0AA7B3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, user_post_id INT DEFAULT NULL, post VARCHAR(150) NOT NULL, date_post DATE NOT NULL, INDEX IDX_5A8A6C8D13841D26 (user_post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sport (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, club_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(30) NOT NULL, sexe VARCHAR(10) NOT NULL, photo_profil VARCHAR(255) DEFAULT NULL, photos VARCHAR(255) DEFAULT NULL, biographie VARCHAR(255) NOT NULL, ville VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D64961190A32 (club_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_event (user_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_D96CF1FFA76ED395 (user_id), INDEX IDX_D96CF1FF71F7E88B (event_id), PRIMARY KEY(user_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_sport (user_id INT NOT NULL, sport_id INT NOT NULL, INDEX IDX_F847148AA76ED395 (user_id), INDEX IDX_F847148AAC78BCF8 (sport_id), PRIMARY KEY(user_id, sport_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCD1190EC9 FOREIGN KEY (user_commentaire_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA79DE46F0F FOREIGN KEY (user_creation_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7AC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D13841D26 FOREIGN KEY (user_post_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D64961190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE user_event ADD CONSTRAINT FK_D96CF1FFA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_event ADD CONSTRAINT FK_D96CF1FF71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_sport ADD CONSTRAINT FK_F847148AA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_sport ADD CONSTRAINT FK_F847148AAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64961190A32');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC71F7E88B');
        $this->addSql('ALTER TABLE user_event DROP FOREIGN KEY FK_D96CF1FF71F7E88B');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7B3E9C81');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7AC78BCF8');
        $this->addSql('ALTER TABLE user_sport DROP FOREIGN KEY FK_F847148AAC78BCF8');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCD1190EC9');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA79DE46F0F');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D13841D26');
        $this->addSql('ALTER TABLE user_event DROP FOREIGN KEY FK_D96CF1FFA76ED395');
        $this->addSql('ALTER TABLE user_sport DROP FOREIGN KEY FK_F847148AA76ED395');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE sport');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_event');
        $this->addSql('DROP TABLE user_sport');
    }
}
