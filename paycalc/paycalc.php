<?php
include_once "../header.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>pay_calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-dark">
    <form action="login.php" method="POST" style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4 text-white">Pay Calculator</h2>
    </form>
</body>
</html>

<?php include_once "../footer.php"; ?><p>
    <?php
    // Connect to DB
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
 
    // Get active shifts (status = 1), including the id field
    $sql = "SELECT id, date, start_time, end_time, start_holiday, end_holiday FROM shifts WHERE status = 1 ORDER BY date DESC";
    $result = $conn->query($sql);
 
    // Initialize array for rows
    $shifts = [];
 
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $shifts[] = $row;
        }
    }
 
    $conn->close();
    ?>
 
<div class="container mt-4">
    <h4>Shift Entries</h4>
 
    <?php if (!empty($shifts)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Start Time</th>
                    <th scope="col">End Time</th>
                    <th scope="col">Start Holiday</th>
                    <th scope="col">End Holiday</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
 
                <?php foreach ($shifts as $shift): ?>
                    <tr>
                        <td><?= htmlspecialchars($shift['date']) ?></td>
                        <td><?= htmlspecialchars($shift['start_time']) ?></td>
                        <td><?= htmlspecialchars($shift['end_time']) ?></td>
                        <td><?= $shift['start_holiday'] ? '✓' : '—' ?></td>
                        <td><?= $shift['end_holiday'] ? '✓' : '—' ?></td>
                        <td>
                            <!-- DELETE button -->
                            <form action="shifts_delete.php" method="get" style="display:inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($shift['id']) ?>">
                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                            </form>
 
                            &nbsp;&nbsp;&nbsp;&nbsp;
 
                            <!-- EDIT button -->
                            <form style="display:inline;">
                                <button
                                    type="button"
                                    class="btn btn-outline-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal<?= $shift['id'] ?>">
                                    Edit
                                </button>
                            </form>
 
                            <!-- Modal -->
                            <div class="modal fade" id="editModal<?= $shift['id'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="post" action="shifts_edit.php" class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Shift</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($shift['id']) ?>">
 
                                            <p><strong>Current Shift ID: <?= htmlspecialchars($shift['id']) ?></strong></p>
 
                                            <div class="row mb-3 align-items-center">
                                                <label for="editDate<?= $shift['id'] ?>" class="col-sm-4 col-form-label">Date:</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control" id="editDate<?= $shift['id'] ?>" name="date" value="<?= htmlspecialchars($shift['date']) ?>" required>
                                                </div>
                                            </div>
 
                                            <div class="row mb-3 align-items-center">
                                                <label for="editStartTime<?= $shift['id'] ?>" class="col-sm-4 col-form-label">Start Time:</label>
                                                <div class="col-sm-8">
                                                    <input type="time" class="form-control" id="editStartTime<?= $shift['id'] ?>" name="start_time" value="<?= htmlspecialchars($shift['start_time']) ?>" required>
                                                </div>
                                            </div>
 
                                            <div class="row mb-3 align-items-center">
                                                <label for="editEndTime<?= $shift['id'] ?>" class="col-sm-4 col-form-label">End Time:</label>
                                                <div class="col-sm-8">
                                                    <input type="time" class="form-control" id="editEndTime<?= $shift['id'] ?>" name="end_time" value="<?= htmlspecialchars($shift['end_time']) ?>" required>
                                                </div>
                                            </div>
 
                                            <div class="row">
                                                <div class="col-sm-8 offset-sm-4">
                                                    <div class="form-check mb-3">
                                                        <label class="form-check-label">
                                                            Start on holiday?
                                                        </label>
                                                        <input class="form-check-input" type="checkbox" name="start_on_holiday" <?= ($shift['start_holiday'] ?? '') === '1' ? 'checked' : '' ?> >
                                                    </div>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            End on holiday?
                                                        </label>
                                                        <input class="form-check-input" type="checkbox" name="end_on_holiday" <?= ($shift['end_holiday'] ?? '') === '1' ? 'checked' : '' ?> >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-info">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
 
</div>
 
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php else: ?>
    <p class="text-muted">No shift entries found.</p>
<?php endif; ?>
</div>
 
</p>