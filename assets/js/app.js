$(document).ready(function(){
    let total_inicio = 0; 
    $("#panelRegistro").hide();
    let btnGenerar = document.getElementById('btnGenerar');
    let btnIniciar = document.getElementById('iniciarRegistro');
    let btnCambiar = document.getElementById('btnCambiar');
    let inputNum = document.querySelector('.inputNumPeriodo');
    let selectPeriodos = document.querySelector('.selectPeriodos');
    let _actual = Number(new Date().getFullYear());
    let attSelectPeriodo = [...selectPeriodos.getAttributeNames()];
    let periodos = {};
    if(attSelectPeriodo.includes('disabled')){
        btnIniciar.setAttribute('disabled',true);
        btnCambiar.setAttribute('disabled',true);
    }

    btnGenerar.addEventListener('click',function(){
        $.ajax({
            type: "POST",
            url: "administrador.php",
            data: {"obtener_periodos": ""},
            success: function (response) {
                let data = JSON.parse(response);
                for(const item of data){
                    let option = document.createElement('option');
                    option.textContent = `${item.inicio} - ${item.fin}`;
                    option.setAttribute('value', `${item.inicio}-${item.fin}`);
                    option.setAttribute('class','optionPeriodo');
                    periodos[`${item.inicio}-${item.fin}`] = item.idperiodos;
                    if(item.evaluado == 1){
                        option.setAttribute('disabled',true);
                    }
                    selectPeriodos.append(option);
                    selectPeriodos.removeAttribute('disabled');
                }
            }
        });
        $(this).attr("disabled",true);
    })
    selectPeriodos.addEventListener('change',(e)=>{
        $("#periodoElegido").html(e.target.value);
        $("#idPeriodo").val(periodos[e.target.value]);
        btnIniciar.removeAttribute("disabled");      
    })
    btnIniciar.addEventListener('click',()=> {
        $("#panelRegistro").toggle(1000);
        selectPeriodos.setAttribute('disabled',true);
        btnCambiar.removeAttribute('disabled');
        btnIniciar.setAttribute('disabled',true);
    })
    btnCambiar.addEventListener('click',()=>{
        $("#panelRegistro").hide(1000);
        selectPeriodos.removeAttribute('disabled');
        btnIniciar.removeAttribute('disabled');
        btnCambiar.setAttribute('disabled',true);
    })
    let subtotal = 0;
    $("#formDatosMatriculas").on('change',(e)=>{
        let id = e.target.id;
        let value = Number(e.target.value);
        if(id == "total_inicio"){
            total_inicio = value;
        }else if(!isNaN(value)){
            subtotal+=value;
            if(subtotal <= total_inicio){
                if(id == "num_no_promovidos"){
                    $(`.${id}`).val(calcularPorcentaje(total_inicio,value));
                    $("#matricula_efectiva").val(Number($("#num_agregadas").val()) +  Number($("#num_promovidos").val()) + Number($("#num_no_promovidos").val()));
                    $(`.matricula_efectiva`).val(calcularPorcentaje(total_inicio,$("#matricula_efectiva").val()));
                }else{
                    $(`.${id}`).val(calcularPorcentaje(total_inicio,value));
                }
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'El número ingresado no es válido',
                    text: 'Has ingresado ' + value + ", lo cuál sumado es: " + subtotal + ". Esta suma no puede ser mayor que el total del inicio = " + total_inicio + ". Llena nuevamente el campo requerido con un valor válido.",
                }).then((result) => {
                    if(result.isConfirmed){
                        $(`#${id}`).focus();
                        $(`#${id}`).val("");
                    }
                })
                subtotal-=value;
            }
        }
    })
    $("#formDatosMatriculas").on("submit",function(e){
        e.preventDefault();
        let formData = new FormData();
        // Valores Variables
        formData.append('idPeriodo',$("#idPeriodo").val());
        formData.append('total_inicio',$("#total_inicio").val());
        formData.append('num_agregadas',$("#num_agregadas").val());
        formData.append('num_segregadas',$("#num_segregadas").val());
        formData.append('num_deserciones',$("#num_deserciones").val());
        formData.append('num_promovidos',$("#num_promovidos").val());
        formData.append('num_no_promovidos',$("#num_no_promovidos").val());
        formData.append('matricula_efectiva',$("#matricula_efectiva").val());
        
        // Porcentaje correspondiente
        formData.append('porcentaje_inicio',$("#porcentaje_inicio").val());
        formData.append('porcentaje_agregada',$("#porcentaje_agregada").val());
        formData.append('porcentaje_segregadas',$("#porcentaje_segregadas").val());
        formData.append('porcentaje_deserciones',$("#porcentaje_deserciones").val());
        formData.append('porcentaje_promovidos',$("#porcentaje_promovidos").val());
        formData.append('porcentaje_no_promovidos',$("#porcentaje_no_promovidos").val());
        formData.append('porcentaje_efectiva',$("#porcentaje_efectiva").val());
        
        Swal.fire({
            title: '¿Quieres guardar los registros de esta matricula?',
            text: "No puedes revertir esta acción",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, almacenar registros!',
            cancelButtonText: "Cancelar"
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "administrador.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        let data = JSON.parse(response);                        
                        if(data.verificacion == true){
                            Swal.fire(
                                '¡Registrado!',
                                'El proceso se ha efectuado correctamente.',
                                'success'
                              ).then((result) => {
                                  if(result.isConfirmed){
                                      subtotal = 0;
                                      window.location.href = "index.php";
                                  }
                              })
                        }
                    }
                });
            }
        })
    })
    function calcularPorcentaje(total,variable){
        let result = Math.round((variable/total) * 100);
        return result;
    }   
})