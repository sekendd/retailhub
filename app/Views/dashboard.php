<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | RETAILHUB</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            overflow-x: hidden;
            width: 100vw;
        }

        #wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            background: #212529;
            display: flex;
            flex-direction: column;
            transition: all 0.3s;
        }

        #sidebar.active {
            min-width: 80px;
            max-width: 80px;
            text-align: center;
        }

        #sidebar .sidebar-header {
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #1a1d20;
            color: #fff;
        }

        #sidebar ul li a {
            padding: 15px 20px;
            display: block;
            color: #adb5bd;
            text-decoration: none;
            white-space: nowrap;
        }

        #sidebar ul li a:hover {
            color: #fff;
            background: #343a40;
        }

        #sidebar.active .link-text,
        #sidebar.active .sidebar-header h3 {
            display: none;
        }

        #sidebar.active .sidebar-header::after {
            content: 'RH';
            font-weight: bold;
            color: white;
        }

        #content {
            width: 100%;
            margin-left: 250px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.3s;
        }

        #content.active {
            margin-left: 80px;
            width: calc(100% - 80px);
        }

        .navbar {
            height: 72px;
            border-bottom: 1px solid #dee2e6;
        }

        .main-container {
            padding: 30px;
        }

        .bento-card {
            border-radius: 16px;
            border: none;
            transition: transform 0.2s;
        }

        .bento-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body>

<div id="wrapper">

    <nav id="sidebar">

        <div class="sidebar-header">
            <h3>RETAILHUB</h3>
        </div>

        <ul class="list-unstyled components h-100 d-flex flex-column">

            <li class="bg-dark">
                <a href="/dashboard">
                    <i class="fas fa-chart-line fa-fw me-2"></i>
                    <span class="link-text">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="/products">
                    <i class="fas fa-boxes fa-fw me-2"></i>
                    <span class="link-text">Inventory</span>
                </a>
            </li>

            <li>
                <a href="/sales">
                    <i class="fas fa-cash-register fa-fw me-2"></i>
                    <span class="link-text">Sales Hub</span>
                </a>
            </li>

            <li>
                <a href="/returns">
                    <i class="fas fa-undo fa-fw me-2"></i>
                    <span class="link-text">Returns</span>
                </a>
            </li>
            
            <?php if(session()->get('role') == 'superadmin'): ?>
            <li>
                <a href="/users">
                    <i class="fas fa-users-cog fa-fw me-2"></i>
                    <span class="link-text">User Management</span>
                </a>
            </li>
            <?php endif; ?>

            <li class="mt-auto mb-3">
                <hr class="bg-secondary mx-3">

                <a href="/logout" class="text-danger">
                    <i class="fas fa-sign-out-alt fa-fw me-2"></i>
                    <span class="link-text">Logout</span>
                </a>
            </li>

        </ul>
    </nav>

    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">

            <button type="button"
                    id="sidebarCollapse"
                    class="btn btn-dark btn-sm">

                <i class="fas fa-bars"></i>

            </button>

            <div class="ms-3 fw-bold text-uppercase">
                Dashboard Overview
            </div>

        </nav>

        <div class="main-container">

            <div class="dashboard-header mb-5 p-4 rounded-4 shadow-sm bg-white border-start border-primary border-5">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h2 class="fw-bold text-dark mb-1">

                            Welcome
                            <?= session()->get('username') ?>

                        </h2>

                        <p class="text-muted mb-0">

                            <i class="far fa-calendar-alt me-2"></i>

                            <?= date('l, F j, Y') ?>

                            |

                            <span class="badge bg-light text-primary border">

                                <?= session()->get('role') ?>

                            </span>

                        </p>

                    </div>

                    <div class="d-none d-md-block text-end">

                        <div class="text-muted small fw-bold text-uppercase">
                            Status
                        </div>

                        <div class="fw-bold text-success">
                            <i class="fas fa-circle me-1 small"></i>
                            Online
                        </div>

                    </div>

                </div>

            </div>

            <div class="row g-4">

                <div class="col-md-6 col-xl-4">

                    <div class="card bento-card shadow-sm p-4 h-100"
                         style="background: linear-gradient(135deg, #198754, #20c997); color: white;">

                        <small class="fw-bold opacity-75 text-uppercase">
                            Sales Today
                        </small>

                      <h1 class="display-5 fw-bold my-3">
    ₱<?= $salesToday ?>
</h1>

                        <a href="/sales"
                           class="btn btn-light btn-sm rounded-pill px-4">

                            Sales Hub

                        </a>

                    </div>

                </div>

                <div class="col-md-6 col-xl-4">

                    <div class="card bento-card shadow-sm p-4 h-100">

                        <small class="text-muted fw-bold text-uppercase">
                            Total Products
                        </small>

                      <h1 class="display-5 fw-bold my-3 text-dark">
    <?= $totalProducts ?>
</h1>

                        <a href="/products"
                           class="btn btn-outline-primary btn-sm rounded-pill px-4">

                            Inventory

                        </a>

                    </div>

                </div>

                <div class="col-md-6 col-xl-4">

                    <div class="card bento-card shadow-sm p-4 h-100">

                        <small class="text-warning fw-bold text-uppercase">
                            Pending Returns
                        </small>

                        <h1 class="display-5 fw-bold my-3 text-warning">
                            0
                        </h1>

                        <a href="/returns"
                           class="btn btn-outline-warning btn-sm rounded-pill px-4">

                            View Returns

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>

document.addEventListener("DOMContentLoaded", function() {

    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    const toggle = document.getElementById('sidebarCollapse');

    sidebar.classList.add('active');
    content.classList.add('active');

    if (toggle) {

        toggle.addEventListener('click', function () {

            sidebar.classList.toggle('active');
            content.classList.toggle('active');

        });

    }

});

</script>

</body>
</html>