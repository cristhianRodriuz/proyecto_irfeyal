const tbody = document.getElementById('tbody');
// const grafica = document.getElementById('grafica');
// let ctx = grafica.getContext('2d');
var context = document.getElementById('grafica').getContext('2d');
let datos_t = [];
const title = document.getElementById('title_periodo');
const labels = ["Matrículas agregadas","Matrículas segregadas","Número deserciones","Número promovidos", "Número no promovidos","Matrículas efectivas"];
$(document).ready(function () {
    $(".selectTablePeriodo").on("change",e => {
        $("#generar_reporte").attr("href",'ajax/reportes.php?infoPeriodos=' + e.target.value);
        let cantidad_total = 0;
        $.ajax({
            type: "POST",
            url: "ajax/tables.php",
            data: {"infoPeriodo": e.target.value},
            success: function (response) {
                if(window.myChart){
                    window.myChart.destroy();
                    datos_t = [];
                }
                let datos = JSON.parse(response);
                tbody.innerHTML = '';
                title.textContent = "Estadísticas correspondientes al periodo " + datos[0].periodo;
                for(const info of datos){
                    let insertInfo = `<tr>
                    <td class='text-start'>${info.variables}</td>
                    <td>${info.valor}</td>
                    <td>${info.valor_porcentual} ${(info.valor_porcentual != 0) ? '%' : ''}</td>
                    </tr>`;
                    if(info.variables != 'Matrículas totales al inicio del año'){
                        datos_t.push(info.valor);
                    }else{
                        cantidad_total = info.valor;
                    }
                    tbody.innerHTML += insertInfo;
                }
                $("#textMatriculasIniciales").html("Matriculas iniciales: " + cantidad_total);
                $("#row-grafica").show();
                var config = {
                    type: 'pie',
                    data: {
                        datasets:[{
                            data: datos_t,
                            backgroundColor: ['rgb(0,220,0)',
                            'rgb(0,0,255)',
                            'rgb(0,0,150)',
                            'rgb(255,0,0)',
                            'rgb(120,0,0)',
                            'rgb(220,220,20)',
                            'rgb(255,220,20)'],
                            offset: 4
                        }],
                        labels: labels
                    }
                }
                window.myChart = new Chart(context,config);
            }
        });

        
    })
});