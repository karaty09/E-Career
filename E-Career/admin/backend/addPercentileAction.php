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

    // ตั้งค่าประเภทไฟล์ที่อนุญาต
    $allowedFileTypes = array('pdf');

    // รับข้อมูลไฟล์ที่อัปโหลด
    $percentile_pdf_file_fileName = $_FILES['percentile_pdf_file']['name'];
    $percentile_pdf_file_fileTmpName = $_FILES['percentile_pdf_file']['tmp_name'];

    // แยกนามสกุลไฟล์
    $percentile_pdf_file_fileExtension = pathinfo($percentile_pdf_file_fileName, PATHINFO_EXTENSION);

    // ตรวจสอบประเภทไฟล์
    if (in_array($percentile_pdf_file_fileExtension, $allowedFileTypes)) {
        $percentile_pdf_file_targetDir = "../../assets/filedata/percentile_pdf/";
        $percentile_pdf_file_targetFilePath = $percentile_pdf_file_targetDir . $percentile_pdf_file_fileName;

        // ย้ายไฟล์ที่อัปโหลดไปยังตำแหน่งที่ต้องการ
        if (move_uploaded_file($percentile_pdf_file_fileTmpName, $percentile_pdf_file_targetFilePath)) {
            echo json_encode("ไฟล์อัปโหลดสำเร็จ", JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode("เกิดข้อผิดพลาดในการอัปโหลดไฟล์", JSON_UNESCAPED_UNICODE);
        }
    } else {
        echo json_encode("ประเภทไฟล์ไม่ได้รับอนุญาต", JSON_UNESCAPED_UNICODE);
    }

    // SQL query
    $sql = "INSERT INTO tb_percentile 
            (percentile_name, percentile_pdf_file_name, edit_by_name, edit_date, active_date, 
            o3_p0, o3_p25, o3_p50, o3_p75, o3_p100, o4_p0, o4_p25, o4_p50, o4_p75, o4_p100,
            o5_p0, o5_p25, o5_p50, o5_p75, o5_p100, s1_p0, s1_p25, s1_p50, s1_p75, s1_p100,
            s2_p0, s2_p25, s2_p50, s2_p75, s2_p100, s3_p0, s3_p25, s3_p50, s3_p75, s3_p100,
            s4_p0, s4_p25, s4_p50, s4_p75, s4_p100) VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // เตรียม statement
    $stmt = $db->prepare($sql);

    // ข้อมูลที่จะใช้ใน query
    $params = array(
        $name_percentile, $percentile_pdf_file_fileName, $edit_by, $edit_date, $active_date, 
        $o3_p0, $o3_p25, $o3_p50, $o3_p75, $o3_p100,
        $o4_p0, $o4_p25, $o4_p50, $o4_p75, $o4_p100,
        $o5_p0, $o5_p25, $o5_p50, $o5_p75, $o5_p100,
        $s1_p0, $s1_p25, $s1_p50, $s1_p75, $s1_p100,
        $s2_p0, $s2_p25, $s2_p50, $s2_p75, $s2_p100,
        $s3_p0, $s3_p25, $s3_p50, $s3_p75, $s3_p100,
        $s4_p0, $s4_p25, $s4_p50, $s4_p75, $s4_p100
    );

    // ดำเนินการ statement พร้อมกับ parameter
    $stmt->execute($params);
}
