<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Hub | RETAILHUB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { 
            --sidebar-width: 250px; 
            --sidebar-collapsed: 80px; 
        }
        body { background-color: #f0f2f5; overflow-x: hidden; width: 100vw; font-family: sans-serif; transition: all 0.3s; }
        #wrapper { display: flex; width: 100%; }

        /* --- Sidebar Logic --- */
        #sidebar { 
            min-width: var(--sidebar-width); 
            max-width: var(--sidebar-width); 
            height: 100vh; 
            position: fixed; 
            background: #212529; 
            display: flex; 
            flex-direction: column; 
            z-index: 1000; 
            transition: all 0.3s; 
        }

        /* The 'active' class now handles the collapsed state */
        #sidebar.active { 
            min-width: var(--sidebar-collapsed); 
            max-width: var(--sidebar-collapsed); 
        }

        #sidebar .sidebar-header { 
            height: 72px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            background: #1a1d20; 
            color: #fff; 
            font-weight: bold; 
        }

        #sidebar ul li a { 
            padding: 15px 25px; 
            display: block; 
            color: #adb5bd; 
            text-decoration: none; 
            white-space: nowrap; 
        }
        #sidebar ul li.active a { color: #fff; background: #343a40; }
        
        /* Hide text labels when active (collapsed) */
        #sidebar.active .link-text { display: none; }
        #sidebar.active ul li a { text-align: center; padding: 22px 0; }
        #sidebar.active .sidebar-header h3 { display: none; }
        #sidebar.active .sidebar-header::after { content: 'RH'; }

        /* --- Content Area --- */
        #content { 
            width: 100%; 
            margin-left: var(--sidebar-width); 
            min-height: 100vh; 
            padding: 25px; 
            transition: all 0.3s; 
        }
        #content.active { margin-left: var(--sidebar-collapsed); }

        .top-dock { 
            background: white; 
            border-radius: 10px; 
            padding: 12px 20px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.05); 
            display: flex; 
            align-items: center; 
            margin-bottom: 30px; 
            border: 1px solid #eef0f2; 
        }

        .checkout-card { 
            border-radius: 20px; 
            border: none; 
            overflow: hidden; 
            background: white; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.05); 
        }
    </style>
</head>
<body>
<div id="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>RETAILHUB</h3>
        </div>
        <ul class="list-unstyled components flex-grow-1">
            <li>
                <a href="<?= base_url('dashboard') ?>">
                    <i class="fas fa-chart-line me-2"></i>
                    <span class="link-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('products') ?>">
                    <i class="fas fa-boxes me-2"></i>
                    <span class="link-text">Inventory</span>
                </a>
            </li>
            <li class="active">
                <a href="<?= base_url('sales') ?>">
                    <i class="fas fa-cash-register me-2"></i>
                    <span class="link-text">Sales Checkout</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('returns') ?>">
                    <i class="fas fa-undo me-2"></i>
                    <span class="link-text">Returns</span>
                </a>
            </li>
        </ul>
        <ul class="list-unstyled">
            <li>
                <a href="<?= base_url('logout') ?>" class="text-danger">
                    <i class="fas fa-sign-out-alt me-2"></i>
                    <span class="link-text">Logout</span>
                </a>
            </li>
        </ul>
    </nav>

    <div id="content">
        <div class="top-dock">
            <!-- Updated button with black square block styling -->
            <button type="button" id="sidebarCollapse" class="btn bg-dark text-white rounded p-2 me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border: none;">
                <i class="fas fa-bars"></i>
            </button>
            <h5 class="mb-0 fw-bold text-uppercase">Sales Checkout</h5>
        </div>

        <div class="row justify-content-center pt-4">
            <div class="col-lg-6 col-xl-5">
                <div class="checkout-card p-4 p-md-5">
                    <div class="text-center mb-4">
                        <div class="bg-success-subtle text-success d-inline-block p-3 rounded-circle mb-3">
                            <i class="fas fa-shopping-cart fa-2x"></i>
                        </div>
                        <h3 class="fw-bold">Point of Sale</h3>
                        <p class="text-muted">Fill in the details to complete the order</p>
                    </div>

                    <form method="post" action="<?= base_url('sales/checkout') ?>">
                        <?= csrf_field() ?>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase text-muted">Select Item Variant</label>
                            <select name="variant_id" class="form-control form-control-lg bg-light border-0 shadow-none" required>
                                <option value="">Select Variant...</option>
                                <?php if (!empty($variants)): foreach($variants as $row): ?>
                                    <option value="<?= $row['id'] ?>">
                                        [ID <?= $row['id'] ?>] <?= esc($row['size']) ?> / <?= esc($row['color']) ?> — ₱<?= number_format($row['price'], 2) ?>
                                    </option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase text-muted">Quantity</label>
                            <input type="number" name="qty" class="form-control form-control-lg bg-light border-0 shadow-none" placeholder="Enter amount" required min="1">
                        </div>
                        <div class="d-grid mt-5">
                            <button class="btn btn-success btn-lg fw-bold rounded-3 py-3 shadow-sm">
                                <i class="fas fa-check-circle me-2"></i>Process Transaction
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    const toggleBtn = document.getElementById('sidebarCollapse');

    // 1. Force the saved state immediately on load
    const isExpanded = localStorage.getItem('sidebar-expanded') === 'true';
    
    if (isExpanded) {
        sidebar.classList.add('active');
        content.classList.add('active');
    } else {
        // Default to collapsed if not explicitly expanded
        sidebar.classList.remove('active');
        content.classList.remove('active');
    }

    // 2. Button Toggle
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            content.classList.toggle('active');
            // Save the new preference
            localStorage.setItem('sidebar-expanded', sidebar.classList.contains('active'));
        });
    }
});

    
</script>
</body>
</html>