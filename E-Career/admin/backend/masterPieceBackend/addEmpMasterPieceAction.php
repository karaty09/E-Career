<?php
require_once '../../../db/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emp_id = $_POST['addEmpMasterPieceID'];
    $p_id = $_POST['addEmpMasterPiecePID'];
    $master_piece_check = $_POST['addEmpMasterPieceCheck'];
    $master_piece_active_date = $_POST['addEmpMasterPieceActiveDate'];
    $master_piece_drop_cause = null;

    // ตั้งค่าประเภทไฟล์ที่อนุญาต
    $allowedFileTypes = array('pdf');

    // รับข้อมูลไฟล์ที่อัปโหลด
    $master_piece_file_fileName = $_FILES['addEmpMasterPieceFile']['name'] ?? null;
    $master_piece_file_fileTmpName = $_FILES['addEmpMasterPieceFile']['tmp_name'] ?? null;

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
        $countMasterPiece = $db->prepare("SELECT COUNT(p_id) as num_PID FROM tb_evaluate_employee WHERE p_id = :p_id");
        $countMasterPiece->bindParam(':p_id', $p_id);
        $countMasterPiece->execute();
        $countRow = $countMasterPiece->fetch(PDO::FETCH_ASSOC);

        $checkMasterPiece = $db->prepare("SELECT * FROM tb_evaluate_employee WHERE p_id = :p_id");
        $checkMasterPiece->bindParam(':p_id', $p_id);
        $checkMasterPiece->execute();
        $row = $checkMasterPiece->fetch(PDO::FETCH_ASSOC);

        if ($countRow['num_PID'] == 1 && $row['master_piece'] == 'true') {
            $emp_id_check = "";
            $master_piece_drop_cause_check = "";
            $MasterPiece_Query = "INSERT INTO tb_evaluate_employee (p_id, p_code, emp_code, name_prefix_th, firstname_th, lastname_th, position_id, 
            position_name_th, pl_superset_th, pl_subset_th, pl_subset_eng, pl_superset_eng, org_id, section_name, sub_department_name, department_name, 
            division_name, company_name, sub11_business_unit, sub1_business_unit, business_unit_description, position_name_eng, cost_center_payment, 
            cost_center_org, emp_type, birthdate, scg_hiring_date, position_entry_date, pl_year, pl_month, age_year, age_month, service_year, service_month, 
            esy, oesy, oesm, salary, review_rating_past1y, review_rating_past2y, review_rating_past3y, review_rating_past4y, review_rating_past5y, hp_review_current, 
            hp_review_rating_current, hp_description_current, hp_review_past1y, hp_review_rating_past1y, hp_description_past1y, hp_review_past2y, hp_review_rating_past2y, 
            hp_description_past2y, hp_review_past3y, hp_review_rating_past3y, hp_description_past3y, hp_review_past4y, hp_review_rating_past4y, hp_description_past4y, 
            hp_review_past5y, hp_review_rating_past5y, hp_description_past5y, percentile_range, master_piece, master_piece_active_date, master_piece_file) 
            VALUES (:p_id, :p_code, :emp_code, :name_prefix_th, :firstname_th, :lastname_th, :position_id, :position_name_th, :pl_superset_th, :pl_subset_th, 
            :pl_subset_eng, :pl_superset_eng, :org_id, :section_name, :sub_department_name, :department_name, :division_name, :company_name, :sub11_business_unit, 
            :sub1_business_unit, :business_unit_description, :position_name_eng, :cost_center_payment, :cost_center_org, :emp_type, :birthdate, :scg_hiring_date, 
            :position_entry_date, :pl_year, :pl_month, :age_year, :age_month, :service_year, :service_month, :esy, :oesy, :oesm, :salary, :review_rating_past1y, 
            :review_rating_past2y, :review_rating_past3y, :review_rating_past4y, :review_rating_past5y, :hp_review_current, :hp_review_rating_current, 
            :hp_description_current, :hp_review_past1y, :hp_review_rating_past1y, :hp_description_past1y, :hp_review_past2y, :hp_review_rating_past2y, 
            :hp_description_past2y, :hp_review_past3y, :hp_review_rating_past3y, :hp_description_past3y, :hp_review_past4y, :hp_review_rating_past4y, 
            :hp_description_past4y, :hp_review_past5y, :hp_review_rating_past5y, :hp_description_past5y, :percentile_range, :master_piece, :master_piece_active_date, 
            :master_piece_file)";
        } else if ($countRow['num_PID'] == 1 && ($row['master_piece'] == 'false' || $row['master_piece'] == null)) {
            $emp_id_check = "";
            $master_piece_drop_cause_check = "Have";
            $MasterPiece_Query = "UPDATE tb_evaluate_employee SET p_code = :p_code, emp_code = :emp_code, name_prefix_th = :name_prefix_th, 
            firstname_th = :firstname_th, lastname_th = :lastname_th, position_id = :position_id, position_name_th = :position_name_th, pl_superset_th = :pl_superset_th,
            pl_subset_th = :pl_subset_th, pl_subset_eng = :pl_subset_eng, pl_superset_eng = :pl_superset_eng, org_id = :org_id, section_name = :section_name,
            sub_department_name = :sub_department_name, department_name = :department_name, division_name = :division_name, company_name = :company_name,
            sub11_business_unit = :sub11_business_unit, sub1_business_unit = :sub1_business_unit, business_unit_description = :business_unit_description,
            position_name_eng = :position_name_eng, cost_center_payment = :cost_center_payment, cost_center_org = :cost_center_org, emp_type = :emp_type,
            birthdate = :birthdate, scg_hiring_date = :scg_hiring_date, position_entry_date = :position_entry_date, pl_year = :pl_year, pl_month = :pl_month,
            age_year = :age_year, age_month = :age_month, service_year = :service_year, service_month = :service_month, esy = :esy, oesy = :oesy, oesm = :oesm,
            salary = :salary, review_rating_past1y = :review_rating_past1y, review_rating_past2y = :review_rating_past2y, review_rating_past3y = :review_rating_past3y,
            review_rating_past4y = :review_rating_past4y, review_rating_past5y = :review_rating_past5y, hp_review_current = :hp_review_current,
            hp_review_rating_current = :hp_review_rating_current, hp_description_current = :hp_description_current, hp_review_past1y = :hp_review_past1y,
            hp_review_rating_past1y = :hp_review_rating_past1y, hp_description_past1y = :hp_description_past1y, hp_review_past2y = :hp_review_past2y,
            hp_review_rating_past2y = :hp_review_rating_past2y, hp_description_past2y = :hp_description_past2y, hp_review_past3y = :hp_review_past3y,
            hp_review_rating_past3y = :hp_review_rating_past3y, hp_description_past3y = :hp_description_past3y, hp_review_past4y = :hp_review_past4y,
            hp_review_rating_past4y = :hp_review_rating_past4y, hp_description_past4y = :hp_description_past4y, hp_review_past5y = :hp_review_past5y,
            hp_review_rating_past5y = :hp_review_rating_past5y, hp_description_past5y = :hp_description_past5y, percentile_range = :percentile_range,
            master_piece = :master_piece, master_piece_active_date = :master_piece_active_date, master_piece_file = :master_piece_file, master_piece_drop_cause = :master_piece_drop_cause 
            WHERE p_id = :p_id";
        } else if ($countRow['num_PID'] >= 2 && $row['master_piece'] == 'false') {
            $emp_id_check = "Have";
            $master_piece_drop_cause_check = "Have";
            $MasterPiece_Query = "UPDATE tb_evaluate_employee SET p_id = :p_id, p_code = :p_code, emp_code = :emp_code, name_prefix_th = :name_prefix_th, 
            firstname_th = :firstname_th, lastname_th = :lastname_th, position_id = :position_id, position_name_th = :position_name_th, pl_superset_th = :pl_superset_th,
            pl_subset_th = :pl_subset_th, pl_subset_eng = :pl_subset_eng, pl_superset_eng = :pl_superset_eng, org_id = :org_id, section_name = :section_name,
            sub_department_name = :sub_department_name, department_name = :department_name, division_name = :division_name, company_name = :company_name,
            sub11_business_unit = :sub11_business_unit, sub1_business_unit = :sub1_business_unit, business_unit_description = :business_unit_description,
            position_name_eng = :position_name_eng, cost_center_payment = :cost_center_payment, cost_center_org = :cost_center_org, emp_type = :emp_type,
            birthdate = :birthdate, scg_hiring_date = :scg_hiring_date, position_entry_date = :position_entry_date, pl_year = :pl_year, pl_month = :pl_month,
            age_year = :age_year, age_month = :age_month, service_year = :service_year, service_month = :service_month, esy = :esy, oesy = :oesy, oesm = :oesm,
            salary = :salary, review_rating_past1y = :review_rating_past1y, review_rating_past2y = :review_rating_past2y, review_rating_past3y = :review_rating_past3y,
            review_rating_past4y = :review_rating_past4y, review_rating_past5y = :review_rating_past5y, hp_review_current = :hp_review_current,
            hp_review_rating_current = :hp_review_rating_current, hp_description_current = :hp_description_current, hp_review_past1y = :hp_review_past1y,
            hp_review_rating_past1y = :hp_review_rating_past1y, hp_description_past1y = :hp_description_past1y, hp_review_past2y = :hp_review_past2y,
            hp_review_rating_past2y = :hp_review_rating_past2y, hp_description_past2y = :hp_description_past2y, hp_review_past3y = :hp_review_past3y,
            hp_review_rating_past3y = :hp_review_rating_past3y, hp_description_past3y = :hp_description_past3y, hp_review_past4y = :hp_review_past4y,
            hp_review_rating_past4y = :hp_review_rating_past4y, hp_description_past4y = :hp_description_past4y, hp_review_past5y = :hp_review_past5y,
            hp_review_rating_past5y = :hp_review_rating_past5y, hp_description_past5y = :hp_description_past5y, percentile_range = :percentile_range,
            master_piece = :master_piece, master_piece_active_date = :master_piece_active_date, master_piece_file = :master_piece_file, master_piece_drop_cause = :master_piece_drop_cause
            WHERE emp_id = :emp_id";
        } else if ($countRow['num_PID'] >= 2 && $row['master_piece'] == 'true') {
            $emp_id_check = "";
            $master_piece_drop_cause_check = "Have";
            $MasterPiece_Query = "INSERT INTO tb_evaluate_employee (p_id, p_code, emp_code, name_prefix_th, firstname_th, lastname_th, position_id, 
            position_name_th, pl_superset_th, pl_subset_th, pl_subset_eng, pl_superset_eng, org_id, section_name, sub_department_name, department_name, 
            division_name, company_name, sub11_business_unit, sub1_business_unit, business_unit_description, position_name_eng, cost_center_payment, 
            cost_center_org, emp_type, birthdate, scg_hiring_date, position_entry_date, pl_year, pl_month, age_year, age_month, service_year, service_month, 
            esy, oesy, oesm, salary, review_rating_past1y, review_rating_past2y, review_rating_past3y, review_rating_past4y, review_rating_past5y, hp_review_current, 
            hp_review_rating_current, hp_description_current, hp_review_past1y, hp_review_rating_past1y, hp_description_past1y, hp_review_past2y, hp_review_rating_past2y, 
            hp_description_past2y, hp_review_past3y, hp_review_rating_past3y, hp_description_past3y, hp_review_past4y, hp_review_rating_past4y, hp_description_past4y, 
            hp_review_past5y, hp_review_rating_past5y, hp_description_past5y, percentile_range, master_piece, master_piece_active_date, master_piece_file, master_piece_drop_cause) 
            VALUES (:p_id, :p_code, :emp_code, :name_prefix_th, :firstname_th, :lastname_th, :position_id, :position_name_th, :pl_superset_th, :pl_subset_th, 
            :pl_subset_eng, :pl_superset_eng, :org_id, :section_name, :sub_department_name, :department_name, :division_name, :company_name, :sub11_business_unit, 
            :sub1_business_unit, :business_unit_description, :position_name_eng, :cost_center_payment, :cost_center_org, :emp_type, :birthdate, :scg_hiring_date, 
            :position_entry_date, :pl_year, :pl_month, :age_year, :age_month, :service_year, :service_month, :esy, :oesy, :oesm, :salary, :review_rating_past1y, 
            :review_rating_past2y, :review_rating_past3y, :review_rating_past4y, :review_rating_past5y, :hp_review_current, :hp_review_rating_current, 
            :hp_description_current, :hp_review_past1y, :hp_review_rating_past1y, :hp_description_past1y, :hp_review_past2y, :hp_review_rating_past2y, 
            :hp_description_past2y, :hp_review_past3y, :hp_review_rating_past3y, :hp_description_past3y, :hp_review_past4y, :hp_review_rating_past4y, 
            :hp_description_past4y, :hp_review_past5y, :hp_review_rating_past5y, :hp_description_past5y, :percentile_range, :master_piece, :master_piece_active_date, 
            :master_piece_file, :master_piece_drop_cause)";
        }

        $MasterPieceAction = $db->prepare($MasterPiece_Query);

        if ($emp_id_check == "Have") {
            $MasterPieceAction->bindParam(':emp_id', $emp_id);
        }

        if ($master_piece_drop_cause_check == "Have") {
            $MasterPieceAction->bindParam(':master_piece_drop_cause', $master_piece_drop_cause);
        }

        $MasterPieceAction->bindParam(':p_id', $p_id);
        $MasterPieceAction->bindParam(':p_code', $row['p_code']);
        $MasterPieceAction->bindParam(':emp_code', $row['emp_code']);
        $MasterPieceAction->bindParam(':name_prefix_th', $row['name_prefix_th']);
        $MasterPieceAction->bindParam(':firstname_th', $row['firstname_th']);
        $MasterPieceAction->bindParam(':lastname_th', $row['lastname_th']);
        $MasterPieceAction->bindParam(':position_id', $row['position_id']);
        $MasterPieceAction->bindParam(':position_name_th', $row['position_name_th']);
        $MasterPieceAction->bindParam(':pl_superset_th', $row['pl_superset_th']);
        $MasterPieceAction->bindParam(':pl_subset_th', $row['pl_subset_th']);
        $MasterPieceAction->bindParam(':pl_subset_eng', $row['pl_subset_eng']);
        $MasterPieceAction->bindParam(':pl_superset_eng', $row['pl_superset_eng']);
        $MasterPieceAction->bindParam(':org_id', $row['org_id']);
        $MasterPieceAction->bindParam(':section_name', $row['section_name']);
        $MasterPieceAction->bindParam(':sub_department_name', $row['sub_department_name']);
        $MasterPieceAction->bindParam(':department_name', $row['department_name']);
        $MasterPieceAction->bindParam(':division_name', $row['division_name']);
        $MasterPieceAction->bindParam(':company_name', $row['company_name']);
        $MasterPieceAction->bindParam(':sub11_business_unit', $row['sub11_business_unit']);
        $MasterPieceAction->bindParam(':sub1_business_unit', $row['sub1_business_unit']);
        $MasterPieceAction->bindParam(':business_unit_description', $row['business_unit_description']);
        $MasterPieceAction->bindParam(':position_name_eng', $row['position_name_eng']);
        $MasterPieceAction->bindParam(':cost_center_payment', $row['cost_center_payment']);
        $MasterPieceAction->bindParam(':cost_center_org', $row['cost_center_org']);
        $MasterPieceAction->bindParam(':emp_type', $row['emp_type']);
        $MasterPieceAction->bindParam(':birthdate', $row['birthdate']);
        $MasterPieceAction->bindParam(':scg_hiring_date', $row['scg_hiring_date']);
        $MasterPieceAction->bindParam(':position_entry_date', $row['position_entry_date']);
        $MasterPieceAction->bindParam(':pl_year', $row['pl_year']);
        $MasterPieceAction->bindParam(':pl_month', $row['pl_month']);
        $MasterPieceAction->bindParam(':age_year', $row['age_year']);
        $MasterPieceAction->bindParam(':age_month', $row['age_month']);
        $MasterPieceAction->bindParam(':service_year', $row['service_year']);
        $MasterPieceAction->bindParam(':service_month', $row['service_month']);
        $MasterPieceAction->bindParam(':esy', $row['esy']);
        $MasterPieceAction->bindParam(':oesy', $row['oesy']);
        $MasterPieceAction->bindParam(':oesm', $row['oesm']);
        $MasterPieceAction->bindParam(':salary', $row['salary']);
        $MasterPieceAction->bindParam(':review_rating_past1y', $row['review_rating_past1y']);
        $MasterPieceAction->bindParam(':review_rating_past2y', $row['review_rating_past2y']);
        $MasterPieceAction->bindParam(':review_rating_past3y', $row['review_rating_past3y']);
        $MasterPieceAction->bindParam(':review_rating_past4y', $row['review_rating_past4y']);
        $MasterPieceAction->bindParam(':review_rating_past5y', $row['review_rating_past5y']);
        $MasterPieceAction->bindParam(':hp_review_current', $row['hp_review_current']);
        $MasterPieceAction->bindParam(':hp_review_rating_current', $row['hp_review_rating_current']);
        $MasterPieceAction->bindParam(':hp_description_current', $row['hp_description_current']);
        $MasterPieceAction->bindParam(':hp_review_past1y', $row['hp_review_past1y']);
        $MasterPieceAction->bindParam(':hp_review_rating_past1y', $row['hp_review_rating_past1y']);
        $MasterPieceAction->bindParam(':hp_description_past1y', $row['hp_description_past1y']);
        $MasterPieceAction->bindParam(':hp_review_past2y', $row['hp_review_past2y']);
        $MasterPieceAction->bindParam(':hp_review_rating_past2y', $row['hp_review_rating_past2y']);
        $MasterPieceAction->bindParam(':hp_description_past2y', $row['hp_description_past2y']);
        $MasterPieceAction->bindParam(':hp_review_past3y', $row['hp_review_past3y']);
        $MasterPieceAction->bindParam(':hp_review_rating_past3y', $row['hp_review_rating_past3y']);
        $MasterPieceAction->bindParam(':hp_description_past3y', $row['hp_description_past3y']);
        $MasterPieceAction->bindParam(':hp_review_past4y', $row['hp_review_past4y']);
        $MasterPieceAction->bindParam(':hp_review_rating_past4y', $row['hp_review_rating_past4y']);
        $MasterPieceAction->bindParam(':hp_description_past4y', $row['hp_description_past4y']);
        $MasterPieceAction->bindParam(':hp_review_past5y', $row['hp_review_past5y']);
        $MasterPieceAction->bindParam(':hp_review_rating_past5y', $row['hp_review_rating_past5y']);
        $MasterPieceAction->bindParam(':hp_description_past5y', $row['hp_description_past5y']);
        $MasterPieceAction->bindParam(':percentile_range', $row['percentile_range']);
        $MasterPieceAction->bindParam(':master_piece', $master_piece_check);
        $MasterPieceAction->bindParam(':master_piece_active_date', $master_piece_active_date);
        $MasterPieceAction->bindParam(':master_piece_file', $master_piece_file_fileName);
        $MasterPieceAction->execute();

        echo json_encode("Add Success");
    } catch (PDOException $e) {
        echo json_encode("Error: " . $e->getMessage());
    }
}
