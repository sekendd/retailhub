<!DOCTYPE html>
<html>
<head>
<title>Add Product</title>
<link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Add Product</h2>

<form method="post" action="/products/store">
<?= csrf_field() ?>

<?php if (session('errors')): ?>
  <div class="alert alert-danger">
    <?php foreach (session('errors') as $e): ?><p class="mb-0"><?= esc($e) ?></p><?php endforeach; ?>
  </div>
<?php endif; ?>

<input type="text" name="product_name" class="form-control mb-3" placeholder="Product Name" required>

<select name="category_id" class="form-control mb-3" required>
  <option value="">-- Select Category --</option>
  <?php foreach ($categories as $cat): ?>
    <option value="<?= esc($cat['id'], 'attr') ?>"><?= esc($cat['category_name']) ?></option>
  <?php endforeach; ?>
</select>

<button class="btn btn-success">Save</button>
<a href="/products" class="btn btn-secondary">Back</a>

</form>

</div>

</body>
</html>