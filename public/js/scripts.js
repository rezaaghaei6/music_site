document.addEventListener('DOMContentLoaded', function() {
    // تغییر حالت تم (دارک/لایت)
    const modeToggle = document.getElementById('modeToggle');
    const body = document.body;
    
    if (modeToggle) {
        modeToggle.addEventListener('click', () => {
            if (body.classList.contains('dark-mode')) {
                body.classList.remove('dark-mode');
                body.classList.add('light-mode');
                modeToggle.textContent = 'حالت تیره';
                localStorage.setItem('theme', 'light');
            } else {
                body.classList.remove('light-mode');
                body.classList.add('dark-mode');
                modeToggle.textContent = 'حالت روشن';
                localStorage.setItem('theme', 'dark');
            }
        });
    }

    // بررسی تم ذخیره شده در مرورگر
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'light') {
        body.classList.remove('dark-mode');
        body.classList.add('light-mode');
        if (modeToggle) modeToggle.textContent = 'حالت تیره';
    } else {
        body.classList.remove('light-mode');
        body.classList.add('dark-mode');
        if (modeToggle) modeToggle.textContent = 'حالت روشن';
    }

    // شبیه‌سازی پخش‌کننده موسیقی
    const playBtn = document.querySelector('.play-btn');
    if (playBtn) {
        playBtn.addEventListener('click', function() {
            if (this.textContent === 'پخش') {
                this.textContent = 'توقف';
            } else {
                this.textContent = 'پخش';
            }
        });
    }

    // انیمیشن اسکرول
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.category-card, .trending-item, .featured-player, .stat-item');
        
        elements.forEach(element => {
            const position = element.getBoundingClientRect();
            
            // اگر المان در صفحه نمایش قابل مشاهده باشد
            if(position.top < window.innerHeight && position.bottom >= 0) {
                element.classList.add('animate__animated', 'animate__fadeInUp');
            }
        });
    };

    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // اجرای اولیه برای المان‌های قابل مشاهده

    // اسکرول نرم برای لینک‌های داخل صفحه
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
});