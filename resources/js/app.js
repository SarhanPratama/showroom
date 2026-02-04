import './bootstrap';
document.addEventListener('DOMContentLoaded', function () {
    const sliderContainer = document.getElementById('slider-container');
    const slides = document.querySelectorAll('.slide');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const dotsContainer = document.getElementById('dots-container');

    let currentIndex = 0;
    let slideInterval;
    const totalSlides = slides.length;

    // Create dots
    for (let i = 0; i < totalSlides; i++) {
        const dot = document.createElement('div');
        dot.classList.add('dot');
        dot.addEventListener('click', () => {
            goToSlide(i);
            resetInterval();
        });
        dotsContainer.appendChild(dot);
    }
    const dots = document.querySelectorAll('.dot');

    function updateTextAnimation(index) {
        slides.forEach((slide, i) => {
            const textContent = slide.querySelector('.animate-text-in');
            if (textContent) {
                textContent.style.animation = 'none';
                // Trigger reflow to restart animation
                void textContent.offsetWidth;
            }
        });
        const currentTextContent = slides[index].querySelector('.animate-text-in');
        if (currentTextContent) {
            currentTextContent.style.animation = '';
        }
    }

    function goToSlide(index) {
        sliderContainer.style.transform = `translateX(-${index * 100}%)`;
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
        currentIndex = index;
        updateTextAnimation(currentIndex);
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        goToSlide(currentIndex);
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        goToSlide(currentIndex);
    }

    function startInterval() {
        slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
    }

    function resetInterval() {
        clearInterval(slideInterval);
        startInterval();
    }

    nextBtn.addEventListener('click', () => {
        nextSlide();
        resetInterval();
    });

    prevBtn.addEventListener('click', () => {
        prevSlide();
        resetInterval();
    });

    // Pause on hover
    sliderContainer.parentElement.addEventListener('mouseenter', () => clearInterval(slideInterval));
    sliderContainer.parentElement.addEventListener('mouseleave', startInterval);

    // Initialize
    goToSlide(0);
    startInterval();
});

function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('hidden');
}

// Show Detail Modal
function showDetail(carName) {
    document.getElementById('detailModal').classList.remove('hidden');
    document.getElementById('carTitle').textContent = carName;
    document.body.style.overflow = 'hidden';
}

// Close Detail Modal
function closeDetail() {
    document.getElementById('detailModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Hitung Kredit Function
function hitungKredit() {
    const hargaMobil = 158000000; // Harga mobil
    const dp = parseInt(document.getElementById('dpInput').value) || 0;
    const tenor = parseInt(document.getElementById('tenorSelect').value) || 60;

    // Simulasi perhitungan sederhana (bunga flat 5% per tahun)
    const pokokPinjaman = hargaMobil - dp;
    const bungaPerBulan = 0.05 / 12; // 5% per tahun / 12 bulan
    const totalBunga = pokokPinjaman * bungaPerBulan * tenor;
    const angsuran = (pokokPinjaman + totalBunga) / tenor;

    // Format currency
    const formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    });

    document.getElementById('angsuranResult').textContent = formatter.format(angsuran);
}

// Smooth scroll for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
            // Close mobile menu if open
            document.getElementById('mobileMenu').classList.add('hidden');
        }
    });
});

// Image gallery in detail modal
document.querySelectorAll('#detailModal img[alt="Thumb"]').forEach(thumb => {
    thumb.addEventListener('click', function () {
        document.getElementById('mainImage').src = this.src.replace('w=150', 'w=600');
    });
});

// Close modal on escape key
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        closeDetail();
    }
});

// Close modal on background click
document.getElementById('detailModal').addEventListener('click', function (e) {
    if (e.target === this) {
        closeDetail();
    }
});
