<?php
include '../../db/connect.php';
include '../../login/loginCheckSession.php';

// ตั้งค่า Content-Type ก่อนการส่งข้อมูลใด ๆ
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
    $Edit_Date = date('Y-m-d H:i:s'); // Current timestamp
    $allowedFileTypes = array('pdf');
    $Meet = $_POST['Meet'];
    $Active_Date = $_POST['Active_Date'];

    // รับข้อมูลไฟล์ที่อัปโหลด
    $document_pdf_file_fileName = $_FILES['document']['name'];
    $document_pdf_file_fileTmpName = $_FILES['document']['tmp_name'];

    // แยกนามสกุลไฟล์
    $document_pdf_file_fileExtension = pathinfo($document_pdf_file_fileName, PATHINFO_EXTENSION);

    // ตรวจสอบประเภทไฟล์
    if (in_array($document_pdf_file_fileExtension, $allowedFileTypes)) {
        $document_pdf_file_targetDir = "../../assets/filedata/PA_pdf/";
        $document_pdf_file_targetFilePath = $document_pdf_file_targetDir . $document_pdf_file_fileName;

        // ย้ายไฟล์ที่อัปโหลดไปยังตำแหน่งที่ต้องการ
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

            $sql = "INSERT INTO PA_standard 
                    (PA_level, TIG, ESY, estimate, Master_piece, Tag, HP, Excellent, very_good, good, fair, adjust, Edit_by, Edit_Date, Meet, Active_Date, document) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($sql);

            $params = [
                $PA_level, $TIG, $ESY, $estimate, $Master_piece, $Tag, $HP,
                $Excellent, $very_good, $good, $fair, $adjust, $Edit_by, $Edit_Date, $Meet, $Active_Date, $document_pdf_file_fileName
            ];

            if ($stmt->execute($params)) {
                $response[($level)]['success'] = true;
            } else {
                $response[($level)]['success'] = false;
                $response[($level)]['error'] = $stmt->errorInfo()[2];
                $all_success = false;
            }
        } else {
            $response[($level)]['error'] = 'Missing required POST data';
            $all_success = false;
        }
    }
    $response['success'] = $all_success;
} else {
    $response['error'] = 'Invalid request';
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
