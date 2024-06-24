<?php
require_once '../../db/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name_percentile = $_POST['name_percentile'];
    $edit_by = $_POST['edit_by'];
    $edit_date = $_POST['edit_date'];
    $active_date = $_POST['active_date'];
    $o3_p0 = $_POST['o3_p0'];
    $o3_p25 = $_POST['o3_p25'];
    $o3_p50 = $_POST['o3_p50'];
    $o3_p75 = $_POST['o3_p75'];
    $o3_p100 = $_POST['o3_p100'];
    $o4_p0 = $_POST['o4_p0'];
    $o4_p25 = $_POST['o4_p25'];
    $o4_p50 = $_POST['o4_p50'];
    $o4_p75 = $_POST['o4_p75'];
    $o4_p100 = $_POST['o4_p100'];
    $o5_p0 = $_POST['o5_p0'];
    $o5_p25 = $_POST['o5_p25'];
    $o5_p50 = $_POST['o5_p50'];
    $o5_p75 = $_POST['o5_p75'];
    $o5_p100 = $_POST['o5_p100'];
    $s1_p0 = $_POST['s1_p0'];
    $s1_p25 = $_POST['s1_p25'];
    $s1_p50 = $_POST['s1_p50'];
    $s1_p75 = $_POST['s1_p75'];
    $s1_p100 = $_POST['s1_p100'];
    $s2_p0 = $_POST['s2_p0'];
    $s2_p25 = $_POST['s2_p25'];
    $s2_p50 = $_POST['s2_p50'];
    $s2_p75 = $_POST['s2_p75'];
    $s2_p100 = $_POST['s2_p100'];
    $s3_p0 = $_POST['s3_p0'];
    $s3_p25 = $_POST['s3_p25'];
    $s3_p50 = $_POST['s3_p50'];
    $s3_p75 = $_POST['s3_p75'];
    $s3_p100 = $_POST['s3_p100'];
    $s4_p0 = $_POST['s4_p0'];
    $s4_p25 = $_POST['s4_p25'];
    $s4_p50 = $_POST['s4_p50'];
    $s4_p75 = $_POST['s4_p75'];
    $s4_p100 = $_POST['s4_p100'];
    $id_percentile = $_POST['id_percentile'];

    // ตั้งค่าประเภทไฟล์ที่อนุญาต
    $allowedFileTypes = array('pdf');

    // รับข้อมูลไฟล์ที่อัปโหลด
    $percentile_pdf_file_fileName = $_FILES['percentile_pdf_file']['name'] ?? null;
    $percentile_pdf_file_fileTmpName = $_FILES['percentile_pdf_file']['tmp_name'] ?? null;

    // แยกนามสกุลไฟล์
    $percentile_pdf_file_fileExtension = $percentile_pdf_file_fileName ? pathinfo($percentile_pdf_file_fileName, PATHINFO_EXTENSION) : null;

    $uploadErrors = [];

    // ย้ายไฟล์ที่อัปโหลดไปยังตำแหน่งที่ต้องการ
    if ($percentile_pdf_file_fileName && in_array($percentile_pdf_file_fileExtension, $allowedFileTypes)) {
        $percentile_pdf_file_targetDir = "../../assets/filedata/percentile_pdf/";
        $percentile_pdf_file_targetFilePath = $percentile_pdf_file_targetDir . $percentile_pdf_file_fileName;
        if (!move_uploaded_file($percentile_pdf_file_fileTmpName, $percentile_pdf_file_targetFilePath)) {
            $uploadErrors[] = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์ Design PDF";
        }
    }

    if (!empty($uploadErrors)) {
        echo implode("<br>", $uploadErrors);
        exit;
    }

    try {
        // SQL query
        $sql = "UPDATE tb_percentile SET percentile_name = :percentile_name, edit_by_name = :edit_by_name, edit_date = :edit_date, active_date = :active_date, 
        o3_p0 = :o3_p0, o3_p25 = :o3_p25, o3_p50 = :o3_p50, o3_p75 = :o3_p75, o3_p100 = :o3_p100,
        o4_p0 = :o4_p0, o4_p25 = :o4_p25, o4_p50 = :o4_p50, o4_p75 = :o4_p75, o4_p100 = :o4_p100,
        o5_p0 = :o5_p0, o5_p25 = :o5_p25, o5_p50 = :o5_p50, o5_p75 = :o5_p75, o5_p100 = :o5_p100,
        s1_p0 = :s1_p0, s1_p25 = :s1_p25, s1_p50 = :s1_p50, s1_p75 = :s1_p75, s1_p100 = :s1_p100,
        s2_p0 = :s2_p0, s2_p25 = :s2_p25, s2_p50 = :s2_p50, s2_p75 = :s2_p75, s2_p100 = :s2_p100,
        s3_p0 = :s3_p0, s3_p25 = :s3_p25, s3_p50 = :s3_p50, s3_p75 = :s3_p75, s3_p100 = :s3_p100,
        s4_p0 = :s4_p0, s4_p25 = :s4_p25, s4_p50 = :s4_p50, s4_p75 = :s4_p75, s4_p100 = :s4_p100";

        if ($percentile_pdf_file_fileName != null) {
            $sql .= " , percentile_pdf_file_name = :percentile_pdf_file_name";
        }

        $sql .= " WHERE percentile_id = :percentile_id";

        // เตรียม statement
        $stmt = $db->prepare($sql);

        if ($percentile_pdf_file_fileName != null) {
            $stmt->bindParam(':percentile_pdf_file_name', $percentile_pdf_file_fileName);
        }

        // ข้อมูลที่จะใช้ใน query
        $stmt->bindParam(':percentile_name', $name_percentile);
        $stmt->bindParam(':edit_by_name', $edit_by);
        $stmt->bindParam(':edit_date', $edit_date);
        $stmt->bindParam(':active_date', $active_date);
        $stmt->bindParam(':o3_p0', $o3_p0);
        $stmt->bindParam(':o3_p25', $o3_p25);
        $stmt->bindParam(':o3_p50', $o3_p50);
        $stmt->bindParam(':o3_p75', $o3_p75);
        $stmt->bindParam(':o3_p100', $o3_p100);
        $stmt->bindParam(':o4_p0', $o4_p0);
        $stmt->bindParam(':o4_p25', $o4_p25);
        $stmt->bindParam(':o4_p50', $o4_p50);
        $stmt->bindParam(':o4_p75', $o4_p75);
        $stmt->bindParam(':o4_p100', $o4_p100);
        $stmt->bindParam(':o5_p0', $o5_p0);
        $stmt->bindParam(':o5_p25', $o5_p25);
        $stmt->bindParam(':o5_p50', $o5_p50);
        $stmt->bindParam(':o5_p75', $o5_p75);
        $stmt->bindParam(':o5_p100', $o5_p100);
        $stmt->bindParam(':s1_p0', $s1_p0);
        $stmt->bindParam(':s1_p25', $s1_p25);
        $stmt->bindParam(':s1_p50', $s1_p50);
        $stmt->bindParam(':s1_p75', $s1_p75);
        $stmt->bindParam(':s1_p100', $s1_p100);
        $stmt->bindParam(':s2_p0', $s2_p0);
        $stmt->bindParam(':s2_p25', $s2_p25);
        $stmt->bindParam(':s2_p50', $s2_p50);
        $stmt->bindParam(':s2_p75', $s2_p75);
        $stmt->bindParam(':s2_p100', $s2_p100);
        $stmt->bindParam(':s3_p0', $s3_p0);
        $stmt->bindParam(':s3_p25', $s3_p25);
        $stmt->bindParam(':s3_p50', $s3_p50);
        $stmt->bindParam(':s3_p75', $s3_p75);
        $stmt->bindParam(':s3_p100', $s3_p100);
        $stmt->bindParam(':s4_p0', $s4_p0);
        $stmt->bindParam(':s4_p25', $s4_p25);
        $stmt->bindParam(':s4_p50', $s4_p50);
        $stmt->bindParam(':s4_p75', $s4_p75);
        $stmt->bindParam(':s4_p100', $s4_p100);
        $stmt->bindParam(':percentile_id', $id_percentile);

        // ดำเนินการ statement พร้อมกับ parameter
        $stmt->execute();

        echo json_encode("Edit Success");
    } catch (PDOException $e) {
        echo json_encode("Error: " . $e->getMessage());
    }
}
