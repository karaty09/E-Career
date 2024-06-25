<?php
require '../../db/connect.php';

// ดึงข้อมูลจากฐานข้อมูล
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = $db->prepare('SELECT * FROM tb_evaluate_employee WHERE emp_id = ?');
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
?>
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editEmployeeModalLabel">แก้ไขกำหนดเงื่อนไข Master Peace</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editEmployee_id_employee" value="<?php echo $row['emp_id'] ?>">
                <div class="row mb-3">
                    <div class="col-md-6 col-12">
                        <p>Name: </p>
                        <input type="text" class="form-control" value="<?php echo $row['firstname_th'] . " " . $row['lastname_th'] ?>" disabled>
                    </div>
                    <div class="col-md-6 col-12">
                        <p>Position: </p>
                        <input type="text" class="form-control" value="<?php echo $row['position_name_th'] ?>" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 col-12">
                        <p>Section: </p>
                        <input type="text" class="form-control" value="<?php echo $row['section_name'] ?>" disabled>
                    </div>
                    <div class="col-md-6 col-12">
                        <p>Department: </p>
                        <input type="text" class="form-control" value="<?php echo $row['department_name'] ?>" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 col-12">
                        <p>Division: </p>
                        <input type="text" class="form-control" value="<?php echo $row['division_name'] ?>" disabled>
                    </div>
                    <div class="col-md-6 col-12">
                        <p>Company: </p>
                        <input type="text" class="form-control" value="<?php echo $row['company_name'] ?>" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 col-12">
                        <p>PL Level: </p>
                        <input type="text" class="form-control" value="<?php echo $row['pl_subset_eng'] ?>" disabled>
                    </div>
                    <div class="col-md-3 col-12">
                        <p>EMP Type: </p>
                        <input type="text" class="form-control" value="<?php echo $row['emp_type'] ?>" disabled>
                    </div>
                    <div class="col-md-3 col-12">
                        <p>Salary (Baht): </p>
                        <input type="text" class="form-control" value="<?php echo number_format($row['salary']) ?>" disabled>
                    </div>
                    <div class="col-md-3 col-12">
                        <p>Percentile Range: </p>
                        <input type="text" class="form-control" value="<?php echo $row['percentile_range'] ?>" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 col-12">
                        <p>Master Piece Select: </p>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="master_piece_check" <?php echo $row['master_piece'] == 1 ? 'checked' : ''; ?> onchange="enabledInputFiles(this)">
                            <label class="form-check-label" for="master_piece_check">
                                Master Piece
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <p>Master Piece File (ไฟล์ล่าสุด): <?php echo $row['master_piece_file'] ?></p>
                        <input type="file" class="form-control" id="editEmployee_master_piece_file" accept=".pdf" disabled>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="save" id="save">Save</button>
            </div>
        </div>
<?php
    }
}
?>