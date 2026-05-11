<!DOCTYPE html>
<html>
<head>
<title>Products</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<div class="alert alert-info">
Products page uses caching for performance optimization.
</div>

<h2>Products</h2>

<form method="get" action="/products" class="mb-3">
<div class="row">

<div class="col-md-6">
<input type="text"
name="search"
class="form-control"
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
<th>Image</th>
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

<td>
<?php if (!empty($row['image'])) : ?>
<img src="/uploads/<?= esc($row['image']) ?>"
width="60"
height="60"
style="object-fit:cover;">
<?php endif; ?>
</td>

<td><?= esc($row['product_name']) ?></td>

<td><?= esc($row['category_id']) ?></td>

<td>
<a href="/variants/<?= $row['id'] ?>"
class="btn btn-info btn-sm">
Variants
</a>

<a href="/products/edit/<?= $row['id'] ?>"
class="btn btn-warning btn-sm">
Edit
</a>

<a href="/products/delete/<?= $row['id'] ?>"
class="btn btn-danger btn-sm">
Delete
</a>
</td>

</tr>

<?php endforeach; ?>
<?php else : ?>

<tr>
<td colspan="5" class="text-center">
No products found
</td>
</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</body>
</html>