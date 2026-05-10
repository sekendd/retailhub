<!DOCTYPE html>
<html>
<head>
<title>Returns</title>
<link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Returns Module</h2>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success">
<?= esc(session()->getFlashdata('success')) ?>
</div>
<?php endif; ?>

<form method="post" action="/returns/store">
<?= csrf_field() ?>

<select name="variant_id" class="form-control mb-3" required>
<option value="">Select Variant</option>

<?php foreach($variants as $row): ?>
<option value="<?= esc($row['id']) ?>">
ID <?= esc($row['id']) ?> |
<?= esc($row['size']) ?> |
<?= esc($row['color']) ?> |
Stock <?= esc($row['stock']) ?>
</option>
<?php endforeach; ?>

</select>

<input type="number" name="qty" class="form-control mb-3" placeholder="Return Quantity" required>

<textarea name="reason" class="form-control mb-3" placeholder="Reason"></textarea>

<button class="btn btn-warning">Process Return</button>
<a href="/dashboard" class="btn btn-secondary">Back</a>

</form>

</div>

</body>
</html>