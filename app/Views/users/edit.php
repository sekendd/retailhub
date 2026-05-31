<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User | RETAILHUB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        #wrapper { display: flex; width: 100%; }
        #sidebar { min-width: 250px; max-width: 250px; height: 100vh; position: fixed; background: #212529; display: flex; flex-direction: column; z-index: 1000; transition: all 0.3s; }
        #sidebar.active { min-width: 80px; max-width: 80px; }
        #sidebar .sidebar-header { height: 72px; display: flex; align-items: center; justify-content: center; background: #1a1d20; color: #fff; }
        #sidebar ul li a { padding: 15px 20px; display: block; color: #adb5bd; text-decoration: none; white-space: nowrap; }
        #sidebar ul li a:hover { color: #fff; background: #343a40; }
        #sidebar.active .link-text, #sidebar.active .sidebar-header h3 { display: none; }
        #sidebar.active .sidebar-header::after { content: 'RH'; font-weight: bold; color: white; }
        #content { width: 100%; margin-left: 250px; min-height: 100vh; transition: all 0.3s; }
        #content.active { margin-left: 80px; }
        .navbar { height: 72px; border-bottom: 1px solid #dee2e6; }
        .main-container { padding: 30px; }
    </style>
</head>
<body>
<div id="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header"><h3>RETAILHUB</h3></div>
        <ul class="list-unstyled components h-100 d-flex flex-column">
            <li><a href="/dashboard"><i class="fas fa-chart-line fa-fw me-2"></i><span class="link-text">Dashboard</span></a></li>
            <li><a href="/products"><i class="fas fa-boxes fa-fw me-2"></i><span class="link-text">Inventory</span></a></li>
            <li><a href="/sales"><i class="fas fa-cash-register fa-fw me-2"></i><span class="link-text">Sales Hub</span></a></li>
            <li><a href="/returns"><i class="fas fa-undo fa-fw me-2"></i><span class="link-text">Returns</span></a></li>
            <li><a href="/users"><i class="fas fa-users-cog fa-fw me-2"></i><span class="link-text">User Management</span></a></li>
            <li class="mt-auto mb-3">
                <hr class="bg-secondary mx-3">
                <a href="/logout" class="text-danger"><i class="fas fa-sign-out-alt fa-fw me-2"></i><span class="link-text">Logout</span></a>
            </li>
        </ul>
    </nav>

    <div id="content">
        <nav class="navbar navbar-light bg-white shadow-sm px-4">
            <button type="button" id="sidebarCollapse" class="btn btn-dark btn-sm"><i class="fas fa-bars"></i></button>
            <div class="ms-3 fw-bold text-uppercase">Edit User</div>
        </nav>

        <div class="main-container">
            <div class="card shadow-sm border-0 rounded-3 p-4" style="max-width: 500px;">
                <form action="/users/update/<?= $user['id'] ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" name="name" class="form-control" value="<?= esc($user['name']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= esc($user['email']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">New Password <small class="text-muted fw-normal">(leave blank to keep current)</small></label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="staff" <?= $user['role'] === 'staff' ? 'selected' : '' ?>>Staff</option>
                            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="superadmin" <?= $user['role'] === 'superadmin' ? 'selected' : '' ?>>Superadmin</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update User</button>
                        <a href="/users" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    document.getElementById('sidebarCollapse').addEventListener('click', function () {
        sidebar.classList.toggle('active');
        content.classList.toggle('active');
    });
});
</script>
</body>
</html>
