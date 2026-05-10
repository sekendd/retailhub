<!DOCTYPE html>
<html>
<head>
<title>Products</title>
<link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Products</h2>

<form method="get" action="/products" class="mb-3">
<div class="row">

<div class="col-md-6">
<input type="text" name="search" class="form-control"
placeholder="Search product"
value="<?= esc($search ?? '') ?>">
</div>

<div class="col-md-6">
<button type="submit" class="btn btn-primary">Search</button>
<a href="/products/create" class="btn btn-success">Add</a>
<a href="/dashboard" class="btn btn-secondary">Back</a>
</div>

</div>
</form>

<table class="table table-bordered table-hover">

<thead>
<tr>
<th>ID</th>
<th>Name</th>
<th>Category</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php if (!empty($products)) : ?>
<?php foreach ($products as $row) : ?>
<tr>
<td><?= esc($row['id']) ?></td>
<td><?= esc($row['product_name']) ?></td>
<td><?= esc($row['category_name'] ?? $row['category_id']) ?></td>
<td>
<a href="/variants/<?= esc($row['id'], 'url') ?>" class="btn btn-info btn-sm">Variants</a>
<a href="/products/edit/<?= esc($row['id'], 'url') ?>" class="btn btn-warning btn-sm">Edit</a>
<a href="/products/delete/<?= esc($row['id'], 'url') ?>" class="btn btn-danger btn-sm">Delete</a>
</td>
</tr>
<?php endforeach; ?>
<?php else : ?>
<tr>
<td colspan="4" class="text-center">No products found</td>
</tr>
<?php endif; ?>

</tbody>

</table>

</div>

</body>
</html>