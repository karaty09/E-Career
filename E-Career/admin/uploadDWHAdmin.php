<?php
include '../db/connect.php';
include '../login/loginCheckSession.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>นำเข้าข้อมูล (Upload DWH)</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">

    <!-- CSS Style -->
    <link rel="stylesheet" href="./styles/stylesUploadDWHAdmin.css">
    <link rel="stylesheet" href="../assets/src/styles/stylesBody.css">
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
                        <h4 class="text-black">นำเข้าข้อมูล (Upload DWH)</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <button id="linkapi" class="btn btn-danger">Link API</button>
                        <script>
                            document.getElementById('linkapi').addEventListener('click', function() {
                                Swal.fire({
                                    icon: "success",
                                    title: "ดึงข้อมูลจาก API สำเร็จ! (Demo)",
                                });
                            });
                        </script>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center" style="background-color: #F7F9F9; border: 2px dashed #979A9A; border-radius: 10px;">
                    <div class="mt-10">
                        <input type="file" id="input" accept=".xls, .xlsx, .csv" onchange="displayFileName()" multiple />
                        <div class="custom-input-files">
                            <center>
                                <img src="../assets/img/import.png" alt="" style="width: 100px; height: 100px; margin-bottom: 5px"><br>
                                <span id="fileName">Import File (.xls, .xlsx)</span>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <button id="import-button" type="button" class="btn btn-success">นำเข้าข้อมูล</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include '../assets/src/footer.php' ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <!-- Include xlsx library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom File Input -->
    <script>
        document.querySelector('.custom-input-files').addEventListener('click', function() {
            document.getElementById('input').click();
        });

        function displayFileName() {
            const fileInput = document.getElementById('input');
            const fileNameDisplay = document.getElementById('fileName');

            if (fileInput.files.length > 0) {
                const fileName = fileInput.files[0].name;
                fileNameDisplay.textContent = `ไฟล์ที่เลือก: ${fileName}`;
            } else {
                fileNameDisplay.textContent = '';
            }
        }
    </script>

    <!-- Send Excel to SQL Server -->
    <script>
        document.getElementById('import-button').addEventListener('click', function() {
            var input = document.getElementById('input');
            if (input.files.length === 0) {
                Swal.fire({
                    icon: "error",
                    title: "กรุณาเลือกไฟล์!",
                });
                return;
            }

            var file = input.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                // Assuming e.target.result contains the file data (Uint8Array)
                var data = new Uint8Array(e.target.result);

                // Read workbook
                var workbook = XLSX.read(data, {
                    type: 'array'
                });

                // Get first sheet name
                var firstSheetName = workbook.SheetNames[0];

                // Get worksheet
                var worksheet = workbook.Sheets[firstSheetName];

                // Function to convert Excel date number to readable date format
                function excelToDate(excelDate) {
                    // Convert Excel date to JavaScript date
                    var date = new Date((excelDate - 25569) * 86400 * 1000); // Adjust by subtracting 25569 days

                    // Get day, month, and year from the JavaScript date object
                    var day = date.getDate();
                    var month = date.getMonth() + 1; // JavaScript months are 0-11
                    var year = date.getFullYear();

                    // Ensure day and month are two digits (pad with zero if necessary)
                    day = day < 10 ? '0' + day : day;
                    month = month < 10 ? '0' + month : month;

                    // Return the formatted date as "YYYY-MM-DD"
                    return year + '-' + month + '-' + day;
                }

                // Convert Excel data to JSON
                var json = XLSX.utils.sheet_to_json(worksheet);

                // Convert birthdate from Excel number to readable format
                json.forEach(function(item, index) {
                    item["Birthdate"] = excelToDate(item["Birthdate"]);
                    item["SCG Hiring Date"] = excelToDate(item["SCG Hiring Date"]);
                    item["Position entry date"] = excelToDate(item["Position entry date"]);
                });

                // Ensure JSON data has expected columns
                json = json.map(row => ({
                    p_id: row["Person ID"] || "",
                    p_code: row["Personnel Number"] || "",
                    emp_code: row["SCG Employee ID"] || "",
                    name_prefix_th: row["Name Prefix (Thai)"] || "",
                    firstname_th: row["First Name (Thai)"] || "",
                    lastname_th: row["Last Name (Thai)"] || "",
                    position_id: row["Position ID"] || "",
                    position_name_th: row["Position Name (Thai)"] || "",
                    pl_superset_th: row["JL (Employee Subgroup Object S)"] || "",
                    pl_subset_th: row["PL (Employee Subgroup Object P)"] || "",
                    pl_subset_eng: row["SCG PL"] || "",
                    pl_superset_eng: row["PL Group"] || "",
                    org_id: row["Organization ID"] || "",
                    section_name: row["Section (Thai)"] || "",
                    sub_department_name: row["Sub1-Department (Thai)"] || "",
                    department_name: row["Department (Thai)"] || "",
                    division_name: row["Division (Thai)"] || "",
                    company_name: row["Company (Thai)"] || "",
                    sub11_business_unit: row["Sub1-1 Business Unit (Thai)"] || "",
                    sub1_business_unit: row["Sub1 Business Unit (Thai)"] || "",
                    business_unit_description: row["Business Unit Description (Thai)"] || "",
                    position_name_eng: row["Position (English)"] || "",
                    cost_center_payment: row["Cost Center (Payment)"] || "",
                    cost_center_org: row["Cost Center (Organization)"] || "",
                    emp_type: row["Employee Type ID"] || "",
                    birthdate: row["Birthdate"] || "",
                    scg_hiring_date: row["SCG Hiring Date"] || "",
                    position_entry_date: row["Position entry date"] || "",
                    pl_year: row["Years in PL"] || "0",
                    pl_month: row["Months in PL"] || "0",
                    age_year: row["Age (Years)"] || "0",
                    age_month: row["Age (Months)"] || "0",
                    service_year: row["Service Years"] || "0",
                    service_month: row["Service Months"] || "0",
                    esy: row["Equivalent years of service"] || "0",
                    oesy: row["Outside Equivalent Service Year"] || "0",
                    oesm: row["Outside Equivalent Service in month"] || "0",
                    salary: row["Salary"] || "0",
                    review_rating_past1y: row["Review Rating (Past 1 Year)"] || "-",
                    review_rating_past2y: row["Review Rating (Past 2 Year)"] || "-",
                    review_rating_past3y: row["Review Rating (Past 3 Year)"] || "-",
                    review_rating_past4y: row["Review Rating (Past 4 Year)"] || "-",
                    review_rating_past5y: row["Review Rating (Past 5 Year)"] || "-",
                    hp_review_rating_current: row["High Potential Review Rating (Current Year)"] || "-",
                    hp_review_rating_past1y: row["High Potential Review Rating (Past 1 Year)"] || "-",
                    hp_review_rating_past2y: row["High Potential Review Rating (Past 2 Year)"] || "-",
                    hp_review_rating_past3y: row["High Potential Review Rating (Past 3 Year)"] || "-",
                    hp_review_rating_past4y: row["High Potential Review Rating (Past 4 Year)"] || "-",
                    hp_review_rating_past5y: row["High Potential Review Rating (Past 5 Year)"] || "-",
                    master_piece: "0",
                    master_piece_file: "",
                    eligible: "",
                    eligible_type: "",
                }));
                // Send the JSON data to the PHP script using fetch API
                fetch('./backend/addExcelDataAction.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(json)
                    })
                    .then(response => response.text())
                    .then(data => {
                        console.log('Success:', data);
                        Swal.fire({
                            title: "บันทึกข้อมูลสำเร็จ",
                            icon: "success",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            };

            reader.readAsArrayBuffer(file);
        });
    </script>
</body>

</html>