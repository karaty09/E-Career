<?php
require '../../db/connect.php';

// ดึงข้อมูลจากฐานข้อมูล
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = $db->prepare('SELECT * FROM PA_standard WHERE Meet = ?');
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
?>
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Promotion Adjustment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modalForm" method="post" enctype="multipart/form-data">
                    <div class="dropdown w-100">
                        <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="PL_level" name="PL_level" style="font-size: 40px;" data-bs-toggle="dropdown" aria-expanded="false">
                            PL level
                        </button>
                        <ul class="dropdown-menu w-100">
                            <li><a class="dropdown-item" onclick="SelectPL_level('O3')">O3</a></li>
                            <li><a class="dropdown-item" onclick="SelectPL_level('O4')">O4</a></li>
                            <li><a class="dropdown-item" onclick="SelectPL_level('O5')">O5</a></li>
                            <li><a class="dropdown-item" onclick="SelectPL_level('S1')">S1</a></li>
                            <li><a class="dropdown-item" onclick="SelectPL_level('S2')">S2</a></li>
                            <li><a class="dropdown-item" onclick="SelectPL_level('S3')">S3</a></li>
                            <li><a class="dropdown-item" onclick="SelectPL_level('S4')">S4</a></li>
                        </ul>
                    </div><br>
                    <div class="row mb-3">
                        <div class="col-4">
                            <p>หลักเกณฑ์ Promotion Adjustment ประชุมบุคคล : </p>
                            <input type="date" name="Meet" id="Meet" class="form-control" value="<?php echo $row['Meet'] ?>" disabled>
                        </div>
                        <div class="col-4">
                            <p>Active Date :</p>
                            <input type="date" name="Active_Date" id="Active_Date" class="form-control" value="<?php echo $row['Active_Date'] ?>" disabled>
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
                            <input type="text" name="estimateNormal" id="estimateNormal" class="form-control" value="<?php echo $row['estimate'] ?>" disabled>
                        </div>
                        <div class="col-4">
                            <p>ESY (ปี) : </p>
                            <input type="text" name="ESYNormal" id="ESYNormal" class="form-control" value="<?php echo $row['ESY'] ?>" disabled>
                        </div>
                        <div class="col-4">
                            <p>TIG (ปี) : </p>
                            <input type="text" name="TIGNormal" id="TIGNormal" class="form-control" value="<?php echo $row['TIG'] ?>" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <p>คุณสมบัติ : </p>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="" id="PotentialNormal">
                                <label class="form-check-label" for="Potential">
                                    Potential
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="" id="High_potentialNormal">
                                <label class="form-check-label" for="High_potential">
                                    High Potential
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="" id="Master_PieceNormal">
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
                                            <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['Excellent'], 0); ?>" disabled></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['very_good'], 0); ?>" disabled></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['good'], 0); ?>" disabled></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['fair'], 0); ?>" disabled></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['adjust'], 0); ?>" disabled></td>
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
                                <input type="text" name="estimate" id="estimatefast" class="form-control" value="<?php echo $row['estimate'] ?>" disabled>
                            </div>
                            <div class="col-4">
                                <p>ESY (ปี) : </p>
                                <input type="text" name="ESY" id="ESYfast" class="form-control" value="<?php echo $row['ESY'] ?>" disabled>
                            </div>
                            <div class="col-4">
                                <p>TIG (ปี) : </p>
                                <input type="text" name="TIG" id="TIGfast" class="form-control" value="<?php echo $row['TIG'] ?>" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <p>คุณสมบัติ : </p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="" id="Potentialfast">
                                    <label class="form-check-label" for="Potential">
                                        Potential
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="" id="High_potentialfast">
                                    <label class="form-check-label" for="High_potential">
                                        High Potential
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="" id="Master_Piecefast">
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
                                            <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['Excellent'], 0); ?>" disabled></td>
                                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['very_good'], 0); ?>" disabled></td>
                                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['good'], 0); ?>" disabled></td>
                                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['fair'], 0); ?>" disabled></td>
                                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['adjust'], 0); ?>" disabled></td>
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
                                <input type="text" name="estimate" id="estimatefast" class="form-control" value="<?php echo $row['estimate'] ?>" disabled>
                            </div>
                            <div class="col-4">
                                <p>ESY (ปี) : </p>
                                <input type="text" name="ESY" id="ESYfast" class="form-control" value="<?php echo $row['ESY'] ?>" disabled>
                            </div>
                            <div class="col-4">
                                <p>TIG (ปี) : </p>
                                <input type="text" name="TIG" id="TIGfast" class="form-control" value="<?php echo $row['TIG'] ?>" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <p>คุณสมบัติ : </p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="" id="PotentialSuper_Fast">
                                    <label class="form-check-label" for="Potential">
                                        Potential
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="" id="High_potentialSuper_Fast">
                                    <label class="form-check-label" for="High_potential">
                                        High Potential
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="" id="Master_PieceSuper_Fast">
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
                                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['Excellent'], 0); ?>" disabled></td>
                                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['very_good'], 0); ?>" disabled></td>
                                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['good'], 0); ?>" disabled></td>
                                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['fair'], 0); ?>" disabled></td>
                                                <td><input type="text" class="form-control text-center" autocomplete="off" value="<?php echo number_format($row['adjust'], 0); ?>" disabled></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                </form>
            </div>
    <?php }
} ?>