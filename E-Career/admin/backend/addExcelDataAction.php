<?php
require_once '../connect.php';

try {
    // Get the raw POST data
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if ($data === null) {
        throw new Exception("Invalid JSON data");
    }

    // Begin a transaction
    $db->beginTransaction();

    // Table name
    $tableName = 'tb_employee';

    // Prepare the SQL statements for insert and update
    $columns = array_keys($data[0]);
    $columnList = implode(", ", $columns);
    $placeholders = implode(", ", array_fill(0, count($columns), "?"));

    $insertSQL = "INSERT INTO $tableName ($columnList) VALUES ($placeholders)";
    $updateSQL = "UPDATE $tableName SET p_id = ?, p_code = ?, name_prefix_th = ?, firstname_th = ?, lastname_th = ?, position_id = ?, position_name_th = ?, 
    pl_superset_th = ?, pl_subset_th = ?, pl_subset_eng = ?, pl_superset_eng = ?, org_id = ?, section_name = ?, sub_department_name = ?, department_name = ?, 
    division_name = ?, company_name = ?, sub11_business_unit = ?, sub1_business_unit = ?, business_unit_description = ?, position_name_eng = ?, cost_center_payment = ?, 
    cost_center_org = ?, birthdate = ?, scg_hiring_date = ?, position_entry_date = ?, pl_year = ?, pl_month = ?, age_year = ?, age_month = ?, service_year = ?,
    service_month = ?, esy = ?, oesy = ?, oesm = ?, salary = ?, review_rating_past1y = ?, review_rating_past2y = ?, review_rating_past3y = ?, review_rating_past4y = ?,
    review_rating_past5y = ?, hp_review_rating_past1y = ?, hp_review_rating_past2y = ?, hp_review_rating_past3y = ?, hp_review_rating_past4y = ?, hp_review_rating_past5y = ?,
    eligible = ?, eligible_type = ? WHERE emp_code = ?";

    $insertStmt = $db->prepare($insertSQL);
    $updateStmt = $db->prepare($updateSQL);

    // Execute the appropriate statement for each row
    foreach ($data as $row) {
        // Check if emp_code already exists
        $checkSQL = "SELECT COUNT(*) FROM $tableName WHERE emp_code = ?";
        $checkStmt = $db->prepare($checkSQL);
        $checkStmt->execute([$row['emp_code']]);
        $exists = $checkStmt->fetchColumn();

        if ($exists) {
            // Update existing record
            $updateStmt->execute([
                $row['p_id'], $row['p_code'], $row['name_prefix_th'], $row['firstname_th'], $row['lastname_th'], $row['position_id'], $row['position_name_th'],
                $row['pl_superset_th'], $row['pl_subset_th'], $row['pl_subset_eng'], $row['pl_superset_eng'], $row['org_id'], $row['section_name'], $row['sub_department_name'],
                $row['department_name'], $row['division_name'], $row['company_name'], $row['sub11_business_unit'], $row['sub1_business_unit'], $row['business_unit_description'],
                $row['position_name_eng'], $row['cost_center_payment'], $row['cost_center_org'], $row['birthdate'], $row['scg_hiring_date'], $row['position_entry_date'],
                $row['pl_year'], $row['pl_month'], $row['age_year'], $row['age_month'], $row['service_year'], $row['service_month'], $row['esy'], $row['oesy'], $row['oesm'],
                $row['salary'], $row['review_rating_past1y'], $row['review_rating_past2y'], $row['review_rating_past3y'], $row['review_rating_past4y'], $row['review_rating_past5y'],
                $row['hp_review_rating_past1y'], $row['hp_review_rating_past2y'], $row['hp_review_rating_past3y'], $row['hp_review_rating_past4y'], $row['hp_review_rating_past5y'],
                $row['eligible'], $row['eligible_type'], $row['emp_code']
            ]);
        } else {
            // Insert new record
            $insertStmt->execute(array_values($row));
        }
    }

    // Commit the transaction
    $db->commit();
    echo "Data successfully imported to the database.";

} catch (Exception $e) {
    // Rollback the transaction if something went wrong
    if ($db->inTransaction()) {
        $db->rollBack();
    }
    echo "Failed: " . $e->getMessage();
}
?>

