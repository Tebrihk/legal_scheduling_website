<?php
// Connect to the database (use your database connection code)

// Check for new records (e.g., based on timestamp or unique ID)
$query = "SELECT COUNT(*) AS newRecord FROM appointment WHERE timestamp > :lastCheckTime";
// Bind ":lastCheckTime" with the timestamp of the last check (you'll need to pass this value via AJAX)

$result = $pdo->prepare($query);
$result->execute([":lastCheckTime" => $lastCheckTime]);
$newRecord = $result->fetch(PDO::FETCH_ASSOC);

echo json_encode(['newRecord' => (bool) $newRecord['newRecord']]);
?>
