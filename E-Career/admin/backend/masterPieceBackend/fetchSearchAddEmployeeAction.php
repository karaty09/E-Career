<?php
require '../../../db/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $fname_lname = explode(" ", $name);
    $sql = "SELECT * FROM tb_evaluate_employee WHERE firstname_th = :firstname_th AND lastname_th = :lastname_th";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':firstname_th', $fname_lname[0]);
    $stmt->bindParam(':lastname_th', $fname_lname[1]);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
?>
    <hr>
    <input type="hidden" id="addEmpMasterPieceID" value="<?php echo $row['emp_id'] ?>">
    <input type="hidden" id="addEmpMasterPiecePID" value="<?php echo $row['p_id'] ?>">
    <h6 class="fw-bold">ข้อมูลเบื้องต้น</h6>
    <div class="row mb-3">
        <div class="col-md-4 col-12">
            <p>Name: </p>
            <input type="text" class="form-control" id="addEmpMasterPieceName" value="<?php echo $row['firstname_th'] . " " . $row['lastname_th'] ?>" disabled>
        </div>
        <div class="col-md-4 col-12">
            <p>Position: </p>
            <input type="text" class="form-control" id="addEmpMasterPiecePosition" value="<?php echo $row['position_name_th'] ?>" disabled>
        </div>
        <div class="col-md-4 col-12">
            <p>Section: </p>
            <input type="text" class="form-control" id="addEmpMasterPieceSection" value="<?php echo $row['section_name'] ?>" disabled>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4 col-12">
            <p>Department: </p>
            <input type="text" class="form-control" id="addEmpMasterPieceDepartment" value="<?php echo $row['department_name'] ?>" disabled>
        </div>
        <div class="col-md-4 col-12">
            <p>Division: </p>
            <input type="text" class="form-control" id="addEmpMasterPieceDivision" value="<?php echo $row['division_name'] ?>" disabled>
        </div>
        <div class="col-md-4 col-12">
            <p>Company: </p>
            <input type="text" class="form-control" id="addEmpMasterPieceCompany" value="<?php echo $row['company_name'] ?>" disabled>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4 col-12">
            <p>PL Level: </p>
            <input type="text" class="form-control" id="addEmpMasterPiecePLLevel" value="<?php echo $row['pl_subset_eng'] ?>" disabled>
        </div>
        <div class="col-md-4 col-12">
            <p>EMP Type: </p>
            <input type="text" class="form-control" id="addEmpMasterPieceEmpType" value="<?php echo $row['emp_type'] ?>" disabled>
        </div>
    </div>
    <hr>
    <h6 class="fw-bold">กำหนด Master Piece</h6>
    <div class="row mb-3">
        <div class="col-md-2 col-12">
            <p>Master Piece Select: </p>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="addEmpMasterPieceCheck">
                <label class="form-check-label" for="master_piece_check">
                    Master Piece
                </label>
            </div>
        </div>
        <div class="col-md-3 col-12">
            <p>Master Piece Active Date: </p>
            <input type="date" class="form-control" id="addEmpMasterPieceActiveDate">
        </div>
        <div class="col-md-7 col-12">
            <p>Master Piece File (ไฟล์ล่าสุด): </p>
            <input type="file" class="form-control" id="addEmpMasterPieceFile" accept=".pdf">
        </div>
    </div>
<?php
}}
?>