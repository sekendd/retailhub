<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">
<div class="card-body">

<h2>Welcome, <?= session()->get('name') ?></h2>
<p>Role: <?= session()->get('role') ?></p>

<hr>

<div class="row text-center">

<div class="col-md-4">
<div class="card p-3">
<h4>Products</h4>
<p>0</p>
<a href="/products" class="btn btn-primary btn-sm">Open</a>
</div>
</div>

<div class="col-md-4">
<div class="card p-3">
<h4>Sales Today</h4>
<p>₱0</p>
<a href="/sales" class="btn btn-success btn-sm">Open</a>
</div>
</div>

<div class="col-md-4">
<div class="card p-3">
<h4>Returns</h4>
<p>0</p>
<a href="/returns" class="btn btn-warning btn-sm">Open</a>
</div>
</div>

</div>

<a href="/logout" class="btn btn-danger mt-4">Logout</a>

</div>
</div>

</div>

</body>
</html>