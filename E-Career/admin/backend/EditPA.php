<?php
include '../../db/connect.php';
include '../../login/loginCheckSession.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

$response = [
    'success' => false,
    'NormalS4' => ['success' => false], 'FastS4' => ['success' => false], 'SuperFastS4' => ['success' => false],
    'NormalS3' => ['success' => false], 'FastS3' => ['success' => false], 'SuperFastS3' => ['success' => false],
    'NormalS2' => ['success' => false], 'FastS2' => ['success' => false], 'SuperFastS2' => ['success' => false],
    'NormalS1' => ['success' => false], 'FastS1' => ['success' => false], 'SuperFastS1' => ['success' => false],
    'NormalO5' => ['success' => false], 'FastO5' => ['success' => false], 'SuperFastO5' => ['success' => false],
    'NormalO4' => ['success' => false], 'FastO4' => ['success' => false], 'SuperFastO4' => ['success' => false],
    'NormalO3' => ['success' => false], 'FastO3' => ['success' => false], 'SuperFastO3' => ['success' => false]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Edit_by = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];
    $Edit_Date = date('Y-m-d H:i:s');
    $allowedFileTypes = array('pdf');
    $Meet = $_POST['Meet'];
    $Active_Date = $_POST['Active_Date'];

    $document_pdf_file_fileName = null;
    if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {
        $document_pdf_file_fileTmpName = $_FILES['document']['tmp_name'];
        $document_pdf_file_fileExtension = pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);

        if (in_array($document_pdf_file_fileExtension, $allowedFileTypes)) {
            $document_pdf_file_fileName = $_FILES['document']['name'];
            $document_pdf_file_targetDir = "../../assets/filedata/PA_pdf/";
            $document_pdf_file_targetFilePath = $document_pdf_file_targetDir . $document_pdf_file_fileName;

            if (!move_uploaded_file($document_pdf_file_fileTmpName, $document_pdf_file_targetFilePath)) {
                $response['error'] = 'เกิดข้อผิดพลาดในการอัปโหลดไฟล์';
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                exit;
            }
        } else {
            $response['error'] = 'ประเภทไฟล์ไม่ได้รับอนุญาต';
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            exit;
        }
    } 

    $levels = ['NormalS4', 'FastS4', 'SuperFastS4', 'NormalS3', 'FastS3', 'SuperFastS3', 'NormalS2', 'FastS2', 'SuperFastS2', 'NormalS1', 'FastS1', 'SuperFastS1', 'NormalO5', 'FastO5', 'SuperFastO5', 'NormalO4', 'FastO4', 'SuperFastO4', 'NormalO3', 'FastO3', 'SuperFastO3'];

    $all_success = true;

    foreach ($levels as $level) {
        if (isset($_POST["PA_level$level"]) && isset($_POST["Tag$level"])) {
            $PA_level = $_POST["PA_level$level"];
            $TIG = $_POST["TIG$level"];
            $ESY = $_POST["ESY$level"];
            $Tag = $_POST["Tag$level"];
            $estimate = $_POST["estimate$level"];
            $HP = $_POST["Potential$level"] . '' . $_POST["HightPotential$level"];
            $Master_piece = $_POST["MasterPiece$level"];
            $Excellent = $_POST["Excellent$level"];
            $very_good = $_POST["very_good$level"];
            $good = $_POST["good$level"];
            $fair = $_POST["fair$level"];
            $adjust = $_POST["adjust$level"];

            if ($document_pdf_file_fileName) {
                $sql = "UPDATE PA_standard 
                        SET TIG = ?, ESY = ?, estimate = ?, Master_piece = ?, HP = ?, Excellent = ?, very_good = ?, good = ?, fair = ?, adjust = ?, Edit_by = ?, Edit_Date = ?, Active_Date = ?, document = ? 
                        WHERE PA_level = ? AND Meet = ? AND Tag = ?";
                $params = [
                    $TIG, $ESY, $estimate, $Master_piece, $HP, $Excellent, $very_good, $good, $fair, $adjust,
                    $Edit_by, $Edit_Date, $Active_Date, $document_pdf_file_fileName, $PA_level, $Meet, $Tag
                ];
            } else {
                $sql = "UPDATE PA_standard 
                        SET TIG = ?, ESY = ?, estimate = ?, Master_piece = ?, HP = ?, Excellent = ?, very_good = ?, good = ?, fair = ?, adjust = ?, Edit_by = ?, Edit_Date = ?, Active_Date = ? 
                        WHERE PA_level = ? AND Meet = ? AND Tag = ?";
                $params = [
                    $TIG, $ESY, $estimate, $Master_piece, $HP, $Excellent, $very_good, $good, $fair, $adjust,
                    $Edit_by, $Edit_Date, $Active_Date, $PA_level, $Meet, $Tag
                ];
            }

            $stmt = $db->prepare($sql);

            if ($stmt->execute($params)) {
                $response[$level]['success'] = true;
            } else {
                $response[$level]['success'] = false;
                $response[$level]['error'] = $stmt->errorInfo()[2];
                $all_success = false;
            }
        } else {
            $response[$level]['error'] = 'Missing required POST data';
            $all_success = false;
        }
    }
    $response['success'] = $all_success;
} else {
    $response['error'] = 'Invalid request';
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
