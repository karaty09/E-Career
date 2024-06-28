<?php
include '../db/connect.php';
include '../login/loginCheckSession.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หลักเกณฑ์ Promotion Adjustment (PA)</title>

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
        .size-col-table {
            width: 10%;
        }

        .button-table {
            border: none;
        }

        .img-button-table {
            width: 30px;
            height: 30px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <?php include './navbarAdmin.php' ?>

    <div class="container-fluid mt-3 mb-3">
        <div class="row" style="margin-left: 40px; margin-right: 40px;">
            <div class="col-md-12 col-12" style="padding: 20px; height: 100%;">
                <div class="row mb-3">
                    <div class="col-6 d-flex justify-content-start">
                        <h4 class="text-black">หลักเกณฑ์ Promotion Adjustment (PA) ที่กำลังใช้งาน</h4>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body" style="overflow-y: auto;">
                        <table class="table table-striped table-bordered">
                            <thead class="table-danger">
                                <tr>
                                    <th scope="col" class="text-center">Name</th>
                                    <th scope="col" class="text-center">View Date</th>
                                    <th scope="col" class="text-center">Edit</th>
                                    <th scope="col" class="text-center">PDF File</th>
                                    <th scope="col" class="text-center">Active Date</th>
                                    <th scope="col" class="text-center">Edit By</th>
                                    <th scope="col" class="text-center">Edit Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $PA = "SELECT Meet, Active_Date, Edit_by, Edit_Date, document FROM PA_standard WHERE Active_Date = (SELECT MAX(Active_Date) FROM PA_standard) GROUP BY Meet, Active_Date, Edit_by, Edit_Date, document";
                                $PA_result = $db->prepare($PA);
                                $PA_result->execute();
                                $PA_data = $PA_result->fetchAll();
                                if ($PA_result->rowCount() > 0) {
                                    foreach ($PA_data as $row) {
                                        $active_date = DateTime::createFromFormat('Y-m-d', $row['Active_Date'])->format('d-m-Y');
                                        $edit_date = DateTime::createFromFormat('Y-m-d', $row['Edit_Date'])->format('d-m-Y');
                                        $meet_date = DateTime::createFromFormat('Y-m-d', $row['Meet'])->format('d-m-Y');
                                ?>
                                        <tr>
                                            <td class="text-start"> หลักเกณฑ์ Promotion Adjustment ประชุมบุคคล ณ <?php echo ($meet_date) ?></td>
                                            <td class="text-center">
                                                <button type="button" class="button-table" onclick="sendMeet('<?php echo $row['Meet']; ?>')">
                                                    <img src="../assets/img/search.png" alt="" class="img-button-table">
                                                </button>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="button-table" onclick="sendMeetEdit('<?php echo $row['Meet']; ?>')">
                                                    <img src="../assets/img/pencil.png" alt="" class="img-button-table">
                                                </button>
                                            </td>
                                            <td class="text-center">
                                                <button class="button-table" id="<?php echo $row['Meet']; ?>" onclick="window.open('../assets/filedata/PA_pdf/<?php echo (!empty($row['document']) ? $row['document'] : '-'); ?>', '_blank')">
                                                    <img src="../assets/img/docs.png" alt="" class="img-button-table">
                                                </button>
                                            </td>
                                            <td class="text-center"><?php echo ($active_date) ?></td>
                                            <td class="text-center"><?php echo $row['Edit_by'] ?></td>
                                            <td class="text-center"><?php echo ($edit_date) ?></td>
                                        </tr>
                                <?php
                                  }} else {
                                    // Handle case where no rows are returned, maybe display a message
                                    echo '<tr><td colspan="8" class="text-center">ไม่มีข้อมูลหลักเกณฑ์ในการประเมิน PA Level ที่บันทึก</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--หลักเกณฑ์ทั้งหมด -->
    <div class="container-fluid mt-3 mb-3">
        <div class="row" style="margin-left: 40px; margin-right: 40px;">
            <div class="col-md-12 col-12" style="padding: 20px; height: 100%;">
                <div class="row mb-3">
                    <div class="col-6 d-flex justify-content-start">
                        <h4 class="text-black">หลักเกณฑ์ Promotion Adjustment (PA)</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <a id="linkapi" class="btn btn-primary" href="addPAAdmin.php">เพิ่มเกณฑ์ Promotion Adjustment (PA)</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body" style="overflow-y: auto;">
                        <table class="table table-striped table-bordered">
                            <thead class="table-danger">
                                <tr>
                                    <th scope="col" class="text-center">NO</th>
                                    <th scope="col" class="text-center">Name</th>
                                    <th scope="col" class="text-center">View Date</th>
                                    <th scope="col" class="text-center">Edit</th>
                                    <th scope="col" class="text-center">PDF File</th>
                                    <th scope="col" class="text-center">Active Date</th>
                                    <th scope="col" class="text-center">Edit By</th>
                                    <th scope="col" class="text-center">Edit Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $PA = "SELECT Meet, Active_Date, Edit_by, Edit_Date, document FROM PA_standard GROUP BY Meet, Active_Date, Edit_by, Edit_Date, document";
                                $PA_result = $db->prepare($PA);
                                $PA_result->execute();
                                $PA_data = $PA_result->fetchAll();
                                if ($PA_result->rowCount() > 0) {
                                    $i = 1;
                                    foreach ($PA_data as $row) {
                                        $active_date = DateTime::createFromFormat('Y-m-d', $row['Active_Date'])->format('d-m-Y');
                                        $edit_date = DateTime::createFromFormat('Y-m-d', $row['Edit_Date'])->format('d-m-Y');
                                        $meet_date = DateTime::createFromFormat('Y-m-d', $row['Meet'])->format('d-m-Y');
                                ?>
                                        <tr>
                                            <td scope="row" class="text-center"><?php echo $i ?></td>
                                            <td class="text-start"> หลักเกณฑ์ Promotion Adjustment ประชุมบุคคล ณ <?php echo ($meet_date) ?></td>
                                            <td class="text-center">
                                                <button type="button" class="button-table" onclick="sendMeet('<?php echo $row['Meet']; ?>')">
                                                    <img src="../assets/img/search.png" alt="" class="img-button-table">
                                                </button>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="button-table" onclick="sendMeetEdit('<?php echo $row['Meet']; ?>')">
                                                    <img src="../assets/img/pencil.png" alt="" class="img-button-table">
                                                </button>
                                            </td>
                                            <td class="text-center">
                                                <button class="button-table" id="<?php echo $row['Meet']; ?>" onclick="window.open('../assets/filedata/PA_pdf/<?php echo (!empty($row['document']) ? $row['document'] : '-'); ?>', '_blank')">
                                                    <img src="../assets/img/docs.png" alt="" class="img-button-table">
                                                </button>
                                            </td>
                                            <td class="text-center"><?php echo ($active_date) ?></td>
                                            <td class="text-center"><?php echo $row['Edit_by'] ?></td>
                                            <td class="text-center"><?php echo ($edit_date) ?></td>
                                        </tr>
                                <?php
                                        $i++;
                                    }
                                } else {
                                    // Handle case where no rows are returned, maybe display a message
                                    echo '<tr><td colspan="8" class="text-center">ไม่มีข้อมูลหลักเกณฑ์ในการประเมิน PA Level ที่บันทึก</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include '../assets/src/footer.php' ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function sendMeet(meetId) {
            var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", "ShowPA.php");

            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", "Meet");
            hiddenField.setAttribute("value", meetId);

            form.appendChild(hiddenField);
            document.body.appendChild(form);
            form.submit();
        }

        function sendMeetEdit(meetId) {
            var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", "EditPAAdmin.php");

            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", "Meet");
            hiddenField.setAttribute("value", meetId);

            form.appendChild(hiddenField);
            document.body.appendChild(form);
            form.submit();
        }

        
    </script>

</body>

</html>