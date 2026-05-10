// main.js - Tüm sayfalarda ortak kullanılan JavaScript dosyası

console.log("Site yüklendi - Enes Web Teknolojileri Projesi");

// Slider değişkenleri
var currentSlide = 0;
var autoSlideInterval = null;

document.addEventListener('DOMContentLoaded', function() {

    // Scroll animasyonları - IntersectionObserver ile elemanlar görününce fade-in
    var fadeElements = document.querySelectorAll('.fade-in');

    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry, index) {
            if (entry.isIntersecting) {
                // Sırayla belirmesi için her elemana gecikme ekliyorum
                setTimeout(function() {
                    entry.target.classList.add('visible');
                }, index * 150);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 }); // %10 görünür olunca tetikle

    fadeElements.forEach(function(el) {
        observer.observe(el);
    });

    // Navbar - aşağı kaydırınca küçülüp gölge ekleniyor
    window.addEventListener('scroll', function() {
        var navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.style.padding = '8px 0';
            navbar.style.boxShadow = '0 4px 30px rgba(0, 0, 0, 0.2)';
        } else {
            navbar.style.padding = '15px 0';
            navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
        }
    });

    // Slider varsa başlat (sehrim.html'de kullanılıyor)
    var slides = document.querySelectorAll('.slider-slide');
    if (slides.length > 0) {
        startAutoSlide();

        // Slide resmine tıklayınca lightbox aç
        slides.forEach(function(slide) {
            var img = slide.querySelector('img');
            if (img) {
                img.addEventListener('click', function() {
                    openLightbox(this.src);
                });
            }
        });
    }
});

// === SLIDER FONKSİYONLARI ===
// Kütüphane kullanmadan saf JS ile yazdım

// direction: 1 ileri, -1 geri
function slideChange(direction) {
    var slides = document.querySelectorAll('.slider-slide');
    if (slides.length === 0) return;
    // Modüler aritmetik - son slide'dan sonra başa döner
    currentSlide = (currentSlide + direction + slides.length) % slides.length;
    updateSlider();
    resetAutoSlide();
}

function goToSlide(index) {
    currentSlide = index;
    updateSlider();
    resetAutoSlide();
}

// Aktif slide, dot ve thumbnail'i güncelle
function updateSlider() {
    var slides = document.querySelectorAll('.slider-slide');
    var dots = document.querySelectorAll('.slider-dot');
    var thumbs = document.querySelectorAll('.thumb');

    slides.forEach(function(slide, i) {
        slide.classList.toggle('active', i === currentSlide);
    });
    dots.forEach(function(dot, i) {
        dot.classList.toggle('active', i === currentSlide);
    });
    thumbs.forEach(function(thumb, i) {
        thumb.classList.toggle('active', i === currentSlide);
    });
}

// Her 4 saniyede otomatik ileri geçiş
function startAutoSlide() {
    autoSlideInterval = setInterval(function() {
        slideChange(1);
    }, 4000);
}

function resetAutoSlide() {
    clearInterval(autoSlideInterval);
    startAutoSlide();
}

// === LIGHTBOX ===
// Resme tıklayınca tam ekran overlay açar, tıklayınca kapanır
function openLightbox(imgSrc) {
    var overlay = document.createElement('div');
    overlay.className = 'slider-lightbox';
    overlay.innerHTML = '<img src="' + imgSrc + '" alt="Büyük Görüntü"><span class="lightbox-close">&times;</span>';
    document.body.appendChild(overlay);

    setTimeout(function() {
        overlay.classList.add('active');
    }, 10);

    overlay.addEventListener('click', function() {
        overlay.classList.remove('active');
        setTimeout(function() {
            overlay.remove();
        }, 300);
    });
}
