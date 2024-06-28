<?php
include '../db/connect.php';
include '../login/loginCheckSession.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Meet'])) {
    $id = $_POST['Meet'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">

    <!-- CSS Style -->
    <link rel="stylesheet" href="../assets/src/styles/stylesBody.css">
</head>

<body>
    <!-- Navbar -->
    <?php include './navbarAdmin.php' ?>
    <div class="container-fluid mt-3 mb-3">
        <div class="row" style="margin-left: 40px; margin-right: 40px;">
            <div class="col-md-12 col-12" style="padding: 20px; height: 100%;">
                <div class="row mb-3">
                    <div class="col-6 d-flex justify-content-start">
                        <h4 class="text-black">ข้อมูลหลักเกณฑ์ Promotion Adjustment (PA)</h4>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body" style="overflow-y: auto;">
                        <?php
                        $sql = "SELECT * FROM PA_standard WHERE Meet = :Meet";
                        $stmt = $db->prepare($sql);
                        $stmt->bindParam(':Meet', $id);
                        $stmt->execute();
                        $pl_level_array = array();

                        // วนลูปเข้าถึงข้อมูลทีละแถว
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $pl_level_array[] = $row;
                        }
                        if (!empty($pl_level_array)) {
                        ?>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <p>วันที่ประชุม : </p>
                                    <input type="date" name="Meet" id="Meet" class="form-control" value="<?php echo $pl_level_array[0]['Meet'] ?>" disabled>
                                </div>
                                <div class="col-4">
                                    <p>Active Date :</p>
                                    <input type="date" name="Active_Date" id="Active_Date" class="form-control" value="<?php echo $pl_level_array[0]['Active_Date'] ?>" disabled>
                                </div>
                                <div class="col-4">
                                    <p>แนบเอกสารการประชุม (PDF) :</p>
                                    <input type="Text" name="document_file" id="document_file" class="form-control" value="<?php echo $pl_level_array[0]['document'] ?>" disabled>
                                </div>
                                <br>
                                <div class="row">
                                    <div><br><br>
                                        <p>กำหนดเกณฑ์ระดับบังคับบัญชา (Supervisor)</p>
                                        <table class="table table-bordered">
                                            <thead class="table-danger">
                                                <tr>
                                                    <th scope="col" rowspan="2" class="size-col-table text-center" style="vertical-align: middle; width: 80px;">PL</th>
                                                    <th scope="col" rowspan="2" class="size-col-table text-center" style="vertical-align: middle; width: 100px;">PL Type</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">อายุในตำแหน่ง</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">อายุงานทั้งหมด</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">พิจารณาเกณฑ์</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">ต้องเป็นดีเลิศ (ปี)</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">มีดีเลิศหรือดีมาก (ปี)</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">ดีอย่างน้อย (ปี)</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">สามมารถเข้าเกณฑ์พอใช้ (ปี)</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">สามมารถเข้าเกณฑ์ปรับปรุง (ปี)</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">Potential</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">Hight Potential</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">Master Piece</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col" class="size-col-table text-center">TIG (ปี)</th>
                                                    <th scope="col" class="size-col-table text-center">ESY (ปี)</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle; width: 150px;">ประเมินย้อนหลัง (ปี)</th>
                                                    <th scope="col" class="size-col-table text-center">1</th>
                                                    <th scope="col" class="size-col-table text-center">2+</th>
                                                    <th scope="col" class="size-col-table text-center">2</th>
                                                    <th scope="col" class="size-col-table text-center">3</th>
                                                    <th scope="col" class="size-col-table text-center">4</th>
                                                    <th scope="col" class="size-col-table text-center">P</th>
                                                    <th scope="col" class="size-col-table text-center">HP</th>
                                                    <th scope="col" class="size-col-table text-center">MP</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td rowspan="3" class="size-col-table text-center" style="vertical-align: middle;">S4</td>
                                                    <td style="vertical-align: middle;">Normal</td>
                                                    <td><input type="text" class="form-control text-end" name="TIGNormalS4" id="TIGNormalS4" value="<?php echo $pl_level_array[0]['TIG'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ESYNormalS4" id="ESYNormalS4" value="<?php echo $pl_level_array[0]['ESY'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="estimateNormalS4" id="estimateNormalS4" value="<?php echo $pl_level_array[0]['estimate'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ExcellentNormalS4" id="ExcellentNormalS4" value="<?php echo $pl_level_array[0]['Excellent'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="very_goodNormalS4" id="very_goodNormalS4" value="<?php echo $pl_level_array[0]['very_good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="goodNormalS4" id="goodNormalS4" value="<?php echo $pl_level_array[0]['good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="fairNormalS4" id="fairNormalS4" value="<?php echo $pl_level_array[0]['fair'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="adjustNormalS4" id="adjustNormalS4" value="<?php echo $pl_level_array[0]['adjust'] ?>" disabled></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialNormalS4" <?php echo ($pl_level_array[0]['HP'] == 'P' || $pl_level_array[0]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialNormalS4" <?php echo ($pl_level_array[0]['HP'] == 'HP' || $pl_level_array[0]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceNormalS4" <?php echo ($pl_level_array[0]['Master_piece'] == '1') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Fast</td>
                                                    <td><input type="text" class="form-control text-end" name="TIGFastS4" id="TIGFastS4" value="<?php echo $pl_level_array[1]['TIG'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ESYFastS4" id="ESYFastS4" value="<?php echo $pl_level_array[1]['ESY'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="estimateFastS4" id="estimateFastS4" value="<?php echo $pl_level_array[1]['estimate'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ExcellentFastS4" id="ExcellentFastS4" value="<?php echo $pl_level_array[1]['Excellent'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="very_goodFastS4" id="very_goodFastS4" value="<?php echo $pl_level_array[1]['very_good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="goodFastS4" id="goodFastS4" value="<?php echo $pl_level_array[1]['good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="fairFastS4" id="fairFastS4" value="<?php echo $pl_level_array[1]['fair'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="adjustFastS4" id="adjustFastS4" value="<?php echo $pl_level_array[1]['adjust'] ?>" disabled></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialFastS4" <?php echo ($pl_level_array[1]['HP'] == 'P' || $pl_level_array[1]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialFastS4" <?php echo ($pl_level_array[1]['HP'] == 'HP' || $pl_level_array[1]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceFastS4" <?php echo ($pl_level_array[1]['Master_piece'] == '1') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Super Fast</td>
                                                    <td><input type="text" class="form-control text-end" name="TIGSuperFastS4" id="TIGSuperFastS4" value="<?php echo $pl_level_array[2]['TIG'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ESYSuperFastS4" id="ESYSuperFastS4" value="<?php echo $pl_level_array[2]['ESY'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="estimateSuperFastS4" id="estimateSuperFastS4" value="<?php echo $pl_level_array[2]['estimate'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ExcellentSuperFastS4" id="ExcellentSuperFastS4" value="<?php echo $pl_level_array[2]['Excellent'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="very_goodSuperFastS4" id="very_goodSuperFastS4" value="<?php echo $pl_level_array[2]['very_good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="goodSuperFastS4" id="goodSuperFastS4" value="<?php echo $pl_level_array[2]['good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="fairSuperFastS4" id="fairSuperFastS4" value="<?php echo $pl_level_array[2]['fair'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="adjustSuperFastS4" id="adjustSuperFastS4" value="<?php echo $pl_level_array[2]['adjust'] ?>" disabled></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialSuperFastS4" <?php echo ($pl_level_array[2]['HP'] == 'P' || $pl_level_array[2]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialSuperFastS4" <?php echo ($pl_level_array[2]['HP'] == 'HP' || $pl_level_array[2]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="Master_piece" id="MasterPieceSuperFastS4" <?php echo ($pl_level_array[2]['Master_piece'] == '1') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                </tr>
                                                <tr>
                                                    <td rowspan="3" class="size-col-table text-center" style="vertical-align: middle;">S3</td>
                                                    <td style="vertical-align: middle;">Normal</td>
                                                    <td><input type="text" class="form-control text-end" name="TIGNormalS3" id="TIGNormalS3" value="<?php echo $pl_level_array[3]['TIG'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ESYNormalS3" id="ESYNormalS3" value="<?php echo $pl_level_array[3]['ESY'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="estimateNormalS3" id="estimateNormalS3" value="<?php echo $pl_level_array[3]['estimate'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ExcellentNormalS3" id="ExcellentNormalS3" value="<?php echo $pl_level_array[3]['Excellent'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="very_goodNormalS3" id="very_goodNormalS3" value="<?php echo $pl_level_array[3]['very_good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="goodNormalS3" id="goodNormalS3" value="<?php echo $pl_level_array[3]['good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="fairNormalS3" id="fairNormalS3" value="<?php echo $pl_level_array[3]['fair'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="adjustNormalS3" id="adjustNormalS3" value="<?php echo $pl_level_array[3]['adjust'] ?>" disabled></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialNormalS3" <?php echo ($pl_level_array[3]['HP'] == 'P' || $pl_level_array[3]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialNormalS3" <?php echo ($pl_level_array[3]['HP'] == 'HP' || $pl_level_array[3]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceNormalS3" <?php echo ($pl_level_array[3]['Master_piece'] == '1') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Fast</td>
                                                    <td><input type="text" class="form-control text-end" name="TIGFastS3" id="TIGFastS3" value="<?php echo $pl_level_array[4]['TIG'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ESYFastS3" id="ESYFastS3" value="<?php echo $pl_level_array[4]['ESY'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="estimateFastS3" id="estimateFastS3" value="<?php echo $pl_level_array[4]['estimate'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ExcellentFastS3" id="ExcellentFastS3" value="<?php echo $pl_level_array[4]['Excellent'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="very_goodFastS3" id="very_goodFastS3" value="<?php echo $pl_level_array[4]['very_good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="goodFastS3" id="goodFastS3" value="<?php echo $pl_level_array[4]['good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="fairFastS3" id="fairFastS3" value="<?php echo $pl_level_array[4]['fair'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="adjustFastS3" id="adjustFastS3" value="<?php echo $pl_level_array[4]['adjust'] ?>" disabled></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialFastS3" <?php echo ($pl_level_array[4]['HP'] == 'P' || $pl_level_array[4]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialFastS3" <?php echo ($pl_level_array[4]['HP'] == 'HP' || $pl_level_array[4]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceFastS3" <?php echo ($pl_level_array[4]['Master_piece'] == '1') ? 'checked' : ''; ?> disabled>
                                                        </td>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Super Fast</td>
                                                    <td><input type="text" class="form-control text-end" name="TIGSuperFastS3" id="TIGSuperFastS3" value="<?php echo $pl_level_array[5]['TIG'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ESYSuperFastS3" id="ESYSuperFastS3" value="<?php echo $pl_level_array[5]['ESY'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="estimateSuperFastS3" id="estimateSuperFastS3" value="<?php echo $pl_level_array[5]['estimate'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ExcellentSuperFastS3" id="ExcellentSuperFastS3" value="<?php echo $pl_level_array[5]['Excellent'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="very_goodSuperFastS3" id="very_goodSuperFastS3" value="<?php echo $pl_level_array[5]['very_good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="goodSuperFastS3" id="goodSuperFastS3" value="<?php echo $pl_level_array[5]['good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="fairSuperFastS3" id="fairSuperFastS3" value="<?php echo $pl_level_array[5]['fair'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="adjustSuperFastS3" id="adjustSuperFastS3" value="<?php echo $pl_level_array[5]['adjust'] ?>" disabled></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialSuperFastS3" <?php echo ($pl_level_array[5]['HP'] == 'P' || $pl_level_array[5]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialSuperFastS3" <?php echo ($pl_level_array[5]['HP'] == 'HP' || $pl_level_array[5]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceSuperFastS3" <?php echo ($pl_level_array[5]['Master_piece'] == '1') ? 'checked' : ''; ?> disabled>
                                                        </td>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                </tr>
                                                <tr>
                                                    <td rowspan="3" class="size-col-table text-center" style="vertical-align: middle;">S2</td>
                                                    <td style="vertical-align: middle;">Normal</td>
                                                    <td><input type="text" class="form-control text-end" name="TIGNormalS2" id="TIGNormalS2" value="<?php echo $pl_level_array[6]['TIG'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ESYNormalS2" id="ESYNormalS2" value="<?php echo $pl_level_array[6]['ESY'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="estimateNormalS2" id="estimateNormalS2" value="<?php echo $pl_level_array[6]['estimate'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ExcellentNormalS2" id="ExcellentNormalS2" value="<?php echo $pl_level_array[6]['Excellent'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="very_goodNormalS2" id="very_goodNormalS2" value="<?php echo $pl_level_array[6]['very_good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="goodNormalS2" id="goodNormalS2" value="<?php echo $pl_level_array[6]['good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="fairNormalS2" id="fairNormalS2" value="<?php echo $pl_level_array[6]['fair'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="adjustNormalS2" id="adjustNormalS2" value="<?php echo $pl_level_array[6]['adjust'] ?>" disabled></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialNormalS2" <?php echo ($pl_level_array[6]['HP'] == 'P' || $pl_level_array[6]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialNormalS2" <?php echo ($pl_level_array[6]['HP'] == 'HP' || $pl_level_array[6]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceNormalS2" <?php echo ($pl_level_array[6]['Master_piece'] == '1') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Fast</td>
                                                    <td><input type="text" class="form-control text-end" name="TIGFastS2" id="TIGFastS2" value="<?php echo $pl_level_array[7]['TIG'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ESYFastS2" id="ESYFastS2" value="<?php echo $pl_level_array[7]['ESY'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="estimateFastS2" id="estimateFastS2"  value="<?php echo $pl_level_array[7]['estimate'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ExcellentFastS2" id="ExcellentFastS2" value="<?php echo $pl_level_array[7]['Excellent'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="very_goodFastS2" id="very_goodFastS2" value="<?php echo $pl_level_array[7]['very_good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="goodFastS2" id="goodFastS2" value="<?php echo $pl_level_array[7]['good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="fairFastS2" id="fairFastS2" value="<?php echo $pl_level_array[7]['fair'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="adjustFastS2" id="adjustFastS2" value="<?php echo $pl_level_array[7]['adjust'] ?>" disabled></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialFastS2" <?php echo ($pl_level_array[7]['HP'] == 'P' || $pl_level_array[7]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialFastS2" <?php echo ($pl_level_array[7]['HP'] == 'HP' || $pl_level_array[7]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceFastS2" <?php echo ($pl_level_array[7]['Master_piece'] == '1') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Super Fast</td>
                                                    <td><input type="text" class="form-control text-end" name="TIGSuperFastS2" id="TIGSuperFastS2" value="<?php echo $pl_level_array[8]['TIG'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ESYSuperFastS2" id="ESYSuperFastS2" value="<?php echo $pl_level_array[8]['ESY'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="estimateSuperFastS2" id="estimateSuperFastS2" value="<?php echo $pl_level_array[8]['estimate'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ExcellentSuperFastS2" id="ExcellentSuperFastS2" value="<?php echo $pl_level_array[8]['Excellent'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="very_goodSuperFastS2" id="very_goodSuperFastS2" value="<?php echo $pl_level_array[8]['very_good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="goodSuperFastS2" id="goodSuperFastS2" value="<?php echo $pl_level_array[8]['good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="fairSuperFastS2" id="fairSuperFastS2" value="<?php echo $pl_level_array[8]['fair'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="adjustSuperFastS2" id="adjustSuperFastS2" value="<?php echo $pl_level_array[8]['adjust'] ?>" disabled></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialSuperFastS2"<?php echo ($pl_level_array[8]['HP'] == 'P' || $pl_level_array[8]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialSuperFastS2" <?php echo ($pl_level_array[8]['HP'] == 'HP' || $pl_level_array[8]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceSuperFastS2" <?php echo ($pl_level_array[8]['Master_piece'] == '1') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                </tr>
                                                <tr>
                                                    <td rowspan="3" class="size-col-table text-center" style="vertical-align: middle;">S1</td>
                                                    <td style="vertical-align: middle;">Normal</td>
                                                    <td><input type="text" class="form-control text-end" name="TIGNormalS1" id="TIGNormalS1" value="<?php echo $pl_level_array[9]['TIG'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ESYNormalS1" id="ESYNormalS1" value="<?php echo $pl_level_array[9]['ESY'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="estimateNormalS1" id="estimateNormalS1" value="<?php echo $pl_level_array[9]['estimate'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ExcellentNormalS1" id="ExcellentNormalS1" value="<?php echo $pl_level_array[9]['Excellent'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="very_goodNormalS1" id="very_goodNormalS1" value="<?php echo $pl_level_array[9]['very_good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="goodNormalS1" id="goodNormalS1" value="<?php echo $pl_level_array[9]['good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="fairNormalS1" id="fairNormalS1" value="<?php echo $pl_level_array[9]['fair'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="adjustNormalS1" id="adjustNormalS1" value="<?php echo $pl_level_array[9]['adjust'] ?>" disabled></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialNormalS1" <?php echo ($pl_level_array[9]['HP'] == 'P' || $pl_level_array[9]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialNormalS1" <?php echo ($pl_level_array[9]['HP'] == 'HP' || $pl_level_array[9]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceNormalS1" <?php echo ($pl_level_array[9]['Master_piece'] == '1') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Fast</td>
                                                    <td><input type="text" class="form-control text-end" name="TIGFastS1" id="TIGFastS1" value="<?php echo $pl_level_array[10]['TIG'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ESYFastS1" id="ESYFastS1" value="<?php echo $pl_level_array[10]['ESY'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="estimateFastS1" id="estimateFastS1" value="<?php echo $pl_level_array[10]['estimate'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ExcellentFastS1" id="ExcellentFastS1" value="<?php echo $pl_level_array[10]['Excellent'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="very_goodFastS1" id="very_goodFastS1" value="<?php echo $pl_level_array[10]['very_good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="goodFastS1" id="goodFastS1" value="<?php echo $pl_level_array[10]['good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="fairFastS1" id="fairFastS1" value="<?php echo $pl_level_array[10]['fair'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="adjustFastS1" id="adjustFastS1" value="<?php echo $pl_level_array[10]['adjust'] ?>" disabled></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialFastS1" <?php echo ($pl_level_array[10]['HP'] == 'P' || $pl_level_array[10]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialFastS1" <?php echo ($pl_level_array[10]['HP'] == 'HP' || $pl_level_array[10]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceFastS1" <?php echo ($pl_level_array[10]['Master_piece'] == '1') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Super Fast</td>
                                                    <td><input type="text" class="form-control text-end" name="TIGSuperFastS1" id="TIGSuperFastS1" value="<?php echo $pl_level_array[11]['TIG'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ESYSuperFastS1" id="ESYSuperFastS1" value="<?php echo $pl_level_array[11]['ESY'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="estimateSuperFastS1" id="estimateSuperFastS1" value="<?php echo $pl_level_array[11]['estimate'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ExcellentSuperFastS1" id="ExcellentSuperFastS1" value="<?php echo $pl_level_array[11]['Excellent'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="very_goodSuperFastS1" id="very_goodSuperFastS1" value="<?php echo $pl_level_array[11]['very_good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="goodSuperFastS1" id="goodSuperFastS1" value="<?php echo $pl_level_array[11]['good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="fairSuperFastS1" id="fairSuperFastS1" value="<?php echo $pl_level_array[11]['fair'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="adjustSuperFastS1" id="adjustSuperFastS1" value="<?php echo $pl_level_array[11]['adjust'] ?>" disabled></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialSuperFastS1" <?php echo ($pl_level_array[11]['HP'] == 'P' || $pl_level_array[11]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialSuperFastS1" <?php echo ($pl_level_array[11]['HP'] == 'HP' || $pl_level_array[11]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceSuperFastS1" <?php echo ($pl_level_array[11]['Master_piece'] == '1') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div><br>
                                        <p>กำหนดเกณฑ์ระดับปฏิบัติการ (Operation)</p>
                                        <table class="table table-bordered">
                                            <thead class="table-danger">
                                                <tr>
                                                    <th scope="col" rowspan="2" class="size-col-table text-center" style="vertical-align: middle; width: 80px;">PL</th>
                                                    <th scope="col" rowspan="2" class="size-col-table text-center" style="vertical-align: middle; width: 100px;">PL Type</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">อายุในตำแหน่ง</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">อายุงานทั้งหมด</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">พิจารณาเกณฑ์</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">ต้องเป็นดีเลิศ (ปี)</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">มีดีเลิศหรือดีมาก (ปี)</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">ดีอย่างน้อย (ปี)</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">สามมารถเข้าเกณฑ์พอใช้ (ปี)</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">สามมารถเข้าเกณฑ์ปรับปรุง (ปี)</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">Potential</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">Hight Potential</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle;">Master Piece</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col" class="size-col-table text-center">TIG (ปี)</th>
                                                    <th scope="col" class="size-col-table text-center">ESY (ปี)</th>
                                                    <th scope="col" class="size-col-table text-center" style="vertical-align: middle; width: 150px;">ประเมินย้อนหลัง (ปี)</th>
                                                    <th scope="col" class="size-col-table text-center">1</th>
                                                    <th scope="col" class="size-col-table text-center">2+</th>
                                                    <th scope="col" class="size-col-table text-center">2</th>
                                                    <th scope="col" class="size-col-table text-center">3</th>
                                                    <th scope="col" class="size-col-table text-center">4</th>
                                                    <th scope="col" class="size-col-table text-center">P</th>
                                                    <th scope="col" class="size-col-table text-center">HP</th>
                                                    <th scope="col" class="size-col-table text-center">MP</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td rowspan="3" class="size-col-table text-center" style="vertical-align: middle;">O5</td>
                                                    <td style="vertical-align: middle;">Normal</td>
                                                    <td><input type="text" class="form-control text-end" name="TIGNormalO5" id="TIGNormalO5" value="<?php echo $pl_level_array[12]['TIG'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ESYNormalO5" id="ESYNormalO5" value="<?php echo $pl_level_array[12]['ESY'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="estimateNormalO5" id="estimateNormalO5" value="<?php echo $pl_level_array[12]['estimate'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ExcellentNormalO5" id="ExcellentNormalO5" value="<?php echo $pl_level_array[12]['Excellent'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="very_goodNormalO5" id="very_goodNormalO5" value="<?php echo $pl_level_array[12]['very_good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="goodNormalO5" id="goodNormalO5" value="<?php echo $pl_level_array[12]['good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="fairNormalO5" id="fairNormalO5" value="<?php echo $pl_level_array[12]['fair'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="adjustNormalO5" id="adjustNormalO5" value="<?php echo $pl_level_array[12]['adjust'] ?>" disabled></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialNormalO5" <?php echo ($pl_level_array[12]['HP'] == 'P' || $pl_level_array[12]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialNormalO5" <?php echo ($pl_level_array[12]['HP'] == 'HP' || $pl_level_array[12]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceNormalO5" <?php echo ($pl_level_array[12]['Master_piece'] == '1') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Fast</td>
                                                    <td><input type="text" class="form-control text-end" name="TIGFastO5" id="TIGFastO5" value="<?php echo $pl_level_array[13]['TIG'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ESYFastO5" id="ESYFastO5" value="<?php echo $pl_level_array[13]['ESY'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="estimateFastO5" id="estimateFastO5" value="<?php echo $pl_level_array[13]['estimate'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ExcellentFastO5" id="ExcellentFastO5" value="<?php echo $pl_level_array[13]['Excellent'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="very_goodFastO5" id="very_goodFastO5" value="<?php echo $pl_level_array[13]['very_good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="goodFastO5" id="goodFastO5" value="<?php echo $pl_level_array[13]['good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="fairFastO5" id="fairFastO5" value="<?php echo $pl_level_array[13]['fair'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="adjustFastO5" id="adjustFastO5" value="<?php echo $pl_level_array[13]['adjust'] ?>" disabled></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialFastO5" <?php echo ($pl_level_array[13]['HP'] == 'P' || $pl_level_array[13]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                        </td>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialFastO5" <?php echo ($pl_level_array[13]['HP'] == 'HP' || $pl_level_array[13]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceFastO5" <?php echo ($pl_level_array[13]['Master_piece'] == '1') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Super Fast</td>
                                                    <td><input type="text" class="form-control text-end" name="TIGSuperFastO5" id="TIGSuperFastO5" value="<?php echo $pl_level_array[14]['TIG'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ESYSuperFastO5" id="ESYSuperFastO5" value="<?php echo $pl_level_array[14]['ESY'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="estimateSuperFastO5" id="estimateSuperFastO5" value="<?php echo $pl_level_array[14]['estimate'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ExcellentSuperFastO5" id="ExcellentSuperFastO5" value="<?php echo $pl_level_array[14]['Excellent'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="very_goodSuperFastO5" id="very_goodSuperFastO5" value="<?php echo $pl_level_array[14]['very_good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="goodSuperFastO5" id="goodSuperFastO5" value="<?php echo $pl_level_array[14]['good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="fairSuperFastO5" id="fairSuperFastO5" value="<?php echo $pl_level_array[14]['fair'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="adjustSuperFastO5" id="adjustSuperFastO5" value="<?php echo $pl_level_array[14]['adjust'] ?>" disabled></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialSuperFastO5" <?php echo ($pl_level_array[14]['HP'] == 'P' || $pl_level_array[14]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialSuperFastO5" <?php echo ($pl_level_array[14]['HP'] == 'HP' || $pl_level_array[14]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceSuperFastO5" <?php echo ($pl_level_array[14]['Master_piece'] == '1') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                </tr>
                                                <tr>
                                                    <td rowspan="3" class="size-col-table text-center" style="vertical-align: middle;">O4</td>
                                                    <td style="vertical-align: middle;">Normal</td>
                                                    <td><input type="text" class="form-control text-end" name="TIGNormalO4" id="TIGNormalO4" value="<?php echo $pl_level_array[15]['TIG'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ESYNormalO4" id="ESYNormalO4" value="<?php echo $pl_level_array[15]['ESY'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="estimateNormalO4" id="estimateNormalO4" value="<?php echo $pl_level_array[15]['estimate'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ExcellentNormalO4" id="ExcellentNormalO4" value="<?php echo $pl_level_array[15]['Excellent'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="very_goodNormalO4" id="very_goodNormalO4" value="<?php echo $pl_level_array[15]['very_good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="goodNormalO4" id="goodNormalO4" value="<?php echo $pl_level_array[15]['good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="fairNormalO4" id="fairNormalO4" value="<?php echo $pl_level_array[15]['fair'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="adjustNormalO4" id="adjustNormalO4" value="<?php echo $pl_level_array[15]['adjust'] ?>" disabled></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialNormalO4" <?php echo ($pl_level_array[15]['HP'] == 'P' || $pl_level_array[15]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialNormalO4" <?php echo ($pl_level_array[15]['HP'] == 'HP' || $pl_level_array[15]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceNormalO4"  <?php echo ($pl_level_array[15]['Master_piece'] == '1') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Fast</td>
                                                    <td><input type="text" class="form-control text-end" name="TIGFastO4" id="TIGFastO4" value="<?php echo $pl_level_array[16]['TIG'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ESYFastO4" id="ESYFastO4" value="<?php echo $pl_level_array[16]['ESY'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="estimateFastO4" id="estimateFastO4" value="<?php echo $pl_level_array[16]['estimate'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ExcellentFastO4" id="ExcellentFastO4" value="<?php echo $pl_level_array[16]['Excellent'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="very_goodFastO4" id="very_goodFastO4" value="<?php echo $pl_level_array[16]['very_good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="goodFastO4" id="goodFastO4" value="<?php echo $pl_level_array[16]['good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="fairFastO4" id="fairFastO4" value="<?php echo $pl_level_array[16]['fair'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="adjustFastO4" id="adjustFastO4" value="<?php echo $pl_level_array[16]['adjust'] ?>" disabled></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialFastO4" <?php echo ($pl_level_array[16]['HP'] == 'P' || $pl_level_array[16]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialFastO4" <?php echo ($pl_level_array[16]['HP'] == 'HP' || $pl_level_array[16]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceFastO4" <?php echo ($pl_level_array[16]['Master_piece'] == '1') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Super Fast</td>
                                                    <td><input type="text" class="form-control text-end" name="TIGSuperFastO4" id="TIGSuperFastO4" value="<?php echo $pl_level_array[17]['TIG'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ESYSuperFastO4" id="ESYSuperFastO4" value="<?php echo $pl_level_array[17]['ESY'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="estimateSuperFastO4" id="estimateSuperFastO4" value="<?php echo $pl_level_array[17]['estimate'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ExcellentSuperFastO4" id="ExcellentSuperFastO4" value="<?php echo $pl_level_array[17]['Excellent'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="very_goodSuperFastO4" id="very_goodSuperFastO4" value="<?php echo $pl_level_array[17]['very_good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="goodSuperFastO4" id="goodSuperFastO4" value="<?php echo $pl_level_array[17]['good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="fairSuperFastO4" id="fairSuperFastO4" value="<?php echo $pl_level_array[17]['fair'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="adjustSuperFastO4" id="adjustSuperFastO4" value="<?php echo $pl_level_array[17]['adjust'] ?>" disabled></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialSuperFastO4" <?php echo ($pl_level_array[17]['HP'] == 'P' || $pl_level_array[17]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialSuperFastO4" <?php echo ($pl_level_array[17]['HP'] == 'HP' || $pl_level_array[17]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceSuperFastO4" <?php echo ($pl_level_array[17]['Master_piece'] == '1') ? 'checked' : ''; ?> disabled>
                                                        </td>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                    <td style="background-color: black;"></td>
                                                </tr>
                                                <tr>
                                                    <td rowspan="3" class="size-col-table text-center" style="vertical-align: middle;">O3</td>
                                                    <td style="vertical-align: middle;">Normal</td>
                                                    <td><input type="text" class="form-control text-end" name="TIGNormalO3" id="TIGNormalO3" value="<?php echo $pl_level_array[18]['TIG'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ESYNormalO3" id="ESYNormalO3" value="<?php echo $pl_level_array[18]['ESY'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="estimateNormalO3" id="estimateNormalO3" value="<?php echo $pl_level_array[18]['estimate'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ExcellentNormalO3" id="ExcellentNormalO3" value="<?php echo $pl_level_array[18]['Excellent'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="very_goodNormalO3" id="very_goodNormalO3" value="<?php echo $pl_level_array[18]['very_good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="goodNormalO3" id="goodNormalO3" value="<?php echo $pl_level_array[18]['good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="fairNormalO3" id="fairNormalO3" value="<?php echo $pl_level_array[18]['fair'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="adjustNormalO3" id="adjustNormalO3" value="<?php echo $pl_level_array[18]['adjust'] ?>" disabled></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialNormalO3" <?php echo ($pl_level_array[18]['HP'] == 'P' || $pl_level_array[18]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialNormalO3" <?php echo ($pl_level_array[18]['HP'] == 'HP' || $pl_level_array[18]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceNormalO3" <?php echo ($pl_level_array[18]['Master_piece'] == '1') ? 'checked' : ''; ?> disabled>
                                                        </td>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Fast</td>
                                                    <td><input type="text" class="form-control text-end" name="TIGFastO3" id="TIGFastO3" value="<?php echo $pl_level_array[19]['TIG'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ESYFastO3" id="ESYFastO3" value="<?php echo $pl_level_array[19]['ESY'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="estimateFastO3" id="estimateFastO3" value="<?php echo $pl_level_array[19]['estimate'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ExcellentFastO3" id="ExcellentFastO3" value="<?php echo $pl_level_array[19]['Excellent'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="very_goodFastO3" id="very_goodFastO3" value="<?php echo $pl_level_array[19]['very_good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="goodFastO3" id="goodFastO3" value="<?php echo $pl_level_array[19]['good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="fairFastO3" id="fairFastO3" value="<?php echo $pl_level_array[19]['fair'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="adjustFastO3" id="adjustFastO3" value="<?php echo $pl_level_array[19]['adjust'] ?>" disabled></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialFastO3" <?php echo ($pl_level_array[19]['HP'] == 'P' || $pl_level_array[19]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialFastO3" <?php echo ($pl_level_array[19]['HP'] == 'HP' || $pl_level_array[19]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceFastO3" <?php echo ($pl_level_array[19]['Master_piece'] == '1') ? 'checked' : ''; ?> disabled>
                                                        </td>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Super Fast</td>
                                                    <td><input type="text" class="form-control text-end" name="TIGSuperFastO3" id="TIGSuperFastO3" value="<?php echo $pl_level_array[20]['TIG'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ESYSuperFastO3" id="ESYSuperFastO3" value="<?php echo $pl_level_array[20]['ESY'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="estimateSuperFastO3" id="estimateSuperFastO3" value="<?php echo $pl_level_array[20]['estimate'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="ExcellentSuperFastO3" id="ExcellentSuperFastO3" value="<?php echo $pl_level_array[20]['Excellent'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="very_goodSuperFastO3" id="very_goodSuperFastO3" value="<?php echo $pl_level_array[20]['very_good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="goodSuperFastO3" id="goodSuperFastO3" value="<?php echo $pl_level_array[20]['good'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="fairSuperFastO3" id="fairSuperFastO3" value="<?php echo $pl_level_array[20]['fair'] ?>" disabled></td>
                                                    <td><input type="text" class="form-control text-end" name="adjustSuperFastO3" id="adjustSuperFastO3" value="<?php echo $pl_level_array[20]['adjust'] ?>" disabled></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialSuperFastO3" <?php echo ($pl_level_array[20]['HP'] == 'P' || $pl_level_array[20]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialSuperFastO3" <?php echo ($pl_level_array[20]['HP'] == 'HP' || $pl_level_array[20]['HP'] == 'PHP') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceSuperFastO3" <?php echo ($pl_level_array[20]['Master_piece'] == '1') ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                            </div>
                    </div>
                <?php
                        }
                ?>
                </div>
            </div>
        </div>
    </div>
    <?php include '../assets/src/footer.php' ?>
</body>

</html>