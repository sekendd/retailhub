<!DOCTYPE html>
<html>
<head>
<title>Sales</title>
<link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Sales Module</h2>

<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
<div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
<?php endif; ?>

<form method="post" action="/sales/checkout">
<?= csrf_field() ?>

<select name="variant_id" class="form-control mb-3" required>
<option value="">Select Variant</option>

<?php if (!empty($variants)): ?>
<?php foreach($variants as $row): ?>
<option value="<?= esc($row['id']) ?>">
ID <?= esc($row['id']) ?> |
<?= esc($row['size']) ?> |
<?= esc($row['color']) ?> |
₱<?= esc($row['price']) ?> |
Stock <?= esc($row['stock']) ?>
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