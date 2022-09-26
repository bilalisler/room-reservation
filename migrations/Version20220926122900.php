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
        $this->connection->executeQuery("INSERT INTO `user` (`id`, `full_name`, `email`, `created_at`, `updated_at`, `phone_number`)
VALUES
	(1, 'Mahir İz', 'mahiriz@test.com', '2022-09-26 00:00:00', NULL, '5554443322'),
	(2, 'Nazım Hikmet', 'nazımh@test.com', '2022-09-26 00:00:00', NULL, '5554443322'),
	(3, 'Peyami Safa', 'p_safa@test.com', '2022-09-26 00:00:00', NULL, '5554443322'),
	(4, 'Nurettin Topçu', 'ntopcu@test.com', '2022-09-26 00:00:00', NULL, '5554443322'),
	(5, 'Orhan Pamuk', 'orhanpamuk@test.com', '2022-09-26 00:00:00', NULL, '5554443322'),
	(6, 'Yaşar Kemal', 'y_kemal@test.com', '2022-09-26 00:00:00', NULL, '5554443322'),
	(7, 'Oğuz Atay', 'oguzatay@test.com', '2022-09-26 00:00:00', NULL, '5554443322'),
	(8, 'Aziz Nesin', 'aziz_nesin@test.com', '2022-09-26 00:00:00', NULL, '5554443322');
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
        $this->connection->executeQuery("INSERT INTO `room` (`id`, `home_type`, `title`, `total_capacity`, `total_bedrooms`, `total_bathrooms`, `address`, `price`, `currency`, `created_at`, `updated_at`, `description`, `latitude`, `longitude`)
VALUES
	(1, 'Daire', 'Beyoğlu\'nda Gözde Turistik Noktalara Yakın Şık Daire', 3, 1, 1, 'Beyoğlu, İstanbul', 1412, 'TRY', '2022-09-10 00:00:00', NULL, 'Sahip olduğu harikalarıyla ruhunuzu coşkuyla dolduracak ve aklınızı başınızdan alacak büyülü bir diyar, merkezi evimiz Grace\'in yanı başında sizi bekliyor. Zarif dairemiz, Beyoğlu\'nun gururla sunduğu baş döndürücü cazibe merkezleri ile çevrili. Şimdi şehrin tarihi ve kültürel mirasını konforla keşfetmenin tam zamanı. Rezervasyon yapın ve hayalini kurduğunuz şımartıcı deneyimi yaşayın!\n\n', '41.037267', '28.979959'),
	(2, 'Daire', 'MİSSAFİR ile Beşiktaş Ortaköy\'de Keyifli Bahçeli Şahane Ev | Paloma', 5, 2, 1, 'Beşiktaş, İstanbul', 2200, 'TRY', '2022-09-10 00:00:00', NULL, 'Geçmişin ve bugünün olağanüstü birlikteliği, beklenmedik bir uyum yaratan keyifli Paloma\'mızda sizi karşılayacak. \n\nİster iş, ister keşif amaçlı, ister ailenizle kaliteli zaman geçirmek için seyahat ediyor olun; tamamen yenilenmiş bu ev size ihtiyacınız olan konfor ve rahatlığı sunmaya hazır. Burada gününüze güzel, tenha bahçemizde temiz havanın ve sakinliğin tadını çıkarırken lezzetli Türk kahvesini yudumlayarak başlayabilirsiniz. Boğaz kıyısı ve Ortaköy Camii gibi yakınlardaki görülecek yerleri keşfettikten veya kolay erişilebilir toplu taşıma noktaları sayesinde şehri fethettikten sonra toprak tonlarının hakim olduğu modern iç tasarımla dekore edilmiş evimizin sakinleştirici atmosferinde dinlenebilirsiniz. \n\nHuzur ve ev konforuyla harmanlanan bir İstanbul deneyimi için hemen rezervasyon yapın!\n\n…\n\nEvimiz Missafir Sürdürülebilirlik Politikası’na uygun bir şekilde hazırlanmıştır. Evimizde enerji verimliliği için A+ enerji sınıfına sahip beyaz eşya ve LED ampulleri tercih edilmiştir. Ayrıca mobilya ve aksesuarlarımızın çoğu yerel tedarikçilerden satın alınmıştır. \n\nMissafir olarak kuru temizleme ile çarşaf ve havlular dahil UV kontrollü profesyonel temizlik hizmetleri, en kaliteli Türk ikramları ile özenle hazırlanmış bir karşılama paketi ve 7/24 iletişim desteği gibi hizmetlerimizle konuklarımıza 5 yıldızlı otel kalitesi sunmaktan mutluluk duyuyoruz. Kendinizi evinizde hissetmeniz için gerekli banyo malzemeleri ve mutfak gereçleri de varışınızdan önce temin edilecektir. ', '41.0529494', '29.0273227');
");
//        $this->connection->executeQuery("");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
