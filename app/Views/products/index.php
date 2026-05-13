<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory | RETAILHUB</title>
    <!-- Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root { 
            --bg-color: #f8f9fa; 
            --card-bg: #ffffff; 
            --header-bg: #ffffff; 
            --text-color: #212529; 
            --border-color: #dee2e6;
            --sidebar-width: 250px; 
            --sidebar-collapsed: 80px; 
        }

        [data-theme="dark"] { 
            --bg-color: #121212; 
            --card-bg: #1e1e1e; 
            --header-bg: #1e1e1e; 
            --text-color: #ffffff; 
            --border-color: #333333; 
        }

        body { background-color: var(--bg-color); color: var(--text-color); overflow-x: hidden; transition: all 0.3s ease; }
        #wrapper { display: flex; width: 100%; }

        /* --- SIDEBAR LOGIC --- */
        #sidebar { 
            min-width: var(--sidebar-collapsed); 
            max-width: var(--sidebar-collapsed); 
            height: 100vh; 
            position: fixed; 
            background: #212529; 
            display: flex; 
            flex-direction: column; 
            z-index: 1000; 
            transition: all 0.3s ease-in-out; 
        }

        #sidebar.active { 
            min-width: var(--sidebar-width); 
            max-width: var(--sidebar-width); 
        }

        #sidebar .sidebar-header { 
            height: 72px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            background: #1a1d20; 
            color: #fff; 
        }

        #sidebar .sidebar-header h3 { display: none; margin: 0; font-size: 1.2rem; }
        #sidebar .sidebar-header::after { content: 'RH'; font-weight: bold; }
        
        #sidebar.active .sidebar-header h3 { display: block; }
        #sidebar.active .sidebar-header::after { content: ''; }

        #sidebar ul li a { 
            padding: 15px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            color: #adb5bd; 
            text-decoration: none; 
            transition: 0.3s;
            white-space: nowrap;
        }

        #sidebar.active ul li a { justify-content: flex-start; padding: 15px 25px; }
        #sidebar ul li a i { font-size: 1.2rem; width: 25px; text-align: center; }

        #sidebar .link-text { display: none; margin-left: 15px; }
        #sidebar.active .link-text { display: inline; }
        #sidebar ul li.active a { color: #fff; background: #343a40; }

        /* --- CONTENT AREA --- */
        #content { 
            width: 100%; 
            margin-left: var(--sidebar-collapsed); 
            min-height: 100vh; 
            transition: all 0.3s ease-in-out; 
        }

        #content.active { margin-left: var(--sidebar-width); }

        .top-dock { 
            background: var(--header-bg); 
            padding: 15px 30px; 
            border-bottom: 1px solid var(--border-color); 
            display: flex; 
            align-items: center; 
        }

        .inventory-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 25px; padding: 30px; }
        .admin-card { background: var(--card-bg); border: 1px solid var(--border-color); border-radius: 12px; overflow: hidden; position: relative; }
        .img-box { aspect-ratio: 1/1; background: #fff; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .img-box img { max-width: 100%; max-height: 100%; object-fit: contain; }

        /* Mass Delete Checkbox Styling */
        .select-check { position: absolute; top: 15px; left: 15px; transform: scale(1.5); z-index: 5; cursor: pointer; }
    </style>
</head>
<body>
<div id="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>RETAILHUB</h3>
        </div>
        <ul class="list-unstyled components flex-grow-1">
            <li><a href="<?= base_url('dashboard') ?>"><i class="fas fa-chart-line"></i><span class="link-text">Dashboard</span></a></li>
            <li class="active"><a href="<?= base_url('products') ?>"><i class="fas fa-boxes"></i><span class="link-text">Inventory</span></a></li>
            <li><a href="<?= base_url('sales') ?>"><i class="fas fa-cash-register"></i><span class="link-text">Sales Checkout</span></a></li>
            <li><a href="<?= base_url('returns') ?>"><i class="fas fa-undo"></i><span class="link-text">Returns</span></a></li>
        </ul>
        <div class="sidebar-footer p-3 border-top border-secondary">
            <a href="<?= base_url('logout') ?>" class="text-danger text-decoration-none">
                <i class="fas fa-sign-out-alt"></i><span class="link-text ms-2">Logout</span>
            </a>
        </div>
    </nav>

    <div id="content">
        <div class="top-dock">
            <button type="button" id="sidebarCollapse" class="btn bg-dark text-white rounded p-0 me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-bars"></i>
            </button>
            <h5 class="text-uppercase mb-0 fw-bold">Inventory Management</h5>
            <button id="dark-mode-toggle" class="btn border-0 ms-auto"><i class="fas fa-moon fa-lg"></i></button>
        </div>

        <div class="container-fluid py-4">
            <!-- Toolbar: Search, Sort, and Actions -->
            <div class="row g-3 mb-4 align-items-center">
                <div class="col-md-4">
                    <input type="text" id="searchInput" class="form-control shadow-sm" placeholder="Search products...">
                </div>
                <div class="col-md-3">
                    <select id="sortSelect" class="form-select shadow-sm">
                        <option value="newest">Newest First</option>
                        <option value="name">Name A-Z</option>
                        <option value="cat">Category Number</option>
                    </select>
                </div>
                <div class="col-md-5 text-end">
                    <!-- New Cancel Button -->
                    <button type="button" id="cancelSelectionBtn" class="btn btn-light me-2 shadow-sm d-none">
                        Cancel Selection
                    </button>
                    <button type="button" id="massDeleteBtn" class="btn btn-danger me-2 shadow-sm d-none">
                        <i class="fas fa-trash-alt me-2"></i>Delete Selected
                    </button>
                    <a href="<?= base_url('products/create') ?>" class="btn btn-success shadow-sm">
                        <i class="fas fa-plus me-2"></i>Add Product
                    </a>
                </div>
            </div>

            <div class="inventory-grid" id="productGrid">
                <?php if (!empty($products)): foreach ($products as $row): ?>
                <div class="admin-card product-item" 
                     data-name="<?= esc(strtolower($row['product_name'])) ?>" 
                     data-cat="<?= esc($row['category_id']) ?>" 
                     data-id="<?= $row['id'] ?>">
                    
                    <input type="checkbox" class="select-check product-checkbox" value="<?= $row['id'] ?>">
                    
                    <div class="img-box">
                        <img src="<?= base_url('uploads/products/'.$row['image']) ?>" alt="Product">
                    </div>
                    <div class="p-3">
                        <div class="fw-bold mb-1 product-name"><?= esc($row['product_name']) ?></div>
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <span class="badge bg-light text-dark border">Cat: <?= esc($row['category_id']) ?></span>
                            <a href="<?= base_url('products/delete/'.$row['id']) ?>" class="text-danger" onclick="return confirm('Delete this product?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                        <div class="row g-2">
                            <div class="col-4"><a href="<?= base_url('products/edit/'.$row['id']) ?>" class="btn btn-sm btn-primary w-100">Edit</a></div>
                            <!-- FIXED ROUTE: Assuming your controller is Variants.php and method is index -->
                            <!-- In your Inventory index.php -->
                        <div class="col-8">
                            <a href="<?= base_url('variants/index/'.$row['id']) ?>" class="btn btn-sm btn-secondary w-100">
                                Manage Variants
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // --- Existing UI Controls ---
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    const toggleBtn = document.getElementById('sidebarCollapse');
    const themeBtn = document.getElementById('dark-mode-toggle');
    
    // --- Selection Controls ---
    const checkboxes = document.querySelectorAll('.product-checkbox');
    const massDeleteBtn = document.getElementById('massDeleteBtn');
    const cancelBtn = document.getElementById('cancelSelectionBtn');

    // --- Sorting Controls ---
    const sortSelect = document.getElementById('sortSelect');
    const productGrid = document.getElementById('productGrid');

    // Sidebar Toggle Logic
    if (localStorage.getItem('sidebar-expanded') === 'true') {
        sidebar.classList.add('active');
        content.classList.add('active');
    }

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('active');
        content.classList.toggle('active');
        localStorage.setItem('sidebar-expanded', sidebar.classList.contains('active'));
    });

    // Selection Logic
    const updateSelectionUI = () => {
        const checkedCount = Array.from(checkboxes).filter(c => c.checked).length;
        const isSelected = checkedCount > 0;
        massDeleteBtn.classList.toggle('d-none', !isSelected);
        cancelBtn.classList.toggle('d-none', !isSelected);
    };

    checkboxes.forEach(cb => cb.addEventListener('change', updateSelectionUI));

    cancelBtn.addEventListener('click', () => {
        checkboxes.forEach(cb => cb.checked = false);
        updateSelectionUI();
    });

    // Sorting Logic (Category Num, Name, Newest)
    sortSelect.addEventListener('change', function() {
        const items = Array.from(document.querySelectorAll('.product-item'));
        const type = this.value;

        items.sort((a, b) => {
            if (type === 'cat') {
                return parseInt(a.dataset.cat) - parseInt(b.dataset.cat);
            } else if (type === 'name') {
                return a.dataset.name.localeCompare(b.dataset.name);
            } else {
                return parseInt(b.dataset.id) - parseInt(a.dataset.id); // Newest
            }
        });

        items.forEach(item => productGrid.appendChild(item));
    });
    
    const searchInput = document.getElementById('searchInput');
    const productItems = document.querySelectorAll('.product-item');

    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase().trim();

        productItems.forEach(item => {
            // Get the name from the data-name attribute we already have
            const productName = item.dataset.name;
            
            if (productName.includes(query)) {
                item.style.display = 'block'; // Show if it matches
            } else {
                item.style.display = 'none';  // Hide if it doesn't match
            }
        });
    });

    // Dark Mode
    themeBtn.addEventListener('click', () => {
        const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
        document.documentElement.setAttribute('data-theme', isDark ? 'light' : 'dark');
    });
});
</script>

</body>
</html>