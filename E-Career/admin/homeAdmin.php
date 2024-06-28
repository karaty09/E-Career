<?php
include '../db/connect.php';
include '../login/loginCheckSession.php';

// $empPl = "O3";
// $criteriaSql = "SELECT * FROM PA_standard WHERE Active_Date = (SELECT MAX(Active_Date) FROM PA_standard) AND PA_level = :pl_level";
// $stmt = $db->prepare($criteriaSql);
// $stmt->bindParam("pl_level", $empPl);
// $stmt->execute();
// $criteria = $stmt->fetchAll();
// var_dump($criteria);

function checkForEligible($db, $empPl, $empArr, $empTig, $empEsy, $empP, $empHP, $empMP){
    $empPotentialArr = [
        "p"=> $empP,
        "hp"=> $empHP,
        "mp"=> $empMP
    ];

    $currentTag = [
        "Super Fast",
        "Fast",
        "Normal"
    ];

    $resultTag = [];
    for ($tagIndex=0; $tagIndex < count($currentTag); $tagIndex++) { 
        $criteriaSql = "SELECT * FROM PA_standard WHERE Active_Date = (SELECT MAX(Active_Date) FROM PA_standard) AND PA_level = :pl_level AND Tag = :tag";  // รับค่าเกณฑ์มาจาก DB โดยอ้างอิงจากวันที่ล่าสุดที่ประกาศใช้ (Active Date) ในแต่ละ Tag ของแต่ละ PL Level
        $stmt = $db->prepare($criteriaSql);
        $stmt->bindParam("pl_level", $empPl);
        $stmt->bindParam("tag", $currentTag[$tagIndex]);
        $stmt->execute();
        $criteria = $stmt->fetchObject();
        if (empty($criteria)){
            return ["status"=>"N/A", "tag"=>"N/A"];
        }

        // กำหนดคะแนนของ "ดีเลิศ" ถึง "ปรับปรุง"
        $excellent = 5;
        $veryGood = 4;      //success
        $good = 3;          //veryGood
        $fair = 2;          //good
        $adjust = 1;        //poor

        $defineYearLater = $criteria->estimate;
        $defineTig = $criteria->TIG;
        $defineEsy = $criteria->ESY;
        $defineTag = $criteria->Tag;
        // $definePl = $criteria->PA_level;        // PL ?

        $defineExcellentYear = $criteria->Excellent;    //defineExcellentYear
        $defineVeryGoodYear = $criteria->very_good;     //defineSuccessYear
        $defineGoodYear = $criteria->good;              //defineVeryGoodYear
        $defineFairYear = $criteria->fair;              //defineGoodYear
        $defineAdjustYear = $criteria->adjust;          //definePoorYear

        $potential = false;
        $highPotential = false;
        if($criteria->HP){
            if ($criteria->HP == "P"){
                $potential = true;
            }else if($criteria->HP == "HP"){
                $highPotential = true;
            } else if($criteria->HP == "PHP"){
                $potential = true;
                $highPotential = true;
            }else{
                $potential = false;
                $highPotential = false;
            }
        }
        $reqPotential = [
            "p"=> $potential,
            "hp"=> $highPotential,
            "mp"=> $criteria->Master_piece
        ];  // คุณสมบัติพิเศษที่กำหนดไว้
        $eligibleArr = [];      
        /* 
            Array ที่ใช้เก็บค่า True (ไม่มีการเก็บค่า False) เพื่อตรวจสอบว่าพนักงานผ่านเกณฑ์ (Eligible) หรือไม่
            ยกตัวอย่างเช่น
                1. ในการดูผลการประเมินย้อนหลัง 3 ปีพนักงาน A มี eligibleArr = [true, true, true]
                    หมายความว่าพนักงาน A มีสิทธิ์ขอเลี่อนตำแหน่ง (เนื่องจากจำนวน index ของ eligibleArr = จำนวนย้อนหลัง)
                2. หากดูผลการประเมินย้อนหลัง 3 ปีแล้วพบว่าพนักงาน A มี eligibleArr = [true]
                    หมายความว่าพนักงาน A จะไม่มีสิทธิ์ขอเลื่อนตำแหน่งเนื่องจากจำนวน index ของ eligibleArr ไม่เท่ากับจำนวนปีย้อนหลัง
        */

        for ($index=0; $index < $defineYearLater; $index++) { 
            $element = $empArr[$index];

            if (empty($element)){
                break;
            }

            if ($defineExcellentYear != 0){
                if ($element >= $excellent && count($empArr) != 0){
                    array_push($eligibleArr, true);
                    $defineExcellentYear --;
                    continue;
                }
            }

            if ($defineVeryGoodYear != 0){
                if ($element >= $veryGood && count($empArr) != 0){
                    array_push($eligibleArr, true);
                    $defineVeryGoodYear --;
                    continue;
                }
            }

            if ($defineGoodYear != 0){
                if ($element >= $good && count($empArr) != 0){
                    array_push($eligibleArr, true);
                    $defineGoodYear --;
                    continue;
                }
            }

            if ($defineFairYear != 0){
                if ($element >= $fair && count($empArr) != 0){
                    array_push($eligibleArr, true);
                    $defineFairYear --;
                    continue;
                }
            }

            if ($defineAdjustYear != 0){
                if ($element >= $adjust && count($empArr) != 0){
                    array_push($eligibleArr, true);
                    $defineAdjustYear --;
                    continue;
                }
            }
        }
        $isEligible = false;
        if (count($eligibleArr) == $defineYearLater and ($empTig >= $defineTig or $empEsy >= $defineEsy)){
            if ($reqPotential['p'] == true and $reqPotential['hp'] == true){
                if (($empPotentialArr['p'] >= $reqPotential['p'] or $empPotentialArr['hp'] >= $reqPotential['hp']) and $empPotentialArr['mp'] >= $reqPotential['mp']){
                    $isEligible = true;
                }
            }else if ($reqPotential['p'] == false or $reqPotential['hp'] == false){
                if (($empPotentialArr['p'] >= $reqPotential['p'] && $empPotentialArr['hp'] >= $reqPotential['hp'])&& $empPotentialArr['mp'] >= $reqPotential['mp']) {
                    $isEligible = true;
                }
            }
        }
        if ($isEligible){
            array_push($resultTag, $currentTag[$tagIndex]);
            // return "Eligible in $resultTag[$tagIndex]";
            // return ["status"=>"Eligible", "tag"=>str_replace("_", " ", $resultTag[$tagIndex])];
            return ["status"=>"Eligible", "tag"=>$resultTag[$tagIndex], "icon"=>'<center><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" class="bi bi-check-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/></svg></center>', "year"=>[$empArr[0], $empArr[1], $empArr[2], $empArr[3], $empArr[4]], "tig-esy"=>[$empTig, $empEsy], "P-HP"=>[$empP, $empHP]];
        }else{
            array_push($resultTag, false);

            // if ($tagIndex == count($currentTag) - 1){
            //     return ["status"=>"Not Eligible", "tag"=>"None"];
            // }
        }



        // echo $defineExcellentYear;
        // echo $empArr[1];
        // var_dump($reqPotential["mp"]);
        // echo "<br><br><br>";
    }

    // return ["status"=>"Not Eligible", "tag"=>"None"];
    return ["status"=>"Not Eligible", "tag"=>"-", "icon"=>'<center><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-x-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/></svg></center>', "year"=>[$empArr[0], $empArr[1], $empArr[2], $empArr[3], $empArr[4]], "tig-esy"=>[$empTig, $empEsy], "P-HP"=>[$empP, $empHP]];

}

// checkForEligible($db,"O3", [5,4,3,1,1], 4, 8, false, true, false);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">

    <!-- CSS Style -->
    <link rel="stylesheet" href="../assets/src/styles/stylesBody.css">

    <style>
        .font-td-table {
            font-size: 14px;
        }

        /* dataTables Config */
        .dataTables_filter,
        .dataTables_length,
        .dataTables_info {
            display: none;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-left: -80px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <?php include './navbarAdmin.php' ?>

    <!-- Content -->
    <div class="container-fluid mt-3 mb-3">
        <div class="row" style="margin-left: 40px; margin-right: 40px;">
            <div class="col-md-12 col-12" style="padding: 20px; height: 100%; overflow-y: auto;">
                <table class="table table-striped table-bordered" id="tb-data">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Emp ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">Section</th>
                            <th scope="col">Department</th>
                            <th scope="col">Division</th>
                            <th scope="col">Company</th>
                            <th scope="col">PL Level</th>
                            <th scope="col">EMP Type</th>
                            <th scope="col">Salary</th>
                            <th scope="col">Percentile</th>
                            <th scope="col">Master Piece</th>
                            <th scope="col">Eligible</th>
                            <th scope="col">Tag</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM tb_evaluate_employee";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $rows = $stmt->fetchAll();

                        $i = 1;
                        foreach ($rows as $row) {
                            $empP = false;     // ค่าเริ่มต้นของ Potential ก่อนจะส่งเข้าไปในฟังก์ชัน checkForEligible()
                            $empHP = false;     // ค่าเริ่มต้นของ High Potential ก่อนจะส่งเข้าไปในฟังก์ชัน checkForEligible()


                            // แปลงข้อมูลคะแนนให้เป็นรูปแบบเดียวกันคือ 5 ถึง 1
                            // ผลการประเมินย้อนหลังปีที่ 1
                            switch ($row['review_rating_past1y']) {
                                case '1':
                                case 'ดีเลิศ':
                                    $row['review_rating_past1y'] = 5;
                                    break;

                                case '2+':
                                case 'ดีมาก':
                                    $row['review_rating_past1y'] = 4;
                                    break;

                                case '2':
                                case 'ดี':
                                    $row['review_rating_past1y'] = 3;
                                    break;

                                case '3':
                                case 'พอใช้':
                                    $row['review_rating_past1y'] = 2;
                                    break;

                                case '4':
                                case 'ต้องปรับปรุง':
                                    $row['review_rating_past1y'] = 1;
                                    break;

                                default:
                                    $row['review_rating_past1y'] = false;
                                    break;
                            }

                            // ผลการประเมินย้อนหลังปีที่ 2
                            switch ($row['review_rating_past2y']) {
                                case '1':
                                case 'ดีเลิศ':
                                    $row['review_rating_past2y'] = 5;
                                    break;

                                case '2+':
                                case 'ดีมาก':
                                    $row['review_rating_past2y'] = 4;
                                    break;

                                case '2':
                                case 'ดี':
                                    $row['review_rating_past2y'] = 3;
                                    break;

                                case '3':
                                case 'พอใช้':
                                    $row['review_rating_past2y'] = 2;
                                    break;

                                case '4':
                                case 'ต้องปรับปรุง':
                                    $row['review_rating_past2y'] = 1;
                                    break;

                                default:
                                    $row['review_rating_past2y'] = false;
                                    break;
                            }

                            // ผลการประเมินย้อนหลังปีที่ 3
                            switch ($row['review_rating_past3y']) {
                                case '1':
                                case 'ดีเลิศ':
                                    $row['review_rating_past3y'] = 5;
                                    break;

                                case '2+':
                                case 'ดีมาก':
                                    $row['review_rating_past3y'] = 4;
                                    break;

                                case '2':
                                case 'ดี':
                                    $row['review_rating_past3y'] = 3;
                                    break;

                                case '3':
                                case 'พอใช้':
                                    $row['review_rating_past3y'] = 2;
                                    break;

                                case '4':
                                case 'ต้องปรับปรุง':
                                    $row['review_rating_past3y'] = 1;
                                    break;

                                default:
                                    $row['review_rating_past3y'] = false;
                                    break;
                            }

                            // ผลการประเมินย้อนหลังปีที่ 4
                            switch ($row['review_rating_past4y']) {
                                case '1':
                                case 'ดีเลิศ':
                                    $row['review_rating_past4y'] = 5;
                                    break;

                                case '2+':
                                case 'ดีมาก':
                                    $row['review_rating_past4y'] = 4;
                                    break;

                                case '2':
                                case 'ดี':
                                    $row['review_rating_past4y'] = 3;
                                    break;

                                case '3':
                                case 'พอใช้':
                                    $row['review_rating_past4y'] = 2;
                                    break;

                                case '4':
                                case 'ต้องปรับปรุง':
                                    $row['review_rating_past4y'] = 1;
                                    break;

                                default:
                                    $row['review_rating_past4y'] = false;
                                    break;
                            }

                            // ผลการประเมินย้อนหลังปีที่ 5
                            switch ($row['review_rating_past5y']) {
                                case '1':
                                case 'ดีเลิศ':
                                    $row['review_rating_past5y'] = 5;
                                    break;

                                case '2+':
                                case 'ดีมาก':
                                    $row['review_rating_past5y'] = 4;
                                    break;

                                case '2':
                                case 'ดี':
                                    $row['review_rating_past5y'] = 3;
                                    break;

                                case '3':
                                case 'พอใช้':
                                    $row['review_rating_past5y'] = 2;
                                    break;

                                case '4':
                                case 'ต้องปรับปรุง':
                                    $row['review_rating_past5y'] = 1;
                                    break;

                                default:
                                    $row['review_rating_past5y'] = false;
                                    break;
                            }

                            //############################################################################

                            // ตรวจสอบ Potential หรือ High Potential ของพนักงานย้อนหลัง 5 ปี
                            switch ($row['hp_review_rating_past1y']) {
                                case 'P':
                                    $empP = true;
                                    break;
                                case 'HP':
                                    $empHP = true;
                                    break;
                            }

                            switch ($row['hp_review_rating_past2y']) {
                                case 'P':
                                    $empP = true;
                                    break;
                                case 'HP':
                                    $empHP = true;
                                    break;
                            }

                            switch ($row['hp_review_rating_past3y']) {
                                case 'P':
                                    $empP = true;
                                    break;
                                case 'HP':
                                    $empHP = true;
                                    break;
                            }

                            switch ($row['hp_review_rating_past4y']) {
                                case 'P':
                                    $empP = true;
                                    break;
                                case 'HP':
                                    $empHP = true;
                                    break;
                            }

                            switch ($row['hp_review_rating_past5y']) {
                                case 'P':
                                    $empP = true;
                                    break;
                                case 'HP':
                                    $empHP = true;
                                    break;
                            }
                            // var_dump( $empP);
                            // echo "<br><br><br><br><br>";
                            $eligible = checkForEligible(
                                $db,
                                $row['pl_subset_eng'],
                                [
                                    $row['review_rating_past1y'],
                                    $row['review_rating_past2y'],
                                    $row['review_rating_past3y'],
                                    $row['review_rating_past4y'],
                                    $row['review_rating_past5y'],
                                ],
                                $row['pl_year'],
                                $row['esy'],
                                $empP,   //P
                                $empHP,   // HP
                                $row['master_piece']
                                
                            );

                            if ($eligible['status'] == "N/A"  and $eligible['tag'] == "N/A"){
                                $eligibleStatus = "N/A";
                                $eligibleInTag = "N/A";
                                
                            }else{
                                $eligibleStatus = $eligible['icon'];
                                $eligibleInTag = $eligible['tag'];
                                
                                $year = $eligible['year'];  // debug
                                $tig_esy = $eligible['tig-esy'];    //debug
                                $empPotentialArrDebug = $eligible['P-HP'];    //debug
                            }
                            

                        ?>
                            <tr>
                                <td class="font-td-table text-center"><?php echo $i; ?></td>
                                <td class="font-td-table"><?php echo $row['emp_code']; ?></td>
                                <td class="font-td-table"><?php echo $row['name_prefix_th'] . " " . $row['firstname_th'] . " " . $row['lastname_th']; ?></td>
                                <td class="font-td-table"><?php echo $row['position_name_th']; ?></td>
                                <td class="font-td-table"><?php echo $row['section_name']; ?></td>
                                <td class="font-td-table"><?php echo $row['department_name']; ?></td>
                                <td class="font-td-table"><?php echo $row['division_name']; ?></td>
                                <td class="font-td-table"><?php echo $row['company_name']; ?></td>
                                <td class="font-td-table text-center"><?php echo $row['pl_subset_eng']; ?></td>
                                <td class="font-td-table text-center"><?php echo $row['emp_type']; ?></td>
                                <td class="font-td-table text-end"><?php echo number_format($row['salary']); ?></td>
                                <td class="font-td-table"><?php echo $row['percentile_range']; ?></td>
                                <td class="font-td-table"><?php
                                                            if ($row['master_piece'] == 1) {
                                                                echo 'มี Master Piece';
                                                            } else {
                                                                echo 'ไม่มี Master Piece';
                                                            }
                                                            ?></td>
                                <td class="font-td-table">
                                    <?php 
                                        echo $eligibleStatus;
                                    ?>
                                </td>
                                <td class="font-td-table">
                                    <?php 
                                    switch ($eligibleInTag) {
                                        case 'Super Fast':
                                            echo "<span style='color:#b52476'><b>$eligibleInTag</b></span>";
                                            break;
                                        case 'Fast':
                                            echo "<span style='color:#24a9b5'><b>$eligibleInTag</b></span>";
                                            break;
                                        case 'Normal':
                                            echo "<span style='color:#24b535'><b>$eligibleInTag</b></span>";
                                            break;
                                        default:
                                        echo "<span>$eligibleInTag</span>";
                                            break;
                                    }
                                        // echo "<span style='color:#24b535'><b>$eligibleInTag</b></span>"; 
                                    ?>
                                </td>
                                <!-- <td class="font-td-table">
                                    <?php 
                                        echo "$year[0] $year[1] $year[2] $year[3] $year[4]";
                                    ?>
                                </td>
                                <td class="font-td-table">
                                    <?php 
                                        var_dump($tig_esy);
                                    ?>
                                </td> -->
                            </tr>
                        <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include '../assets/src/footer.php' ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <!-- DataTables Config -->
    <script>
        $(document).ready(function() {
            var table = $('#tb-data').DataTable();

            // $('#searchInput').on('keyup', function() {
            //     table.search(this.value).draw();
            // });
        });
    </script>

</body>

</html>