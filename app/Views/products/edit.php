<!DOCTYPE html>
<html>
<head>
    <title>Edit Product | RETAILHUB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h2>Edit Product</h2>
        <hr>

        <!-- The action matches your controller update() method -->
        <form method="post" action="<?= base_url('products/update/'.$product['id']) ?>">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="product_name" class="form-control" 
                       value="<?= esc($product['product_name']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Category ID (Decimals allowed)</label>
                <!-- step="any" is the secret fix for your 2.1 / 3.1 issue -->
                <input type="number" name="category_id" class="form-control" 
                       value="<?= esc($product['category_id']) ?>" step="any" required>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-success px-4">Update Product</button>
                <a href="<?= base_url('products') ?>" class="btn btn-secondary">Back to Inventory</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>