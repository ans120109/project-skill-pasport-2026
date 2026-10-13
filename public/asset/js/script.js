document.addEventListener("DOMContentLoaded", function () {

    const menuButton = document.querySelector(".menu-button");
    const navMenu = document.querySelector(".nav-menu");

    if (menuButton && navMenu) {

        menuButton.addEventListener("click", function () {
            navMenu.classList.toggle("active");
        });

    }


    const yearElements = document.querySelectorAll(".current-year");

    yearElements.forEach(function (element) {
        element.textContent = new Date().getFullYear();
    });


    const registerForm = document.getElementById("registerForm");

    if (registerForm) {

        registerForm.addEventListener("submit", function (event) {

            const nama = document.getElementById("nama");
            const email = document.getElementById("email");
            const password = document.getElementById("password");
            const konfirmasi = document.getElementById("konfirmasi");


            if (
                !nama ||
                !email ||
                !password ||
                !konfirmasi
            ) {
                return;
            }


            nama.value = nama.value.trim();
            email.value = email.value.trim();


            if (nama.value === "") {

                event.preventDefault();

                alert("Nama lengkap harus diisi.");

                nama.focus();

                return;
            }


            if (email.value === "") {

                event.preventDefault();

                alert("Email harus diisi.");

                email.focus();

                return;
            }


            if (password.value.length < 6) {

                event.preventDefault();

                alert("Password minimal 6 karakter.");

                password.focus();

                return;
            }


            if (password.value !== konfirmasi.value) {

                event.preventDefault();

                alert("Konfirmasi password tidak sama.");

                konfirmasi.focus();

                return;
            }

        });

    }


    const loginForm = document.getElementById("loginForm");

    if (loginForm) {

        loginForm.addEventListener("submit", function (event) {

            const email = document.getElementById("email");
            const password = document.getElementById("password");


            if (!email || !password) {
                return;
            }


            email.value = email.value.trim();


            if (email.value === "") {

                event.preventDefault();

                alert("Email harus diisi.");

                email.focus();

                return;
            }


            if (password.value === "") {

                event.preventDefault();

                alert("Password harus diisi.");

                password.focus();

                return;
            }


        });

    }


    const logoutButtons =
        document.querySelectorAll(".logout-button");


    logoutButtons.forEach(function (button) {

        button.addEventListener("click", function (event) {

            const konfirmasi = confirm(
                "Apakah kamu yakin ingin logout?"
            );


            if (!konfirmasi) {

                event.preventDefault();

            }

        });

    });


    const searchBerita =
        document.getElementById("searchBerita");

    const beritaItems =
        document.querySelectorAll(".berita-item");


    if (searchBerita) {

        searchBerita.addEventListener("input", function () {

            const keyword =
                this.value.toLowerCase().trim();


            beritaItems.forEach(function (item) {

                const text =
                    item.textContent.toLowerCase();


                if (text.includes(keyword)) {

                    item.style.display = "";

                } else {

                    item.style.display = "none";

                }

            });

        });

    }


    const contactForm =
        document.getElementById("contactForm");


    if (contactForm) {

        contactForm.addEventListener("submit", function (event) {

            const nama =
                document.getElementById("nama");

            const email =
                document.getElementById("email");

            const pesan =
                document.getElementById("pesan");


            if (!nama || !email || !pesan) {
                return;
            }


            nama.value = nama.value.trim();
            email.value = email.value.trim();
            pesan.value = pesan.value.trim();


            if (nama.value === "") {

                event.preventDefault();

                alert("Nama harus diisi.");

                nama.focus();

                return;
            }


            if (email.value === "") {

                event.preventDefault();

                alert("Email harus diisi.");

                email.focus();

                return;
            }


            if (pesan.value === "") {

                event.preventDefault();

                alert("Pesan harus diisi.");

                pesan.focus();

                return;
            }

        });

    }


    const backButtons =
        document.querySelectorAll(".btn-back");


    backButtons.forEach(function (button) {

        button.addEventListener("click", function () {

            window.history.back();

        });

    });


    const deleteButtons =
        document.querySelectorAll(".btn-delete");


    deleteButtons.forEach(function (button) {

        button.addEventListener("click", function (event) {

            const yakin = confirm(
                "Apakah kamu yakin ingin menghapus data ini?"
            );


            if (!yakin) {

                event.preventDefault();

            }

        });

    });


    const passwordToggle =
        document.querySelector(".password-toggle");

    const passwordInput =
        document.querySelector(".password-input");


    if (passwordToggle && passwordInput) {

        passwordToggle.addEventListener("click", function () {

            if (passwordInput.type === "password") {

                passwordInput.type = "text";

                passwordToggle.textContent = "Sembunyikan";

            } else {

                passwordInput.type = "password";

                passwordToggle.textContent = "Tampilkan";

            }

        });

    }

});
