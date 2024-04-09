<?php
include 'header.php';
require_once 'Database.php';

// View a list of users
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'view') {
    $stmt = $conn->prepare("SELECT * FROM registered_user");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = null;
}

// Edit a user's details
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'edit') {
    if (isset($_GET['id'])) {
        $stmt = $conn->prepare("SELECT * FROM registered_user WHERE user_id = ?");
        $stmt->execute([$_GET['id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
    }
}

// Update a user's role to administrator
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_role') {
    if (isset($_POST['id'])) {
        $newRoleId = $_POST['role'] === 'admin' ? 2 : 1;
        $stmt = $conn->prepare("UPDATE registered_user SET fk_role_id = ? WHERE user_id = ?");
        $stmt->execute([$newRoleId, $_POST['id']]);
        $stmt = null;
    }
}

// Delete a user (and all related data)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    if (isset($_POST['id'])) {
        $stmt = $conn->prepare("DELETE FROM registered_user WHERE user_id = ?");
        $stmt->execute([$_POST['id']]);
        $stmt = null;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Manage Users</h1>

    <?php if (isset($_GET['action']) && $_GET['action'] === 'view') : ?>
        <?php if (!empty($users)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Nickname</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo $user['user_id']; ?></td>
                            <td><?php echo $user['user_nickname']; ?></td>
                            <td><?php echo $user['user_name']; ?></td>
                            <td><?php echo $user['user_email']; ?></td>
                            <td><?php echo $user['fk_role_id'] === 2 ? 'Administrator' : 'Regular User'; ?></td>
                            <td>
                                <a href="?action=edit&id=<?php echo $user['user_id']; ?>">Edit</a>
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="action" value="update_role">
                                    <input type="hidden" name="id" value="<?php echo $user['user_id']; ?>">
                                    <input type="hidden" name="role" value="<?php echo $user['fk_role_id'] === 2 ? 'user' : 'admin'; ?>">
                                    <button type="submit"><?php echo $user['fk_role_id'] === 2 ? 'Demote' : 'Promote'; ?></button>
                                </form>
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?php echo $user['user_id']; ?>">
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No users found.</p>
        <?php endif; ?>
    <?php elseif (isset($_GET['action']) && $_GET['action'] === 'edit') : ?>
        <?php if (isset($user)) : ?>
            <h2>Edit User</h2>
            <form method="post" action="update_user.php">
                <input type="hidden" name="id" value="<?php echo $user['user_id']; ?>">
                <label for="nickname">Nickname:</label>
                <input type="text" name="nickname" id="nickname" value="<?php echo $user['user_nickname']; ?>">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?php echo $user['user_name']; ?>">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $user['user_email']; ?>">
                <button type="submit">Save Changes</button>
            </form>
        <?php else : ?>
            <p>User not found.</p>
        <?php endif; ?>
    <?php else : ?>
        <a href="?action=view">View Users</a>
    <?php endif; ?>

    <script src="script.js"></script>
</body>
</html>