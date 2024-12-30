<?php
session_start();
include 'config/dbconn.php';

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['first_name'])) {
    header("Location: login.php");
    exit();
}
$firstName = $_SESSION['first_name'];
$userId = $_SESSION['user_id'];

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['add_task'])) {
        $task = trim($_POST['task']);
        if (!empty($task)) {
            $stmt = $conn->prepare("INSERT INTO todo (user_id, task) VALUES (?, ?)");
            $stmt->bind_param("is", $userId, $task);
            $stmt->execute();
            $stmt->close();
        }
    } elseif (isset($_POST['edit_task'])) {
        $taskId = $_POST['task_id'];
        $newTask = trim($_POST['new_task']);
        if (!empty($newTask)) {
            $stmt = $conn->prepare("UPDATE todo SET task = ? WHERE id = ? AND user_id = ?");
            $stmt->bind_param("sii", $newTask, $taskId, $userId);
            $stmt->execute();
            $stmt->close();
        }
    } elseif (isset($_POST['remove_task'])) {
        $taskId = $_POST['task_id'];
        $stmt = $conn->prepare("DELETE FROM todo WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $taskId, $userId);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch tasks
$stmt = $conn->prepare("SELECT id, task, created_at FROM todo WHERE user_id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$tasks = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iTask | Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <?php include 'components/header.php' ?>
    <div class="container mt-3">
        <h2>Your Tasks</h2>

        <!-- Add Task -->
        <form method="POST" class="mb-3">
            <div class="input-group">
                <input type="text" name="task" class="form-control" placeholder="New Task" required>
                <button type="submit" name="add_task" class="btn btn-success">Add Task</button>
            </div>
        </form>

        <!-- Task List -->
        <?php if (!empty($tasks)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Task</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $index => $task): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo htmlspecialchars($task['task']); ?></td>
                    <td><?php echo htmlspecialchars($task['created_at']); ?></td>
                    <td>
                        <!-- Edit Task -->
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                            <input type="text" name="new_task" class="form-control d-inline w-auto"
                                placeholder="Edit Task">
                            <button type="submit" name="edit_task" class="btn btn-warning btn-sm">Edit</button>
                        </form>

                        <!-- Remove Task -->
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                            <button type="submit" name="remove_task" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>No tasks found. Start adding some!</p>
        <?php endif; ?>

        <!-- Logout -->
        <!-- <form action="logout.php" method="POST" class="mt-3">
            <button type="submit" class="btn btn-secondary">Logout</button>
        </form> -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>