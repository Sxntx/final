<?php

include'bd.php';

include('../views/common/header.php');


if (isset($_POST['guardar'])) {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $usuario = $_POST['usuario'];
    $contrasenya = $_POST['contrasenya'];
    $idTipoUsuario = $_POST['idTipoUsuario'];
    $idCurso = $_POST['idCurso'];

    /*ENCRYPTIN PASSWORD*/
    $hash = password_hash($contrasenya, PASSWORD_DEFAULT);

    $query = mysqli_query($conn,
        "INSERT INTO Personal(nombre,apellidos,usuario,contrasenya,idTipoUsuario,idCurso)
  VALUES ('$nombre', '$apellidos', '$usuario', '$hash', '$idTipoUsuario', '$idCurso')");

    if ($idTipoUsuario == 2) {//if studen save data into alumno table (2)
        $idPersonalA = mysqli_query($conn, "SELECT id FROM Personal ORDER BY id DESC LIMIT 1");
        $lastId = mysqli_fetch_array($idPersonalA, MYSQLI_ASSOC);
        $i = $lastId['id'];
        $fnac = $_POST['anyNac'];
        $nExp = 'SF'.$i++;
        $insAlu = mysqli_query($conn, "INSERT INTO Alumno(nombre, apellidos, anyoNacimiento, nExp)
        VALUES ('$nombre', '$apellidos', '$fnac', '$nExp')");

        echo    "<script>alert('Alumno guardado exitosamente')</script>";

    }

    if ($idTipoUsuario == 1) {//if teacher save data into profesor table (1)
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $idPersonal = mysqli_query($conn, "SELECT id FROM Personal WHERE usuario = '$usuario'");
        $row = mysqli_fetch_array($idPersonal, MYSQLI_ASSOC);
        $idPers = $row['id'];
        mysqli_query($conn, "INSERT INTO Profesor(idPersonal, Email, Telefono)
   VALUES ('$idPers', '$email', '$tel')");

        echo    "<script>alert('Profesor guardado exitosamente')</script>";
    }

    if (!$query) {
        echo $nombre . ' ' . $apellidos . ' ' . $usuario . ' ' . $contrasenya . ' ' . $idTipoUsuario . ' ' . $idCurso;
        echo "Couldnt save, query wrong";
    } else {
        header('Refresh:0;  url=admin.php');
    }
}

echo "<script>
                
                document.addEventListener('DOMContentLoaded', function() {
                  var src1 = document.getElementById('img_dep').src = '../views/common/imgs/departament.png';
                    var src2 = document.getElementById('img_ninios').src = '../views/common/imgs/niños-estudiando.jpg';
                    var src3 = document.getElementById('consll').src = '../views/common/imgs/logo_main.png';
                    var src4 = document.getElementById('moodl').src =  '../views/common/imgs/logo_moodle.png';
                    var src5 = document.getElementById('sonfe_text').href =  '../index.php';
                }) 
                    
                  </script>";

?>
<script>
    function muestra() {//show clas ids
        document.getElementById("lista").removeAttribute('hidden');
    }

    function oculta() {//hidde clas id
        document.getElementById("lista").setAttribute('hidden', true);
    }

    function appear() {
        var tpuser = document.getElementById("tpuser");
        var rmHiden = document.getElementById("email");
        var lemail = document.getElementById("apEmail");
        var lnac = document.getElementById("apNac");
        var anc = document.getElementById("anc");
        var lmovil = document.getElementById("lmovil");
        var imovil = document.getElementById("tel");
        if (tpuser.value == 1) {
            rmHiden.removeAttribute('hidden');
            lemail.removeAttribute('hidden');
            lmovil.removeAttribute('hidden');
            imovil.removeAttribute('hidden');
            lnac.setAttribute('hidden', true)
            anc.setAttribute('hidden', true);
        } else if (tpuser.value == 2) {
            rmHiden.setAttribute('hidden', true);
            lemail.setAttribute('hidden', true);
            lmovil.setAttribute('hidden', true);
            imovil.setAttribute('hidden', true);
            anc.removeAttribute('hidden');
            lnac.removeAttribute('hidden');
        } else if (tpuser.value == 0) {
            rmHiden.setAttribute('hidden', true);
            lemail.setAttribute('hidden', true);
            lnac.setAttribute('hidden', true)
            anc.setAttribute('hidden', true);
            lmovil.setAttribute('hidden', true);
            imovil.setAttribute('hidden', true);
        }

    }
</script>
<div class="container text-center mt-5 mb-5">
    <div class="row mb-3">
        <div class="col-12 h3">
            Añade personal
        </div>
    </div>

<form class="" action="addPersonalController.php" method="post">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
    <label>Nombre: </label><input type="text" class="form-control" name="nombre" value=""><br>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
    <label>Apellidos:</label><input type="text" class="form-control" name="apellidos" value=""><br>
            </div>
        </div>
    </div>

    <label>Nick:</label><input type="text" class="form-control" name="usuario" value=""><br>
    <label>Pass:</label><input type="password" class="form-control" name="contrasenya" value=""><br>
    <label>Confirm Pass:</label><input type="password" class="form-control" name="contrasenyaDos" value=""><br>
    <label>Tipo usuario:</label><input type="number" class="form-control" min="0" max="2" id="tpuser" name="idTipoUsuario" value=""
                                       onchange="appear()"> <i><small>0 admin, 1 profesor, 2 alumnno</small></i><br>
    <label>idCurso:</label><input type="number" class="form-control" min="-1" max="13" name="idCurso" value=""> <i id="show" onmouseover="muestra()"
                                                                                              onmouseout="oculta()"><small>ratón aquí
            para info</small></i><br>
    <small>
        <ul hidden id="lista">
            <li><i><small>-1 Sin curso</small></i></li>
            <li><i><small>0 1r GM SMX</small></i></li>
            <li><i><small>1 2n GM SMX</small></i></li>
            <li><i><small>2 1r GS DAW</small></i></li>
            <li><i><small>3 2n GS DAW</small></i></li>
            <li><i><small>4 1r ESO</small></i></li>
            <li><i><small>5 2n ESO</small></i></li>
            <li><i><small>6 3r ESO</small></i></li>
            <li><i><small>7 4rt ESO</small></i></li>
            <li><i><small>8 1r BAX</small></i></li>
            <li><i><small>9 2n BAX</small></i></li>
            <li><i><small>10 1r FPB Info</small></i></li>
            <li><i><small>11 2n FPB Info</small></i></li>
            <li><i><small>12 1r FPB Fabricacio</small></i></li>
            <li><i><small>13 2n FPB Fabricacio</small></i></li>
        </ul>
    </small>
    <label id="apEmail" hidden>email:</label> <input hidden type="email" value="" name="email" id="email"
                                                     placeholder="you@mail.com"><br>
    <label id="lmovil" hidden>tel:</label><input hidden type="tel" value="" name="tel" id="tel" placeholder="600000001"><br>
    <label id="apNac" hidden>año nacimiento</label> <input hidden type="date" id="anc" name="anyNac"
                                                           placeholder="YYYY/MM/DD"><br>
    <button type="submit" name="guardar" class="btn btn-success">guarda</button>
</form>
</div>


<?php
include '../views/common/footer.php';