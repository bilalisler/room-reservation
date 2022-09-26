<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220926122900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->connection->executeQuery("INSERT INTO `user` (`id`, `full_name`, `email`, `created_at`, `phone_number`)
VALUES
	(1, 'Mahir İz', 'mahiriz@test.com', '2022-09-26 00:00:00', '5554443322'),
	(2, 'Nazım Hikmet', 'nazımh@test.com', '2022-09-26 00:00:00', '5554443322'),
	(3, 'Peyami Safa', 'p_safa@test.com', '2022-09-26 00:00:00', '5554443322'),
	(4, 'Nurettin Topçu', 'ntopcu@test.com', '2022-09-26 00:00:00', '5554443322'),
	(5, 'Orhan Pamuk', 'orhanpamuk@test.com', '2022-09-26 00:00:00', '5554443322'),
	(6, 'Yaşar Kemal', 'y_kemal@test.com', '2022-09-26 00:00:00', '5554443322'),
	(7, 'Oğuz Atay', 'oguzatay@test.com', '2022-09-26 00:00:00', '5554443322'),
	(8, 'Aziz Nesin', 'aziz_nesin@test.com', '2022-09-26 00:00:00', '5554443322');
");
        $this->connection->executeQuery("INSERT INTO `room_property` (`id`, `name`, `parent_id`)
VALUES
	(1, 'Sağlık ve Güvenlik', NULL),
	(3, 'Yatak Odası', NULL),
	(4, 'Muftak', NULL),
	(5, 'Banyo', NULL),
	(6, 'Konut Tipi', NULL),
	(7, 'İç Özellikler', NULL),
	(8, 'Dış Özellikler', NULL),
	(9, 'Otopark', 8),
	(10, 'Havlu', 7),
	(16, 'Havlu', 7),
	(17, 'Çamaşır Makinesi', 7),
	(18, 'Sıcak Su', 7),
	(19, 'TV', 7),
	(20, 'Ütü', 7),
	(21, 'Donanımlı Mutfak', 7),
	(22, 'Klima', 7),
	(23, 'Kombi', 7),
	(24, 'Kablo TV', 7),
	(25, 'WiFi', 7),
	(26, 'Temel İhtiyaçlar', 7),
	(27, 'İnternet', 7),
	(28, 'Asansör', 6),
	(29, 'Uzun Süreli Kalmaya Uygun', 6),
	(30, 'Aileye Uygun', 6),
	(31, 'Tek Katlı Ev', 6),
	(32, 'Saç Kurutma Makinesi', 5),
	(33, 'Şampuan', 5),
	(34, 'Kettle', 4),
	(35, 'Bulaşık Makinesi', 4),
	(36, 'Mikrodalga', 4),
	(37, 'Yemek Malzemeleri', 4),
	(38, 'Buzdolabı', 4),
	(39, 'Tencere', 4),
	(40, 'Ocak', 4),
	(42, 'Nevresim Takımı', 3),
	(43, 'Çalışma Masası', 3),
	(44, 'Askı', 3),
	(45, 'Ekstra Yastık ve Battaniye', 3),
	(46, 'Dezenfektan Temizliği', 1);
");
        $this->connection->executeQuery("INSERT INTO `room` (`id`, `home_type`, `title`, `total_capacity`, `total_bedrooms`, `total_bathrooms`, `min_stay_day_count`, `country`, `city`, `address`, `description`, `price`, `currency`, `latitude`, `longitude`, `created_at`, `updated_at`)
VALUES
	(1, 'Daire', 'Çengelköy\'de Muhteşem Boğaz Manzaralı, Balkonlu, Teraslı ve Arka Bahçeli Olağanüstü Villa', 3, 2, 1, 1, 'Türkiye', 'İstanbul', 'Üsküdar, İstanbul', 'Kendinizi İstanbul\'un rengarenk ruhuyla sarıp sarmalamak istiyorsanız Çengelköy sizi bekliyor. Bu muhteşem semtin kalbinde büyüleyici bir Boğaz manzarasına sahip olağanüstü güzellikteki tripleks villamız Peitho, sizi tanrılara yakışır bir yolculuğa davet ediyor. Unutulmaz bir İstanbul deneyimi için şimdi rezervasyon yapın!', 3309, 'TRY', '41.04751', '29.055903', '2022-09-26 00:00:00', NULL),
	(2, 'Villa', 'Fethiye Göcek\'te Harika Manzaralı Dubleks Yazlık', 7, 3, 2, 7, 'Türkiye', 'Fethiye', 'Fethiye, Muğla', 'Akdeniz\'in olağanüstü güzelliğini bir hazine gibi koruyup kollayarak ziyaretçilerine yaşatan Fethiye\'de eviniz hazır. Göcek\'te yer alan dubleksimiz Skopea 5 huzur dolu bahçesi, ferahlatan havuzu ve dinlendiren doğa manzarasıyla size düşlerinizdeki tatili sunuyor. Hayallerinizi gerçekleştirmek için hemen bir adım atın ve rezervasyon yaptırın!', 1553, 'TRY', '36.7669133', '28.9519847', '2022-09-27 00:00:00', NULL);
");
//        $this->connection->executeQuery("");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
