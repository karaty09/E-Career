<?php
include '../db/connect.php';
include '../login/loginCheckSession.php';
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
                        <h4 class="text-black">กรอกหลักเกณฑ์ Promotion Adjustment (PA)</h4>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body" style="overflow-y: auto;">
                        <form id="AddPAform" method="post" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <div class="col-4">
                                    <p>วันที่ประชุม : </p>
                                    <input type="date" name="Meet" id="Meet" class="form-control">
                                </div>
                                <div class="col-4">
                                    <p>Active Date :</p>
                                    <input type="date" name="Active_Date" id="Active_Date" class="form-control">
                                </div>
                                <div class="col-4">
                                    <p>แนบเอกสารการประชุม (PDF) :</p>
                                    <input type="file" name="document_file" id="document_file" class="form-control" accept=".pdf">
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
                                                    <td><input type="text" class="form-control" name="TIGNormalS4" id="TIGNormalS4"></td>
                                                    <td><input type="text" class="form-control" name="ESYNormalS4" id="ESYNormalS4"></td>
                                                    <td><input type="text" class="form-control" name="estimateNormalS4" id="estimateNormalS4"></td>
                                                    <td><input type="text" class="form-control" name="ExcellentNormalS4" id="ExcellentNormalS4"></td>
                                                    <td><input type="text" class="form-control" name="very_goodNormalS4" id="very_goodNormalS4"></td>
                                                    <td><input type="text" class="form-control" name="goodNormalS4" id="goodNormalS4"></td>
                                                    <td><input type="text" class="form-control" name="fairNormalS4" id="fairNormalS4"></td>
                                                    <td><input type="text" class="form-control" name="adjustNormalS4" id="adjustNormalS4"></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialNormalS4">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialNormalS4">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceNormalS4">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Fast</td>
                                                    <td><input type="text" class="form-control" name="TIGFastS4" id="TIGFastS4"></td>
                                                    <td><input type="text" class="form-control" name="ESYFastS4" id="ESYFastS4"></td>
                                                    <td><input type="text" class="form-control" name="estimateFastS4" id="estimateFastS4"></td>
                                                    <td><input type="text" class="form-control" name="ExcellentFastS4" id="ExcellentFastS4"></td>
                                                    <td><input type="text" class="form-control" name="very_goodFastS4" id="very_goodFastS4"></td>
                                                    <td><input type="text" class="form-control" name="goodFastS4" id="goodFastS4"></td>
                                                    <td><input type="text" class="form-control" name="fairFastS4" id="fairFastS4"></td>
                                                    <td><input type="text" class="form-control" name="adjustFastS4" id="adjustFastS4"></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialFastS4">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialFastS4">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceFastS4">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Super Fast</td>
                                                    <td><input type="text" class="form-control" name="TIGSuperFastS4" id="TIGSuperFastS4"></td>
                                                    <td><input type="text" class="form-control" name="ESYSuperFastS4" id="ESYSuperFastS4"></td>
                                                    <td><input type="text" class="form-control" name="estimateSuperFastS4" id="estimateSuperFastS4"></td>
                                                    <td><input type="text" class="form-control" name="ExcellentSuperFastS4" id="ExcellentSuperFastS4"></td>
                                                    <td><input type="text" class="form-control" name="very_goodSuperFastS4" id="very_goodSuperFastS4"></td>
                                                    <td><input type="text" class="form-control" name="goodSuperFastS4" id="goodSuperFastS4"></td>
                                                    <td><input type="text" class="form-control" name="fairSuperFastS4" id="fairSuperFastS4"></td>
                                                    <td><input type="text" class="form-control" name="adjustSuperFastS4" id="adjustSuperFastS4"></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialSuperFastS4">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialSuperFastS4">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceSuperFastS4">
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
                                                    <td><input type="text" class="form-control" name="TIGNormalS3" id="TIGNormalS3"></td>
                                                    <td><input type="text" class="form-control" name="ESYNormalS3" id="ESYNormalS3"></td>
                                                    <td><input type="text" class="form-control" name="estimateNormalS3" id="estimateNormalS3"></td>
                                                    <td><input type="text" class="form-control" name="ExcellentNormalS3" id="ExcellentNormalS3"></td>
                                                    <td><input type="text" class="form-control" name="very_goodNormalS3" id="very_goodNormalS3"></td>
                                                    <td><input type="text" class="form-control" name="goodNormalS3" id="goodNormalS3"></td>
                                                    <td><input type="text" class="form-control" name="fairNormalS3" id="fairNormalS3"></td>
                                                    <td><input type="text" class="form-control" name="adjustNormalS3" id="adjustNormalS3"></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialNormalS3">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialNormalS3">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceNormalS3">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Fast</td>
                                                    <td><input type="text" class="form-control" name="TIGFastS3" id="TIGFastS3"></td>
                                                    <td><input type="text" class="form-control" name="ESYFastS3" id="ESYFastS3"></td>
                                                    <td><input type="text" class="form-control" name="estimateFastS3" id="estimateFastS3"></td>
                                                    <td><input type="text" class="form-control" name="ExcellentFastS3" id="ExcellentFastS3"></td>
                                                    <td><input type="text" class="form-control" name="very_goodFastS3" id="very_goodFastS3"></td>
                                                    <td><input type="text" class="form-control" name="goodFastS3" id="goodFastS3"></td>
                                                    <td><input type="text" class="form-control" name="fairFastS3" id="fairFastS3"></td>
                                                    <td><input type="text" class="form-control" name="adjustFastS3" id="adjustFastS3"></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialFastS3">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialFastS3">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceFastS3">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Super Fast</td>
                                                    <td><input type="text" class="form-control" name="TIGSuperFastS3" id="TIGSuperFastS3"></td>
                                                    <td><input type="text" class="form-control" name="ESYSuperFastS3" id="ESYSuperFastS3"></td>
                                                    <td><input type="text" class="form-control" name="estimateSuperFastS3" id="estimateSuperFastS3"></td>
                                                    <td><input type="text" class="form-control" name="ExcellentSuperFastS3" id="ExcellentSuperFastS3"></td>
                                                    <td><input type="text" class="form-control" name="very_goodSuperFastS3" id="very_goodSuperFastS3"></td>
                                                    <td><input type="text" class="form-control" name="goodSuperFastS3" id="goodSuperFastS3"></td>
                                                    <td><input type="text" class="form-control" name="fairSuperFastS3" id="fairSuperFastS3"></td>
                                                    <td><input type="text" class="form-control" name="adjustSuperFastS3" id="adjustSuperFastS3"></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialSuperFastS3">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialSuperFastS3">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceSuperFastS3">
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
                                                    <td><input type="text" class="form-control" name="TIGNormalS2" id="TIGNormalS2"></td>
                                                    <td><input type="text" class="form-control" name="ESYNormalS2" id="ESYNormalS2"></td>
                                                    <td><input type="text" class="form-control" name="estimateNormalS2" id="estimateNormalS2"></td>
                                                    <td><input type="text" class="form-control" name="ExcellentNormalS2" id="ExcellentNormalS2"></td>
                                                    <td><input type="text" class="form-control" name="very_goodNormalS2" id="very_goodNormalS2"></td>
                                                    <td><input type="text" class="form-control" name="goodNormalS2" id="goodNormalS2"></td>
                                                    <td><input type="text" class="form-control" name="fairNormalS2" id="fairNormalS2"></td>
                                                    <td><input type="text" class="form-control" name="adjustNormalS2" id="adjustNormalS2"></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialNormalS2">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialNormalS2">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceNormalS2">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Fast</td>
                                                    <td><input type="text" class="form-control" name="TIGFastS2" id="TIGFastS2"></td>
                                                    <td><input type="text" class="form-control" name="ESYFastS2" id="ESYFastS2"></td>
                                                    <td><input type="text" class="form-control" name="estimateFastS2" id="estimateFastS2"></td>
                                                    <td><input type="text" class="form-control" name="ExcellentFastS2" id="ExcellentFastS2"></td>
                                                    <td><input type="text" class="form-control" name="very_goodFastS2" id="very_goodFastS2"></td>
                                                    <td><input type="text" class="form-control" name="goodFastS2" id="goodFastS2"></td>
                                                    <td><input type="text" class="form-control" name="fairFastS2" id="fairFastS2"></td>
                                                    <td><input type="text" class="form-control" name="adjustFastS2" id="adjustFastS2"></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialFastS2">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialFastS2">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceFastS2">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Super Fast</td>
                                                    <td><input type="text" class="form-control" name="TIGSuperFastS2" id="TIGSuperFastS2"></td>
                                                    <td><input type="text" class="form-control" name="ESYSuperFastS2" id="ESYSuperFastS2"></td>
                                                    <td><input type="text" class="form-control" name="estimateSuperFastS2" id="estimateSuperFastS2"></td>
                                                    <td><input type="text" class="form-control" name="ExcellentSuperFastS2" id="ExcellentSuperFastS2"></td>
                                                    <td><input type="text" class="form-control" name="very_goodSuperFastS2" id="very_goodSuperFastS2"></td>
                                                    <td><input type="text" class="form-control" name="goodSuperFastS2" id="goodSuperFastS2"></td>
                                                    <td><input type="text" class="form-control" name="fairSuperFastS2" id="fairSuperFastS2"></td>
                                                    <td><input type="text" class="form-control" name="adjustSuperFastS2" id="adjustSuperFastS2"></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialSuperFastS2">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialSuperFastS2">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceSuperFastS2">
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
                                                    <td><input type="text" class="form-control" name="TIGNormalS1" id="TIGNormalS1"></td>
                                                    <td><input type="text" class="form-control" name="ESYNormalS1" id="ESYNormalS1"></td>
                                                    <td><input type="text" class="form-control" name="estimateNormalS1" id="estimateNormalS1"></td>
                                                    <td><input type="text" class="form-control" name="ExcellentNormalS1" id="ExcellentNormalS1"></td>
                                                    <td><input type="text" class="form-control" name="very_goodNormalS1" id="very_goodNormalS1"></td>
                                                    <td><input type="text" class="form-control" name="goodNormalS1" id="goodNormalS1"></td>
                                                    <td><input type="text" class="form-control" name="fairNormalS1" id="fairNormalS1"></td>
                                                    <td><input type="text" class="form-control" name="adjustNormalS1" id="adjustNormalS1"></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialNormalS1">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialNormalS1">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceNormalS1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Fast</td>
                                                    <td><input type="text" class="form-control" name="TIGFastS1" id="TIGFastS1"></td>
                                                    <td><input type="text" class="form-control" name="ESYFastS1" id="ESYFastS1"></td>
                                                    <td><input type="text" class="form-control" name="estimateFastS1" id="estimateFastS1"></td>
                                                    <td><input type="text" class="form-control" name="ExcellentFastS1" id="ExcellentFastS1"></td>
                                                    <td><input type="text" class="form-control" name="very_goodFastS1" id="very_goodFastS1"></td>
                                                    <td><input type="text" class="form-control" name="goodFastS1" id="goodFastS1"></td>
                                                    <td><input type="text" class="form-control" name="fairFastS1" id="fairFastS1"></td>
                                                    <td><input type="text" class="form-control" name="adjustFastS1" id="adjustFastS1"></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialFastS1">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialFastS1">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceFastS1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Super Fast</td>
                                                    <td><input type="text" class="form-control" name="TIGSuperFastS1" id="TIGSuperFastS1"></td>
                                                    <td><input type="text" class="form-control" name="ESYSuperFastS1" id="ESYSuperFastS1"></td>
                                                    <td><input type="text" class="form-control" name="estimateSuperFastS1" id="estimateSuperFastS1"></td>
                                                    <td><input type="text" class="form-control" name="ExcellentSuperFastS1" id="ExcellentSuperFastS1"></td>
                                                    <td><input type="text" class="form-control" name="very_goodSuperFastS1" id="very_goodSuperFastS1"></td>
                                                    <td><input type="text" class="form-control" name="goodSuperFastS1" id="goodSuperFastS1"></td>
                                                    <td><input type="text" class="form-control" name="fairSuperFastS1" id="fairSuperFastS1"></td>
                                                    <td><input type="text" class="form-control" name="adjustSuperFastS1" id="adjustSuperFastS1"></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialSuperFastS1">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialSuperFastS1">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceSuperFastS1">
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
                                                    <td><input type="text" class="form-control" name="TIGNormalO5" id="TIGNormalO5"></td>
                                                    <td><input type="text" class="form-control" name="ESYNormalO5" id="ESYNormalO5"></td>
                                                    <td><input type="text" class="form-control" name="estimateNormalO5" id="estimateNormalO5"></td>
                                                    <td><input type="text" class="form-control" name="ExcellentNormalO5" id="ExcellentNormalO5"></td>
                                                    <td><input type="text" class="form-control" name="very_goodNormalO5" id="very_goodNormalO5"></td>
                                                    <td><input type="text" class="form-control" name="goodNormalO5" id="goodNormalO5"></td>
                                                    <td><input type="text" class="form-control" name="fairNormalO5" id="fairNormalO5"></td>
                                                    <td><input type="text" class="form-control" name="adjustNormalO5" id="adjustNormalO5"></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialNormalO5">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialNormalO5">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceNormalO5">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Fast</td>
                                                    <td><input type="text" class="form-control" name="TIGFastO5" id="TIGFastO5"></td>
                                                    <td><input type="text" class="form-control" name="ESYFastO5" id="ESYFastO5"></td>
                                                    <td><input type="text" class="form-control" name="estimateFastO5" id="estimateFastO5"></td>
                                                    <td><input type="text" class="form-control" name="ExcellentFastO5" id="ExcellentFastO5"></td>
                                                    <td><input type="text" class="form-control" name="very_goodFastO5" id="very_goodFastO5"></td>
                                                    <td><input type="text" class="form-control" name="goodFastO5" id="goodFastO5"></td>
                                                    <td><input type="text" class="form-control" name="fairFastO5" id="fairFastO5"></td>
                                                    <td><input type="text" class="form-control" name="adjustFastO5" id="adjustFastO5"></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialFastO5">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialFastO5">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceFastO5">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Super Fast</td>
                                                    <td><input type="text" class="form-control" name="TIGSuperFastO5" id="TIGSuperFastO5"></td>
                                                    <td><input type="text" class="form-control" name="ESYSuperFastO5" id="ESYSuperFastO5"></td>
                                                    <td><input type="text" class="form-control" name="estimateSuperFastO5" id="estimateSuperFastO5"></td>
                                                    <td><input type="text" class="form-control" name="ExcellentSuperFastO5" id="ExcellentSuperFastO5"></td>
                                                    <td><input type="text" class="form-control" name="very_goodSuperFastO5" id="very_goodSuperFastO5"></td>
                                                    <td><input type="text" class="form-control" name="goodSuperFastO5" id="goodSuperFastO5"></td>
                                                    <td><input type="text" class="form-control" name="fairSuperFastO5" id="fairSuperFastO5"></td>
                                                    <td><input type="text" class="form-control" name="adjustSuperFastO5" id="adjustSuperFastO5"></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialSuperFastO5">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialSuperFastO5">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceSuperFastO5">
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
                                                    <td><input type="text" class="form-control" name="TIGNormalO4" id="TIGNormalO4"></td>
                                                    <td><input type="text" class="form-control" name="ESYNormalO4" id="ESYNormalO4"></td>
                                                    <td><input type="text" class="form-control" name="estimateNormalO4" id="estimateNormalO4"></td>
                                                    <td><input type="text" class="form-control" name="ExcellentNormalO4" id="ExcellentNormalO4"></td>
                                                    <td><input type="text" class="form-control" name="very_goodNormalO4" id="very_goodNormalO4"></td>
                                                    <td><input type="text" class="form-control" name="goodNormalO4" id="goodNormalO4"></td>
                                                    <td><input type="text" class="form-control" name="fairNormalO4" id="fairNormalO4"></td>
                                                    <td><input type="text" class="form-control" name="adjustNormalO4" id="adjustNormalO4"></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialNormalO4">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialNormalO4">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceNormalO4">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Fast</td>
                                                    <td><input type="text" class="form-control" name="TIGFastO4" id="TIGFastO4"></td>
                                                    <td><input type="text" class="form-control" name="ESYFastO4" id="ESYFastO4"></td>
                                                    <td><input type="text" class="form-control" name="estimateFastO4" id="estimateFastO4"></td>
                                                    <td><input type="text" class="form-control" name="ExcellentFastO4" id="ExcellentFastO4"></td>
                                                    <td><input type="text" class="form-control" name="very_goodFastO4" id="very_goodFastO4"></td>
                                                    <td><input type="text" class="form-control" name="goodFastO4" id="goodFastO4"></td>
                                                    <td><input type="text" class="form-control" name="fairFastO4" id="fairFastO4"></td>
                                                    <td><input type="text" class="form-control" name="adjustFastO4" id="adjustFastO4"></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialFastO4">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialFastO4">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceFastO4">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Super Fast</td>
                                                    <td><input type="text" class="form-control" name="TIGSuperFastO4" id="TIGSuperFastO4"></td>
                                                    <td><input type="text" class="form-control" name="ESYSuperFastO4" id="ESYSuperFastO4"></td>
                                                    <td><input type="text" class="form-control" name="estimateSuperFastO4" id="estimateSuperFastO4"></td>
                                                    <td><input type="text" class="form-control" name="ExcellentSuperFastO4" id="ExcellentSuperFastO4"></td>
                                                    <td><input type="text" class="form-control" name="very_goodSuperFastO4" id="very_goodSuperFastO4"></td>
                                                    <td><input type="text" class="form-control" name="goodSuperFastO4" id="goodSuperFastO4"></td>
                                                    <td><input type="text" class="form-control" name="fairSuperFastO4" id="fairSuperFastO4"></td>
                                                    <td><input type="text" class="form-control" name="adjustSuperFastO4" id="adjustSuperFastO4"></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialSuperFastO4">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialSuperFastO4">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceSuperFastO4">
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
                                                    <td><input type="text" class="form-control" name="TIGNormalO3" id="TIGNormalO3"></td>
                                                    <td><input type="text" class="form-control" name="ESYNormalO3" id="ESYNormalO3"></td>
                                                    <td><input type="text" class="form-control" name="estimateNormalO3" id="estimateNormalO3"></td>
                                                    <td><input type="text" class="form-control" name="ExcellentNormalO3" id="ExcellentNormalO3"></td>
                                                    <td><input type="text" class="form-control" name="very_goodNormalO3" id="very_goodNormalO3"></td>
                                                    <td><input type="text" class="form-control" name="goodNormalO3" id="goodNormalO3"></td>
                                                    <td><input type="text" class="form-control" name="fairNormalO3" id="fairNormalO3"></td>
                                                    <td><input type="text" class="form-control" name="adjustNormalO3" id="adjustNormalO3"></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialNormalO3">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialNormalO3">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceNormalO3">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Fast</td>
                                                    <td><input type="text" class="form-control" name="TIGFastO3" id="TIGFastO3"></td>
                                                    <td><input type="text" class="form-control" name="ESYFastO3" id="ESYFastO3"></td>
                                                    <td><input type="text" class="form-control" name="estimateFastO3" id="estimateFastO3"></td>
                                                    <td><input type="text" class="form-control" name="ExcellentFastO3" id="ExcellentFastO3"></td>
                                                    <td><input type="text" class="form-control" name="very_goodFastO3" id="very_goodFastO3"></td>
                                                    <td><input type="text" class="form-control" name="goodFastO3" id="goodFastO3"></td>
                                                    <td><input type="text" class="form-control" name="fairFastO3" id="fairFastO3"></td>
                                                    <td><input type="text" class="form-control" name="adjustFastO3" id="adjustFastO3"></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialFastO3">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialFastO3">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceFastO3">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Super Fast</td>
                                                    <td><input type="text" class="form-control" name="TIGSuperFastO3" id="TIGSuperFastO3"></td>
                                                    <td><input type="text" class="form-control" name="ESYSuperFastO3" id="ESYSuperFastO3"></td>
                                                    <td><input type="text" class="form-control" name="estimateSuperFastO3" id="estimateSuperFastO3"></td>
                                                    <td><input type="text" class="form-control" name="ExcellentSuperFastO3" id="ExcellentSuperFastO3"></td>
                                                    <td><input type="text" class="form-control" name="very_goodSuperFastO3" id="very_goodSuperFastO3"></td>
                                                    <td><input type="text" class="form-control" name="goodSuperFastO3" id="goodSuperFastO3"></td>
                                                    <td><input type="text" class="form-control" name="fairSuperFastO3" id="fairSuperFastO3"></td>
                                                    <td><input type="text" class="form-control" name="adjustSuperFastO3" id="adjustSuperFastO3"></td>
                                                    <td style="display: grid; justify-content: center; align-items: center;">
                                                        <input class="form-check-input" type="checkbox" value="P" id="PotentialSuperFastO3">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="HP" id="HightPotentialSuperFastO3">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="MasterPieceSuperFastO3">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../assets/src/footer.php' ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Add fuction -->
    <script>
        document.getElementById('AddPAform').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Get form field values
            var meet = document.getElementById('Meet').value;
            var activeDate = document.getElementById('Active_Date').value;
            var documentFile = document.getElementById('document_file').files[0];

            // Check if required fields are filled
            if (!meet || !activeDate || !documentFile) {
                Swal.fire({
                    title: "เกิดข้อผิดพลาด",
                    text: "กรุณากรอกข้อมูลวันที่ประชุม วันที่กำหนดใช้เกณฑ์และแนบไฟล์หลักฐานการประชุมให้ครบถ้วน",
                    icon: "error",
                });
                return; // Stop form submission
            }

            var formData = new FormData();
            formData.append('document', documentFile);
            formData.append('Meet', meet);
            formData.append('Active_Date', activeDate);

            // S4
            // Normal
            formData.append('PA_levelNormalS4', 'S4');
            formData.append('TIGNormalS4', document.getElementById('TIGNormalS4').value);
            formData.append('ESYNormalS4', document.getElementById('ESYNormalS4').value);
            formData.append('estimateNormalS4', document.getElementById('estimateNormalS4').value);
            formData.append('PotentialNormalS4', document.getElementById('PotentialNormalS4').checked ? 'P' : '');
            formData.append('HightPotentialNormalS4', document.getElementById('HightPotentialNormalS4').checked ? 'HP' : '');
            formData.append('MasterPieceNormalS4', document.getElementById('MasterPieceNormalS4').checked ? 1 : 0);
            formData.append('ExcellentNormalS4', document.getElementById('ExcellentNormalS4').value);
            formData.append('very_goodNormalS4', document.getElementById('very_goodNormalS4').value);
            formData.append('goodNormalS4', document.getElementById('goodNormalS4').value);
            formData.append('fairNormalS4', document.getElementById('fairNormalS4').value);
            formData.append('adjustNormalS4', document.getElementById('adjustNormalS4').value);
            formData.append('TagNormalS4', 'Normal');

            //Fast
            formData.append('PA_levelFastS4', 'S4');
            formData.append('TIGFastS4', document.getElementById('TIGFastS4').value);
            formData.append('ESYFastS4', document.getElementById('ESYFastS4').value);
            formData.append('estimateFastS4', document.getElementById('estimateFastS4').value);
            formData.append('PotentialFastS4', document.getElementById('PotentialFastS4').checked ? 'P' : '');
            formData.append('HightPotentialFastS4', document.getElementById('HightPotentialFastS4').checked ? 'HP' : '');
            formData.append('MasterPieceFastS4', document.getElementById('MasterPieceFastS4').checked ? 1 : 0);
            formData.append('ExcellentFastS4', document.getElementById('ExcellentFastS4').value);
            formData.append('very_goodFastS4', document.getElementById('very_goodFastS4').value);
            formData.append('goodFastS4', document.getElementById('goodFastS4').value);
            formData.append('fairFastS4', document.getElementById('fairFastS4').value);
            formData.append('adjustFastS4', document.getElementById('adjustFastS4').value);
            formData.append('TagFastS4', 'Fast');
            //Super Fast
            formData.append('PA_levelSuperFastS4', 'S4');
            formData.append('TIGSuperFastS4', document.getElementById('TIGSuperFastS4').value);
            formData.append('ESYSuperFastS4', document.getElementById('ESYSuperFastS4').value);
            formData.append('estimateSuperFastS4', document.getElementById('estimateSuperFastS4').value);
            formData.append('PotentialSuperFastS4', document.getElementById('PotentialSuperFastS4').checked ? 'P' : '');
            formData.append('HightPotentialSuperFastS4', document.getElementById('HightPotentialSuperFastS4').checked ? 'HP' : '');
            formData.append('MasterPieceSuperFastS4', document.getElementById('MasterPieceSuperFastS4').checked ? 1 : 0);
            formData.append('ExcellentSuperFastS4', document.getElementById('ExcellentSuperFastS4').value);
            formData.append('very_goodSuperFastS4', document.getElementById('very_goodSuperFastS4').value);
            formData.append('goodSuperFastS4', document.getElementById('goodSuperFastS4').value);
            formData.append('fairSuperFastS4', document.getElementById('fairSuperFastS4').value);
            formData.append('adjustSuperFastS4', document.getElementById('adjustSuperFastS4').value);
            formData.append('TagSuperFastS4', 'Super Fast');

            // S3
            // Normal
            formData.append('PA_levelNormalS3', 'S3');
            formData.append('TIGNormalS3', document.getElementById('TIGNormalS3').value);
            formData.append('ESYNormalS3', document.getElementById('ESYNormalS3').value);
            formData.append('estimateNormalS3', document.getElementById('estimateNormalS3').value);
            formData.append('PotentialNormalS3', document.getElementById('PotentialNormalS3').checked ? 'P' : '');
            formData.append('HightPotentialNormalS3', document.getElementById('HightPotentialNormalS3').checked ? 'HP' : '');
            formData.append('MasterPieceNormalS3', document.getElementById('MasterPieceNormalS3').checked ? 1 : 0);
            formData.append('ExcellentNormalS3', document.getElementById('ExcellentNormalS3').value);
            formData.append('very_goodNormalS3', document.getElementById('very_goodNormalS3').value);
            formData.append('goodNormalS3', document.getElementById('goodNormalS3').value);
            formData.append('fairNormalS3', document.getElementById('fairNormalS3').value);
            formData.append('adjustNormalS3', document.getElementById('adjustNormalS3').value);
            formData.append('TagNormalS3', 'Normal');
            //Fast
            formData.append('PA_levelFastS3', 'S3');
            formData.append('TIGFastS3', document.getElementById('TIGFastS3').value);
            formData.append('ESYFastS3', document.getElementById('ESYFastS3').value);
            formData.append('estimateFastS3', document.getElementById('estimateFastS3').value);
            formData.append('PotentialFastS3', document.getElementById('PotentialFastS3').checked ? 'P' : '');
            formData.append('HightPotentialFastS3', document.getElementById('HightPotentialFastS3').checked ? 'HP' : '');
            formData.append('MasterPieceFastS3', document.getElementById('MasterPieceFastS3').checked ? 1 : 0);
            formData.append('ExcellentFastS3', document.getElementById('ExcellentFastS3').value);
            formData.append('very_goodFastS3', document.getElementById('very_goodFastS3').value);
            formData.append('goodFastS3', document.getElementById('goodFastS3').value);
            formData.append('fairFastS3', document.getElementById('fairFastS3').value);
            formData.append('adjustFastS3', document.getElementById('adjustFastS3').value);
            formData.append('TagFastS3', 'Fast');
            //Super Fast
            formData.append('PA_levelSuperFastS3', 'S3');
            formData.append('TIGSuperFastS3', document.getElementById('TIGSuperFastS3').value);
            formData.append('ESYSuperFastS3', document.getElementById('ESYSuperFastS3').value);
            formData.append('estimateSuperFastS3', document.getElementById('estimateSuperFastS3').value);
            formData.append('PotentialSuperFastS3', document.getElementById('PotentialSuperFastS3').checked ? 'P' : '');
            formData.append('HightPotentialSuperFastS3', document.getElementById('HightPotentialSuperFastS3').checked ? 'HP' : '');
            formData.append('MasterPieceSuperFastS3', document.getElementById('MasterPieceSuperFastS3').checked ? 1 : 0);
            formData.append('ExcellentSuperFastS3', document.getElementById('ExcellentSuperFastS3').value);
            formData.append('very_goodSuperFastS3', document.getElementById('very_goodSuperFastS3').value);
            formData.append('goodSuperFastS3', document.getElementById('goodSuperFastS3').value);
            formData.append('fairSuperFastS3', document.getElementById('fairSuperFastS3').value);
            formData.append('adjustSuperFastS3', document.getElementById('adjustSuperFastS3').value);
            formData.append('TagSuperFastS3', 'Super Fast');

            // S2
            // Normal
            formData.append('PA_levelNormalS2', 'S2');
            formData.append('TIGNormalS2', document.getElementById('TIGNormalS2').value);
            formData.append('ESYNormalS2', document.getElementById('ESYNormalS2').value);
            formData.append('estimateNormalS2', document.getElementById('estimateNormalS2').value);
            formData.append('PotentialNormalS2', document.getElementById('PotentialNormalS2').checked ? 'P' : '');
            formData.append('HightPotentialNormalS2', document.getElementById('HightPotentialNormalS2').checked ? 'HP' : '');
            formData.append('MasterPieceNormalS2', document.getElementById('MasterPieceNormalS2').checked ? 1 : 0);
            formData.append('ExcellentNormalS2', document.getElementById('ExcellentNormalS2').value);
            formData.append('very_goodNormalS2', document.getElementById('very_goodNormalS2').value);
            formData.append('goodNormalS2', document.getElementById('goodNormalS2').value);
            formData.append('fairNormalS2', document.getElementById('fairNormalS2').value);
            formData.append('adjustNormalS2', document.getElementById('adjustNormalS2').value);
            formData.append('TagNormalS2', 'Normal');
            //Fast
            formData.append('PA_levelFastS2', 'S2');
            formData.append('TIGFastS2', document.getElementById('TIGFastS2').value);
            formData.append('ESYFastS2', document.getElementById('ESYFastS2').value);
            formData.append('estimateFastS2', document.getElementById('estimateFastS2').value);
            formData.append('PotentialFastS2', document.getElementById('PotentialFastS2').checked ? 'P' : '');
            formData.append('HightPotentialFastS2', document.getElementById('HightPotentialFastS2').checked ? 'HP' : '');
            formData.append('MasterPieceFastS2', document.getElementById('MasterPieceFastS2').checked ? 1 : 0);
            formData.append('ExcellentFastS2', document.getElementById('ExcellentFastS2').value);
            formData.append('very_goodFastS2', document.getElementById('very_goodFastS2').value);
            formData.append('goodFastS2', document.getElementById('goodFastS2').value);
            formData.append('fairFastS2', document.getElementById('fairFastS2').value);
            formData.append('adjustFastS2', document.getElementById('adjustFastS2').value);
            formData.append('TagFastS2', 'Fast');
            //Super Fast
            formData.append('PA_levelSuperFastS2', 'S2');
            formData.append('TIGSuperFastS2', document.getElementById('TIGSuperFastS2').value);
            formData.append('ESYSuperFastS2', document.getElementById('ESYSuperFastS2').value);
            formData.append('estimateSuperFastS2', document.getElementById('estimateSuperFastS2').value);
            formData.append('PotentialSuperFastS2', document.getElementById('PotentialSuperFastS2').checked ? 'P' : '');
            formData.append('HightPotentialSuperFastS2', document.getElementById('HightPotentialSuperFastS2').checked ? 'HP' : '');
            formData.append('MasterPieceSuperFastS2', document.getElementById('MasterPieceSuperFastS2').checked ? 1 : 0);
            formData.append('ExcellentSuperFastS2', document.getElementById('ExcellentSuperFastS2').value);
            formData.append('very_goodSuperFastS2', document.getElementById('very_goodSuperFastS2').value);
            formData.append('goodSuperFastS2', document.getElementById('goodSuperFastS2').value);
            formData.append('fairSuperFastS2', document.getElementById('fairSuperFastS2').value);
            formData.append('adjustSuperFastS2', document.getElementById('adjustSuperFastS2').value);
            formData.append('TagSuperFastS2', 'Super Fast');

            // S1
            // Normal
            formData.append('PA_levelNormalS1', 'S1');
            formData.append('TIGNormalS1', document.getElementById('TIGNormalS1').value);
            formData.append('ESYNormalS1', document.getElementById('ESYNormalS1').value);
            formData.append('estimateNormalS1', document.getElementById('estimateNormalS1').value);
            formData.append('PotentialNormalS1', document.getElementById('PotentialNormalS1').checked ? 'P' : '');
            formData.append('HightPotentialNormalS1', document.getElementById('HightPotentialNormalS1').checked ? 'HP' : '');
            formData.append('MasterPieceNormalS1', document.getElementById('MasterPieceNormalS1').checked ? 1 : 0);
            formData.append('ExcellentNormalS1', document.getElementById('ExcellentNormalS1').value);
            formData.append('very_goodNormalS1', document.getElementById('very_goodNormalS1').value);
            formData.append('goodNormalS1', document.getElementById('goodNormalS1').value);
            formData.append('fairNormalS1', document.getElementById('fairNormalS1').value);
            formData.append('adjustNormalS1', document.getElementById('adjustNormalS1').value);
            formData.append('TagNormalS1', 'Normal');
            //Fast
            formData.append('PA_levelFastS1', 'S1');
            formData.append('TIGFastS1', document.getElementById('TIGFastS1').value);
            formData.append('ESYFastS1', document.getElementById('ESYFastS1').value);
            formData.append('estimateFastS1', document.getElementById('estimateFastS1').value);
            formData.append('PotentialFastS1', document.getElementById('PotentialFastS1').checked ? 'P' : '');
            formData.append('HightPotentialFastS1', document.getElementById('HightPotentialFastS1').checked ? 'HP' : '');
            formData.append('MasterPieceFastS1', document.getElementById('MasterPieceFastS1').checked ? 1 : 0);
            formData.append('ExcellentFastS1', document.getElementById('ExcellentFastS1').value);
            formData.append('very_goodFastS1', document.getElementById('very_goodFastS1').value);
            formData.append('goodFastS1', document.getElementById('goodFastS1').value);
            formData.append('fairFastS1', document.getElementById('fairFastS1').value);
            formData.append('adjustFastS1', document.getElementById('adjustFastS1').value);
            formData.append('TagFastS1', 'Fast');
            //Super Fast
            formData.append('PA_levelSuperFastS1', 'S1');
            formData.append('TIGSuperFastS1', document.getElementById('TIGSuperFastS1').value);
            formData.append('ESYSuperFastS1', document.getElementById('ESYSuperFastS1').value);
            formData.append('estimateSuperFastS1', document.getElementById('estimateSuperFastS1').value);
            formData.append('PotentialSuperFastS1', document.getElementById('PotentialSuperFastS1').checked ? 'P' : '');
            formData.append('HightPotentialSuperFastS1', document.getElementById('HightPotentialSuperFastS1').checked ? 'HP' : '');
            formData.append('MasterPieceSuperFastS1', document.getElementById('MasterPieceSuperFastS1').checked ? 1 : 0);
            formData.append('ExcellentSuperFastS1', document.getElementById('ExcellentSuperFastS1').value);
            formData.append('very_goodSuperFastS1', document.getElementById('very_goodSuperFastS1').value);
            formData.append('goodSuperFastS1', document.getElementById('goodSuperFastS1').value);
            formData.append('fairSuperFastS1', document.getElementById('fairSuperFastS1').value);
            formData.append('adjustSuperFastS1', document.getElementById('adjustSuperFastS1').value);
            formData.append('TagSuperFastS1', 'Super Fast');

            // O5
            // Normal
            formData.append('PA_levelNormalO5', 'O5');
            formData.append('TIGNormalO5', document.getElementById('TIGNormalO5').value);
            formData.append('ESYNormalO5', document.getElementById('ESYNormalO5').value);
            formData.append('estimateNormalO5', document.getElementById('estimateNormalO5').value);
            formData.append('PotentialNormalO5', document.getElementById('PotentialNormalO5').checked ? 'P' : '');
            formData.append('HightPotentialNormalO5', document.getElementById('HightPotentialNormalO5').checked ? 'HP' : '');
            formData.append('MasterPieceNormalO5', document.getElementById('MasterPieceNormalO5').checked ? 1 : 0);
            formData.append('ExcellentNormalO5', document.getElementById('ExcellentNormalO5').value);
            formData.append('very_goodNormalO5', document.getElementById('very_goodNormalO5').value);
            formData.append('goodNormalO5', document.getElementById('goodNormalO5').value);
            formData.append('fairNormalO5', document.getElementById('fairNormalO5').value);
            formData.append('adjustNormalO5', document.getElementById('adjustNormalO5').value);
            formData.append('TagNormalO5', 'Normal');
            //Fast
            formData.append('PA_levelFastO5', 'O5');
            formData.append('TIGFastO5', document.getElementById('TIGFastO5').value);
            formData.append('ESYFastO5', document.getElementById('ESYFastO5').value);
            formData.append('estimateFastO5', document.getElementById('estimateFastO5').value);
            formData.append('PotentialFastO5', document.getElementById('PotentialFastO5').checked ? 'P' : '');
            formData.append('HightPotentialFastO5', document.getElementById('HightPotentialFastO5').checked ? 'HP' : '');
            formData.append('MasterPieceFastO5', document.getElementById('MasterPieceFastO5').checked ? 1 : 0);
            formData.append('ExcellentFastO5', document.getElementById('ExcellentFastO5').value);
            formData.append('very_goodFastO5', document.getElementById('very_goodFastO5').value);
            formData.append('goodFastO5', document.getElementById('goodFastO5').value);
            formData.append('fairFastO5', document.getElementById('fairFastO5').value);
            formData.append('adjustFastO5', document.getElementById('adjustFastO5').value);
            formData.append('TagFastO5', 'Fast');
            //Super Fast
            formData.append('PA_levelSuperFastO5', 'O5');
            formData.append('TIGSuperFastO5', document.getElementById('TIGSuperFastO5').value);
            formData.append('ESYSuperFastO5', document.getElementById('ESYSuperFastO5').value);
            formData.append('estimateSuperFastO5', document.getElementById('estimateSuperFastO5').value);
            formData.append('PotentialSuperFastO5', document.getElementById('PotentialSuperFastO5').checked ? 'P' : '');
            formData.append('HightPotentialSuperFastO5', document.getElementById('HightPotentialSuperFastO5').checked ? 'HP' : '');
            formData.append('MasterPieceSuperFastO5', document.getElementById('MasterPieceSuperFastO5').checked ? 1 : 0);
            formData.append('ExcellentSuperFastO5', document.getElementById('ExcellentSuperFastO5').value);
            formData.append('very_goodSuperFastO5', document.getElementById('very_goodSuperFastO5').value);
            formData.append('goodSuperFastO5', document.getElementById('goodSuperFastO5').value);
            formData.append('fairSuperFastO5', document.getElementById('fairSuperFastO5').value);
            formData.append('adjustSuperFastO5', document.getElementById('adjustSuperFastO5').value);
            formData.append('TagSuperFastO5', 'Super Fast');


            // O4
            // Normal
            formData.append('PA_levelNormalO4', 'O4');
            formData.append('TIGNormalO4', document.getElementById('TIGNormalO4').value);
            formData.append('ESYNormalO4', document.getElementById('ESYNormalO4').value);
            formData.append('estimateNormalO4', document.getElementById('estimateNormalO4').value);
            formData.append('PotentialNormalO4', document.getElementById('PotentialNormalO4').checked ? 'P' : '');
            formData.append('HightPotentialNormalO4', document.getElementById('HightPotentialNormalO4').checked ? 'HP' : '');
            formData.append('MasterPieceNormalO4', document.getElementById('MasterPieceNormalO4').checked ? 1 : 0);
            formData.append('ExcellentNormalO4', document.getElementById('ExcellentNormalO4').value);
            formData.append('very_goodNormalO4', document.getElementById('very_goodNormalO4').value);
            formData.append('goodNormalO4', document.getElementById('goodNormalO4').value);
            formData.append('fairNormalO4', document.getElementById('fairNormalO4').value);
            formData.append('adjustNormalO4', document.getElementById('adjustNormalO4').value);
            formData.append('TagNormalO4', 'Normal');
            //Fast
            formData.append('PA_levelFastO4', 'O4');
            formData.append('TIGFastO4', document.getElementById('TIGFastO4').value);
            formData.append('ESYFastO4', document.getElementById('ESYFastO4').value);
            formData.append('estimateFastO4', document.getElementById('estimateFastO4').value);
            formData.append('PotentialFastO4', document.getElementById('PotentialFastO4').checked ? 'P' : '');
            formData.append('HightPotentialFastO4', document.getElementById('HightPotentialFastO4').checked ? 'HP' : '');
            formData.append('MasterPieceFastO4', document.getElementById('MasterPieceFastO4').checked ? 1 : 0);
            formData.append('ExcellentFastO4', document.getElementById('ExcellentFastO4').value);
            formData.append('very_goodFastO4', document.getElementById('very_goodFastO4').value);
            formData.append('goodFastO4', document.getElementById('goodFastO4').value);
            formData.append('fairFastO4', document.getElementById('fairFastO4').value);
            formData.append('adjustFastO4', document.getElementById('adjustFastO4').value);
            formData.append('TagFastO4', 'Fast');
            //Super Fast
            formData.append('PA_levelSuperFastO4', 'O4');
            formData.append('TIGSuperFastO4', document.getElementById('TIGSuperFastO4').value);
            formData.append('ESYSuperFastO4', document.getElementById('ESYSuperFastO4').value);
            formData.append('estimateSuperFastO4', document.getElementById('estimateSuperFastO4').value);
            formData.append('PotentialSuperFastO4', document.getElementById('PotentialSuperFastO4').checked ? 'P' : '');
            formData.append('HightPotentialSuperFastO4', document.getElementById('HightPotentialSuperFastO4').checked ? 'HP' : '');
            formData.append('MasterPieceSuperFastO4', document.getElementById('MasterPieceSuperFastO4').checked ? 1 : 0);
            formData.append('ExcellentSuperFastO4', document.getElementById('ExcellentSuperFastO4').value);
            formData.append('very_goodSuperFastO4', document.getElementById('very_goodSuperFastO4').value);
            formData.append('goodSuperFastO4', document.getElementById('goodSuperFastO4').value);
            formData.append('fairSuperFastO4', document.getElementById('fairSuperFastO4').value);
            formData.append('adjustSuperFastO4', document.getElementById('adjustSuperFastO4').value);
            formData.append('TagSuperFastO4', 'Super Fast');


            // O3
            // Normal
            formData.append('PA_levelNormalO3', 'O3');
            formData.append('TIGNormalO3', document.getElementById('TIGNormalO3').value);
            formData.append('ESYNormalO3', document.getElementById('ESYNormalO3').value);
            formData.append('estimateNormalO3', document.getElementById('estimateNormalO3').value);
            formData.append('PotentialNormalO3', document.getElementById('PotentialNormalO3').checked ? 'P' : '');
            formData.append('HightPotentialNormalO3', document.getElementById('HightPotentialNormalO3').checked ? 'HP' : '');
            formData.append('MasterPieceNormalO3', document.getElementById('MasterPieceNormalO3').checked ? 1 : 0);
            formData.append('ExcellentNormalO3', document.getElementById('ExcellentNormalO3').value);
            formData.append('very_goodNormalO3', document.getElementById('very_goodNormalO3').value);
            formData.append('goodNormalO3', document.getElementById('goodNormalO3').value);
            formData.append('fairNormalO3', document.getElementById('fairNormalO3').value);
            formData.append('adjustNormalO3', document.getElementById('adjustNormalO3').value);
            formData.append('TagNormalO3', 'Normal');
            //Fast
            formData.append('PA_levelFastO3', 'O3');
            formData.append('TIGFastO3', document.getElementById('TIGFastO3').value);
            formData.append('ESYFastO3', document.getElementById('ESYFastO3').value);
            formData.append('estimateFastO3', document.getElementById('estimateFastO3').value);
            formData.append('PotentialFastO3', document.getElementById('PotentialFastO3').checked ? 'P' : '');
            formData.append('HightPotentialFastO3', document.getElementById('HightPotentialFastO3').checked ? 'HP' : '');
            formData.append('MasterPieceFastO3', document.getElementById('MasterPieceFastO3').checked ? 1 : 0);
            formData.append('ExcellentFastO3', document.getElementById('ExcellentFastO3').value);
            formData.append('very_goodFastO3', document.getElementById('very_goodFastO3').value);
            formData.append('goodFastO3', document.getElementById('goodFastO3').value);
            formData.append('fairFastO3', document.getElementById('fairFastO3').value);
            formData.append('adjustFastO3', document.getElementById('adjustFastO3').value);
            formData.append('TagFastO3', 'Fast');
            //Super Fast
            formData.append('PA_levelSuperFastO3', 'O3');
            formData.append('TIGSuperFastO3', document.getElementById('TIGSuperFastO3').value);
            formData.append('ESYSuperFastO3', document.getElementById('ESYSuperFastO3').value);
            formData.append('estimateSuperFastO3', document.getElementById('estimateSuperFastO3').value);
            formData.append('PotentialSuperFastO3', document.getElementById('PotentialSuperFastO3').checked ? 'P' : '');
            formData.append('HightPotentialSuperFastO3', document.getElementById('HightPotentialSuperFastO3').checked ? 'HP' : '');
            formData.append('MasterPieceSuperFastO3', document.getElementById('MasterPieceSuperFastO3').checked ? 1 : 0);
            formData.append('ExcellentSuperFastO3', document.getElementById('ExcellentSuperFastO3').value);
            formData.append('very_goodSuperFastO3', document.getElementById('very_goodSuperFastO3').value);
            formData.append('goodSuperFastO3', document.getElementById('goodSuperFastO3').value);
            formData.append('fairSuperFastO3', document.getElementById('fairSuperFastO3').value);
            formData.append('adjustSuperFastO3', document.getElementById('adjustSuperFastO3').value);
            formData.append('TagSuperFastO3', 'Super Fast');


            fetch('./backend/addPa.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.text(); // เปลี่ยนจาก response.json() เป็น response.text() เพื่อดีบัก
                })
                .then(text => {
                    try {
                        const data = JSON.parse(text); // ทำการ parse JSON
                        console.log('Parsed data:', data);
                        if (data.success) {
                            Swal.fire({
                                title: "บันทึกข้อมูลสำเร็จ",
                                icon: "success",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'paAdmin.php';
                                }
                            });
                        } else {
                            let errorMsg = 'เกิดข้อผิดพลาด';
                            for (const key in data) {
                                if (data[key].error) {
                                    errorMsg += ` (${key}): ${data[key].error}`;
                                }
                            }
                            console.log('Error data:', errorMsg);
                            Swal.fire({
                                title: "เกิดข้อผิดพลาด",
                                text: errorMsg,
                                icon: "error",
                            });
                        }
                    } catch (error) {
                        console.error('Error parsing JSON:', error);
                        console.log('Response text:', text); // แสดงข้อความที่ได้รับเพื่อดีบัก
                        Swal.fire({
                            title: "เกิดข้อผิดพลาด",
                            text: "โปรดกรอกข้อมูลเป็นตัวเลข",
                            icon: "error",
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: "เกิดข้อผิดพลาด",
                        text: "กรุณาลองอีกครั้ง",
                        icon: "error",
                    });
                });

        });
    </script>
</body>

</html>