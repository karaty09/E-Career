<?php
include '../db/connect.php';
include '../login/loginCheckSession.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กำหนดเงื่อนไข Master Peace</title>

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

        .button-table {
            background-color: white;
            border: none;
            padding: 0;
        }

        .img-button-table {
            width: 30px;
            height: 30px;
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
            <div class="col-md-12 col-12" style="padding: 20px; height: 100%;">
                <div class="row mb-3">
                    <div class="col-6 d-flex justify-content-start">
                        <h4 class="text-black">กำหนดเงื่อนไข Master Piece</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <input type="text" id="searchInput" class="form-control" style="width: 300px;" placeholder="ค้นหารายชื่อพนักงาน">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-12" style="overflow-y: auto;">
                        <table class="table table-bordered" id="tb-data">
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
                                    <th scope="col">Salary (Baht)</th>
                                    <th scope="col">Percentile</th>
                                    <th scope="col">Master Piece</th>
                                    <th scope="col">Edit</th>
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
                                        <td><button class="button-table editBtn" data-bs-toggle="modal" data-bs-target="#editEmployeeModal" data-id="<?php echo $row['emp_id'] ?>" data-master-piece="<?php echo $row['master_piece']; ?>">
                                                <img src="../assets/img/pencil.png" alt="" class="img-button-table"></button></td>
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
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="employeeModalEdit" method="post" enctype="multipart/form-data">
                <div id="editModalBody">
                    <!-- ข้อมูลที่จะแก้ไขจะถูกโหลดมาที่นี่ -->
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php include '../assets/src/footer.php' ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <!-- Fetch Modal Show and Edit Data Employee -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.editBtn');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', './backend/fetchEditEmployeeAction.php', true);
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

    <!-- Modal Edit Employee Action -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('employeeModalEdit').addEventListener('submit', function(event) {
                event.preventDefault();

                if (document.getElementById('master_piece_check').checked) {
                    master_piece = 1;
                } else {
                    master_piece = 0;
                }

                var formData = new FormData();
                formData.append('master_piece', master_piece);
                formData.append('master_piece_file', document.getElementById('editEmployee_master_piece_file').files[0]);
                formData.append('emp_id', document.getElementById('editEmployee_id_employee').value);

                fetch('./backend/editEmployeeAction.php', {
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
                                window.location.href = '../admin/addMasterPeaceAdmin.php';
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

    <script>
        function enabledInputFiles() {
            var checkBox = document.getElementById("master_piece_check");

            if (checkBox.checked == true) {
                document.getElementById("editEmployee_master_piece_file").disabled = false;
            } else {
                document.getElementById("editEmployee_master_piece_file").disabled = true;
            }
        }
    </script>

    <!-- Enable Input Files when Checkbox Master Piece Select -->
    <script>
        // รอให้เนื้อหาในหน้าเว็บโหลดเสร็จก่อน
        document.addEventListener('DOMContentLoaded', (event) => {
            // ค้นหาปุ่มทั้งหมดที่มีคลาส 'editBtn'
            const editButtons = document.querySelectorAll('.editBtn');

            // เพิ่ม event listener สำหรับแต่ละปุ่ม
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // ดึงค่าจาก data-master-piece attribute
                    const masterPiece = this.getAttribute('data-master-piece');

                    if (masterPiece === '1') {
                        // กำหนด event listener สำหรับ modal เพื่อเปิดใช้งานองค์ประกอบเมื่อ modal เปิดขึ้น
                        editEmployeeModal.addEventListener('shown.bs.modal', function onShown() {
                            document.getElementById("editEmployee_master_piece_file").disabled = false;

                            // ลบ event listener หลังจากทำงานเสร็จ
                            editEmployeeModal.removeEventListener('shown.bs.modal', onShown);
                        });
                    }
                });
            });
        });
    </script>

    <!-- DataTables Config -->
    <script>
        $(document).ready(function() {
            var table = $('#tb-data').DataTable();

            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });
        });
    </script>

</body>

</html>