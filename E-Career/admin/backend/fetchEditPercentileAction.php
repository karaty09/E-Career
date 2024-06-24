<?php
require '../../db/connect.php';

// ดึงข้อมูลจากฐานข้อมูล
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = $db->prepare('SELECT * FROM tb_percentile WHERE percentile_id = ?');
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
?>
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editPercentileModalLabel">แก้ไขเกณฑ์ของ Percentile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editPercentile_id_percentile" value="<?php echo $row['percentile_id'] ?>">
                <div class="row mb-3">
                    <div class="col-12">
                        <p>Name: </p>
                        <input type="text" class="form-control" id="editPercentile_name_percentile" autocomplete="off" value="<?php echo $row['percentile_name'] ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <p>Edit By: </p>
                        <input type="text" class="form-control" id="editPercentile_edit_by" value="<?php echo $row['edit_by_name'] ?>" disabled>
                    </div>
                    <div class="col-6">
                        <p>PDF File (ไฟล์ล่าสุด): <?php echo $row['percentile_pdf_file_name'] ?></p>
                        <input type="file" class="form-control" accept=".pdf" id="editPercentile_percentile_pdf_file">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <p>Edit Date: </p>
                        <input type="date" class="form-control" id="editPercentile_edit_date" value="<?php echo $row['edit_date'] ?>" disabled>
                    </div>
                    <div class="col-6">
                        <p>Active Date: </p>
                        <input type="date" class="form-control" id="editPercentile_active_date" value="<?php echo $row['active_date'] ?>">
                    </div>
                </div>
                <div class="row">
                    <table class="table table-bordered">
                        <thead class="table-danger">
                            <tr>
                                <th scope="col" class="size-col-table text-center">SCG PL</th>
                                <th scope="col" class="size-col-table text-center">P0 (Min)</th>
                                <th scope="col" class="size-col-table text-center">P25</th>
                                <th scope="col" class="size-col-table text-center">P50 (MP)</th>
                                <th scope="col" class="size-col-table text-center">P75</th>
                                <th scope="col" class="size-col-table text-center">P100 (Max)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="text-center">S4 (บ.4)</th>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['s4_p0'] ?>" id="editPercentile_s4_p0"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['s4_p25'] ?>" id="editPercentile_s4_p25"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['s4_p50'] ?>" id="editPercentile_s4_p50"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['s4_p75'] ?>" id="editPercentile_s4_p75"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['s4_p100'] ?>" id="editPercentile_s4_p100"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center">S3 (บ.3)</th>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['s3_p0'] ?>" id="editPercentile_s3_p0"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['s3_p25'] ?>" id="editPercentile_s3_p25"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['s3_p50'] ?>" id="editPercentile_s3_p50"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['s3_p75'] ?>" id="editPercentile_s3_p75"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['s3_p100'] ?>" id="editPercentile_s3_p100"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center">S2 (บ.2)</th>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['s2_p0'] ?>" id="editPercentile_s2_p0"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['s2_p25'] ?>" id="editPercentile_s2_p25"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['s2_p50'] ?>" id="editPercentile_s2_p50"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['s2_p75'] ?>" id="editPercentile_s2_p75"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['s2_p100'] ?>" id="editPercentile_s2_p100"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center">S1 (บ.1)</th>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['s1_p0'] ?>" id="editPercentile_s1_p0"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['s1_p25'] ?>" id="editPercentile_s1_p25"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['s1_p50'] ?>" id="editPercentile_s1_p50"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['s1_p75'] ?>" id="editPercentile_s1_p75"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['s1_p100'] ?>" id="editPercentile_s1_p100"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center">O5 (ป.5)</th>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['o5_p0'] ?>" id="editPercentile_o5_p0"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['o5_p25'] ?>" id="editPercentile_o5_p25"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['o5_p50'] ?>" id="editPercentile_o5_p50"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['o5_p75'] ?>" id="editPercentile_o5_p75"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['o5_p100'] ?>" id="editPercentile_o5_p100"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center">O4 (ป.4)</th>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['o4_p0'] ?>" id="editPercentile_o4_p0"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['o4_p25'] ?>" id="editPercentile_o4_p25"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['o4_p50'] ?>" id="editPercentile_o4_p50"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['o4_p75'] ?>" id="editPercentile_o4_p75"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['o4_p100'] ?>" id="editPercentile_o4_p100"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center">O3 (ป.3)</th>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['o3_p0'] ?>" id="editPercentile_o3_p0"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['o3_p25'] ?>" id="editPercentile_o3_p25"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['o3_p50'] ?>" id="editPercentile_o3_p50"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['o3_p75'] ?>" id="editPercentile_o3_p75"></td>
                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo $row['o3_p100'] ?>" id="editPercentile_o3_p100"></td>
                            </tr>
                        </tbody>
                    </table>
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