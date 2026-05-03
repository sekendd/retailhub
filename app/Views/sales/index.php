<!DOCTYPE html>
<html>
<head>
<title>Sales</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Sales Module</h2>

<form method="post" action="/sales/checkout">
<?= csrf_field() ?>

<select name="variant_id" class="form-control mb-3" required>
<option value="">Select Variant</option>

<?php if (!empty($variants)): ?>
<?php foreach($variants as $row): ?>
<option value="<?= $row['id'] ?>">
ID <?= $row['id'] ?> |
<?= $row['size'] ?> |
<?= $row['color'] ?> |
₱<?= $row['price'] ?> |
Stock <?= $row['stock'] ?>
</option>
<?php endforeach; ?>
<?php endif; ?>

</select>

<input type="number" name="qty" class="form-control mb-3" placeholder="Quantity" required>

<button class="btn btn-success">Checkout</button>
<a href="/dashboard" class="btn btn-secondary">Back</a>

</form>

</div>

</body>
</html>