<?php
require_once '../../../db/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emp_id = $_POST['editEmpMasterPieceID'];
    $p_id = $_POST['editEmpMasterPiecePID'];
    $master_piece = $_POST['editEmpMasterPieceCheck'];
    $master_piece_active_date = $_POST['editEmpMasterPieceActiveDate'] ?? null;
    $master_piece_drop_cause = $_POST['editMasterPieceDropCause'] ?? null;

    // ตั้งค่าประเภทไฟล์ที่อนุญาต
    $allowedFileTypes = array('pdf');

    // รับข้อมูลไฟล์ที่อัปโหลด
    $master_piece_file_fileName = $_FILES['editEmpMasterPieceFile']['name'] ?? null;
    $master_piece_file_fileTmpName = $_FILES['editEmpMasterPieceFile']['tmp_name'] ?? null;

    // แยกนามสกุลไฟล์
    $master_piece_file_fileExtension = $master_piece_file_fileName ? pathinfo($master_piece_file_fileName, PATHINFO_EXTENSION) : null;

    $uploadErrors = [];

    // ย้ายไฟล์ที่อัปโหลดไปยังตำแหน่งที่ต้องการ
    if ($master_piece_file_fileName && in_array($master_piece_file_fileExtension, $allowedFileTypes)) {
        $master_piece_file_targetDir = "../../../assets/filedata/masterPiece_pdf/";
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
        $querypid = "SELECT COUNT(p_id) as num_PID FROM tb_evaluate_employee WHERE p_id = '$p_id'";
        $stmt = $db->prepare($querypid);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['num_PID'] >= 2 && $master_piece == 'true') {
            $sql = "UPDATE tb_evaluate_employee SET master_piece = :master_piece";

            if ($master_piece_active_date != null) {
                $sql .= ", master_piece_active_date = :master_piece_active_date";
            } else {
                $sql .= ", master_piece_active_date = NULL";
            }

            if ($master_piece_file_fileName != null) {
                $sql .= ", master_piece_file = :master_piece_file";
            } else {
                $sql .= ", master_piece_file = NULL";
            }

            $sql .= " WHERE emp_id = :emp_id";

            $stmt = $db->prepare($sql);

            if ($master_piece_active_date != null) {
                $stmt->bindParam(':master_piece_active_date', $master_piece_active_date);
            }

            if ($master_piece_file_fileName != null) {
                $stmt->bindParam(':master_piece_file', $master_piece_file_fileName);
            }

            $stmt->bindParam(':master_piece', $master_piece);
            $stmt->bindParam(':emp_id', $emp_id);
            $stmt->execute();

            echo json_encode("Edit Success");

        } else if ($row['num_PID'] >= 2 && $master_piece == 'false') {
            $sql = "UPDATE tb_evaluate_employee SET master_piece = :master_piece";

            if ($master_piece_active_date != null) {
                $sql .= ", master_piece_active_date = :master_piece_active_date";
            } else {
                $sql .= ", master_piece_active_date = NULL";
            }

            if ($master_piece_file_fileName != null) {
                $sql .= ", master_piece_file = :master_piece_file";
            } else {
                $sql .= ", master_piece_file = NULL";
            }

            if ($master_piece_drop_cause != null) {
                $sql .= ", master_piece_drop_cause = :master_piece_drop_cause";
            } else {
                $sql .= ", master_piece_drop_cause = NULL";
            }

            $sql .= " WHERE emp_id = :emp_id";

            $stmt = $db->prepare($sql);

            if ($master_piece_active_date != null) {
                $stmt->bindParam(':master_piece_active_date', $master_piece_active_date);
            }

            if ($master_piece_file_fileName != null) {
                $stmt->bindParam(':master_piece_file', $master_piece_file_fileName);
            }

            if ($master_piece_drop_cause != null) {
                $stmt->bindParam(':master_piece_drop_cause', $master_piece_drop_cause);
            }

            $stmt->bindParam(':master_piece', $master_piece);
            $stmt->bindParam(':emp_id', $emp_id);
            $stmt->execute();

            echo json_encode("Edit Success");

        } else if ($row['num_PID'] == 1 && $master_piece == 'true') {
            $sql = "UPDATE tb_evaluate_employee SET master_piece = :master_piece";

            if ($master_piece_active_date != null) {
                $sql .= ", master_piece_active_date = :master_piece_active_date";
            } else {
                $sql .= ", master_piece_active_date = NULL";
            }

            if ($master_piece_file_fileName != null) {
                $sql .= ", master_piece_file = :master_piece_file";
            } else {
                $sql .= ", master_piece_file = NULL";
            }

            $sql .= " WHERE emp_id = :emp_id";

            $stmt = $db->prepare($sql);

            if ($master_piece_active_date != null) {
                $stmt->bindParam(':master_piece_active_date', $master_piece_active_date);
            }

            if ($master_piece_file_fileName != null) {
                $stmt->bindParam(':master_piece_file', $master_piece_file_fileName);
            }

            $stmt->bindParam(':master_piece', $master_piece);
            $stmt->bindParam(':emp_id', $emp_id);
            $stmt->execute();

            echo json_encode("Edit Success");

        } else if ($row['num_PID'] == 1 && $master_piece == 'false') {
            $sql = "UPDATE tb_evaluate_employee SET master_piece = :master_piece";

            if ($master_piece_active_date != null) {
                $sql .= ", master_piece_active_date = :master_piece_active_date";
            } else {
                $sql .= ", master_piece_active_date = NULL";
            }

            if ($master_piece_file_fileName != null) {
                $sql .= ", master_piece_file = :master_piece_file";
            } else {
                $sql .= ", master_piece_file = NULL";
            }

            if ($master_piece_drop_cause != null) {
                $sql .= ", master_piece_drop_cause = :master_piece_drop_cause";
            } else {
                $sql .= ", master_piece_drop_cause = NULL";
            }

            $sql .= " WHERE emp_id = :emp_id";

            $stmt = $db->prepare($sql);

            if ($master_piece_active_date != null) {
                $stmt->bindParam(':master_piece_active_date', $master_piece_active_date);
            }

            if ($master_piece_file_fileName != null) {
                $stmt->bindParam(':master_piece_file', $master_piece_file_fileName);
            }

            if ($master_piece_drop_cause != null) {
                $stmt->bindParam(':master_piece_drop_cause', $master_piece_drop_cause);
            }

            $stmt->bindParam(':master_piece', $master_piece);
            $stmt->bindParam(':emp_id', $emp_id);
            $stmt->execute();

            echo json_encode("Edit Success");
        }
    } catch (PDOException $e) {
        echo json_encode("Error: " . $e->getMessage());
    }
}
