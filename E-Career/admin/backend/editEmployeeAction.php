<?php
require_once '../../db/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $master_piece = $_POST['master_piece'];
    $emp_id = $_POST['emp_id'];

    // ตั้งค่าประเภทไฟล์ที่อนุญาต
    $allowedFileTypes = array('pdf');

    // รับข้อมูลไฟล์ที่อัปโหลด
    $master_piece_file_fileName = $_FILES['master_piece_file']['name'] ?? null;
    $master_piece_file_fileTmpName = $_FILES['master_piece_file']['tmp_name'] ?? null;

    // แยกนามสกุลไฟล์
    $master_piece_file_fileExtension = $master_piece_file_fileName ? pathinfo($master_piece_file_fileName, PATHINFO_EXTENSION) : null;

    $uploadErrors = [];

    // ย้ายไฟล์ที่อัปโหลดไปยังตำแหน่งที่ต้องการ
    if ($master_piece_file_fileName && in_array($master_piece_file_fileExtension, $allowedFileTypes)) {
        $master_piece_file_targetDir = "../filedata/master_piece_pdf/";
        $master_piece_file_targetFilePath = $master_piece_file_targetDir . $master_piece_file_fileName;
        if (!move_uploaded_file($master_piece_file_fileTmpName, $master_piece_file_targetFilePath)) {
            $uploadErrors[] = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์ PDF";
        }
    }

    if (!empty($uploadErrors)) {
        echo implode("<br>", $uploadErrors);
        exit;
    }

    try {
        // SQL query
        $sql = "UPDATE tb_evaluate_employee SET master_piece = :master_piece";

        if ($master_piece_file_fileName != null) {
            $sql .= ", master_piece_file = :master_piece_file";
        } else {
            $sql .= ", master_piece_file = NULL";
        }

        $sql .= " WHERE emp_id = :emp_id";

        // เตรียม statement
        $stmt = $db->prepare($sql);

        if ($master_piece_file_fileName != null) {
            $stmt->bindParam(':master_piece_file', $master_piece_file_fileName);
        }

        // ข้อมูลที่จะใช้ใน query
        $stmt->bindParam(':master_piece', $master_piece);
        $stmt->bindParam(':emp_id', $emp_id);

        // ดำเนินการ statement พร้อมกับ parameter
        $stmt->execute();

        echo json_encode("Edit Success");
    } catch (PDOException $e) {
        echo json_encode("Error: " . $e->getMessage());
    }
}
