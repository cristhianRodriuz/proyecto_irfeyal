<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matriculas registradas</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/plugins/sweetalert/dist/sweetalert2.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto mt-2">
                <div class="card">
                    <div class="card-header bg-info text-white text-center py-3">
                        <h2 id="title_periodo">Matriculas registradas</h2>
                    </div>
                    <div class="card-body">
                        <form action="" id="formSelectPeriodos">
                            <div class="form-floating mb-2">
                                <select name="" id="floatingSelect" class="form-select selectTablePeriodo">
                                    <option value="" disabled selected>Periodo lectivo</option>
                                    <option value="2016-2017">2016-2017</option>
                                    <option value="2017-2018">2017-2018</option>
                                    <option value="2018-2019">2018-2019</option>
                                    <option value="2019-2020">2019-2020</option>
                                    <option value="2020-2021">2020-2021</option>
                                </select>
                                <label for="floatingSelect">Periodo lectivo</label>
                            </div>
                        </form>
                        <table class="table table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Variable</th>
                                    <th># Estudiantes</th>
                                    <th>Porcentaje</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                        <a href="index.php" class="btn btn-primary">Volver</a>
                        <a class="btn btn-dark" id="generar_reporte">Generar reporte Excell</a>
                        <div class="row" id="row-grafica">
                            <div class="col-md-6 mx-auto mt-3">
                                <canvas id="grafica"></canvas>
                            </div>
                        </div>
                        <div class="col-12 mx-auto mt-2 text-center">
                        <span id="textMatriculasIniciales" class="fw-300"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/plugins/sweetalert/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/plugins/chartJS/myChart.js"></script>
    <script src="assets/js/tablas.js"></script>
</body>

</html>