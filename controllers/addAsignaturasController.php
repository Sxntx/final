<?php
include 'bd.php';
include '..//views/common/header.php';

//codigo para corregir rutas imgs
echo "<script>
                
                document.addEventListener('DOMContentLoaded', function() {
                  var src1 = document.getElementById('img_dep').src = '../views/common/imgs/departament.png';
                    var src2 = document.getElementById('img_ninios').src = '../views/common/imgs/niños-estudiando.jpg';
                    var src3 = document.getElementById('consll').src = '../views/common/imgs/logo_main.png';
                    var src4 = document.getElementById('moodl').src =  '../views/common/imgs/logo_moodle.png';
                    var src5 = document.getElementById('sonfe_text').href =  '../index.php';
                }) 
                    
                  </script>";

if (isset($_POST['btnguarda'])){
    $nombre = $_POST['nombre'];
    $idgp = (int)$_POST['idgp'];
    $idp = (int)$_POST['idp'];
    $save = mysqli_query($conn, "INSERT INTO Asignatura (nombre, idGrupo, idProfe)
                                        VALUES ('$nombre', '$idgp', '$idp') ");
    if (!$save){
        echo "<script>alert('Couldnt save, error query')</script>";
        header("Refresh:0;url=admin.php");
    }else{
        echo "<script>alert('saved successfully')</script>";
        header("Refresh:0;url=admin.php");
    }
}

?>
    <div class="container text-center mt-5 mb-5">
        <div class="row mb-3">
            <div class="col-12 h3">
                Añade asignatura
            </div>
        </div>

    <form action="addAsignaturasController.php" method="POST">
        <label for="">nombre: <input type="text" class="form-control" required="required" name="nombre"></label><br>
        <label for="">id grupo: <input type="number" class="form-control" name="idgp" id="idgp" min="-1" required="required"></label><br>
        <label for="">id profesor: <input type="number" class="form-control" name="idp" id="idp" min="0" required></label><br>
        <input type="submit" name="btnguarda" value="guarda" class="btn btn-info mt-3">
    </form>

    </div>

<?php
include '..//views/common/footer.php';
?>