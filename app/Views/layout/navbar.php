<style>
    .navbar.navbar-expand-lg {
        background-color: transparent;
        transition: background-color 0.3s ease-in-out;
    }

    /* Navbar dengan latar belakang hitam ketika collapse terbuka */
    .navbar-collapse.show {
        background-color: black;
        transition: background-color 0.3s ease-in-out;
    }

    /* Navbar tetap transparan saat collapse tidak terbuka */
    .navbar-collapse {
        background-color: transparent;
    }

    .navbar-brand,
    .nav-link {
        color: #fff !important;
    }

    /* Gradient background for navbar */
    .bg-gradient-custom {
        background: none;
    }

    /* Text shadow and hover effect on links */
    .navbar-brand,
    .nav-link {
        color: #fff !important;
        font-weight: bold;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.6);
    }

    .nav-link:hover {
        color: #ffeb3b !important;
        transform: scale(1.1);
        transition: 0.3s ease;
    }

    /* Add a soft shadow to the navbar */
    .shadow-lg {
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
    }

    /* Styling brand logo */
    .navbar-brand img {
        transition: transform 0.3s ease;
        margin-left: 20px;
    }

    /* Logo hover effect */
    .navbar-brand:hover img {
        transform: rotate(360deg);
    }

    /* Styling untuk tombol Login dan Logout */
    .login-btn,
    .logout-btn {
        position: relative;
        z-index: 10;
    }

    /* Desain Tombol Login */
    .login-btn .btn {
        background-color: #007bff;
        color: white;
        transition: all 0.3s ease;
        border: 2px solid #007bff;
    }

    .login-btn .btn:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        transform: scale(1.1);
    }

    .login-btn .btn:focus {
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.5);
    }

    /* Desain Tombol Logout */
    .logout-btn .btn {
        background-color: #dc3545;
        color: white;
        transition: all 0.3s ease;
        border: 2px solid #dc3545;
    }

    .logout-btn .btn:hover {
        background-color: #c82333;
        border-color: #c82333;
        transform: scale(1.1);
    }

    .logout-btn .btn:focus {
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.5);
    }

    /* Responsiveness: Pastikan tombol menyesuaikan ukuran layar */
    @media (max-width: 767px) {

        .login-btn .btn,
        .logout-btn .btn {
            font-size: 14px;
            padding: 10px 20px;
        }
    }
</style>
<nav class="navbar navbar-expand-lg fixed-top">
    <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="<?= base_url('images/logo.png'); ?>" alt="Logo" style="width: 30px; height: 30px; margin-right: 8px;">
        <span>MetoPark</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav" style="padding-left: 30px; padding: 20px;">
        <ul class="navbar-nav ms-auto" style="margin-right: 20px;">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/'); ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('pelaporan/'); ?>">Report</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('gallery/sort'); ?>">Gallery By Sort</a>
            </li>
            <!-- Check if user is logged in -->
            <?php if (!logged_in()): ?>
                <!-- Login Button with unique design -->
                <li class="nav-item">
                    <a class="nav-link login-btn" href="<?= site_url('login'); ?>">
                        <button class="btn btn-outline-primary rounded-pill px-4 py-1" style="margin-top: -5px;">
                            Login
                        </button>
                    </a>
                </li>
            <?php else: ?>
                <!-- Logout Button with unique design -->
                <li class="nav-item">
                    <a class="nav-link logout-btn" href="<?= site_url('logout'); ?>">
                        <button class="btn btn-outline-danger rounded-pill px-4 py-1" style="margin-top: -5px;">
                            Logout
                        </button>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>


<script>
    let lastScrollTop = 0; // Keep track of the last scroll position
    const navbar = document.querySelector('.navbar'); // Select the navbar

    window.addEventListener('scroll', function() {
        let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

        if (currentScroll > lastScrollTop) {
            // Scrolling down
            navbar.style.top = "-80px"; // Adjust the value to hide the navbar
        } else {
            // Scrolling up
            navbar.style.top = "0"; // Bring the navbar back to the top
        }

        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Prevent negative scroll position
    });
</script>