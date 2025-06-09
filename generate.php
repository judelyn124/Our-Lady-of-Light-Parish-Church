<?php
// Simulated DB fetch using ID (you'll replace this with real DB logic)
$requestId = $_GET['id'] ?? null;

// Dummy data - you would typically fetch this from a database
$requests = [
    1 => [
        'name' => 'Juan Dela Cruz',
        'requested_by' => 'Maria Santos',
        'date_requested' => '2025-06-01',
        'status' => 'Pending',
    ],
    2 => [
        'name' => 'Ana Reyes',
        'requested_by' => 'Carlos Reyes',
        'date_requested' => '2025-05-29',
        'status' => 'Approved',
    ],
];

// Check if the ID exists
$request = $requests[$requestId] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate Certificate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <a href="tracking.php" class="btn btn-secondary mb-3">&larr; Back to Requests</a>

    <?php if ($request): ?>
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Generate Certificate for Request #<?= htmlspecialchars($requestId) ?></h4>
            </div>
            <div class="card-body">
                <form method="post" action="save_certificate.php">
                    <input type="hidden" name="request_id" value="<?= $requestId ?>">

                    <div class="form-group">
                        <label>Child's Name</label>
                        <input type="text" name="child_name" class="form-control" value="<?= htmlspecialchars($request['name']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Requested By</label>
                        <input type="text" name="requested_by" class="form-control" value="<?= htmlspecialchars($request['requested_by']) ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Date of Baptism</label>
                        <input type="date" name="date_baptized" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Priest's Name</label>
                        <input type="text" name="priest" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Certificate Notes</label>
                        <textarea name="notes" class="form-control" rows="3" placeholder="Optional notes..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Save Certificate
                    </button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">Request not found.</div>
    <?php endif; ?>
</div>

<!-- JS for icons (FontAwesome) -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>