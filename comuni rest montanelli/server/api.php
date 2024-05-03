<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
$urlParam = isset($_GET['url']) ? explode('/', $_GET['url']) : [];
$action = strtolower($urlParam[0] ?? '');
$id = $urlParam[1] ?? null;

// Database connection setup
$conn = new mysqli('localhost', 'root', '', 'codicipostali');
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

// Handle the request based on the HTTP method and action
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        handleGetRequest($conn, $id);
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if ($action === 'add') {
            handlePostRequest($conn, $data);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid URL for POST request']);
            http_response_code(404);
        }
        break;
    case 'PUT':
        if ($action === 'edit' && $id !== null) {
            $data = json_decode(file_get_contents('php://input'), true);
            handlePutRequest($conn, $id, $data);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid URL for PUT request']);
            http_response_code(404);
        }
        break;
    case 'DELETE':
        if ($action === 'delete' && $id !== null) {
            handleDeleteRequest($conn, $id);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid URL for DELETE request']);
            http_response_code(404);
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(['status' => 'error', 'message' => 'Method Not Allowed']);
        break;
}

// Close the database connection
$conn->close();

// Function to handle GET requests
function handleGetRequest($conn, $id) {
    $sql = "SELECT * FROM CodiciPostali";
    if ($id !== null) {
        $sql .= " WHERE id = " . intval($id);
    }

    $result = $conn->query($sql);
    if ($result) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($rows);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Error executing query']);
    }
}

// Function to handle POST requests (Add)
function handlePostRequest($conn, $data) {
    $stmt = $conn->prepare("INSERT INTO CodiciPostali (CodicePostale, Comune) VALUES (?, ?)");
    $stmt->bind_param("ss", $data['CodicePostale'], $data['Comune']);
    if ($stmt->execute()) {
        http_response_code(201);
        echo json_encode(['status' => 'success', 'message' => 'Entry added']);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Error adding entry']);
    }
    $stmt->close();
}

// Function to handle PUT requests (Edit)
function handlePutRequest($conn, $id, $data) {
    $stmt = $conn->prepare("UPDATE CodiciPostali SET CodicePostale = ?, Comune = ? WHERE id = ?");
    $stmt->bind_param("ssi", $data['CodicePostale'], $data['Comune'], $id);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Entry updated']);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Error updating entry']);
    }
    $stmt->close();
}

// Function to handle DELETE requests
function handleDeleteRequest($conn, $id) {
    $stmt = $conn->prepare("DELETE FROM CodiciPostali WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Entry deleted']);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Error deleting entry']);
    }
    $stmt->close();
}
?>
