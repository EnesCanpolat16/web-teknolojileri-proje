// Ana JavaScript dosyası
console.log("Site yüklendi - Enes Web Teknolojileri Projesi");

// ===== SLIDER DEĞİŞKENLERİ =====
var currentSlide = 0;
var autoSlideInterval = null;

// Scroll animasyonları - elemanlar görünür olduğunda fade-in efekti
document.addEventListener('DOMContentLoaded', function() {
    var fadeElements = document.querySelectorAll('.fade-in');

    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry, index) {
            if (entry.isIntersecting) {
                setTimeout(function() {
                    entry.target.classList.add('visible');
                }, index * 150);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    fadeElements.forEach(function(el) {
        observer.observe(el);
    });

    // Navbar scroll efekti
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

    // ===== SLIDER BAŞLAT =====
    var slides = document.querySelectorAll('.slider-slide');
    if (slides.length > 0) {
        startAutoSlide();

        // Slide resmini tıklayınca lightbox aç
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

// ===== SLIDER FONKSİYONLARI =====
function slideChange(direction) {
    var slides = document.querySelectorAll('.slider-slide');
    if (slides.length === 0) return;
    currentSlide = (currentSlide + direction + slides.length) % slides.length;
    updateSlider();
    resetAutoSlide();
}

function goToSlide(index) {
    currentSlide = index;
    updateSlider();
    resetAutoSlide();
}

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

function startAutoSlide() {
    autoSlideInterval = setInterval(function() {
        slideChange(1);
    }, 4000);
}

function resetAutoSlide() {
    clearInterval(autoSlideInterval);
    startAutoSlide();
}

// ===== LIGHTBOX =====
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
