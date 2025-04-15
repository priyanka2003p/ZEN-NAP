<?php
header('Content-Type: application/json');
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['userId'], $input['sleepDate'], $input['sleepTime'], $input['wakeTime'], $input['duration'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'sleept');

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

// Check if the record exists
$checkStmt = $conn->prepare("SELECT ID FROM sleep_history WHERE ID = ?");
$checkStmt->bind_param("s", $input['userId']);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    // Update existing record
    $updateStmt = $conn->prepare("UPDATE sleep_history SET START = ?, END = ?, DURATION = ? WHERE ID = ?");
    $updateStmt->bind_param("ssss", $input['sleepTime'], $input['wakeTime'], $input['duration'], $input['userId']);

    if ($updateStmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Log updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update log']);
    }

    $updateStmt->close();
} else {
    // Insert new record
    $insertStmt = $conn->prepare("INSERT INTO sleep_history (ID, START, END, DURATION) VALUES (?, ?, ?, ?)");
    $insertStmt->bind_param("ssss", $input['userId'], $input['sleepTime'], $input['wakeTime'], $input['duration']);

    if ($insertStmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Log saved successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save log']);
    }

    $insertStmt->close();
}

$checkStmt->close();
$conn->close();
?>
