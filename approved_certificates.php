<?php
// Simulated approved requests with delivery status
$requests = [
    [
        'id' => 1,
        'name' => 'Juan Dela Cruz',
        'requested_by' => 'Maria Santos',
        'status' => 'Approved',
        'generated_by' => 'AdminUser1',
        'approved_by' => 'Father Jose',
        'date_requested' => '2025-06-01',
        'date_approved' => '2025-06-03',
        'delivery_status' => 'Delivered'
    ],
    [
        'id' => 2,
        'name' => 'Ana Reyes',
        'requested_by' => 'Carlos Reyes',
        'status' => 'Approved',
        'generated_by' => 'AdminUser1',
        'approved_by' => 'Father Jose',
        'date_requested' => '2025-05-29',
        'date_approved' => '2025-06-02',
        'delivery_status' => 'Received'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Approved Certificates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/StartBootstrap/startbootstrap-sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body id="page-top">
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon mr-2">
                <i class="fas fa-church"></i>
            </div>
            <div class="d-flex flex-column text-white text-center">
                <div class="font-weight-bold">OUR LADY OF</div>
                <div class="font-weight-bold">LIGHT</div>
                <div class="small">PARISH LOON,</div>
                <div class="small">BOHOL</div>
            </div>
        </a>

        <hr class="sidebar-divider my-3">

        <li class="nav-item">
            <a class="nav-link" href="tracking.php"><i class="fas fa-fw fa-file-alt"></i><span>Certificate Requests</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="approved_certificates.php"><i class="fas fa-fw fa-check"></i><span>Approved Certificates</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="certificate_tracking.php"><i class="fas fa-map-marker-alt"></i><span>Track Requests</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-fw fa-cogs"></i><span>Settings</span></a>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <h5 class="ml-3 font-weight-bold text-primary">Approved Certificates</h5>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 font-weight-bold text-gray-800">Admin</span>
                            <i class="fas fa-user fa-fw"></i>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-primary text-white">
                        <h6 class="m-0 font-weight-bold">List of Approved Certificates</h6>
                    </div>
                    <div class="card-body">
                        <?php if (count($requests) > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>Request ID</th>
                                        <th>Child's Name</th>
                                        <th>Requested By</th>
                                        <th>Date Approved</th>
                                        <th>Delivery Status</th>
                                        <th>Status Progress</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($requests as $req): ?>
                                        <?php
                                        $status = strtolower($req['delivery_status']);
                                        $progress = match ($status) {
                                            'processing' => 25,
                                            'delivered' => 75,
                                            'received' => 100,
                                            default => 0
                                        };
                                        $badge = match ($status) {
                                            'delivered' => '<span class="badge badge-warning"><i class="fas fa-truck"></i> Delivered</span>',
                                            'received' => '<span class="badge badge-success"><i class="fas fa-check-circle"></i> Received</span>',
                                            default => '<span class="badge badge-secondary"><i class="fas fa-clock"></i> Processing</span>'
                                        };
                                        ?>
                                        <tr>
                                            <td><?= $req['id'] ?></td>
                                            <td><?= $req['name'] ?></td>
                                            <td><?= $req['requested_by'] ?></td>
                                            <td><?= $req['date_approved'] ?></td>
                                            <td><?= $badge ?></td>
                                            <td>
                                                <div class="progress" style="height: 20px;">
                                                    <div class="progress-bar
                                                        <?= $progress === 100 ? 'bg-success' : ($progress >= 75 ? 'bg-warning' : 'bg-secondary') ?>"
                                                        role="progressbar" style="width: <?= $progress ?>%;">
                                                        <?= $progress ?>%
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="track_request.php?id=<?= $req['id'] ?>" class="btn btn-info btn-sm">
                                                    Track
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info">No approved requests found.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- End Main Content -->

        </div>

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto text-center">
                <span class="text-muted">© <?= date('Y') ?> Baptism Certificate System</span>
            </div>
        </footer>

    </div>
</div>

<!-- JS Files -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/StartBootstrap/startbootstrap-sb-admin-2/js/sb-admin-2.min.js"></script>
</body>
</html>
