<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    @vite(['resources/css/sidebar.css', 'resources/js/sidebar.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <title>Backoffice</title>
</head>
<body>
    <div class="d-flex">
        <aside>
            <div class="d-flex">
                <button class="" type="button" id="toggle-btn"><i class="fa-solid fa-bars"></i></button>
                <div class="sidebar-logo">
                    <a href="#">Sidebar</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link"><i class=" fa-solid fa-user"></i><span>Profile</span></a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link"><i class="fa-solid fa-building"></i><span>Company</span></a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link"><i class="fa-solid fa-file-invoice"></i><span>Reports</span></a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link"><i class="fa-solid fa-file-invoice-dollar"></i><span>Invoices</span></a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#auth"
                        aria-expanded="false" aria-controls="auth">
                        <i class="fa-solid fa-square-caret-down"></i>
                        <span>Dropdown</span>
                    </a>
                    <ul class="sidebar-dropdown list-unstyled collapse" id="auth" data-bs-parent="#sidebar">
                        <li><a href="#" class="sidebar-link"><span>Login</span></a></li>
                        <li><a href="#" class="sidebar-link"><span>Register</span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#multi"
                        aria-expanded="false" aria-controls="multi">
                        <i class="fa-solid fa-layer-group"></i>
                        <span>Multilevel</span>
                    </a>
                    <ul class="sidebar-dropdown list-unstyled collapse" id="multi" data-bs-parent="#sidebar">
                        <li><a href="#" class="sidebar-link"><span>Link</span></a></li>
                        <li><a href="#" class="sidebar-link"><span>Link</span></a></li>
                        <li><a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#level2" data-bs-parent="#multi" aria-expanded="false" aria-controls="level2">
                                <i class="fa-solid fa-square-caret-down"></i>
                                <span>Sub-links</span>
                            </a>
                            <ul class="sidebar-dropdown list-unstyled collapse" id="level2">
                                <li><a href="#" class="sidebar-link"><span>Sub-link 1</span></a></li>
                                <li><a href="#" class="sidebar-link"><span>Sub-link 2</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a class="sidebar-link" href="#">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <main class="p-3">
            {{ $slot }}
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>