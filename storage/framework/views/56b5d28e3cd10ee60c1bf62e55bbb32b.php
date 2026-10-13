<style>
    .btn {
        display: inline-flex; align-items: center; justify-content: center; gap: 7px;
        padding: 10px 20px; border: 1.5px solid transparent; border-radius: 10px;
        font-family: inherit; font-size: 14px; font-weight: 600; line-height: 1;
        white-space: nowrap; text-decoration: none; cursor: pointer;
        transition: background .2s, color .2s, border-color .2s, transform .15s, box-shadow .2s;
    }
    .btn:hover { transform: translateY(-2px); }
    .btn:active { transform: translateY(0); box-shadow: none; }
    .btn:focus-visible { outline: 3px solid rgba(217,154,34,.45); outline-offset: 2px; }

    .btn-tambah::before, .btn-edit::before, .btn-hapus::before, .btn-danger::before, .btn-simpan::before {
        content: ""; width: 15px; height: 15px; flex: none; background: currentColor;
        -webkit-mask-repeat: no-repeat; mask-repeat: no-repeat;
        -webkit-mask-position: center; mask-position: center;
        -webkit-mask-size: contain; mask-size: contain;
    }
    .btn-tambah::before {
        -webkit-mask-image: url("data:image/svg+xml;utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='2.6' stroke-linecap='round'%3E%3Cpath d='M12 5v14M5 12h14'/%3E%3C/svg%3E");
                mask-image: url("data:image/svg+xml;utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='2.6' stroke-linecap='round'%3E%3Cpath d='M12 5v14M5 12h14'/%3E%3C/svg%3E");
    }
    .btn-edit::before {
        -webkit-mask-image: url("data:image/svg+xml;utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M12 20h9'/%3E%3Cpath d='M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z'/%3E%3C/svg%3E");
                mask-image: url("data:image/svg+xml;utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M12 20h9'/%3E%3Cpath d='M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z'/%3E%3C/svg%3E");
    }
    .btn-hapus::before, .btn-danger::before {
        -webkit-mask-image: url("data:image/svg+xml;utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M3 6h18'/%3E%3Cpath d='M8 6V4h8v2'/%3E%3Cpath d='M19 6l-1 14H6L5 6'/%3E%3Cpath d='M10 11v6M14 11v6'/%3E%3C/svg%3E");
                mask-image: url("data:image/svg+xml;utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M3 6h18'/%3E%3Cpath d='M8 6V4h8v2'/%3E%3Cpath d='M19 6l-1 14H6L5 6'/%3E%3Cpath d='M10 11v6M14 11v6'/%3E%3C/svg%3E");
    }
    .btn-simpan::before {
        -webkit-mask-image: url("data:image/svg+xml;utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='2.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M20 6 9 17l-5-5'/%3E%3C/svg%3E");
                mask-image: url("data:image/svg+xml;utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='2.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M20 6 9 17l-5-5'/%3E%3C/svg%3E");
    }

    .btn-tambah, .btn-simpan, .btn-gold {
        background: linear-gradient(135deg, #e8a92d, #d99a22);
        color: #fff; border-color: #d99a22;
        box-shadow: 0 3px 8px rgba(217,154,34,.35);
    }
    .btn-tambah:hover, .btn-simpan:hover, .btn-gold:hover {
        background: linear-gradient(135deg, #d99a22, #c28a1c);
        border-color: #c28a1c; color: #fff;
        box-shadow: 0 6px 14px rgba(217,154,34,.45);
    }

    .btn-edit {
        background: #0f1f4b; color: #fff; border-color: #0f1f4b;
        box-shadow: 0 3px 8px rgba(15,31,75,.25);
    }
    .btn-edit:hover {
        background: #1a3170; border-color: #1a3170; color: #fff;
        box-shadow: 0 6px 14px rgba(15,31,75,.35);
    }

    .btn-hapus, .btn-danger {
        background: #fef2f2; color: #dc2626; border-color: #fecaca;
    }
    .btn-hapus:hover, .btn-danger:hover {
        background: #dc2626; color: #fff; border-color: #dc2626;
        box-shadow: 0 6px 14px rgba(220,38,38,.35);
    }

    .btn-outline {
        background: #fff; color: #0f1f4b; border-color: #cbd2e1;
    }
    .btn-outline:hover {
        background: #f1f4fb; color: #0f1f4b; border-color: #0f1f4b;
        box-shadow: 0 4px 10px rgba(15,31,75,.12);
    }

    .btn-back {
        display: inline-flex; align-items: center; gap: 9px;
        padding: 7px 18px 7px 8px; background: #0f1f4b; color: #fff;
        border-radius: 999px; font-size: 13px; font-weight: 600; line-height: 1;
        text-decoration: none; box-shadow: 0 3px 8px rgba(15,31,75,.25);
        transition: background .2s, transform .15s, box-shadow .2s;
    }
    .btn-back::before {
        content: ""; width: 26px; height: 26px; border-radius: 50%; flex: none;
        background-color: #d99a22;
        background-image: url("data:image/svg+xml;utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2.8' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M19 12H5M12 19l-7-7 7-7'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: center; background-size: 14px;
        transition: transform .2s;
    }
    .btn-back:hover {
        background: #1a3170; color: #fff; transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(15,31,75,.35);
    }
    .btn-back:hover::before { transform: translateX(-3px); }

    .btn-sm { padding: 8px 12px; font-size: 12.5px; border-radius: 8px; }
    .btn-sm::before { width: 13px !important; height: 13px !important; }

    .aksi { display: flex; gap: 8px; flex-wrap: nowrap; }
    .aksi form { margin: 0; flex: 1; display: flex; }
    .aksi > .btn, .aksi form .btn { flex: 1; width: 100%; }
</style><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views/partials/ui-styles.blade.php ENDPATH**/ ?>