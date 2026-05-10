<!DOCTYPE html>
<html>
<head>
<title>Variants</title>
<link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2><?= esc($product['product_name']) ?> Variants</h2>

<a href="/variants/create/<?= esc($product['id']) ?>" class="btn btn-primary mb-3">Add Variant</a>
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
<td><?= esc($row['size']) ?></td>
<td><?= esc($row['color']) ?></td>
<td><?= esc($row['price']) ?></td>
<td><?= esc($row['stock']) ?></td>
</tr>
<?php endforeach; ?>

</table>

</div>

</body>
</html>