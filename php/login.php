<?php
// =============================================
// LOGIN İŞLEMİ - Kullanıcı Giriş Kontrolü
// Bu dosya login.html'deki formdan POST ile
// gelen kullanıcı adı ve şifreyi kontrol eder.
// =============================================

// --- Saat dilimini Türkiye olarak ayarlıyorum ---
date_default_timezone_set('Europe/Istanbul');

// --- Doğru kullanıcı bilgilerini değişkenlerde tanımlıyorum ---
// Kullanıcı adı olarak öğrenci mail adresimi,
// şifre olarak da öğrenci numaramı kullanıyorum
$dogruMail = "enes.canpolaten@ogr.sakarya.edu.tr";
$dogruSifre = "g231210050";

// --- POST ile gelen verileri alıyorum ---
// isset() ile değişkenin gelip gelmediğini kontrol ediyorum
// trim() ile baştaki ve sondaki boşlukları temizliyorum
$gelenMail = isset($_POST['kullaniciAdi']) ? trim($_POST['kullaniciAdi']) : '';
$gelenSifre = isset($_POST['sifre']) ? trim($_POST['sifre']) : '';

// --- Boş alan kontrolü ---
// Eğer mail veya şifre boş geldiyse login sayfasına geri yönlendiriyorum
// header() fonksiyonu ile yönlendirme yapıyorum, ?hata=1 parametresi ile
// login sayfasındaki JavaScript hata mesajını gösterecek
if ($gelenMail === '' || $gelenSifre === '') {
    header("Location: ../pages/login.html?hata=1");
    exit(); // Yönlendirmeden sonra kodun devam etmesini engelliyorum
}

// --- Kullanıcı bilgilerini karşılaştırıyorum ---
// Gelen mail ve şifreyi, yukarıda tanımladığım doğru değerlerle
// karşılaştırıyorum. İkisi de eşleşirse giriş başarılı.
if ($gelenMail === $dogruMail && $gelenSifre === $dogruSifre) {

    // === GİRİŞ BAŞARILI ===
    // Öğrenci numarasını şifreden alıyorum (şifre = öğrenci no)
    $ogrenciNo = $gelenSifre;
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Başarılı</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container">
                <a class="navbar-brand fw-bold" href="../index.html"><i class="fa-solid fa-code me-2"></i>Enes</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navMenu">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="../index.html">Hakkında</a></li>
                        <li class="nav-item"><a class="nav-link" href="../pages/cv.html">CV</a></li>
                        <li class="nav-item"><a class="nav-link" href="../pages/sehrim.html">Şehrim</a></li>
                        <li class="nav-item"><a class="nav-link" href="../pages/mirasimiz.html">Mirasımız</a></li>
                        <li class="nav-item"><a class="nav-link" href="../pages/ilgi-alanlarim.html">İlgi Alanlarım</a></li>
                        <li class="nav-item"><a class="nav-link" href="../pages/iletisim.html">İletişim</a></li>
                        <li class="nav-item"><a class="nav-link" href="../pages/login.html">Giriş</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="page-header">
        <div class="container text-center">
            <h1 class="page-title"><i class="fa-solid fa-circle-check me-3"></i>Giriş Başarılı</h1>
            <p class="page-subtitle">Sisteme başarıyla giriş yaptınız</p>
        </div>
    </section>

    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="php-sonuc-card text-center fade-in">
                    <!-- Başarı ikonu -->
                    <div class="php-basari-icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>

                    <!-- Hoşgeldiniz mesajı - Hoca bunu istiyor -->
                    <h2 class="fw-bold mt-4">Hoşgeldiniz <?php echo htmlspecialchars($ogrenciNo); ?></h2>

                    <p class="text-muted mt-2">Sisteme başarıyla giriş yaptınız.</p>

                    <!-- Kullanıcı bilgileri tablosu -->
                    <div class="table-responsive mt-4">
                        <table class="table php-tablo">
                            <tr>
                                <td class="fw-bold"><i class="fa-solid fa-envelope me-2"></i>Mail</td>
                                <!-- htmlspecialchars() ile XSS saldırısına karşı koruma sağlıyorum -->
                                <td><?php echo htmlspecialchars($gelenMail); ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold"><i class="fa-solid fa-id-card me-2"></i>Öğrenci No</td>
                                <td><?php echo htmlspecialchars($ogrenciNo); ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold"><i class="fa-solid fa-clock me-2"></i>Giriş Zamanı</td>
                                <!-- date() ile şu anki tarih ve saati alıyorum -->
                                <td><?php echo date('d.m.Y - H:i:s'); ?></td>
                            </tr>
                        </table>
                    </div>

                    <!-- Ana sayfaya dön butonu -->
                    <a href="../index.html" class="btn btn-primary mt-3">
                        <i class="fa-solid fa-house me-2"></i>Ana Sayfaya Dön
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container text-center py-4">
            <p class="mb-0 text-light">&copy; 2026 Enes Canpolat — Web Teknolojileri Projesi</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>

<?php
} else {

    // === GİRİŞ BAŞARISIZ ===
    // Mail veya şifre yanlışsa kullanıcıyı login sayfasına
    // geri yönlendiriyorum. URL'ye ?hata=1 ekliyorum ki
    // login sayfasındaki JavaScript hata mesajı göstersin.
    header("Location: ../pages/login.html?hata=1");
    exit();
}
?>
