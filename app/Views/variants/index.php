<!DOCTYPE html>
<html>
<head>
<title>Variants</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2><?= $product['product_name'] ?> Variants</h2>

<a href="/variants/create/<?= $product['id'] ?>" class="btn btn-primary mb-3">Add Variant</a>
<a href="/products" class="btn btn-secondary mb-3">Back</a>

<table class="table table-bordered">
<tr>
<th>Size</th>
<th>Color</th>
<th>Price</th>
<th>Stock</th>
</tr>

<?php foreach($variants as $row): ?>
<tr>
<td><?= $row['size'] ?></td>
<td><?= $row['color'] ?></td>
<td><?= $row['price'] ?></td>
<td><?= $row['stock'] ?></td>
</tr>
<?php endforeach; ?>

</table>

</div>

</body>
</html>