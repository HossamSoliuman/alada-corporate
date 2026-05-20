// resources/js/app.js
import Alpine from 'alpinejs';
import axios from 'axios';

window.Alpine = Alpine;
Alpine.start();

// CSRF for Axios
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const token = document.querySelector('meta[name="csrf-token"]');
if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.getAttribute('content');
}

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

// Lazy load images (native + polyfill)
document.querySelectorAll('img[loading="lazy"]').forEach(img => {
    if (!('loading' in HTMLImageElement.prototype)) {
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const image = entry.target;
                    image.src = image.dataset.src || image.src;
                    observer.unobserve(image);
                }
            });
        });
        observer.observe(img);
    }
});

// Quick inquiry modal AJAX submit
window.submitQuickInquiry = async function(formEl) {
    const data = new FormData(formEl);
    const btn = formEl.querySelector('[type=submit]');
    btn.disabled = true;
    btn.textContent = 'Sending...';

    try {
        const res = await axios.post('/contact/inquiry', Object.fromEntries(data));
        formEl.reset();
        const msg = document.createElement('div');
        msg.className = 'mt-4 p-3 bg-green-50 text-green-700 rounded-lg text-sm';
        msg.textContent = res.data.message;
        formEl.appendChild(msg);
        setTimeout(() => msg.remove(), 5000);
    } catch (err) {
        const errors = err.response?.data?.errors;
        const msg = document.createElement('div');
        msg.className = 'mt-4 p-3 bg-red-50 text-red-700 rounded-lg text-sm';
        msg.textContent = errors ? Object.values(errors).flat().join('. ') : 'Something went wrong.';
        formEl.appendChild(msg);
    } finally {
        btn.disabled = false;
        btn.textContent = 'Send';
    }
};
