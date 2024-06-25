<?php
include '../../db/connect.php';
include '../../login/loginCheckSession.php';

// ตั้งค่า Content-Type ก่อนการส่งข้อมูลใด ๆ
header('Content-Type: application/json');

$response = ['normal' => ['success' => false], 'fast' => ['success' => false], 'SuperFast' => ['success' => false]];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Edit_by = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];
    $Edit_Date = date('Y-m-d H:i:s'); // Current timestamp
    $allowedFileTypes = array('pdf');

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
        if (move_uploaded_file($document_pdf_file_fileTmpName, $document_pdf_file_targetFilePath)) {
            // echo json_encode("ไฟล์อัปโหลดสำเร็จ", JSON_UNESCAPED_UNICODE);
        } else {
            // echo json_encode("เกิดข้อผิดพลาดในการอัปโหลดไฟล์", JSON_UNESCAPED_UNICODE);
        }
    } else {
        // echo json_encode("ประเภทไฟล์ไม่ได้รับอนุญาต", JSON_UNESCAPED_UNICODE);
    }
    // ตรวจสอบและเพิ่มข้อมูล Normal
    if (isset($_POST['PA_level']) && isset($_POST['TIG'])) {
        $PA_level = $_POST['PA_level'];
        $TIG = $_POST['TIG'];
        $ESY = $_POST['ESY'];
        $Tag = $_POST['Tag'];
        $estimate = $_POST['estimate'];
        $HP = $_POST['HP'];
        $P = $_POST['P'];
        $Master_piece = $_POST['Master_piece'];
        $Excellent = $_POST['Excellent'];
        $very_good = $_POST['very_good'];
        $good = $_POST['good'];
        $fair = $_POST['fair'];
        $adjust = $_POST['adjust'];
        $Meet = $_POST['Meet'];
        $Active_Date = $_POST['Active_Date'];

        $sql = "INSERT INTO PA_standard 
                (PA_level, TIG, ESY, estimate, HP, P, Master_piece, Tag, Excellent, very_good, good, fair, adjust, Edit_by, Edit_Date, Meet, Active_Date, document) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);

        $params = [
            $PA_level, $TIG, $ESY, $estimate, $HP, $P, $Master_piece, $Tag,
            $Excellent, $very_good, $good, $fair, $adjust, $Edit_by, $Edit_Date, $Meet, $Active_Date, $document_pdf_file_fileName
        ];

        if ($stmt->execute($params)) {
            $response['normal']['success'] = true;
        } else {
            $response['normal']['success'] = false;
            $response['normal']['error'] = $stmt->errorInfo()[2];
        }
    }

    // ตรวจสอบและเพิ่มข้อมูล Fast
    if (isset($_POST['PA_level']) && isset($_POST['TIGfast'])) {
        $PA_level = $_POST['PA_level'];
        $TIG = $_POST['TIGfast'];
        $ESY = $_POST['ESYfast'];
        $Tag = $_POST['Tagfast'];
        $estimate = $_POST['estimatefast'];
        $HP = $_POST['HPfast'];
        $P = $_POST['Pfast'];
        $Master_piece = $_POST['Master_Piecefast'];
        $Excellent = $_POST['Excellentfast'];
        $very_good = $_POST['very_goodfast'];
        $good = $_POST['goodfast'];
        $fair = $_POST['fairfast'];
        $adjust = $_POST['adjustfast'];
        $Meet = $_POST['Meet'];
        $Active_Date = $_POST['Active_Date'];

        $sql = "INSERT INTO PA_standard 
                (PA_level, TIG, ESY, estimate, HP, P, Master_piece, Tag, Excellent, very_good, good, fair, adjust, Edit_by, Edit_Date, Meet, Active_Date, document) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);

        $params = [
            $PA_level, $TIG, $ESY, $estimate, $HP, $P, $Master_piece, $Tag,
            $Excellent, $very_good, $good, $fair, $adjust, $Edit_by, $Edit_Date, $Meet, $Active_Date, $document_pdf_file_fileName
        ];

        if ($stmt->execute($params)) {
            $response['fast']['success'] = true;
        } else {
            $response['fast']['success'] = false;
            $response['fast']['error'] = $stmt->errorInfo()[2];
        }
    }

    // ตรวจสอบและเพิ่มข้อมูล Super Fast
    if (isset($_POST['PA_level']) && isset($_POST['TIGSuper_Fast'])) {
        $PA_level = $_POST['PA_level'];
        $TIG = $_POST['TIGSuper_Fast'];
        $ESY = $_POST['ESYSuper_Fast'];
        $Tag = $_POST['TagSuper_Fast'];
        $estimate = $_POST['estimateSuper_Fast'];
        $HP = $_POST['HPSuper_Fast'];
        $P = $_POST['PSuper_Fast'];
        $Master_piece = $_POST['Master_PieceSuper_Fast'];
        $Excellent = $_POST['ExcellentSuper_Fast'];
        $very_good = $_POST['very_goodSuper_Fast'];
        $good = $_POST['goodSuper_Fast'];
        $fair = $_POST['fairSuper_Fast'];
        $adjust = $_POST['adjustSuper_Fast'];
        $Meet = $_POST['Meet'];
        $Active_Date = $_POST['Active_Date'];

        $sql = "INSERT INTO PA_standard 
                (PA_level, TIG, ESY, estimate, HP, P, Master_piece, Tag, Excellent, very_good, good, fair, adjust, Edit_by, Edit_Date, Meet, Active_Date, document) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);

        $params = [
            $PA_level, $TIG, $ESY, $estimate, $HP, $P, $Master_piece, $Tag,
            $Excellent, $very_good, $good, $fair, $adjust, $Edit_by, $Edit_Date, $Meet, $Active_Date, $document_pdf_file_fileName
        ];

        if ($stmt->execute($params)) {
            $response['SuperFast']['success'] = true;
        } else {
            $response['SuperFast']['success'] = false;
            $response['SuperFast']['error'] = $stmt->errorInfo()[2];
        }
    }
} else {
    $response['success'] = false;
    $response['error'] = 'Invalid request';
}

echo json_encode($response);
