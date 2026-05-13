<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Product | RETAILHUB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container" style="max-width: 600px;">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                <h3 class="fw-bold mb-4">Edit Product Details</h3>
                
                <form action="<?= base_url('products/update/'.$product['id']) ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Product Name</label>
                        <input type="text" name="product_name" class="form-control" value="<?= esc($product['product_name']) ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Category ID</label>
                        <!-- ADD step="any" HERE to allow decimals like 2.5 -->
                        <input type="number" 
                               step="any" 
                               name="category_id" 
                               class="form-control" 
                               value="<?= esc($product['category_id']) ?>" 
                               required>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?= base_url('products') ?>" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>