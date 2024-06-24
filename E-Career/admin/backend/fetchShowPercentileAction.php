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
                <h1 class="modal-title fs-5" id="showPercentileModalLabel">แสดงเกณฑ์ของ Percentile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-12">
                        <p>Name: </p>
                        <input type="text" class="form-control" autocomplete="off" value="<?php echo $row['percentile_name'] ?>" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <p>Edit By: </p>
                        <input type="text" class="form-control" value="<?php echo $row['edit_by_name'] ?>" disabled>
                    </div>
                    <div class="col-6">
                        <p>PDF File (ไฟล์ล่าสุด): <?php echo $row['percentile_pdf_file_name'] ?></p>
                        <input type="file" class="form-control" accept=".pdf" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <p>Edit Date: </p>
                        <input type="date" class="form-control" value="<?php echo $row['edit_date'] ?>" disabled>
                    </div>
                    <div class="col-6">
                        <p>Active Date: </p>
                        <input type="date" class="form-control" value="<?php echo $row['active_date'] ?>" disabled>
                    </div>
                </div>
                <div class="row">
                    <form>
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
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['s4_p0'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['s4_p25'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['s4_p50'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['s4_p75'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['s4_p100'], 0, '.', ','); ?>" disabled></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">S3 (บ.3)</th>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['s3_p0'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['s3_p25'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['s3_p50'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['s3_p75'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['s3_p100'], 0, '.', ','); ?>" disabled></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">S2 (บ.2)</th>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['s2_p0'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['s2_p25'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['s2_p50'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['s2_p75'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['s2_p100'], 0, '.', ','); ?>" disabled></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">S1 (บ.1)</th>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['s1_p0'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['s1_p25'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['s1_p50'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['s1_p75'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['s1_p100'], 0, '.', ','); ?>" disabled></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">O5 (ป.5)</th>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['o5_p0'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['o5_p25'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['o5_p50'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['o5_p75'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['o5_p100'], 0, '.', ','); ?>" disabled></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">O4 (ป.4)</th>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['o4_p0'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['o4_p25'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['o4_p50'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['o4_p75'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['o4_p100'], 0, '.', ','); ?>" disabled></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">O3 (ป.3)</th>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['o3_p0'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['o3_p25'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['o3_p50'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['o3_p75'], 0, '.', ','); ?>" disabled></td>
                                    <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['o3_p100'], 0, '.', ','); ?>" disabled></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
<?php }
} ?>