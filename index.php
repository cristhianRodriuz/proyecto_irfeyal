<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema historial</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/plugins/sweetalert/dist/sweetalert2.min.css">
</head>

<body>
    <div class="container p-4">
        <div class="row">
            <div class="col-md-10 mx-auto mt-2">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Historial establecimiento</h2>

                        <form action="" class="form" id="formDatosMatriculas">
                            <div class="form-group mb-2">
                                <button type="button" class="btn btn-primary" id="btnGenerar">Nuevo registro</button>
                                <a href="tablas_registro.php" class="btn btn-outline-primary" id="btnVer">Ver historial registrado</a>
                            </div>
                            <div class="form-floating mb-2">
                                <select name="" id="floatingSelect" class="form-select selectPeriodos" disabled>
                                    <option value="" disabled selected>Periodo lectivo</option>
                                </select>
                                <label for="floatingSelect">Periodo lectivo</label>
                            </div>
                            <div class="form-group mb-2">
                                <button type="button" class="btn btn-primary" id="iniciarRegistro">Empezar registro</button>
                                <button type="button" class="btn btn-info" id="btnCambiar">Cambiar periodo</button>
                            </div>
                            <div class="form-group mb-2 pt-2">
                                <h3 class="text-center text-info">Registro de historial de matriculas</h3>
                                <div class="container" id="panelRegistro">
                                    <h4 class="text-center text-secondary">Periodo <span id="periodoElegido"></span></h4>
                                    <input type="hidden" id="idPeriodo">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="text-center">Variables a evaluar</h5>
                                            <div class="form-floating mb-2">
                                                <input type="number" name="total_inicio" id="total_inicio" class="form-control text-center" placeholder="Total inicio" required>
                                                <label for="floatingInicio">Total inicio</label>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input type="number" name="num_agregadas" id="num_agregadas" class="form-control text-center" placeholder="Matriculas agregadas" required>
                                                <label for="floatingInicio">Matriculas agregadas</label>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input type="number" name="num_segregadas" id="num_segregadas" class="form-control text-center" placeholder="Matriculas segregadas" required>
                                                <label for="floatingInicio">Matriculas segregadas</label>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input type="number" name="num_deserciones" id="num_deserciones" class="form-control text-center" placeholder="Número de deserciones" required>
                                                <label for="floatingInicio">Número de deserciones</label>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input type="number" name="num_promovidos" id="num_promovidos" class="form-control text-center" placeholder="Número de promovidos"  required>
                                                <label for="floatingInicio">Número de promovidos</label>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input type="number" name="num_no_promovidos" id="num_no_promovidos" class="form-control text-center" placeholder="Número de no promovidos" required>
                                                <label for="floatingInicio">Número de no promovidos</label>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input type="number" name="matricula_efectiva" id="matricula_efectiva" class="form-control text-center" placeholder="Matrícula efectiva" disabled>
                                                <label for="floatingInicio">Matricula efectiva al final</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="text-center">Valores(%)</h5>
                                            <div class="form-floating mb-2">
                                                <input type="number" name="porcentaje_inicio" id="porcentaje_inicio" class="form-control text-center" placeholder="Total inicio" disabled value="100">
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input type="number" name="porcentaje_agregada" id="porcentaje_agregada" class="form-control text-center num_agregadas" placeholder="Matriculas agregadas" disabled>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input type="number" name="porcentaje_segregadas" id="porcentaje_segregadas" class="form-control text-center num_segregadas" placeholder="Matriculas segregadas" disabled>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input type="number" name="porcentaje_deserciones" id="porcentaje_deserciones" class="form-control text-center num_deserciones" placeholder="Número de deserciones"  disabled>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input type="number" name="porcentaje_promovidos" id="porcentaje_promovidos" class="form-control text-center num_promovidos" placeholder="Número de promovidos" disabled>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input type="number" name="porcentaje_no_promovidos" id="porcentaje_no_promovidos" class="form-control text-center num_no_promovidos" placeholder="Número de no promovidos" disabled>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input type="number" name="porcentaje_efectiva" id="porcentaje_efectiva" class="form-control text-center matricula_efectiva" placeholder="Matrícula efectiva" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" id="btnRegistrar">Registrar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/plugins/sweetalert/dist/sweetalert2.all.min.js"></script>
    <script src="assets/js/app.js"></script>
</body> 

</html>