<?php
include '../db/connect.php';
include '../login/loginCheckSession.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หลักเกณฑ์ Percentile</title>

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
            background-color: white;
            border: none;
            padding: 0;
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

    <!-- Content -->
    <div class="container-fluid mt-3 mb-3">
        <div class="row" style="margin-left: 40px; margin-right: 40px;">
            <div class="col-md-12 col-12" style="padding: 20px; height: 100%;">
                <div class="row mb-3">
                    <div class="col-6 d-flex justify-content-start">
                        <h4 class="text-black">หลักเกณฑ์ Percentile</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <button id="linkapi" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPercentileModal">เพิ่มเกณฑ์ Percentile</button>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body" style="overflow-y: auto;">
                        <table class="table table-bordered">
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
                                $percentile_query = "SELECT * FROM tb_percentile";
                                $percentile_result = $db->prepare($percentile_query);
                                $percentile_result->execute();
                                $percentile_data = $percentile_result->fetchAll();

                                // Check if there are rows returned
                                if ($percentile_result->rowCount() > 0) {
                                    $i = 1;
                                    foreach ($percentile_data as $row) {
                                ?>
                                        <tr>
                                            <td scope="row" class="text-center"><?php echo $i ?></td>
                                            <td class="text-start"><?php echo $row['percentile_name'] ?></td>
                                            <td class="text-center"><button class="button-table showBtn" data-bs-toggle="modal" data-bs-target="#showPercentileModal" data-id="<?php echo $row['percentile_id'] ?>"><img src="../assets/img/search.png" alt="" class="img-button-table"></button></td>
                                            <td class="text-center"><button class="button-table editBtn" data-bs-toggle="modal" data-bs-target="#editPercentileModal" data-id="<?php echo $row['percentile_id'] ?>"><img src="../assets/img/pencil.png" alt="" class="img-button-table"></button></td>
                                            <td class="text-center"><button class="button-table" data-bs-toggle="modal" data-bs-target="#pdfModal" data-id="../admin/filedata/percentile_pdf/63110951_สาณิตา_จิตตุราช.pdf"><img src="../assets/img/docs.png" alt="" class="img-button-table"></button></td>
                                            <td class="text-center">
                                                <?php
                                                $date = new DateTime($row['active_date']);
                                                echo $date->format('d/m/Y');
                                                ?>
                                            </td>
                                            <td class="text-center"><?php echo $row['edit_by_name'] ?></td>
                                            <td class="text-center">
                                                <?php
                                                $date = new DateTime($row['edit_date']);
                                                echo $date->format('d/m/Y');
                                                ?>
                                            </td>

                                        </tr>
                                <?php
                                        $i++;
                                    }
                                } else {
                                    // Handle case where no rows are returned, maybe display a message
                                    echo '<tr><td colspan="8" class="text-center">ไม่มีข้อมูลของหลักเกณฑ์ Percentile ที่บันทึก</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="addPercentileModal" tabindex="-1" aria-labelledby="addPercentileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="percentileModalAdd" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addPercentileModalLabel">เกณฑ์ของ Percentile</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <p>Name: </p>
                                <input type="text" class="form-control" id="name_percentile" autocomplete="off">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <p>Edit By: </p>
                                <input type="text" class="form-control" id="edit_by" disabled>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        // ดึงข้อมูลจาก Session มาแสดง
                                        var edit_by = '<?php echo $firstname . " " . $lastname ?>';
                                        document.getElementById('edit_by').value = edit_by;
                                    });
                                </script>
                            </div>
                            <div class="col-6">
                                <p>PDF File: </p>
                                <input type="file" class="form-control" accept=".pdf" id="percentile_pdf_file">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <p>Edit Date: </p>
                                <input type="date" class="form-control" id="edit_date" disabled>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        // สร้างวันที่ปัจจุบัน
                                        var today = new Date();

                                        // แปลงวันที่เป็นรูปแบบที่เหมาะสมสำหรับ input[type="date"]
                                        var day = ('0' + today.getDate()).slice(-2);
                                        var month = ('0' + (today.getMonth() + 1)).slice(-2);
                                        var year = today.getFullYear();

                                        // สร้างสตริงวันที่ในรูปแบบ YYYY-MM-DD
                                        var currentDate = `${year}-${month}-${day}`;

                                        // ตั้งค่าวันที่ปัจจุบันเป็นค่าเริ่มต้นใน input[type="date"]
                                        document.getElementById('edit_date').value = currentDate;
                                    });
                                </script>
                            </div>
                            <div class="col-6">
                                <p>Active Date: </p>
                                <input type="date" class="form-control" id="active_date">
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
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="s4_p0"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="s4_p25"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="s4_p50"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="s4_p75"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="s4_p100"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-center">S3 (บ.3)</th>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="s3_p0"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="s3_p25"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="s3_p50"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="s3_p75"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="s3_p100"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-center">S2 (บ.2)</th>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="s2_p0"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="s2_p25"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="s2_p50"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="s2_p75"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="s2_p100"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-center">S1 (บ.1)</th>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="s1_p0"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="s1_p25"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="s1_p50"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="s1_p75"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="s1_p100"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-center">O5 (ป.5)</th>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="o5_p0"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="o5_p25"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="o5_p50"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="o5_p75"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="o5_p100"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-center">O4 (ป.4)</th>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="o4_p0"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="o4_p25"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="o4_p50"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="o4_p75"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="o4_p100"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-center">O3 (ป.3)</th>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="o3_p0"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="o3_p25"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="o3_p50"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="o3_p75"></td>
                                            <td><input type="text" class="form-control text-center" autocomplete="off" id="o3_p100"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="save" id="save">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Show -->
    <div class="modal fade" id="showPercentileModal" tabindex="-1" aria-labelledby="showPercentileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div id="showModalBody">
                <!-- ข้อมูลที่จะแสดงจะถูกโหลดมาที่นี่ -->
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editPercentileModal" tabindex="-1" aria-labelledby="editPercentileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="percentileModalEdit" method="post" enctype="multipart/form-data">
                <div id="editModalBody">
                    <!-- ข้อมูลที่จะแก้ไขจะถูกโหลดมาที่นี่ -->
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Show PDF -->
    <!-- <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">PDF Viewer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfFrame" src="" style="width: 100%; height: 500px;" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div> -->

    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var pdfModal = document.getElementById('pdfModal');

            pdfModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // ปุ่มที่เรียก Modal
                var pdfUrl = button.getAttribute('data-pdf'); // ดึงค่า URL ของ PDF จาก data-pdf attribute
                var iframe = pdfModal.querySelector('.modal-body iframe');
                iframe.setAttribute('src', pdfUrl); // กำหนดค่า src ของ iframe
                console.log('Success');
            });
        });
    </script> -->

    <!-- Footer -->
    <?php include '../assets/src/footer.php' ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Fetch Modal Show and Edit Data Percentile -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.showBtn');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', './backend/fetchShowPercentileAction.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                document.getElementById('showModalBody').innerHTML = xhr.responseText;
                            } else {
                                // alert('เกิดข้อผิดพลาดในการโหลดข้อมูล');
                            }
                        }
                    };

                    xhr.send('id=' + encodeURIComponent(id));
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.editBtn');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', './backend/fetchEditPercentileAction.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                document.getElementById('editModalBody').innerHTML = xhr.responseText;
                            } else {
                                // alert('เกิดข้อผิดพลาดในการโหลดข้อมูล');
                            }
                        }
                    };

                    xhr.send('id=' + encodeURIComponent(id));
                });
            });
        });
    </script>

    <!-- Modal Data Percentile -->
    <script>
        document.getElementById('percentileModalAdd').addEventListener('submit', function(event) {
            event.preventDefault();

            var formData = new FormData();
            formData.append('name_percentile', document.getElementById('name_percentile').value);
            formData.append('edit_by', document.getElementById('edit_by').value);
            formData.append('percentile_pdf_file', document.getElementById('percentile_pdf_file').files[0]);
            formData.append('edit_date', document.getElementById('edit_date').value);
            formData.append('active_date', document.getElementById('active_date').value);
            formData.append('o3_p0', document.getElementById('o3_p0').value);
            formData.append('o3_p25', document.getElementById('o3_p25').value);
            formData.append('o3_p50', document.getElementById('o3_p50').value);
            formData.append('o3_p75', document.getElementById('o3_p75').value);
            formData.append('o3_p100', document.getElementById('o3_p100').value);
            formData.append('o4_p0', document.getElementById('o4_p0').value);
            formData.append('o4_p25', document.getElementById('o4_p25').value);
            formData.append('o4_p50', document.getElementById('o4_p50').value);
            formData.append('o4_p75', document.getElementById('o4_p75').value);
            formData.append('o4_p100', document.getElementById('o4_p100').value);
            formData.append('o5_p0', document.getElementById('o5_p0').value);
            formData.append('o5_p25', document.getElementById('o5_p25').value);
            formData.append('o5_p50', document.getElementById('o5_p50').value);
            formData.append('o5_p75', document.getElementById('o5_p75').value);
            formData.append('o5_p100', document.getElementById('o5_p100').value);
            formData.append('s1_p0', document.getElementById('s1_p0').value);
            formData.append('s1_p25', document.getElementById('s1_p25').value);
            formData.append('s1_p50', document.getElementById('s1_p50').value);
            formData.append('s1_p75', document.getElementById('s1_p75').value);
            formData.append('s1_p100', document.getElementById('s1_p100').value);
            formData.append('s2_p0', document.getElementById('s2_p0').value);
            formData.append('s2_p25', document.getElementById('s2_p25').value);
            formData.append('s2_p50', document.getElementById('s2_p50').value);
            formData.append('s2_p75', document.getElementById('s2_p75').value);
            formData.append('s2_p100', document.getElementById('s2_p100').value);
            formData.append('s3_p0', document.getElementById('s3_p0').value);
            formData.append('s3_p25', document.getElementById('s3_p25').value);
            formData.append('s3_p50', document.getElementById('s3_p50').value);
            formData.append('s3_p75', document.getElementById('s3_p75').value);
            formData.append('s3_p100', document.getElementById('s3_p100').value);
            formData.append('s4_p0', document.getElementById('s4_p0').value);
            formData.append('s4_p25', document.getElementById('s4_p25').value);
            formData.append('s4_p50', document.getElementById('s4_p50').value);
            formData.append('s4_p75', document.getElementById('s4_p75').value);
            formData.append('s4_p100', document.getElementById('s4_p100').value);

            fetch('./backend/addPercentileAction.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        title: "บันทึกข้อมูลสำเร็จ",
                        icon: "success",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../admin/percentileAdmin.php';
                        }
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
        });
    </script>

    <!-- Modal Edit Data Percentile -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('percentileModalEdit').addEventListener('submit', function(event) {
                event.preventDefault();

                // สร้างวันที่ปัจจุบัน
                var today = new Date();

                // แปลงวันที่เป็นรูปแบบที่เหมาะสมสำหรับ input[type="date"]
                var day = ('0' + today.getDate()).slice(-2);
                var month = ('0' + (today.getMonth() + 1)).slice(-2);
                var year = today.getFullYear();

                // สร้างสตริงวันที่ในรูปแบบ YYYY-MM-DD
                var currentDate = `${year}-${month}-${day}`;

                var formData = new FormData();
                formData.append('name_percentile', document.getElementById('editPercentile_name_percentile').value);
                formData.append('edit_by', "<?php echo $firstname . " " . $lastname ?>");
                formData.append('percentile_pdf_file', document.getElementById('editPercentile_percentile_pdf_file').files[0]);
                formData.append('edit_date', currentDate);
                formData.append('active_date', document.getElementById('editPercentile_active_date').value);
                formData.append('o3_p0', document.getElementById('editPercentile_o3_p0').value);
                formData.append('o3_p25', document.getElementById('editPercentile_o3_p25').value);
                formData.append('o3_p50', document.getElementById('editPercentile_o3_p50').value);
                formData.append('o3_p75', document.getElementById('editPercentile_o3_p75').value);
                formData.append('o3_p100', document.getElementById('editPercentile_o3_p100').value);
                formData.append('o4_p0', document.getElementById('editPercentile_o4_p0').value);
                formData.append('o4_p25', document.getElementById('editPercentile_o4_p25').value);
                formData.append('o4_p50', document.getElementById('editPercentile_o4_p50').value);
                formData.append('o4_p75', document.getElementById('editPercentile_o4_p75').value);
                formData.append('o4_p100', document.getElementById('editPercentile_o4_p100').value);
                formData.append('o5_p0', document.getElementById('editPercentile_o5_p0').value);
                formData.append('o5_p25', document.getElementById('editPercentile_o5_p25').value);
                formData.append('o5_p50', document.getElementById('editPercentile_o5_p50').value);
                formData.append('o5_p75', document.getElementById('editPercentile_o5_p75').value);
                formData.append('o5_p100', document.getElementById('editPercentile_o5_p100').value);
                formData.append('s1_p0', document.getElementById('editPercentile_s1_p0').value);
                formData.append('s1_p25', document.getElementById('editPercentile_s1_p25').value);
                formData.append('s1_p50', document.getElementById('editPercentile_s1_p50').value);
                formData.append('s1_p75', document.getElementById('editPercentile_s1_p75').value);
                formData.append('s1_p100', document.getElementById('editPercentile_s1_p100').value);
                formData.append('s2_p0', document.getElementById('editPercentile_s2_p0').value);
                formData.append('s2_p25', document.getElementById('editPercentile_s2_p25').value);
                formData.append('s2_p50', document.getElementById('editPercentile_s2_p50').value);
                formData.append('s2_p75', document.getElementById('editPercentile_s2_p75').value);
                formData.append('s2_p100', document.getElementById('editPercentile_s2_p100').value);
                formData.append('s3_p0', document.getElementById('editPercentile_s3_p0').value);
                formData.append('s3_p25', document.getElementById('editPercentile_s3_p25').value);
                formData.append('s3_p50', document.getElementById('editPercentile_s3_p50').value);
                formData.append('s3_p75', document.getElementById('editPercentile_s3_p75').value);
                formData.append('s3_p100', document.getElementById('editPercentile_s3_p100').value);
                formData.append('s4_p0', document.getElementById('editPercentile_s4_p0').value);
                formData.append('s4_p25', document.getElementById('editPercentile_s4_p25').value);
                formData.append('s4_p50', document.getElementById('editPercentile_s4_p50').value);
                formData.append('s4_p75', document.getElementById('editPercentile_s4_p75').value);
                formData.append('s4_p100', document.getElementById('editPercentile_s4_p100').value);
                formData.append('id_percentile', document.getElementById('editPercentile_id_percentile').value);

                fetch('./backend/editPercentileAction.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire({
                            title: "บันทึกข้อมูลสำเร็จ",
                            icon: "success",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '../admin/percentileAdmin.php';
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                    });
            });
        });
    </script>
</body>

</html>