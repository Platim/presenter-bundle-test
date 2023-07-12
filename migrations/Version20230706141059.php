<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230706141059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE album (id SERIAL NOT NULL, artist_id INT NOT NULL, title VARCHAR(160) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_39986E43B7970CF8 ON album (artist_id)');
        $this->addSql('CREATE TABLE artist (id SERIAL NOT NULL, name VARCHAR(120) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE customer (id SERIAL NOT NULL, support_rep_id INT DEFAULT NULL, first_name VARCHAR(40) NOT NULL, last_name VARCHAR(20) NOT NULL, company VARCHAR(80) DEFAULT NULL, address VARCHAR(70) DEFAULT NULL, city VARCHAR(40) DEFAULT NULL, state VARCHAR(40) DEFAULT NULL, country VARCHAR(40) DEFAULT NULL, postal_code VARCHAR(10) DEFAULT NULL, phone VARCHAR(24) DEFAULT NULL, fax VARCHAR(24) DEFAULT NULL, email VARCHAR(60) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_81398E09DC3FA91A ON customer (support_rep_id)');
        $this->addSql('CREATE TABLE employee (id SERIAL NOT NULL, reports_to_id INT DEFAULT NULL, first_name VARCHAR(20) NOT NULL, last_name VARCHAR(20) NOT NULL, title VARCHAR(30) NOT NULL, birth_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, hire_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, address VARCHAR(70) DEFAULT NULL, city VARCHAR(40) DEFAULT NULL, state VARCHAR(40) DEFAULT NULL, country VARCHAR(40) DEFAULT NULL, postal_code VARCHAR(10) DEFAULT NULL, phone VARCHAR(24) DEFAULT NULL, fax VARCHAR(24) DEFAULT NULL, email VARCHAR(60) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5D9F75A19BE3208E ON employee (reports_to_id)');
        $this->addSql('CREATE TABLE genre (id SERIAL NOT NULL, name VARCHAR(120) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE invoice (id SERIAL NOT NULL, customer_id INT NOT NULL, invoice_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, billing_address VARCHAR(70) DEFAULT NULL, billing_city VARCHAR(40) DEFAULT NULL, billing_state VARCHAR(40) DEFAULT NULL, billing_country VARCHAR(40) DEFAULT NULL, billing_postal_code VARCHAR(10) DEFAULT NULL, total NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_906517449395C3F3 ON invoice (customer_id)');
        $this->addSql('CREATE TABLE invoice_line (id SERIAL NOT NULL, invoice_id INT NOT NULL, track_id INT NOT NULL, unit_price NUMERIC(10, 2) NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D3D1D6932989F1FD ON invoice_line (invoice_id)');
        $this->addSql('CREATE INDEX IDX_D3D1D6935ED23C43 ON invoice_line (track_id)');
        $this->addSql('CREATE TABLE media_type (id SERIAL NOT NULL, name VARCHAR(120) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE playlist (id SERIAL NOT NULL, name VARCHAR(120) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE playlist_track (playlist_id INT NOT NULL, track_id INT NOT NULL, PRIMARY KEY(playlist_id, track_id))');
        $this->addSql('CREATE INDEX IDX_75FFE1E56BBD148 ON playlist_track (playlist_id)');
        $this->addSql('CREATE INDEX IDX_75FFE1E55ED23C43 ON playlist_track (track_id)');
        $this->addSql('CREATE TABLE track (id SERIAL NOT NULL, album_id INT DEFAULT NULL, media_type_id INT DEFAULT NULL, genre_id INT DEFAULT NULL, name VARCHAR(200) NOT NULL, composer VARCHAR(220) DEFAULT NULL, milliseconds INT NOT NULL, bytes INT NOT NULL, unit_price NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D6E3F8A61137ABCF ON track (album_id)');
        $this->addSql('CREATE INDEX IDX_D6E3F8A6A49B0ADA ON track (media_type_id)');
        $this->addSql('CREATE INDEX IDX_D6E3F8A64296D31F ON track (genre_id)');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_39986E43B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09DC3FA91A FOREIGN KEY (support_rep_id) REFERENCES employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A19BE3208E FOREIGN KEY (reports_to_id) REFERENCES employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_906517449395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invoice_line ADD CONSTRAINT FK_D3D1D6932989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invoice_line ADD CONSTRAINT FK_D3D1D6935ED23C43 FOREIGN KEY (track_id) REFERENCES track (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE playlist_track ADD CONSTRAINT FK_75FFE1E56BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE playlist_track ADD CONSTRAINT FK_75FFE1E55ED23C43 FOREIGN KEY (track_id) REFERENCES track (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE track ADD CONSTRAINT FK_D6E3F8A61137ABCF FOREIGN KEY (album_id) REFERENCES album (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE track ADD CONSTRAINT FK_D6E3F8A6A49B0ADA FOREIGN KEY (media_type_id) REFERENCES media_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE track ADD CONSTRAINT FK_D6E3F8A64296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE album DROP CONSTRAINT FK_39986E43B7970CF8');
        $this->addSql('ALTER TABLE customer DROP CONSTRAINT FK_81398E09DC3FA91A');
        $this->addSql('ALTER TABLE employee DROP CONSTRAINT FK_5D9F75A19BE3208E');
        $this->addSql('ALTER TABLE invoice DROP CONSTRAINT FK_906517449395C3F3');
        $this->addSql('ALTER TABLE invoice_line DROP CONSTRAINT FK_D3D1D6932989F1FD');
        $this->addSql('ALTER TABLE invoice_line DROP CONSTRAINT FK_D3D1D6935ED23C43');
        $this->addSql('ALTER TABLE playlist_track DROP CONSTRAINT FK_75FFE1E56BBD148');
        $this->addSql('ALTER TABLE playlist_track DROP CONSTRAINT FK_75FFE1E55ED23C43');
        $this->addSql('ALTER TABLE track DROP CONSTRAINT FK_D6E3F8A61137ABCF');
        $this->addSql('ALTER TABLE track DROP CONSTRAINT FK_D6E3F8A6A49B0ADA');
        $this->addSql('ALTER TABLE track DROP CONSTRAINT FK_D6E3F8A64296D31F');
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE invoice_line');
        $this->addSql('DROP TABLE media_type');
        $this->addSql('DROP TABLE playlist');
        $this->addSql('DROP TABLE playlist_track');
        $this->addSql('DROP TABLE track');
    }
}
