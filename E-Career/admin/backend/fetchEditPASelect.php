<?php
require '../../db/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pl_level = $_POST['pl_level'];
    $sql = "SELECT * FROM PA_standard WHERE PA_level = :PA_level";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':PA_level', $pl_level);
    $stmt->execute();

    // เตรียม array เพื่อเก็บข้อมูลที่ได้จากฐานข้อมูล
    $pl_level_array = array();

    // วนลูปเข้าถึงข้อมูลทีละแถว
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $pl_level_array[] = $row;
    }

?>
    <div class="row mb-3">
        <div class="col-4">
            <php>วันที่ประชุม : </p>
                <input type="date" name="Meet" id="Meet" class="form-control" value="<?php echo $pl_level_array[0]['Meet'] ?>">
        </div>
        <div class="col-4">
            <p>Active Date :</p>
            <input type="date" name="Active_Date" id="Active_Date" class="form-control" value="<?php echo $pl_level_array[0]['Active_Date'] ?>">
        </div>
        <div class="col-4">
            <p>แนบเอกสารการประชุม (PDF) : <?php echo $pl_level_array[0]['document'] ?></p>
            <input type="file" name="document_file" id="document_file" class="form-control" accept=".pdf">
        </div>
    </div>
    <hr>
    <!-- Normal -->
    <div class="row mb-3">
        <p style="font-size: 30px; font-weight: bold; ">Normal</p>
    </div>
    <div class="row mb-3">
        <div class="col-4">
            <p>ประเมินย้อนหลัง (ปี) : </p>
            <input type="text" name="estimateNormal" id="estimateNormal" class="form-control" value="<?php echo $pl_level_array[0]['estimate'] ?>">
        </div>
        <div class="col-4">
            <p>ESY (ปี) : </p>
            <input type="text" name="ESYNormal" id="ESYNormal" class="form-control" value="<?php echo $pl_level_array[0]['ESY'] ?>">
        </div>
        <div class="col-4">
            <p>TIG (ปี) : </p>
            <input type="text" name="TIGNormal" id="TIGNormal" class="form-control" value="<?php echo $pl_level_array[0]['TIG'] ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <p>คุณสมบัติ : </p>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="" id="PotentialNormal" <?php echo $pl_level_array[0]['P'] == 1 ? 'checked' : ''; ?>>
                <label class="form-check-label" for="Potential">
                    Potential
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="" id="High_potentialNormal" <?php echo $pl_level_array[0]['HP'] == 1 ? 'checked' : ''; ?>>
                <label class="form-check-label" for="High_potential">
                    High Potential
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="" id="Master_PieceNormal" <?php echo $pl_level_array[0]['Master_piece'] == 1 ? 'checked' : ''; ?>>
                <label class="form-check-label" for="Master_Piece">
                    Master Piece
                </label>
            </div>
        </div>

        <div class="row">
            <div><br><br>
                <table class="table table-bordered">
                    <thead class="table-danger">
                        <tr>
                            <th scope="col" class="size-col-table text-center">ต้องเป็นดีเลิศ</th>
                            <th scope="col" class="size-col-table text-center">มีดีเลิศหรือดีมาก</th>
                            <th scope="col" class="size-col-table text-center">ดีอย่างน้อย</th>
                            <th scope="col" class="size-col-table text-center">สามมารถเข้าเกณฑ์พอใช้</th>
                            <th scope="col" class="size-col-table text-center">สามมารถเข้าเกณฑ์ปรับปรุง</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="form-control" value="<?php echo $pl_level_array[0]['Excellent'] ?>" name="ExcellentNormal" id="ExcellentNormal"></td>
                            <td><input type="text" class="form-control" value="<?php echo $pl_level_array[0]['very_good'] ?>" name="very_goodNormal" id="very_goodNormal"></td>
                            <td><input type="text" class="form-control" value="<?php echo $pl_level_array[0]['good'] ?>" name="goodNormal" id="goodNormal"></td>
                            <td><input type="text" class="form-control" value="<?php echo $pl_level_array[0]['fair'] ?>" name="fairNormal" id="fairNormal"></td>
                            <td><input type="text" class="form-control" value="<?php echo $pl_level_array[0]['adjust'] ?>" name="adjustNormal" id="adjustNormal"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <!-- Fast -->
        <div class="row mb-3">
            <p style="font-size: 30px; font-weight: bold;">Fast</p>
        </div>
        <div class="row mb-3">
            <div class="col-4">
                <p>ประเมินย้อนหลัง (ปี) : </p>
                <input type="text" name="estimate" id="estimatefast" class="form-control" value="<?php echo $pl_level_array[1]['estimate'] ?>">
            </div>
            <div class="col-4">
                <p>ESY (ปี) : </p>
                <input type="text" name="ESY" id="ESYfast" class="form-control" value="<?php echo $pl_level_array[1]['ESY'] ?>">
            </div>
            <div class="col-4">
                <p>TIG (ปี) : </p>
                <input type="text" name="TIG" id="TIGfast" class="form-control" value="<?php echo $pl_level_array[2]['TIG'] ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <p>คุณสมบัติ : </p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="" id="Potentialfast" <?php echo $pl_level_array[1]['P'] == 1 ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="Potential">
                        Potential
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="" id="High_potentialfast" <?php echo $pl_level_array[1]['HP'] == 1 ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="High_potential">
                        High Potential
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="" id="Master_Piecefast" <?php echo $pl_level_array[1]['Master_piece'] == 1 ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="Master_Piece">
                        Master Piece
                    </label>
                </div>
            </div>

            <div class="row">
                <div><br><br>
                    <table class="table table-bordered">
                        <thead class="table-danger">
                            <tr>
                                <th scope="col" class="size-col-table text-center">ต้องเป็นดีเลิศ</th>
                                <th scope="col" class="size-col-table text-center">มีดีเลิศหรือดีมาก</th>
                                <th scope="col" class="size-col-table text-center">ดีอย่างน้อย</th>
                                <th scope="col" class="size-col-table text-center">สามมารถเข้าเกณฑ์พอใช้</th>
                                <th scope="col" class="size-col-table text-center">สามมารถเข้าเกณฑ์ปรับปรุง</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" class="form-control" value="<?php echo $pl_level_array[1]['Excellent'] ?>" name="Excellentfast" id="Excellentfast"></td>
                                <td><input type="text" class="form-control" value="<?php echo $pl_level_array[1]['very_good'] ?>" name="very_goodfast" id="very_goodfast"></td>
                                <td><input type="text" class="form-control" value="<?php echo $pl_level_array[1]['good'] ?>"  name="goodfast" id="goodfast"></td>
                                <td><input type="text" class="form-control" value="<?php echo $pl_level_array[1]['fair'] ?>"  name="fairfast" id="fairfast"></td>
                                <td><input type="text" class="form-control" value="<?php echo $pl_level_array[1]['adjust'] ?>" name="adjustfast" id="adjustfast"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr>
        <!-- Super Fast -->
        <div class="row mb-3">
            <p style="font-size: 30px; font-weight: bold;">Super Fast</p>
        </div>
        <div class="row mb-3">
            <div class="col-4">
                <p>ประเมินย้อนหลัง (ปี) : </p>
                <input type="text" name="estimate" id="estimateSuper_Fast" class="form-control" value="<?php echo $pl_level_array[2]['estimate'] ?>">
            </div>
            <div class="col-4">
                <p>ESY (ปี) : </p>
                <input type="text" name="ESYSuper_Fast" id="ESYSuper_Fast" class="form-control" value="<?php echo $pl_level_array[2]['ESY'] ?>">
            </div>
            <div class="col-4">
                <p>TIG (ปี) : </p>
                <input type="text" name="TIG" id="TIGSuper_Fast" class="form-control" value="<?php echo $pl_level_array[2]['TIG'] ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <p>คุณสมบัติ : </p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="" id="PotentialSuper_Fast" <?php echo $pl_level_array[2]['P'] == 1 ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="Potential">
                        Potential
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="" id="High_potentialSuper_Fast" <?php echo $pl_level_array[2]['HP'] == 1 ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="High_potential">
                        High Potential
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="" id="Master_PieceSuper_Fast" <?php echo $pl_level_array[2]['Master_piece'] == 1 ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="Master_Piece">
                        Master Piece
                    </label>
                </div>
            </div>
            <div class="row">
                <div><br>
                    <table class="table table-bordered">
                        <thead class="table-danger">
                            <tr>
                                <th scope="col" class="size-col-table text-center">ต้องเป็นดีเลิศ</th>
                                <th scope="col" class="size-col-table text-center">มีดีเลิศหรือดีมาก</th>
                                <th scope="col" class="size-col-table text-center">ดีอย่างน้อย</th>
                                <th scope="col" class="size-col-table text-center">สามมารถเข้าเกณฑ์พอใช้</th>
                                <th scope="col" class="size-col-table text-center">สามมารถเข้าเกณฑ์ปรับปรุง</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" class="form-control" value="<?php echo $pl_level_array[2]['Excellent'] ?>" name="Excellent" id="ExcellentSuper_Fast"></td>
                                <td><input type="text" class="form-control" value="<?php echo $pl_level_array[2]['very_good'] ?>" name="very_good" id="very_goodSuper_Fast"></td>
                                <td><input type="text" class="form-control" value="<?php echo $pl_level_array[2]['good'] ?>" name="good" id="goodSuper_Fast"></td>
                                <td><input type="text" class="form-control" value="<?php echo $pl_level_array[2]['fair'] ?>" name="fair" id="fairSuper_Fast"></td>
                                <td><input type="text" class="form-control" value="<?php echo $pl_level_array[2]['adjust'] ?>" name="adjust" id="adjustSuper_Fast"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
<?php
}
?>