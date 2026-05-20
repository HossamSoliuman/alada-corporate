// resources/js/admin.js
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Image preview on file input change
document.addEventListener('change', function (e) {
    if (e.target.type === 'file' && e.target.accept.includes('image')) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function (ev) {
            let preview = e.target.closest('.image-upload-wrap')?.querySelector('.image-preview');
            if (!preview) {
                preview = e.target.nextElementSibling;
            }
            if (preview && preview.tagName === 'IMG') {
                preview.src = ev.target.result;
            }
        };
        reader.readAsDataURL(file);
    }
});

// Auto-dismiss flash messages after 4s
document.querySelectorAll('[data-auto-dismiss]').forEach(el => {
    setTimeout(() => el.remove(), 4000);
});

// Confirm delete on all delete forms
document.querySelectorAll('form[data-confirm]').forEach(form => {
    form.addEventListener('submit', function (e) {
        const msg = this.dataset.confirm || 'Are you sure?';
        if (!window.confirm(msg)) e.preventDefault();
    });
});

// Initialize TinyMCE if loaded
if (typeof tinymce !== 'undefined') {
    tinymce.init({
        selector: '#blog-content, #page-content, #cs-content',
        height: 450,
        plugins: 'autolink lists link image charmap preview searchreplace code fullscreen insertdatetime media table paste wordcount',
        toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image | removeformat code',
        branding: false,
        promotion: false,
    });
}
