<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Returns Hub | RETAILHUB</title>
    
    <!-- External Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --sidebar-wide: 250px;
            --sidebar-collapsed: 80px;
        }

        body { background-color: #f8f9fa; overflow-x: hidden; }
        #wrapper { display: flex; width: 100%; }

        /* --- 1. Sidebar: Default is COLLAPSED (80px) --- */
        #sidebar {
            min-width: var(--sidebar-collapsed);
            max-width: var(--sidebar-collapsed);
            height: 100vh;
            position: fixed;
            background: #212529;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease-in-out;
            z-index: 1000;
        }

        /* 2. Sidebar: WIDE when 'active' is added --- */
        #sidebar.active {
            min-width: var(--sidebar-wide);
            max-width: var(--sidebar-wide);
        }

        #sidebar .sidebar-header {
            height: 72px;
            background: #1a1d20;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            overflow: hidden;
        }

        /* Logo logic: Show 'RH' by default, 'RETAILHUB' when active */
        #sidebar .sidebar-header h3 { display: none; margin: 0; font-size: 1.2rem; }
        #sidebar .sidebar-header::after { content: 'RH'; font-weight: bold; }
        #sidebar.active .sidebar-header h3 { display: block; }
        #sidebar.active .sidebar-header::after { content: ''; }

        /* Links and Text visibility */
        #sidebar ul li a { 
            padding: 15px; 
            display: flex;
            align-items: center;
            justify-content: center;
            color: #adb5bd; 
            text-decoration: none; 
            white-space: nowrap;
        }

        #sidebar.active ul li a { justify-content: flex-start; padding: 15px 25px; }
        
        #sidebar .link-text { display: none; margin-left: 10px; }
        #sidebar.active .link-text { display: inline; }

        #sidebar ul li a:hover, #sidebar ul li.active a { color: #fff; background: #343a40; }

        /* --- 3. Content Area: Default margin matches collapsed sidebar --- */
        #content {
            flex: 1;
            margin-left: var(--sidebar-collapsed);
            min-height: 100vh;
            transition: all 0.3s ease-in-out;
        }

        #content.active { margin-left: var(--sidebar-wide); }

        .navbar { height: 72px; padding: 0 1.5rem; background: #fff; border-bottom: 1px solid #dee2e6; }
        .main-container { padding: 30px; }
    </style>
</head>
<body>

<div id="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>RETAILHUB</h3>
        </div>

        <ul class="list-unstyled components h-100 d-flex flex-column mb-0">
            <li><a href="/dashboard"><i class="fas fa-chart-line fa-fw"></i><span class="link-text">Dashboard</span></a></li>
            <li><a href="/products"><i class="fas fa-boxes fa-fw"></i><span class="link-text">Inventory</span></a></li>
            <li><a href="/sales"><i class="fas fa-cash-register fa-fw"></i><span class="link-text">Sales Hub</span></a></li>
            <li class="active"><a href="/returns"><i class="fas fa-undo fa-fw"></i><span class="link-text">Returns</span></a></li>
            <li class="mt-auto mb-3">
                <!-- In your sidebar/layout view -->
            <a href="<?= base_url('logout') ?>" class="text-danger">
                <i class="fas fa-sign-out-alt fa-fw me-2"></i>
                <span class="link-text">Logout</span>
            </a>
            </li>
        </ul>
    </nav>

    <div id="content">
        <nav class="navbar shadow-sm d-flex align-items-center">
            <button type="button" id="sidebarCollapse" class="btn btn-dark">
                <i class="fas fa-bars"></i>
            </button>
            <div class="ms-3 fw-bold text-uppercase">Returns Module</div>
        </nav>

        <div class="main-container container-fluid">
            <!-- Form content remains the same -->
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 p-md-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-warning-subtle p-3 rounded-circle me-3">
                                    <i class="fas fa-undo text-warning fa-lg"></i>
                                </div>
                                <h4 class="fw-bold mb-0">Process Product Return</h4>
                            </div>
                            <!-- Form fields here... -->
                             <div class="mb-4">
    <label class="form-label small fw-bold text-uppercase tracking-wider">Select Variant</label>
    <select name="variant_id" class="form-select form-select-lg shadow-sm" required>
        <option value="">Choose item to return...</option>
        <?php foreach($variants as $row): ?>
            <option value="<?= $row['id'] ?>">
                ID <?= $row['id'] ?> | <?= $row['size'] ?> - <?= $row['color'] ?> | Stock: <?= $row['stock'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<!-- Quantity Input -->
<div class="mb-4">
    <label class="form-label small fw-bold text-uppercase tracking-wider">Return Quantity</label>
    <input type="number" name="qty" class="form-control form-control-lg shadow-sm" placeholder="Enter amount" required min="1">
</div>

<!-- Reason Textarea -->
<div class="mb-4">
    <label class="form-label small fw-bold text-uppercase tracking-wider">Reason for Return</label>
    <textarea name="reason" class="form-control shadow-sm" rows="3" placeholder="Explain why the item is being returned..."></textarea>
</div>

<!-- Submission Buttons -->
<div class="d-grid gap-3 pt-2">
    <button type="submit" class="btn btn-warning btn-lg fw-bold rounded-pill shadow-sm">
        <i class="fas fa-check me-2"></i>Process Return
    </button>
    <a href="/dashboard" class="btn btn-light text-muted btn-sm">Cancel and Return to Dashboard</a>
</div>
                        </div>
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

        // Check LocalStorage to remember choice across pages
        const isExpanded = localStorage.getItem('sidebar-expanded') === 'true';
        if (isExpanded) {
            sidebar.classList.add('active');
            content.classList.add('active');
        }

        if (toggle) {
            toggle.addEventListener('click', function () {
                sidebar.classList.toggle('active');
                content.classList.toggle('active');
                // Save the preference
                localStorage.setItem('sidebar-expanded', sidebar.classList.contains('active'));
            });
        }
    });
</script>
</body>
</html>