<!DOCTYPE html>
<html>
<head>
<title>Add Product</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Add Product</h2>

<form method="post" action="/products/store">
<?= csrf_field() ?>

<input type="text" name="product_name" class="form-control mb-3" placeholder="Product Name" required>

<input type="number" name="category_id" class="form-control mb-3" placeholder="Category ID" required>

<button class="btn btn-success">Save</button>
<a href="/products" class="btn btn-secondary">Back</a>

</form>

</div>

</body>
</html>