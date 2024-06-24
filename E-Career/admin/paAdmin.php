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

    <!-- Content -->
    <div class="container-fluid mt-3 mb-3">
        <div class="row" style="margin-left: 40px; margin-right: 40px;">
            <div class="col-md-12 col-12" style="padding: 20px; height: 100%;">
                <div class="row mb-3">
                    <div class="col-6 d-flex justify-content-start">
                        <h4 class="text-black">หลักเกณฑ์ Promotion Adjustment (PA)</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <button id="linkapi" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#percentileModal">เพิ่มเกณฑ์ Promotion Adjustment (PA)</button>
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
                                <tr>
                                    <td scope="row" class="text-center">1</td>
                                    <td>หลักเกณฑ์ Promotion Adjustment ประชุมบุคคล ณ 31/10/2548​</td>
                                    <td class="text-center"><button class="button-table"><img src="../assets/img/search.png" alt="" class="img-button-table"></button></td>
                                    <td class="text-center"><button class="button-table"><img src="../assets/img/pencil.png" alt="" class="img-button-table"></button></td>
                                    <td class="text-center"><button class="button-table"><img src="../assets/img/docs.png" alt="" class="img-button-table"></button></td>
                                    <td class="text-center">01-Jan-2024</td>
                                    <td class="text-center">Supansa Moonsiri</td>
                                    <td class="text-center">01-May-2024</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="percentileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
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
                            <div class="col-6">
                                <p>หลักเกณฑ์ Promotion Adjustment ประชุมบุคคล : </p>
                                <input type="date" name="Meet" id="Meet" class="form-control">
                            </div>
                            <div class="col-6">
                                <p>Active Date :</p>
                                <input type="date" name="Active_Date" id="Active_Date" class="form-control">
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
                                <input type="text" name="estimateNormal" id="estimateNormal" class="form-control">
                            </div>
                            <div class="col-4">
                                <p>ESY (ปี) : </p>
                                <input type="text" name="ESYNormal" id="ESYNormal" class="form-control">
                            </div>
                            <div class="col-4">
                                <p>TIG (ปี) : </p>
                                <input type="text" name="TIGNormal" id="TIGNormal" class="form-control">
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
                                                <td><input type="text" class="form-control" name="ExcellentNormal" id="ExcellentNormal"></td>
                                                <td><input type="text" class="form-control" name="very_goodNormal" id="very_goodNormal"></td>
                                                <td><input type="text" class="form-control" name="goodNormal" id="goodNormal"></td>
                                                <td><input type="text" class="form-control" name="fairNormal" id="fairNormal"></td>
                                                <td><input type="text" class="form-control" name="adjustNormal" id="adjustNormal"></td>
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
                                    <input type="text" name="estimate" id="estimatefast" class="form-control">
                                </div>
                                <div class="col-4">
                                    <p>ESY (ปี) : </p>
                                    <input type="text" name="ESY" id="ESYfast" class="form-control">
                                </div>
                                <div class="col-4">
                                    <p>TIG (ปี) : </p>
                                    <input type="text" name="TIG" id="TIGfast" class="form-control">
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
                                                    <td><input type="text" class="form-control" name="Excellentfast" id="Excellentfast"></td>
                                                    <td><input type="text" class="form-control" name="very_goodfast" id="very_goodfast"></td>
                                                    <td><input type="text" class="form-control" name="goodfast" id="goodfast"></td>
                                                    <td><input type="text" class="form-control" name="fairfast" id="fairfast"></td>
                                                    <td><input type="text" class="form-control" name="adjustfast" id="adjustfast"></td>
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
                                    <input type="text" name="estimate" id="estimateSuper_Fast" class="form-control">
                                </div>
                                <div class="col-4">
                                    <p>ESY (ปี) : </p>
                                    <input type="text" name="ESYSuper_Fast" id="ESYSuper_Fast" class="form-control">
                                </div>
                                <div class="col-4">
                                    <p>TIG (ปี) : </p>
                                    <input type="text" name="TIG" id="TIGSuper_Fast" class="form-control">
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
                                                    <td><input type="text" class="form-control" name="Excellent" id="ExcellentSuper_Fast"></td>
                                                    <td><input type="text" class="form-control" name="very_good" id="very_goodSuper_Fast"></td>
                                                    <td><input type="text" class="form-control" name="good" id="goodSuper_Fast"></td>
                                                    <td><input type="text" class="form-control" name="fair" id="fairSuper_Fast"></td>
                                                    <td><input type="text" class="form-control" name="adjust" id="adjustSuper_Fast"></td>
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
                    </form>
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
        function SelectPL_level(PL_level) {
            document.getElementById('PL_level').innerText = PL_level;
            document.getElementById('PL_level').value = PL_level;
            console.log(PL_level)
        }
    </script>

    <script>
        document.getElementById('modalForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
            const PL = [
                'PL_level'
            ];

            for (let field of PL) {
                if (!document.getElementById(field).value) {
                    Swal.fire({
                        title: "เกิดข้อผิดพลาด",
                        text: `กรุณาเลือก PL Level ที่กำหนด`,
                        icon: "error",
                    });
                    return; // หยุดการส่งฟอร์ม
                }
            }
            const requiredFields = [
                'TIGNormal', 'ESYNormal', 'estimateNormal',
                'TIGfast', 'ESYfast', 'estimatefast',
                'TIGSuper_Fast', 'ESYSuper_Fast', 'estimateSuper_Fast', 'Meet', 'Active_Date'
            ];

            for (let field of requiredFields) {
                if (!document.getElementById(field).value) {
                    Swal.fire({
                        title: "เกิดข้อผิดพลาด",
                        text: `กรุณากรอกข้อมูล ตรวจสอบจำนวนปีย้อนหลัง TIG ESY ให้ครบ`,
                        icon: "error",
                    });
                    return; // หยุดการส่งฟอร์ม
                }
            }
            // Normal
            var formData = new FormData();
            formData.append('PA_level', document.getElementById('PL_level').value);
            formData.append('TIG', document.getElementById('TIGNormal').value);
            formData.append('ESY', document.getElementById('ESYNormal').value);
            formData.append('estimate', document.getElementById('estimateNormal').value);
            formData.append('HP', document.getElementById('High_potentialNormal').checked ? 1 : 0);
            formData.append('P', document.getElementById('PotentialNormal').checked ? 1 : 0);
            formData.append('Master_pice', document.getElementById('Master_PieceNormal').checked ? 1 : 0);
            formData.append('Excellent', document.getElementById('ExcellentNormal').value);
            formData.append('very_good', document.getElementById('very_goodNormal').value);
            formData.append('good', document.getElementById('goodNormal').value);
            formData.append('fair', document.getElementById('fairNormal').value);
            formData.append('adjust', document.getElementById('adjustNormal').value);
            formData.append('Tag', 'Normal');
            formData.append('Meet', document.getElementById('Meet').value);
            formData.append('Active_Date', document.getElementById('Active_Date').value);
            //Fast
            formData.append('PA_level', document.getElementById('PL_level').value);
            formData.append('TIGfast', document.getElementById('TIGfast').value);
            formData.append('ESYfast', document.getElementById('ESYfast').value);
            formData.append('estimatefast', document.getElementById('estimatefast').value);
            formData.append('HPfast', document.getElementById('High_potentialfast').checked ? 1 : 0);
            formData.append('Pfast', document.getElementById('Potentialfast').checked ? 1 : 0);
            formData.append('Master_Piecefast', document.getElementById('Master_Piecefast').checked ? 1 : 0);
            formData.append('Excellentfast', document.getElementById('Excellentfast').value);
            formData.append('very_goodfast', document.getElementById('very_goodfast').value);
            formData.append('goodfast', document.getElementById('goodfast').value);
            formData.append('fairfast', document.getElementById('fairfast').value);
            formData.append('adjustfast', document.getElementById('adjustfast').value);
            formData.append('Tagfast', 'Fast');
            formData.append('Meet', document.getElementById('Meet').value);
            formData.append('Active_Date', document.getElementById('Active_Date').value);
            //Super Fast
            formData.append('PA_level', document.getElementById('PL_level').value);
            formData.append('TIGSuper_Fast', document.getElementById('TIGSuper_Fast').value);
            formData.append('ESYSuper_Fast', document.getElementById('ESYSuper_Fast').value);
            formData.append('estimateSuper_Fast', document.getElementById('estimateSuper_Fast').value);
            formData.append('HPSuper_Fast', document.getElementById('High_potentialSuper_Fast').checked ? 1 : 0);
            formData.append('PSuper_Fast', document.getElementById('PotentialSuper_Fast').checked ? 1 : 0);
            formData.append('Master_PieceSuper_Fast', document.getElementById('Master_PieceSuper_Fast').checked ? 1 : 0);
            formData.append('ExcellentSuper_Fast', document.getElementById('ExcellentSuper_Fast').value);
            formData.append('very_goodSuper_Fast', document.getElementById('very_goodSuper_Fast').value);
            formData.append('goodSuper_Fast', document.getElementById('goodSuper_Fast').value);
            formData.append('fairSuper_Fast', document.getElementById('fairSuper_Fast').value);
            formData.append('adjustSuper_Fast', document.getElementById('adjustSuper_Fast').value);
            formData.append('TagSuper_Fast', 'Super_Fast');
            formData.append('Meet', document.getElementById('Meet').value);
            formData.append('Active_Date', document.getElementById('Active_Date').value);

            console.log('PL Level:', document.getElementById('PL_level').value);

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
                        if (data.normal.success && data.fast.success) {
                            Swal.fire({
                                title: "บันทึกข้อมูลสำเร็จ",
                                icon: "success",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        } else {
                            let errorMsg = 'เกิดข้อผิดพลาด';
                            if (data.normal.error) errorMsg += ' (Normal): ' + data.Normal.error;
                            if (data.fast.error) errorMsg += ' (Fast): ' + data.Fast.error;
                            if (data.fast.error) errorMsg += ' (SuperFast): ' + data.SuperFast.error;
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