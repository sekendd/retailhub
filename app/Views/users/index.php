<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management | RETAILHUB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; overflow-x: hidden; }
        #wrapper { display: flex; width: 100%; }
        #sidebar { min-width: 250px; max-width: 250px; height: 100vh; position: fixed; background: #212529; display: flex; flex-direction: column; z-index: 1000; transition: all 0.3s; }
        #sidebar.active { min-width: 80px; max-width: 80px; }
        #sidebar .sidebar-header { height: 72px; display: flex; align-items: center; justify-content: center; background: #1a1d20; color: #fff; }
        #sidebar ul li a { padding: 15px 20px; display: block; color: #adb5bd; text-decoration: none; white-space: nowrap; }
        #sidebar ul li a:hover, #sidebar ul li.active a { color: #fff; background: #343a40; }
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
            <li class="active"><a href="/users"><i class="fas fa-users-cog fa-fw me-2"></i><span class="link-text">User Management</span></a></li>
            <li class="mt-auto mb-3">
                <hr class="bg-secondary mx-3">
                <a href="/logout" class="text-danger"><i class="fas fa-sign-out-alt fa-fw me-2"></i><span class="link-text">Logout</span></a>
            </li>
        </ul>
    </nav>

    <div id="content">
        <nav class="navbar navbar-light bg-white shadow-sm px-4">
            <button type="button" id="sidebarCollapse" class="btn btn-dark btn-sm"><i class="fas fa-bars"></i></button>
            <div class="ms-3 fw-bold text-uppercase">User Management</div>
        </nav>

        <div class="main-container">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">All Users</h5>
                <a href="/users/create" class="btn btn-success btn-sm"><i class="fas fa-plus me-2"></i>Add User</a>
            </div>

            <div class="card shadow-sm border-0 rounded-3">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $user['id'] ?></td>
                                <td><?= esc($user['name']) ?></td>
                                <td><?= esc($user['email']) ?></td>
                                <td><span class="badge bg-secondary"><?= esc($user['role']) ?></span></td>
                                <td>
                                    <a href="/users/edit/<?= $user['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <?php if ((int)$user['id'] !== (int)session()->get('id')): ?>
                                    <a href="/users/delete/<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">Delete</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
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
