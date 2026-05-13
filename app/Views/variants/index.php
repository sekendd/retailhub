<!DOCTYPE html>
<html lang="en">
<head>
    <title>Variants | <?= esc($product['product_name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Variants for: <?= esc($product['product_name']) ?></h2>
            <div>
                <a href="<?= base_url('products') ?>" class="btn btn-outline-secondary">Back to Inventory</a>
                <a href="<?= base_url('variants/create/'.$product['id']) ?>" class="btn btn-primary">Add New Variant</a>
            </div>
        </div>

        <div class="card shadow-sm">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($variants)): foreach($variants as $v): ?>
                        <tr>
                            <td><?= esc($v['size']) ?></td>
                            <td><?= esc($v['color']) ?></td>
                            <td>$<?= number_format($v['price'], 2) ?></td>
                            <td><?= esc($v['stock']) ?></td>
                            <td>
                              <a href="<?= base_url('variants/delete/'.$v['id'].'/'.$product['id']) ?>" 
                            class="btn btn-sm btn-danger" 
                            onclick="return confirm('Delete this variant?')">
                            Delete
                            <a href="<?= base_url('variants/edit/'.$v['id']) ?>" class="btn btn-sm btn-primary me-1">Edit</a>

                            </a>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center">No variants found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>