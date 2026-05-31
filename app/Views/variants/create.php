<!DOCTYPE html>
<html>
<head>
<title>Add Variant</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Add Variant</h2>

<form method="post" action="/variants/store">
<?= csrf_field() ?>

<input type="hidden" name="product_id" value="<?= $product_id ?>">

<input type="text" name="size" class="form-control mb-3" placeholder="Size (S,M,L)" required>

<input type="text" name="color" class="form-control mb-3" placeholder="Color" required>

<input type="number" step="0.01" name="price" class="form-control mb-3" placeholder="Price" required>

<input type="number" name="stock" class="form-control mb-3" placeholder="Stock" required>

<button class="btn btn-success">Save</button>

</form>

</div>

</body>
</html>