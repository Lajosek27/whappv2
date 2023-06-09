<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230503200231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, game_master_id INT DEFAULT NULL, player_id INT NOT NULL, info_id INT NOT NULL, profession_id INT DEFAULT NULL, points_id INT DEFAULT NULL, exp_id INT DEFAULT NULL, name VARCHAR(120) NOT NULL, is_private TINYINT(1) NOT NULL, profession_lv SMALLINT DEFAULT NULL, INDEX IDX_937AB034C1151A13 (game_master_id), INDEX IDX_937AB03499E6F5DF (player_id), UNIQUE INDEX UNIQ_937AB0345D8BC1F8 (info_id), INDEX IDX_937AB034FDEF8996 (profession_id), UNIQUE INDEX UNIQ_937AB034DF69572F (points_id), UNIQUE INDEX UNIQ_937AB034D26628FA (exp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_info (id INT AUTO_INCREMENT NOT NULL, race VARCHAR(100) NOT NULL, age INT DEFAULT NULL, height INT DEFAULT NULL, hair VARCHAR(100) DEFAULT NULL, eyes VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exp (id INT AUTO_INCREMENT NOT NULL, spend INT NOT NULL, free INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE points (id INT AUTO_INCREMENT NOT NULL, fate SMALLINT NOT NULL, luck SMALLINT NOT NULL, resolve SMALLINT NOT NULL, resilience SMALLINT NOT NULL, speed SMALLINT NOT NULL, walk SMALLINT NOT NULL, run SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profession (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, tier_names JSON NOT NULL, statuses JSON NOT NULL, grupe VARCHAR(30) NOT NULL, creator_name VARCHAR(180) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034C1151A13 FOREIGN KEY (game_master_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB03499E6F5DF FOREIGN KEY (player_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0345D8BC1F8 FOREIGN KEY (info_id) REFERENCES character_info (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034FDEF8996 FOREIGN KEY (profession_id) REFERENCES profession (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034DF69572F FOREIGN KEY (points_id) REFERENCES points (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034D26628FA FOREIGN KEY (exp_id) REFERENCES exp (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034C1151A13');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB03499E6F5DF');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB0345D8BC1F8');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034FDEF8996');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034DF69572F');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034D26628FA');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE character_info');
        $this->addSql('DROP TABLE exp');
        $this->addSql('DROP TABLE points');
        $this->addSql('DROP TABLE profession');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
