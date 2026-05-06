<?php
// =============================================
// İLETİŞİM FORMU - Sunucu Tarafı İşleme
// Bu dosya iletisim.html'deki formdan POST ile
// gelen tüm verileri alıp düzenli şekilde ekrana yazdırır.
// =============================================

// --- Saat dilimini Türkiye olarak ayarlıyorum ---
date_default_timezone_set('Europe/Istanbul');

// --- POST ile gelen verileri alıyorum ---
// Her bir form elemanının değerini $_POST ile çekiyorum
// isset() ile o alanın gelip gelmediğini kontrol ediyorum
// htmlspecialchars() ile XSS saldırısına karşı verileri temizliyorum

$ad = isset($_POST['ad']) ? htmlspecialchars(trim($_POST['ad'])) : 'Belirtilmedi';
$soyad = isset($_POST['soyad']) ? htmlspecialchars(trim($_POST['soyad'])) : 'Belirtilmedi';
$email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : 'Belirtilmedi';
$telefon = isset($_POST['telefon']) ? htmlspecialchars(trim($_POST['telefon'])) : 'Belirtilmedi';
$dogumTarihi = isset($_POST['dogumTarihi']) ? htmlspecialchars(trim($_POST['dogumTarihi'])) : 'Belirtilmedi';
$cinsiyet = isset($_POST['cinsiyet']) ? htmlspecialchars(trim($_POST['cinsiyet'])) : 'Belirtilmedi';
$konu = isset($_POST['konu']) ? htmlspecialchars(trim($_POST['konu'])) : 'Belirtilmedi';
$mesaj = isset($_POST['mesaj']) ? htmlspecialchars(trim($_POST['mesaj'])) : 'Belirtilmedi';
$deneyim = isset($_POST['deneyim']) ? htmlspecialchars(trim($_POST['deneyim'])) : 'Belirtilmedi';
$kvkk = isset($_POST['kvkk']) ? 'Evet' : 'Hayır';

// --- Checkbox grubunu (ilgi alanları) alıyorum ---
// Checkbox grubu dizi olarak gelir, bu yüzden $_POST['ilgiAlanlari'] bir array
// implode() ile diziyi virgülle ayırarak tek bir string haline getiriyorum
$ilgiAlanlari = isset($_POST['ilgiAlanlari']) ? implode(', ', $_POST['ilgiAlanlari']) : 'Seçilmedi';

// --- Gönderim tarihini alıyorum ---
// date() fonksiyonu ile şu anki tarih ve saati formatladım
$gonderimTarihi = date('d.m.Y - H:i:s');
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sonucu - İletişim</title>
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
            <h1 class="page-title"><i class="fa-solid fa-envelope-open-text me-3"></i>Form Sonucu</h1>
            <p class="page-subtitle">Gönderdiğiniz bilgiler aşağıda listelenmektedir</p>
        </div>
    </section>

    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="php-sonuc-card fade-in">

                    <!-- Başarı mesajı -->
                    <div class="alert alert-success">
                        <i class="fa-solid fa-circle-check me-2"></i>
                        <strong>Form başarıyla gönderildi!</strong> Tüm bilgiler sunucu tarafında (PHP) işlendi.
                    </div>

                    <h4 class="fw-bold mb-4"><i class="fa-solid fa-list-check me-2 text-primary"></i>Gönderilen Bilgiler</h4>

                    <!-- Tüm form verilerini tabloda gösteriyorum -->
                    <div class="table-responsive">
                        <table class="table php-tablo">
                            <thead>
                                <tr>
                                    <th style="width: 35%;">Alan</th>
                                    <th>Değer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><i class="fa-solid fa-user me-2 text-primary"></i>Ad</td>
                                    <!-- PHP değişkenini echo ile yazdırıyorum -->
                                    <td><?php echo $ad; ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-user me-2 text-primary"></i>Soyad</td>
                                    <td><?php echo $soyad; ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-envelope me-2 text-primary"></i>E-posta</td>
                                    <td><?php echo $email; ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-phone me-2 text-primary"></i>Telefon</td>
                                    <td><?php echo $telefon; ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-calendar me-2 text-primary"></i>Doğum Tarihi</td>
                                    <td><?php echo $dogumTarihi; ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-venus-mars me-2 text-primary"></i>Cinsiyet</td>
                                    <td><?php echo $cinsiyet; ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-tag me-2 text-primary"></i>Konu</td>
                                    <td><?php echo $konu; ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-heart me-2 text-primary"></i>İlgi Alanları</td>
                                    <!-- implode() ile birleştirdiğim checkbox değerleri -->
                                    <td><?php echo $ilgiAlanlari; ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-gauge me-2 text-primary"></i>Deneyim Seviyesi</td>
                                    <td><?php echo $deneyim; ?>/10</td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-message me-2 text-primary"></i>Mesaj</td>
                                    <!-- nl2br() ile mesajdaki satır sonlarını <br> etiketine çeviriyorum -->
                                    <td><?php echo nl2br($mesaj); ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-shield-halved me-2 text-primary"></i>KVKK Onayı</td>
                                    <td><?php echo $kvkk; ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-clock me-2 text-primary"></i>Gönderim Tarihi</td>
                                    <td><?php echo $gonderimTarihi; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Geri dön butonu -->
                    <div class="text-center mt-4">
                        <a href="../pages/iletisim.html" class="btn btn-primary me-2">
                            <i class="fa-solid fa-arrow-left me-2"></i>Forma Geri Dön
                        </a>
                        <a href="../index.html" class="btn btn-outline-primary">
                            <i class="fa-solid fa-house me-2"></i>Ana Sayfa
                        </a>
                    </div>

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
