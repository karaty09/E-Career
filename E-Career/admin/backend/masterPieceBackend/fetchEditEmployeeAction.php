<?php
require '../../../db/connect.php';

// ดึงข้อมูลจากฐานข้อมูล
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = $db->prepare('SELECT * FROM tb_evaluate_employee WHERE emp_id = ?');
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
?>
        <input type="hidden" id="editEmpMasterPieceID" value="<?php echo $row['emp_id'] ?>">
        <input type="hidden" id="editEmpMasterPiecePID" value="<?php echo $row['p_id'] ?>">
        <h6 class="fw-bold">ข้อมูลเบื้องต้น</h6>
        <div class="row mb-3">
            <div class="col-md-4 col-12">
                <p>Name: </p>
                <input type="text" class="form-control" id="editEmpMasterPieceName" value="<?php echo $row['firstname_th'] . " " . $row['lastname_th'] ?>" disabled>
            </div>
            <div class="col-md-4 col-12">
                <p>Position: </p>
                <input type="text" class="form-control" id="editEmpMasterPiecePosition" value="<?php echo $row['position_name_th'] ?>" disabled>
            </div>
            <div class="col-md-4 col-12">
                <p>Section: </p>
                <input type="text" class="form-control" id="editEmpMasterPieceSection" value="<?php echo $row['section_name'] ?>" disabled>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 col-12">
                <p>Department: </p>
                <input type="text" class="form-control" id="editEmpMasterPieceDepartment" value="<?php echo $row['department_name'] ?>" disabled>
            </div>
            <div class="col-md-4 col-12">
                <p>Division: </p>
                <input type="text" class="form-control" id="editEmpMasterPieceDivision" value="<?php echo $row['division_name'] ?>" disabled>
            </div>
            <div class="col-md-4 col-12">
                <p>Company: </p>
                <input type="text" class="form-control" id="editEmpMasterPieceCompany" value="<?php echo $row['company_name'] ?>" disabled>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 col-12">
                <p>PL Level: </p>
                <input type="text" class="form-control" id="editEmpMasterPiecePLLevel" value="<?php echo $row['pl_subset_eng'] ?>" disabled>
            </div>
            <div class="col-md-4 col-12">
                <p>EMP Type: </p>
                <input type="text" class="form-control" id="editEmpMasterPieceEmpType" value="<?php echo $row['emp_type'] ?>" disabled>
            </div>
        </div>
        <hr>
        <h6 class="fw-bold">กำหนด Master Piece</h6>
        <div class="row mb-3">
            <div class="col-md-2 col-12">
                <p>Master Piece Select: </p>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="editEmpMasterPieceCheck" <?php echo $row['master_piece'] == 'true' ? 'checked' : ''; ?> onchange="enabledInputFilesEdit(this)">
                    <label class="form-check-label" for="master_piece_check">
                        Master Piece
                    </label>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <p>Master Piece Active Date: </p>
                <input type="date" class="form-control" id="editEmpMasterPieceActiveDate" value="<?php echo $row['master_piece_active_date'] ?>">
            </div>
            <div class="col-md-7 col-12">
                <p>Master Piece File (ไฟล์ล่าสุด): <?php echo $row['master_piece_file'] == true ? $row['master_piece_file'] : 'ไม่มีไฟล์' ?></p>
                <input type="file" class="form-control" id="editEmpMasterPieceFile" accept=".pdf">
            </div>
        </div>
        <div id="causeMasterPiece" class="row mb-3" hidden>
            <div class="col-md-12 col-12">
                <p>เหตุผลที่ติ๊ก Master Piece ออก: </p>
                <input type="text" class="form-control" id="editMasterPieceDropCause" autocomplete="off" required>
            </div>
        </div>
<?php
    }
}
?>