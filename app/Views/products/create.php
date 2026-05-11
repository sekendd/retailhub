<!DOCTYPE html>
<html>
<head>
<title>Add Product</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">
<div class="card-body">

<h2 class="mb-4">Add Product</h2>

<form method="post"
action="/products/store"
enctype="multipart/form-data">

<?= csrf_field() ?>

<label class="form-label">Product Name</label>

<input type="text"
name="product_name"
class="form-control mb-3"
placeholder="Enter product name"
required>

<label class="form-label">Category ID</label>

<input type="number"
name="category_id"
class="form-control mb-3"
placeholder="Enter category ID"
required>

<label class="form-label">Product Image</label>

<input type="file"
name="image"
class="form-control mb-4"
accept="image/*">

<button type="submit"
class="btn btn-success">
Save Product
</button>

<a href="/products"
class="btn btn-secondary">
Back
</a>

</form>

</div>
</div>

</div>

</body>
</html>