<style>
    .form-card {
        background: #fff; border: 1px solid #e5e7eb; border-radius: 12px;
        padding: 24px; max-width: 760px; margin-top: 16px;
    }
    .form-group { margin-bottom: 18px; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    @media (max-width: 700px) { .form-row { grid-template-columns: 1fr; } }

    .form-group label {
        display: block; font-size: 14px; font-weight: 600;
        margin-bottom: 6px; color: #1f2937;
    }
    .form-group label .req { color: #dc2626; }
    .form-group label .hint { color: #6b7280; font-weight: 400; font-size: 12px; }

    .form-group input[type="text"],
    .form-group input[type="date"],
    .form-group textarea {
        width: 100%; padding: 10px 12px; border: 1px solid #d1d5db;
        border-radius: 8px; font: inherit; font-size: 14px; background: #fff;
        box-sizing: border-box; transition: border-color .2s, box-shadow .2s;
    }
    .form-group input:focus, .form-group textarea:focus {
        outline: none; border-color: #d99a22; box-shadow: 0 0 0 3px rgba(217,154,34,.2);
    }
    .form-group textarea { min-height: 140px; resize: vertical; line-height: 1.6; }
    .form-group textarea.tall { min-height: 200px; }

    .form-group input[type="file"] {
        width: 100%; padding: 10px; border: 1px dashed #d1d5db;
        border-radius: 8px; background: #fafafa; font-size: 13px; box-sizing: border-box;
    }
    .form-error { color: #dc2626; font-size: 13px; margin-top: 4px; }

    .foto-lama, .img-preview {
        max-width: 240px; border-radius: 8px; border: 1px solid #e5e7eb;
    }
    .foto-lama { display: block; margin-bottom: 10px; }
    .img-preview { display: none; margin-top: 10px; }
    .img-preview.show { display: block; }

    .form-actions {
        display: flex; gap: 10px; margin-top: 8px;
        padding-top: 16px; border-top: 1px solid #eee;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var input = document.querySelector('input[type="file"][data-preview]');
        var img = document.getElementById('preview');
        if (!input || !img) return;
        input.addEventListener('change', function () {
            var file = this.files[0];
            if (file) { img.src = URL.createObjectURL(file); img.classList.add('show'); }
            else { img.removeAttribute('src'); img.classList.remove('show'); }
        });
    });
</script><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\partials\form-styles.blade.php ENDPATH**/ ?>