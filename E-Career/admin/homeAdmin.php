<?php
include '../db/connect.php';
include '../login/loginCheckSession.php';
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