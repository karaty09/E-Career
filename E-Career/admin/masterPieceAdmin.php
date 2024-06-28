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

    <!-- Select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <!-- CSS Style -->
    <link rel="stylesheet" href="../assets/src/styles/stylesBody.css">
    <link rel="stylesheet" href="./styles/stylesMasterPieceAdmin.css">

    <!-- Select 2 CSS -->
    <style>
        .select2-container {
            width: 100% !important;
            height: 50px !important;
        }

        .select2-selection {
            border: 1px solid #ced4da;
            height: 50px !important;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
        }

        .select2-selection:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .select2-selection__arrow {
            height: 50px !important;
        }

        .select2-selection__rendered {
            line-height: 1.5;
            padding-top: .375rem;
            padding-bottom: .375rem;
        }

        .select2-results__option {
            padding: .5rem .75rem;
            font-size: 1rem;
            color: #495057;
            background-color: #fff;
        }

        .select2-results__option--highlighted {
            background-color: #007bff !important;
            color: #fff;
        }
    </style>

    <style>
        .dateinput {
            display: block;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .dateinput:focus {
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25);
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
                    <div class="col-12 d-flex justify-content-start">
                        <h4 class="text-black">Master Piece</h4>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 d-flex">
                        <div class="col-6 d-flex align-items-center">
                            <label for="start-date" class="me-2">วันที่เริ่มต้น: </label>
                            <input type="date" id="start-date" name="start-date" class="me-2 dateinput">
                            <label for="end-date" class="me-2">วันที่สิ้นสุด: </label>
                            <input type="date" id="end-date" name="end-date" class="me-2 dateinput">
                            <button id="all-filter" class="btn btn-info" style="width: 70px;">All</button>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <input type="text" id="searchInput" class="form-control me-2" style="width: 300px;" placeholder="ค้นหารายชื่อพนักงาน" autocomplete="off">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">เพิ่มพนักงานที่มี Master Piece</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-12" style="overflow-y: auto;">
                        <table class="table table-bordered display" id="tb-data">
                            <thead class="table-dark">
                                <tr class="text-center">
                                    <th scope="col" class="font-head">No</th>
                                    <th scope="col" class="font-head" style="width: 20px">Active Year</th>
                                    <th scope="col" class="font-head" style="width: 60px">Active Date</th>
                                    <th scope="col" class="font-head" style="width: 70px">Emp ID</th>
                                    <th scope="col" class="font-head" style="width: 120px">Name</th>
                                    <th scope="col" class="font-head">Position</th>
                                    <th scope="col" class="font-head">Section</th>
                                    <th scope="col" class="font-head">Department</th>
                                    <th scope="col" class="font-head">Division</th>
                                    <th scope="col" class="font-head">Company</th>
                                    <th scope="col" class="font-head">PL Level</th>
                                    <th scope="col" class="font-head">EMP Type</th>
                                    <th scope="col" class="font-head">Master Piece</th>
                                    <th scope="col" class="font-head">Master Piece Evidence</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <div id="tb-td-data">
                                    <?php
                                    $sql = "SELECT * FROM tb_evaluate_employee WHERE master_piece = 'true'";
                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();
                                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    $i = 1;
                                    foreach ($rows as $row) {
                                    ?>
                                        <tr>
                                            <td class="font-td-table text-center"><?php echo $i; ?></td>
                                            <td class="font-td-table text-center"><?php echo date('Y', strtotime($row['master_piece_active_date'])); ?></td>
                                            <td class="font-td-table text-center"><?php echo date($row['master_piece_active_date']); ?></td>
                                            <td class="font-td-table"><?php echo $row['emp_code']; ?></td>
                                            <td class="font-td-table"><?php echo $row['name_prefix_th'] . " " . $row['firstname_th'] . " " . $row['lastname_th']; ?></td>
                                            <td class="font-td-table"><?php echo $row['position_name_th']; ?></td>
                                            <td class="font-td-table"><?php echo $row['section_name']; ?></td>
                                            <td class="font-td-table"><?php echo $row['department_name']; ?></td>
                                            <td class="font-td-table"><?php echo $row['division_name']; ?></td>
                                            <td class="font-td-table"><?php echo $row['company_name']; ?></td>
                                            <td class="font-td-table text-center"><?php echo $row['pl_subset_eng']; ?></td>
                                            <td class="font-td-table text-center"><?php echo $row['emp_type']; ?></td>
                                            <td class="font-td-table">
                                                <?php
                                                if ($row['master_piece'] == 'true') {
                                                    echo '<center><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                        <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                                                    </svg></center>';
                                                } else if ($row['master_piece'] == 'false') {
                                                    echo '<center><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                                    </svg></center>';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <button class="button-table" id="<?php echo rawurlencode($row['master_piece_file']); ?>" onclick="window.open('../assets/filedata/masterPiece_pdf/<?php echo !empty($row['master_piece_file']) ? rawurlencode($row['master_piece_file']) : '-'; ?>', '_blank')">
                                                    <img src="../assets/img/docs.png" alt="" class="img-button-table">
                                                </button>
                                            </td>
                                            <td class="text-center">
                                                <button class="button-table editBtn" data-bs-toggle="modal" data-bs-target="#editEmployeeModal" data-id="<?php echo $row['emp_id'] ?>" data-master-piece="<?php echo $row['master_piece']; ?>">
                                                    <img src="../assets/img/pencil.png" alt="" class="img-button-table">
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="employeeModalAdd" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มพนักงานที่มี Master Piece</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex">
                            <select id="addEmpInput" name="addEmpInput" class="js-example-basic-single">
                                <option value=""></option>
                                <?php
                                $employee_query = "SELECT DISTINCT firstname_th, lastname_th FROM tb_evaluate_employee ORDER BY firstname_th ASC";
                                $employee_query_result = $db->prepare($employee_query);
                                $employee_query_result->execute();
                                while ($employee_row = $employee_query_result->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?= $employee_row['firstname_th'] . ' ' . $employee_row['lastname_th'] ?>">
                                        <?= $employee_row['firstname_th'] . ' ' . $employee_row['lastname_th'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id="addModalBody">
                            <!-- ข้อมูลที่จะแก้ไขจะถูกโหลดมาที่นี่ -->
                            <hr>
                            <h6 class="fw-bold">ข้อมูลเบื้องต้น</h6>
                            <div class="row mb-3">
                                <div class="col-md-4 col-12">
                                    <p>Name: </p>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-4 col-12">
                                    <p>Position: </p>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-4 col-12">
                                    <p>Section: </p>
                                    <input type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 col-12">
                                    <p>Department: </p>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-4 col-12">
                                    <p>Division: </p>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-4 col-12">
                                    <p>Company: </p>
                                    <input type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 col-12">
                                    <p>PL Level: </p>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-4 col-12">
                                    <p>EMP Type: </p>
                                    <input type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <hr>
                            <h6 class="fw-bold">กำหนด Master Piece</h6>
                            <div class="row mb-3">
                                <div class="col-md-2 col-12">
                                    <p>Master Piece Select: </p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" disabled>
                                        <label class="form-check-label">
                                            Master Piece
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <p>Master Piece Active Date: </p>
                                    <input type="date" class="form-control" disabled>
                                </div>
                                <div class="col-md-7 col-12">
                                    <p>Master Piece File (ไฟล์ล่าสุด): </p>
                                    <input type="file" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="employeeModalEdit" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editEmployeeModalLabel">แก้ไขกำหนดเงื่อนไข Master Peace</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="editModalBody">
                            <!-- ข้อมูลที่จะแก้ไขจะถูกโหลดมาที่นี่ -->
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

    <!-- Footer -->
    <?php include '../assets/src/footer.php' ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <!-- Select 2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Select2 and DataTables Config -->
    <script>
        $(document).ready(function() {
            var table = $('#tb-data').DataTable();

            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });

            $('.js-example-basic-single').select2({
                dropdownParent: $('#addEmployeeModal'),
                placeholder: 'ค้นหารายชื่อพนักงาน',
            });

            $('#addEmpInput').on('change', function() {
                var selectedAddEmployeeId = $(this).val();
                addSelectEmp(selectedAddEmployeeId);
            });

            // Custom filtering function which will search data in column 4 between two dates
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var startDate = $('#start-date').val();
                    var endDate = $('#end-date').val();
                    var date = data[2]; // Use data for the date column

                    if ((startDate === "" && endDate === "") ||
                        (startDate === "" && date <= endDate) ||
                        (startDate <= date && endDate === "") ||
                        (startDate <= date && date <= endDate)) {
                        return true;
                    }
                    return false;
                }
            );

            // Event listener to the two range filtering inputs to redraw on input
            $('#start-date, #end-date').change(function() {
                table.draw();
            });

            // All filter button functionality
            $('#all-filter').click(function() {
                $('#start-date').val('');
                $('#end-date').val('');
                table.draw();
            });
        });
    </script>

    <!-- Function to add and edit employee data to the modal when selected from the dropdown list: -->
    <script>
        function addSelectEmp(value) {
            var name = value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', './backend/masterPieceBackend/fetchSearchAddEmployeeAction.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        document.getElementById('addModalBody').innerHTML = xhr.responseText;
                    } else {
                        console.error('เกิดข้อผิดพลาดในการโหลดข้อมูล');
                    }
                }
            };

            xhr.send('name=' + encodeURIComponent(name));
        }

        function enabledInputFilesEdit() {
            var checkBox = document.getElementById("editEmpMasterPieceCheck");

            if (checkBox.checked == true) {
                document.getElementById("editEmpMasterPieceFile").disabled = false;
                document.getElementById("editEmpMasterPieceActiveDate").disabled = false;
                document.getElementById("causeMasterPiece").hidden = true;
                document.getElementById("editMasterPieceDropCause").required = false;
            } else {
                document.getElementById("editEmpMasterPieceFile").disabled = true;
                document.getElementById("editEmpMasterPieceActiveDate").disabled = true;
                document.getElementById("editEmpMasterPieceFile").value = null;
                document.getElementById("editEmpMasterPieceActiveDate").value = null;
                document.getElementById("causeMasterPiece").hidden = false;
                document.getElementById("editMasterPieceDropCause").required = true;
            }
        }
    </script>

    <!-- Fetch Modal Edit -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.editBtn');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', './backend/masterPieceBackend/fetchEditEmployeeAction.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                document.getElementById('editModalBody').innerHTML = xhr.responseText;
                            } else {
                                alert('เกิดข้อผิดพลาดในการโหลดข้อมูล');
                            }
                        }
                    };

                    xhr.send('id=' + encodeURIComponent(id));
                });
            });
        });

        // Enable Input Files when Checkbox Master Piece Select 
        document.addEventListener('DOMContentLoaded', (event) => {
            // ค้นหาปุ่มทั้งหมดที่มีคลาส 'editBtn'
            const editButtons = document.querySelectorAll('.editBtn');

            // เพิ่ม event listener สำหรับแต่ละปุ่ม
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // ดึงค่าจาก data-master-piece attribute
                    const masterPiece = this.getAttribute('data-master-piece');

                    if (masterPiece == 'true') {
                        // กำหนด event listener สำหรับ modal เพื่อเปิดใช้งานองค์ประกอบเมื่อ modal เปิดขึ้น
                        editEmployeeModal.addEventListener('shown.bs.modal', function onShown() {
                            document.getElementById("editEmpMasterPieceFile").disabled = false;
                            document.getElementById("editEmpMasterPieceActiveDate").disabled = false;
                            document.getElementById("causeMasterPiece").hidden = true;
                            document.getElementById("editMasterPieceDropCause").required = false;

                            // ลบ event listener หลังจากทำงานเสร็จ
                            editEmployeeModal.removeEventListener('shown.bs.modal', onShown);
                        });
                    }
                });
            });
        });
    </script>

    <!-- Modal Add Employee Action -->
    <script>
        document.getElementById('employeeModalAdd').addEventListener('submit', function(event) {
            event.preventDefault();

            var formData = new FormData();
            formData.append('addEmpMasterPieceID', document.getElementById('addEmpMasterPieceID').value);
            formData.append('addEmpMasterPiecePID', document.getElementById('addEmpMasterPiecePID').value);
            formData.append('addEmpMasterPieceCheck', document.getElementById('addEmpMasterPieceCheck').checked);
            formData.append('addEmpMasterPieceActiveDate', document.getElementById('addEmpMasterPieceActiveDate').value);
            formData.append('addEmpMasterPieceFile', document.getElementById('addEmpMasterPieceFile').files[0]);

            fetch('./backend/masterPieceBackend/addEmpMasterPieceAction.php', {
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
                            window.location.href = './masterPieceAdmin.php';
                        }
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
        });
    </script>

    <!-- Modal Edit Employee Action -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('employeeModalEdit').addEventListener('submit', function(event) {
                event.preventDefault();

                var formData = new FormData();
                formData.append('editEmpMasterPieceID', document.getElementById('editEmpMasterPieceID').value);
                formData.append('editEmpMasterPiecePID', document.getElementById('editEmpMasterPiecePID').value);
                formData.append('editEmpMasterPieceCheck', document.getElementById('editEmpMasterPieceCheck').checked);
                formData.append('editEmpMasterPieceActiveDate', document.getElementById('editEmpMasterPieceActiveDate').value);
                formData.append('editEmpMasterPieceFile', document.getElementById('editEmpMasterPieceFile').files[0]);
                formData.append('editMasterPieceDropCause', document.getElementById('editMasterPieceDropCause').value);

                fetch('./backend/masterPieceBackend/editEmpMasterPieceAction.php', {
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
                                window.location.href = './masterPieceAdmin.php';
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