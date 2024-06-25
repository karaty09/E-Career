<?php
require '../../db/connect.php';

// ดึงข้อมูลจากฐานข้อมูล
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM PA_standard WHERE Meet = :Meet";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':Meet', $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
?>
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Promotion Adjustment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modalForm" method="post" enctype="multipart/form-data">
                    <div class="dropdown w-100">
                        <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="EditPL_level" name="EditPL_level" style="font-size: 40px;" data-bs-toggle="dropdown" aria-expanded="false">
                            PL level
                        </button>
                        <ul class="dropdown-menu w-100">
                            <li><a class="dropdown-item" onclick="EditPL_level('O3')">O3</a></li>
                            <li><a class="dropdown-item" onclick="EditPL_level('O4')">O4</a></li>
                            <li><a class="dropdown-item" onclick="EditPL_level('O5')">O5</a></li>
                            <li><a class="dropdown-item" onclick="EditPL_level('S1')">S1</a></li>
                            <li><a class="dropdown-item" onclick="EditPL_level('S2')">S2</a></li>
                            <li><a class="dropdown-item" onclick="EditPL_level('S3')">S3</a></li>
                            <li><a class="dropdown-item" onclick="EditPL_level('S4')">S4</a></li>
                        </ul>
                    </div><br>
                    <div id="modalEditPAData">

                    </div>
                </form>
            </div>
        </div>
<?php
    }}
?>