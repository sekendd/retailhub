<!DOCTYPE html>
<html>
<head>
<title>Edit Product</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Edit Product</h2>

<form method="post" action="/products/update/<?= $product['id'] ?>">
<?= csrf_field() ?>

<input type="text" name="product_name" class="form-control mb-3"
value="<?= $product['product_name'] ?>" required>

<input type="number" name="category_id" class="form-control mb-3"
value="<?= $product['category_id'] ?>" required>

<button class="btn btn-success">Update</button>
<a href="/products" class="btn btn-secondary">Back</a>

</form>

</div>

</body>
</html>