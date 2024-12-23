function newTapete(resp, title, url) {
    $('#modal-title-lg').html(title);
    console.log(url);
    if (url != '') {
        $.ajax({
            url: url,
            type: 'POST',
            data: { resp },
            success: function(respHtml) {
                $('#modal-body-lg').html(respHtml);

            }
        });
    }
    $.ajax({
        url: '../tapetes/boton.php',
        type: 'POST',
        data: { resp },
        success: function(respHtml) {
            $('#modal-footer-lg').html(respHtml);
        }
    });
}

function crearTapetes(param, file, table) {
    if (validarCampos(param) == 0) {
        var formulario = new FormData($("#" + param)[0]);
        $.ajax({
            url: '../tapetes/tapetes.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                $('#largeModal').modal('hide');
                $('#modal-title-sm').html('Solicitud Actualizada');
                $('#modal-body-sm').html(resp);
                $('#smallModal').modal('show');
                $('#btn-footer-sm').attr('onclick', 'refreshTablePer("' + file + '","' + table + '")');
            }
        });
    }
}


function appearTa(value) {
    if (value == 1) {
        $.ajax({
            url: '../tapetes/Tsimples.php',
            type: 'POST',
            data: { value: value },
            success: function(resp) {
                $('#tipTap').html(resp);
                $('#agregartap').attr("onclick", "crearTiem('1', 'form-Tsen')");
                $('#agregartap').html('Tapete Sencillo');

            }
        });
    } else if (value == 2) {
        $.ajax({
            url: '../tapetes/Tcomplejos.php',
            type: 'POST',
            data: { value: value },
            success: function(resp) {
                $('#tipTap').html(resp);
                $('#agregartap').attr("onclick", "crearTiem('2','form-Tcom')");
                $('#agregartap').html('Tapete Complejo');
            }
        });
    } else if (value == 3) {
        $.ajax({
            url: '../tapetes/Tsinlogo.php',
            type: 'POST',
            data: { value: value },
            success: function(resp) {
                $('#tipTap').html(resp);
                $('#agregartap').attr("onclick", "crearTiem('3', 'form-Tsin')");
                $('#agregartap').html('Tapete Sin Logo');

            }
        });
    } else if (value == 4) {
        $.ajax({
            url: '../tapetes/manoT.php',
            type: 'POST',
            data: { value: value },
            success: function(resp) {
                $('#tipTap').html(resp);
                $('#agregartap').attr("onclick", "crearTiem('4', 'form-manotap')");
                $('#agregartap').html('Mano de obra');

            }
        });
    }
}

function crearTiem(value, param) {
    if (validarCampos(param) == 0) {
        var formulario = new FormData($("#" + param)[0]);
        $.ajax({
            url: '../tapetes/tapetes.controller.php',
            data: formulario,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(resp) {
                if (value == 1) {
                    $('#respuestaSimp').html(resp);
                    $('#errorSim').html('');
                } else if (value == 2) {
                    $('#respuestaCom').html(resp);
                    $('#errorCom').html('');
                } else if (value == 3) {
                    $('#respuestaSin').html(resp);
                    $('#errorSin').html('');
                } else if (value == 4) {
                    $('#respuemantap').html(resp);
                    $('#rrorMan').html('');
                }
            }
        });
    }
}

function openTap(param) {
    if (param == 1) {
        $('#openTa').css("display", "block");
        $('#opentapetes').attr('onclick', 'openTap(2)');
    } else if (param == 2) {
        $('#openTa').css("display", "none");
        $('#opentapetes').attr('onclick', 'openTap(1)');
    } else if (param == 3) {
        $('#idlogo').css("visibility", "visible");
        $('#openlog').attr('onclick', 'openTap(4)');
        $('#tip_tap_log').attr('onchange', 'calcuTapint(4,this.value);');
    } else if (param == 4) {
        $('#idlogo').css("visibility", "hidden");
        $('#openlog').attr('onclick', 'openTap(3)');

    }

}

function calcularTab() {
    // Mano de obra primera parte 
    if ($('#sal_bas').val() != "") {
        var salB = $('#sal_bas').val();
        if ($('#fac_pres').val() != "") {
            var facP = $('#fac_pres').val();
            if ($('#sub_tran').val() != "") {
                var subT = $('#sub_tran').val();
                var totSa = parseFloat(salB) + (parseFloat(salB) * parseFloat(facP)) + parseFloat(subT);
                $('#tot_sal').attr("value", totSa);
            }
        }
    }
    if ($('#hor_mes').val() != "") {
        var horM = $('#hor_mes').val();
        var costH = Math.round(parseFloat(totSa) / parseFloat(horM));
        $('#cos_hor').attr("value", costH);
    }
    //formulas de tapete sencillo
    if ($('#di_min').val() != "") {
        var dimin = $('#di_min').val();
        var dihor = (parseFloat(dimin) / 60);
        $('#di_horas').attr("value", dihor);
    }
    if ($('#cal_min').val() != "") {
        var calmin = $('#cal_min').val();
        var calhor = (parseFloat(calmin) / 60);
        $('#cal_horas').attr("value", calhor);
    }
    if ($('#peg_min').val() != "") {
        var pegmin = $('#peg_min').val();
        var peghor = (parseFloat(pegmin) / 60);
        $('#peg_horas').attr("value", peghor);
    }
    if ($('#cort_min').val() != "") {
        var cortmin = $('#cort_min').val();
        var corthor = (parseFloat(cortmin) / 60);
        $('#cort_horas').attr("value", corthor);
    }
    if ($('#base_min').val() != "") {
        var basemin = $('#base_min').val();
        var basehor = (parseFloat(basemin) / 60);
        $('#base_Horas').attr("value", basehor);
    }
    if ($('#log_min').val() != "") {
        var logmin = $('#log_min').val();
        var loghor = (parseFloat(logmin) / 60);
        $('#log_Horas').attr("value", loghor);
    }
    if ($('#unio_min').val() != "") {
        var uniomin = $('#unio_min').val();
        var uniohor = (parseFloat(uniomin) / 60);
        $('#unio_Horas').attr("value", uniohor);
    }
    if ($('#escu_min').val() != "") {
        var escuomin = $('#escu_min').val();
        var escuhor = (parseFloat(escuomin) / 60);
        $('#escu_Horas').attr("value", escuhor);
    }
    if ($('#perfi_min').val() != "") {
        var perfimin = $('#perfi_min').val();
        var perfihor = (parseFloat(perfimin) / 60);
        $('#perfi_Horas').attr("value", perfihor);
    }
    if ($('#rell_min').val() != "") {
        var rellmin = $('#rell_min').val();
        var rellhor = (parseFloat(rellmin) / 60);
        var totaSum = parseFloat(dihor) + parseFloat(calhor) + parseFloat(peghor) + parseFloat(corthor) + parseFloat(basehor) +
            parseFloat(loghor) + parseFloat(uniohor) + parseFloat(escuhor) + parseFloat(perfihor) + parseFloat(rellhor);
        $('#rell_Horas').attr("value", rellhor);
        $('#tot_Horas').attr("value", totaSum);

    }
    //formulas de tapete complejo 
    if ($('#di_min2').val() != "") {
        var di_min2 = $('#di_min2').val();
        var di_horas2 = (parseFloat(di_min2) / 60);
        $('#di_horas2').attr("value", di_horas2);
    }
    if ($('#cal_min2').val() != "") {
        var calmin2 = $('#cal_min2').val();
        var calhor2 = (parseFloat(calmin2) / 60);
        $('#cal_horas2').attr("value", calhor2);
    }
    if ($('#peg_min2').val() != "") {
        var pegmin2 = $('#peg_min2').val();
        var peghor2 = (parseFloat(pegmin2) / 60);
        $('#peg_horas2').attr("value", peghor2);
    }
    if ($('#cort_min2').val() != "") {
        var cortmin2 = $('#cort_min2').val();
        var corthor2 = (parseFloat(cortmin2) / 60);
        $('#cort_horas2').attr("value", corthor2);
    }
    if ($('#base_min2').val() != "") {
        var basemin2 = $('#base_min2').val();
        var basehor2 = (parseFloat(basemin2) / 60);
        $('#base_Horas2').attr("value", basehor2);
    }
    if ($('#log_min2').val() != "") {
        var logmin2 = $('#log_min2').val();
        var loghor2 = (parseFloat(logmin2) / 60);
        $('#log_Horas2').attr("value", loghor2);
    }
    if ($('#unio_min2').val() != "") {
        var uniomin2 = $('#unio_min2').val();
        var uniohor2 = (parseFloat(uniomin2) / 60);
        $('#unio_Horas2').attr("value", uniohor2);
    }
    if ($('#escu_min2').val() != "") {
        var escuomin2 = $('#escu_min2').val();
        var escuhor2 = (parseFloat(escuomin2) / 60);
        $('#escu_Horas2').attr("value", escuhor2);
    }
    if ($('#perfi_min2').val() != "") {
        var perfimin2 = $('#perfi_min2').val();
        var perfihor2 = (parseFloat(perfimin2) / 60);
        $('#perfi_Horas2').attr("value", perfihor2);
    }
    if ($('#rell_min2').val() != "") {
        var rellmin2 = $('#rell_min2').val();
        var rellhor2 = (parseFloat(rellmin2) / 60);
        var totaSum2 = parseFloat(di_horas2) + parseFloat(calhor2) + parseFloat(peghor2) + parseFloat(corthor2) + parseFloat(basehor2) +
            parseFloat(loghor2) + parseFloat(uniohor2) + parseFloat(escuhor2) + parseFloat(perfihor2) + parseFloat(rellhor2);
        $('#rell_Horas2').attr("value", rellhor2);
        $('#tot_Horas2').attr("value", totaSum2);
    }
    //// tapete sin logo 
    if ($('#di_min3').val() != "") {
        var dimin3 = $('#di_min3').val();
        var dihor3 = (parseFloat(dimin3) / 60);
        $('#di_horas3').attr("value", dihor3);
    }
    if ($('#cal_min3').val() != "") {
        var calmin3 = $('#cal_min3').val();
        var calhor3 = (parseFloat(calmin3) / 60);
        $('#cal_horas3').attr("value", calhor3);
    }
    if ($('#peg_min3').val() != "") {
        var pegmin3 = $('#peg_min3').val();
        var peghor3 = (parseFloat(pegmin3) / 60);
        $('#peg_horas3').attr("value", peghor3);
    }
    if ($('#cort_min3').val() != "") {
        var cortmin3 = $('#cort_min3').val();
        var corthor3 = (parseFloat(cortmin3) / 60);
        $('#cort_horas3').attr("value", corthor3);
    }
    if ($('#base_min3').val() != "") {
        var basemin3 = $('#base_min3').val();
        var basehor3 = (parseFloat(basemin3) / 60);
        $('#base_Horas3').attr("value", basehor3);
    }
    if ($('#log_min3').val() != "") {
        var logmin3 = $('#log_min3').val();
        var loghor3 = (parseFloat(logmin3) / 60);
        $('#log_Horas3').attr("value", loghor3);
    }
    if ($('#unio_min3').val() != "") {
        var uniomin3 = $('#unio_min3').val();
        var uniohor3 = (parseFloat(uniomin3) / 60);
        $('#unio_Horas3').attr("value", uniohor3);
    }
    if ($('#escu_min3').val() != "") {
        var escuomin3 = $('#escu_min3').val();
        var escuhor3 = (parseFloat(escuomin3) / 60);
        $('#escu_Horas3').attr("value", escuhor3);
    }
    if ($('#perfi_min3').val() != "") {
        var perfimin3 = $('#perfi_min3').val();
        var perfihor3 = (parseFloat(perfimin3) / 60);
        $('#perfi_Horas3').attr("value", perfihor3);
    }
    if ($('#rell_min3').val() != "") {
        var rellmin3 = $('#rell_min3').val();
        var rellhor3 = (parseFloat(rellmin3) / 60);
        var totaSum3 = parseFloat(dihor3) + parseFloat(calhor3) + parseFloat(peghor3) + parseFloat(corthor3) + parseFloat(basehor3) +
            parseFloat(loghor3) + parseFloat(uniohor3) + parseFloat(escuhor3) + parseFloat(perfihor3) + parseFloat(rellhor3);
        $('#rell_Horas3').attr("value", rellhor3);
        $('#tot_Horas3').attr("value", totaSum3);
    }
    // Formulario de costo de material
    // Nomad T3000
    if ($('#cl_t3').val() != "") {
        var clt3 = $('#cl_t3').val();
        var valml3 = (parseFloat(clt3) * 100);
        var valm23 = ((parseFloat(clt3) * 10) / 120);
        $('#ml_t3').attr("value", valml3);
        $('#m2_t3').attr("value", valm23);
    }
    // Nomad T1000
    if ($('#cl_t1').val() != "") {
        var clt1 = $('#cl_t1').val();
        var valml1 = (parseFloat(clt1) * 100);
        var valm21 = ((parseFloat(clt1) * 10) / 120);
        $('#ml_t1').attr("value", valml1);
        $('#m2_t1').attr("value", valm21);
    }
    // Tapete Koreano pesado 
    if ($('#m2_tkor').val() != "") {
        var cmTk = $('#m2_tkor').val();
        var ctkMl = (parseFloat(cmTk) * 1.2);
        $('#ml_tkor').attr("value", ctkMl);
    }
    // Tapete Koreano liviano
    if ($('#m2_tliv').val() != "") {
        var cmTvl = $('#m2_tliv').val();
        var cTL = (parseFloat(cmTvl) * 1.2);
        $('#ml_tliv').attr("value", cTL);
    }
    //Boston
    if ($('#cl_boston').val() != "") {
        var clbost = $('#cl_boston').val();
        var clbost1 = (parseFloat(clbost) * 100);
        var clbost2 = ((parseFloat(clbost) * 10) / 180);
        $('#ml_boston').attr("value", clbost1);
        $('#m2_boston').attr("value", clbost2);
    }
    //Aqua 
    if ($('#cl_aqua').val() != "") {
        var aqua = $('#cl_aqua').val();
        var aqua1 = (parseFloat(aqua) * 100);
        var aqua2 = ((parseFloat(aqua) * 10) / 120);
        $('#ml_aqua').attr("value", aqua1);
        $('#m2_aqua').attr("value", aqua2);
    }
    //Nomad Sin Base
    if ($('#cl_nsb').val() != "") {
        var sinba = $('#cl_nsb').val();
        var sinba1 = (parseFloat(sinba) * 100);
        var sinba2 = ((parseFloat(sinba) * 10) / 120);
        $('#ml_nsb').attr("value", sinba1);
        $('#m2_nsb').attr("value", sinba2);
    }
    //Depreciación
    if ($('#dep_mes').val() != "") {
        var depm = $('#dep_mes').val();
        var dept = (parseFloat(depm) / 184);
        $('#dep_hora').attr("value", dept);
    }
    //Servicios Publicos 
    if ($('#plan_mes').val() != "") {
        var plan = $('#plan_mes').val();
        var plansiatm = (parseFloat(plan) * 0.7);
        $('#siat_mes').attr("value", plansiatm);
    }
    if ($('#siat_mes').val() != "") {
        var siat = $('#siat_mes').val();
        var siatT = Math.round((parseFloat(siat) / 184));
        $('#siat_hor').attr("value", siatT);
    }

}


//funcion de sumas onkey up de tapetes
function calculator() {
    //Perfil 
    if ($('#base_anc').val() != "") {
        var baseAnch = $('#base_anc').val();
        if ($('#base_alt').val() != "") {
            var baseAlto = $('#base_alt').val();
            var perfil = ((((parseFloat(baseAnch) * 2) + (parseFloat(baseAlto) * 2)) * 0.05) + ((parseFloat(baseAnch) * 2) + ((parseFloat(baseAlto) * 2)) * 1) * 1)
            $('#perfil').attr("value", perfil);
            // como se ponene las medidas  se pone de una vez el costo de pegante y del pliego Bond
            //pegante Maxon
            $('#pegm_can').attr("value", "1");
            var peg = $('#pegm_can').val();
            var pegCo = $('#pegm_cost').val();
            var totpeg = (parseFloat(peg) * parseFloat(pegCo));
            $('#pegm_ctot').attr("value", totpeg);
            //pliego papel bond
            $('#ppb_can').attr("value", "1");
            var ppb = $('#ppb_can').val();
            var ppbCo = $('#ppb_cost').val();
            var totppb = (parseFloat(ppb) * parseFloat(ppbCo));
            $('#ppb_ctot').attr("value", totppb);
            // Tapete 
            if ($('#anch_est').val() != "") {
                var basEst = $('#anch_est').val();
                var tapete = (((((parseFloat(baseAnch) * parseFloat(baseAlto)) * 0.02) + (parseFloat(baseAnch) * parseFloat(baseAlto)) / parseFloat(basEst)) * 1) * 1)
                var decim = Math.round(tapete * 100) / 100
                $('#tapete').attr("value", decim);
                //Logo
                var taplog = (((parseFloat(baseAnch) * parseFloat(baseAlto)) * 0.35) * 0.05) + (((parseFloat(baseAnch) * parseFloat(baseAlto)) * 0.35)) * 0;
                var taplogselec = (((parseFloat(baseAnch) * parseFloat(baseAlto)) * 0.35) * 0.05) + (((parseFloat(baseAnch) * parseFloat(baseAlto)) * 0.35)) * 1;
                // Cuando el logo no es seleccionado
                //Tapete Nomad T3000 Logo
                $('#tn3l_can').attr("value", taplog);
                var costlog3cer = $('#tn3l_cost').val();
                var totlog3cer = parseFloat(taplog) * parseFloat(costlog3cer);
                var totlog3cerDecim = totlog3cer.toFixed(3);
                $('#tn3l_ctot').attr("value", totlog3cerDecim);
                //Tapete Nomad T1000 Logo
                $('#tn1l_can').attr("value", taplog);
                var costlog1cer = $('#tn1l_cost').val();
                var totlog1cer = parseFloat(taplog) * parseFloat(costlog1cer);
                var totlog1cerDecim = totlog1cer.toFixed(3);
                $('#tn1l_ctot').attr("value", totlog1cerDecim);
                //Tapete Koreano Trafico Liviano Logo
                $('#tktll_can').attr("value", taplog);
                var costloglivcer = $('#tktll_cost').val();
                var totloglivcer = Math.round(parseFloat(taplog) * parseFloat(costloglivcer));
                $('#tktll_ctot').attr("value", totloglivcer);
                // Imputs ocultos 
                $('#estandlog').attr("value", taplog);
                $('#logo').attr("value", taplogselec);
            }
        }
    }

}

function calcuTapint(param, value) {
    if (param == 1) {
        if (value == 1) {
            //si es sencillo
            $('#mans_can').attr("value", "1");
            var Msen = $('#mans_can').val();
            var MsenCo = $('#mans_cost').val();
            var costS = (parseFloat(Msen) * parseFloat(MsenCo));
            $('#mans_ctot').attr("value", costS);
            //Poner 0 tapete complejo
            $('#mancom_can').attr("value", "0");
            var Mcoce = $('#mancom_can').val();
            var costce = $('#mancom_cost').val();
            var totcostce = (parseFloat(Mcoce) * parseFloat(costce));
            $('#mancom_ctot').attr("value", totcostce);
            $('#mancom_part').attr("value", "0,0");
            //poner 0 tapete sin logo 
            $('#mansin_can').attr("value", "0");
            var Msice = $('#mansin_can').val();
            var costsice = $('#mansin_cost').val();
            var totsince = (parseFloat(Msice) * parseFloat(costsice));
            $('#mansin_ctot').attr("value", totsince);
            $('#mansin_part').attr("value", "0,0");
        } else if (value == 2) {
            // si es complejo
            $('#mancom_can').attr("value", "1");
            var Mcom = $('#mancom_can').val();
            var costcomp = $('#mancom_cost').val();
            var totcomp = (parseFloat(Mcom) * parseFloat(costcomp));
            $('#mancom_ctot').attr("value", totcomp);
            // Poner 0 Tapete sencillo 
            $('#mans_can').attr("value", "0");
            var Msencero = $('#mans_can').val();
            var MsenCoscero = $('#mans_cost').val();
            var totcerosen = (parseFloat(Msencero) * parseFloat(MsenCoscero));
            $('#mans_ctot').attr("value", totcerosen);
            $('#mans_part').attr("value", "0,0");
            //poner 0 tapete sin logo 
            $('#mansin_can').attr("value", "0");
            var Msice = $('#mansin_can').val();
            var costsice = $('#mansin_cost').val();
            var totsince = (parseFloat(Msice) * parseFloat(costsice));
            $('#mansin_ctot').attr("value", totsince);
            $('#mansin_part').attr("value", "0,0");
        } else if (value == 3) {
            // si es sin logo 
            $('#mansin_can').attr("value", "1");
            var Msilo = $('#mansin_can').val();
            var costsilo = $('#mansin_cost').val();
            var totsinlo = (parseFloat(Msilo) * parseFloat(costsilo));
            $('#mansin_ctot').attr("value", totsinlo);
            //Poner 0 tapete complejo
            $('#mancom_can').attr("value", "0");
            var Mcoce = $('#mancom_can').val();
            var costce = $('#mancom_cost').val();
            var totcostce = (parseFloat(Mcoce) * parseFloat(costce));
            $('#mancom_ctot').attr("value", totcostce);
            $('#mancom_part').attr("value", "0,0");
            // Poner 0 Tapete sencillo 
            $('#mans_can').attr("value", "0");
            var Msencero = $('#mans_can').val();
            var MsenCoscero = $('#mans_cost').val();
            var totcerosen = (parseFloat(Msencero) * parseFloat(MsenCoscero));
            $('#mans_ctot').attr("value", totcerosen);
            $('#mans_part').attr("value", "0,0");
        }
    } else if (param == 2) {
        if (value == 1) {
            // Si es perfil Mediano
            var perM = $('#perfil').val();
            var cosperM = $('#perM_cost').val();
            var pertotM = Math.round(parseFloat(perM) * parseFloat(cosperM));
            $('#perM_can').attr("value", perM);
            $('#perM_ctot').attr("value", pertotM);
            // 0.0 perfil grueso 
            $('#perG_can').attr("value", "0,0");
            var perfgruce = $('#perG_can').val();
            var coscerGru = $('#perG_cost').val();
            var totcerGr = parseFloat(perfgruce) * parseFloat(coscerGru);
            $('#perG_ctot').attr("value", totcerGr);
        } else if (value == 2) {
            // Si es perfil grueso 
            var perG = $('#perfil').val();
            var cpstperG = $('#perG_cost').val();
            var pertotG = parseFloat(perG) * parseFloat(cpstperG);
            $('#perG_can').attr("value", perG);
            $('#perG_ctot').attr("value", pertotG);
            // 0.0 perfil mediano
            $('#perM_can').attr("value", "0,0");
            var perfgruce = $('#perM_can').val();
            var coscerGru = $('#perM_cost').val();
            var totcerGr = Math.round(parseFloat(perfgruce) * parseFloat(coscerGru));
            $('#perM_ctot').attr("value", totcerGr);
        }
    } else if (param == 3) {
        if (value == 1) {
            //Si es Tapete Nomad T3000 base
            var tap3 = $('#tapete').val();
            var cosTap3 = $('#tap3_cost').val();
            var totap3 = parseFloat(tap3) * parseFloat(cosTap3);
            $('#tap3_can').attr("value", tap3);
            $('#tap3_ctot').attr("value", totap3);
            // 0 Tapete Nomad T1000 base
            $('#tap1_can').attr("value", "0,0");
            var tap1cantce = $('#tap1_can').val();
            var tap1costcer = $('#tap1_cost').val();
            var totap1cer = parseFloat(tap1cantce) * parseFloat(tap1costcer);
            $('#tap1_ctot').attr("value", totap1cer);
            // 0 Tapete Koreano Trafico Pesado Base
            $('#tkpb_can').attr("value", "0,0");
            var tkpbcer = $('#tkpb_can').val();
            var tkpbcostcer = $('#tkpb_cost').val();
            var tkpbtotcer = parseFloat(tkpbcer) * parseInt(tkpbcostcer);
            $('#tkpb_ctot').attr("value", tkpbtotcer);
            // 0 Tapete Koreano Trafico Liviano Base
            $('#tktlb_can').attr("value", "0,0");
            var tktlbcer = $('#tktlb_can').val();
            var tktlbcostcer = $('#tktlb_cost').val();
            var tktlbtotcer = parseFloat(tktlbcer) * parseFloat(tktlbcostcer);
            $('#tktlb_ctot').attr("value", tktlbtotcer);
            // 0 Tapete Boston Tapete
            $('#boston_can').attr("value", "0,0");
            var bostoncer = $('#boston_can').val();
            var bostoncostcer = $('#boston_cost').val();
            var bostontotcer = parseFloat(bostoncer) * parseFloat(bostoncostcer);
            $('#boston_ctot').attr("value", bostontotcer);
            // 0 Tapete Aqua
            $('#aqua_can').attr("value", "0,0");
            var aquacer = $('#aqua_can').val();
            var aquaccer = $('#aqua_cost').val();
            var aquatotcer = parseFloat(aquacer) * parseFloat(aquaccer);
            $('#aqua_ctot').attr("value", aquatotcer);
            // 0 Tapete Nomad Sin Base
            $('#tnsb_can').attr("value", "0,0");
            var tnsbcer = $('#tnsb_can').val();
            var tnsbcostcer = $('#tnsb_cost').val();
            var tnsbtotcer = parseFloat(tnsbcer) * parseFloat(tnsbcostcer);
            $('#tnsb_ctot').attr("value", tnsbtotcer);
        } else if (value == 2) {
            // Si tapete Nomad T1000 base
            var tap1 = $('#tapete').val();
            var cosTap1 = $('#tap1_cost').val();
            var totap1 = parseFloat(tap1) * parseFloat(cosTap1);
            $('#tap1_can').attr("value", tap1);
            $('#tap1_ctot').attr("value", totap1);
            // 0 Tapete Nomad T3000 base
            $('#tap3_can').attr("value", "0,0");
            var tapcer = $('#tap3_can').val();
            var tapcost3cer = $('#tap3_cost').val();
            var taptot3cer = parseFloat(tapcer) * parseInt(tapcost3cer);
            $('#tap3_ctot').attr("value", taptot3cer);
            // 0 Tapete Koreano Trafico Pesado Base
            $('#tkpb_can').attr("value", "0,0");
            var tkpbcer = $('#tkpb_can').val();
            var tkpbcostcer = $('#tkpb_cost').val();
            var tkpbtotcer = parseFloat(tkpbcer) * parseInt(tkpbcostcer);
            $('#tkpb_ctot').attr("value", tkpbtotcer);
            // 0 Tapete Koreano Trafico Liviano Base
            $('#tktlb_can').attr("value", "0,0");
            var tktlbcer = $('#tktlb_can').val();
            var tktlbcostcer = $('#tktlb_cost').val();
            var tktlbtotcer = parseFloat(tktlbcer) * parseFloat(tktlbcostcer);
            $('#tktlb_ctot').attr("value", tktlbtotcer);
            // 0 Tapete Boston Tapete
            $('#boston_can').attr("value", "0,0");
            var bostoncer = $('#boston_can').val();
            var bostoncostcer = $('#boston_cost').val();
            var bostontotcer = parseFloat(bostoncer) * parseFloat(bostoncostcer);
            $('#boston_ctot').attr("value", bostontotcer);
            // 0 Tapete Aqua
            $('#aqua_can').attr("value", "0,0");
            var aquacer = $('#aqua_can').val();
            var aquaccer = $('#aqua_cost').val();
            var aquatotcer = parseFloat(aquacer) * parseFloat(aquaccer);
            $('#aqua_ctot').attr("value", aquatotcer);
            // 0 Tapete Nomad Sin Base
            $('#tnsb_can').attr("value", "0,0");
            var tnsbcer = $('#tnsb_can').val();
            var tnsbcostcer = $('#tnsb_cost').val();
            var tnsbtotcer = parseFloat(tnsbcer) * parseFloat(tnsbcostcer);
            $('#tnsb_ctot').attr("value", tnsbtotcer);
        } else if (value == 3) {
            // Si Tapete Koreano Trafico Pesado Base
            var tkpb = $('#tapete').val();
            var costkpb = $('#tkpb_cost').val();
            var totkpb = parseFloat(tkpb) * parseFloat(costkpb);
            $('#tkpb_can').attr("value", tkpb);
            $('#tkpb_ctot').attr("value", totkpb);
            // 0 Tapete Nomad T1000 base
            $('#tap1_can').attr("value", "0,0");
            var tap1cantce = $('#tap1_can').val();
            var tap1costcer = $('#tap1_cost').val();
            var totap1cer = parseFloat(tap1cantce) * parseFloat(tap1costcer);
            $('#tap1_ctot').attr("value", totap1cer);
            // 0 Tapete Nomad T3000 base
            $('#tap3_can').attr("value", "0,0");
            var tapcer = $('#tap3_can').val();
            var tapcost3cer = $('#tap3_cost').val();
            var taptot3cer = parseFloat(tapcer) * parseInt(tapcost3cer);
            $('#tap3_ctot').attr("value", taptot3cer);
            // 0 Tapete Koreano Trafico Liviano Base
            $('#tktlb_can').attr("value", "0,0");
            var tktlbcer = $('#tktlb_can').val();
            var tktlbcostcer = $('#tktlb_cost').val();
            var tktlbtotcer = parseFloat(tktlbcer) * parseFloat(tktlbcostcer);
            $('#tktlb_ctot').attr("value", tktlbtotcer);
            // 0 Tapete Boston Tapete
            $('#boston_can').attr("value", "0,0");
            var bostoncer = $('#boston_can').val();
            var bostoncostcer = $('#boston_cost').val();
            var bostontotcer = parseFloat(bostoncer) * parseFloat(bostoncostcer);
            $('#boston_ctot').attr("value", bostontotcer);
            // 0 Tapete Aqua
            $('#aqua_can').attr("value", "0,0");
            var aquacer = $('#aqua_can').val();
            var aquaccer = $('#aqua_cost').val();
            var aquatotcer = parseFloat(aquacer) * parseFloat(aquaccer);
            $('#aqua_ctot').attr("value", aquatotcer);
            // 0 Tapete Nomad Sin Base
            $('#tnsb_can').attr("value", "0,0");
            var tnsbcer = $('#tnsb_can').val();
            var tnsbcostcer = $('#tnsb_cost').val();
            var tnsbtotcer = parseFloat(tnsbcer) * parseFloat(tnsbcostcer);
            $('#tnsb_ctot').attr("value", tnsbtotcer);

        } else if (value == 4) {
            // Si Tapete Koreano Trafico Liviano Base
            var tktlb = $('#tapete').val();
            var costktlb = $('#tktlb_cost').val();
            var totktlb = parseFloat(tktlb) * parseFloat(costktlb);
            $('#tktlb_can').attr("value", tktlb);
            $('#tktlb_ctot').attr("value", totktlb);
            // 0 Tapete Nomad T1000 base
            $('#tap1_can').attr("value", "0,0");
            var tap1cantce = $('#tap1_can').val();
            var tap1costcer = $('#tap1_cost').val();
            var totap1cer = parseFloat(tap1cantce) * parseFloat(tap1costcer);
            $('#tap1_ctot').attr("value", totap1cer);
            // 0 Tapete Nomad T3000 base
            $('#tap3_can').attr("value", "0,0");
            var tapcer = $('#tap3_can').val();
            var tapcost3cer = $('#tap3_cost').val();
            var taptot3cer = parseFloat(tapcer) * parseInt(tapcost3cer);
            $('#tap3_ctot').attr("value", taptot3cer);
            // 0 Tapete Koreano Trafico Pesado Base
            $('#tkpb_can').attr("value", "0,0");
            var tkpbcer = $('#tkpb_can').val();
            var tkpbcostcer = $('#tkpb_cost').val();
            var tkpbtotcer = parseFloat(tkpbcer) * parseInt(tkpbcostcer);
            $('#tkpb_ctot').attr("value", tkpbtotcer);
            // 0 Tapete Boston Tapete
            $('#boston_can').attr("value", "0,0");
            var bostoncer = $('#boston_can').val();
            var bostoncostcer = $('#boston_cost').val();
            var bostontotcer = parseFloat(bostoncer) * parseFloat(bostoncostcer);
            $('#boston_ctot').attr("value", bostontotcer);
            // 0 Tapete Aqua
            $('#aqua_can').attr("value", "0,0");
            var aquacer = $('#aqua_can').val();
            var aquaccer = $('#aqua_cost').val();
            var aquatotcer = parseFloat(aquacer) * parseFloat(aquaccer);
            $('#aqua_ctot').attr("value", aquatotcer);
            // 0 Tapete Nomad Sin Base
            $('#tnsb_can').attr("value", "0,0");
            var tnsbcer = $('#tnsb_can').val();
            var tnsbcostcer = $('#tnsb_cost').val();
            var tnsbtotcer = parseFloat(tnsbcer) * parseFloat(tnsbcostcer);
            $('#tnsb_ctot').attr("value", tnsbtotcer);
        } else if (value == 5) {
            // Si es Tapete Boston
            var boston = $('#tapete').val();
            var costbost = $('#boston_cost').val();
            var bostontot = parseFloat(boston) * parseFloat(costbost);
            $('#boston_can').attr("value", boston);
            $('#boston_ctot').attr("value", bostontot);
            // 0 Tapete Nomad T1000 base
            $('#tap1_can').attr("value", "0,0");
            var tap1cantce = $('#tap1_can').val();
            var tap1costcer = $('#tap1_cost').val();
            var totap1cer = parseFloat(tap1cantce) * parseFloat(tap1costcer);
            $('#tap1_ctot').attr("value", totap1cer);
            // 0 Tapete Nomad T3000 base
            $('#tap3_can').attr("value", "0,0");
            var tapcer = $('#tap3_can').val();
            var tapcost3cer = $('#tap3_cost').val();
            var taptot3cer = parseFloat(tapcer) * parseInt(tapcost3cer);
            $('#tap3_ctot').attr("value", taptot3cer);
            // 0 Tapete Koreano Trafico Pesado Base
            $('#tkpb_can').attr("value", "0,0");
            var tkpbcer = $('#tkpb_can').val();
            var tkpbcostcer = $('#tkpb_cost').val();
            var tkpbtotcer = parseFloat(tkpbcer) * parseInt(tkpbcostcer);
            $('#tkpb_ctot').attr("value", tkpbtotcer);
            // 0 Tapete Koreano Trafico Liviano Base
            $('#tktlb_can').attr("value", "0,0");
            var tktlbcer = $('#tktlb_can').val();
            var tktlbcostcer = $('#tktlb_cost').val();
            var tktlbtotcer = parseFloat(tktlbcer) * parseFloat(tktlbcostcer);
            $('#tktlb_ctot').attr("value", tktlbtotcer);
            // 0 Tapete Aqua
            $('#aqua_can').attr("value", "0,0");
            var aquacer = $('#aqua_can').val();
            var aquaccer = $('#aqua_cost').val();
            var aquatotcer = parseFloat(aquacer) * parseFloat(aquaccer);
            $('#aqua_ctot').attr("value", aquatotcer);
            // 0 Tapete Nomad Sin Base
            $('#tnsb_can').attr("value", "0,0");
            var tnsbcer = $('#tnsb_can').val();
            var tnsbcostcer = $('#tnsb_cost').val();
            var tnsbtotcer = parseFloat(tnsbcer) * parseFloat(tnsbcostcer);
            $('#tnsb_ctot').attr("value", tnsbtotcer);
        } else if (value == 6) {
            // Si es Tapete Aqua
            var aqua = $('#tapete').val();
            var costaqua = $('#aqua_cost').val();
            var aquatot = parseFloat(aqua) * parseFloat(costaqua);
            $('#aqua_can').attr("value", aqua);
            $('#aqua_ctot').attr("value", aquatot);
            // 0 Tapete Nomad T1000 base
            $('#tap1_can').attr("value", "0,0");
            var tap1cantce = $('#tap1_can').val();
            var tap1costcer = $('#tap1_cost').val();
            var totap1cer = parseFloat(tap1cantce) * parseFloat(tap1costcer);
            $('#tap1_ctot').attr("value", totap1cer);
            // 0 Tapete Nomad T3000 base
            $('#tap3_can').attr("value", "0,0");
            var tapcer = $('#tap3_can').val();
            var tapcost3cer = $('#tap3_cost').val();
            var taptot3cer = parseFloat(tapcer) * parseInt(tapcost3cer);
            $('#tap3_ctot').attr("value", taptot3cer);
            // 0 Tapete Koreano Trafico Pesado Base
            $('#tkpb_can').attr("value", "0,0");
            var tkpbcer = $('#tkpb_can').val();
            var tkpbcostcer = $('#tkpb_cost').val();
            var tkpbtotcer = parseFloat(tkpbcer) * parseInt(tkpbcostcer);
            $('#tkpb_ctot').attr("value", tkpbtotcer);
            // 0 Tapete Koreano Trafico Liviano Base
            $('#tktlb_can').attr("value", "0,0");
            var tktlbcer = $('#tktlb_can').val();
            var tktlbcostcer = $('#tktlb_cost').val();
            var tktlbtotcer = parseFloat(tktlbcer) * parseFloat(tktlbcostcer);
            $('#tktlb_ctot').attr("value", tktlbtotcer);
            // 0 Tapete Boston Tapete
            $('#boston_can').attr("value", "0,0");
            var bostoncer = $('#boston_can').val();
            var bostoncostcer = $('#boston_cost').val();
            var bostontotcer = parseFloat(bostoncer) * parseFloat(bostoncostcer);
            $('#boston_ctot').attr("value", bostontotcer);
            // 0 Tapete Nomad Sin Base
            $('#tnsb_can').attr("value", "0,0");
            var tnsbcer = $('#tnsb_can').val();
            var tnsbcostcer = $('#tnsb_cost').val();
            var tnsbtotcer = parseFloat(tnsbcer) * parseFloat(tnsbcostcer);
            $('#tnsb_ctot').attr("value", tnsbtotcer);
        } else if (value == 7) {
            //Si es Tapete Nomad Sin Base
            var nomsin = $('#tapete').val();
            var costnomsin = $('#tnsb_cost').val();
            var nomsintot = parseFloat(nomsin) * parseFloat(costnomsin);
            $('#tnsb_can').attr("value", nomsin);
            $('#tnsb_ctot').attr("value", nomsintot);
            // 0 Tapete Nomad T1000 base
            $('#tap1_can').attr("value", "0,0");
            var tap1cantce = $('#tap1_can').val();
            var tap1costcer = $('#tap1_cost').val();
            var totap1cer = parseFloat(tap1cantce) * parseFloat(tap1costcer);
            $('#tap1_ctot').attr("value", totap1cer);
            // 0 Tapete Nomad T3000 base
            $('#tap3_can').attr("value", "0,0");
            var tapcer = $('#tap3_can').val();
            var tapcost3cer = $('#tap3_cost').val();
            var taptot3cer = parseFloat(tapcer) * parseInt(tapcost3cer);
            $('#tap3_ctot').attr("value", taptot3cer);
            // 0 Tapete Koreano Trafico Pesado Base
            $('#tkpb_can').attr("value", "0,0");
            var tkpbcer = $('#tkpb_can').val();
            var tkpbcostcer = $('#tkpb_cost').val();
            var tkpbtotcer = parseFloat(tkpbcer) * parseInt(tkpbcostcer);
            $('#tkpb_ctot').attr("value", tkpbtotcer);
            // 0 Tapete Koreano Trafico Liviano Base
            $('#tktlb_can').attr("value", "0,0");
            var tktlbcer = $('#tktlb_can').val();
            var tktlbcostcer = $('#tktlb_cost').val();
            var tktlbtotcer = parseFloat(tktlbcer) * parseFloat(tktlbcostcer);
            $('#tktlb_ctot').attr("value", tktlbtotcer);
            // 0 Tapete Boston Tapete
            $('#boston_can').attr("value", "0,0");
            var bostoncer = $('#boston_can').val();
            var bostoncostcer = $('#boston_cost').val();
            var bostontotcer = parseFloat(bostoncer) * parseFloat(bostoncostcer);
            $('#boston_ctot').attr("value", bostontotcer);
            // 0 Tapete Aqua
            $('#aqua_can').attr("value", "0,0");
            var aquacer = $('#aqua_can').val();
            var aquaccer = $('#aqua_cost').val();
            var aquatotcer = parseFloat(aquacer) * parseFloat(aquaccer);
            $('#aqua_ctot').attr("value", aquatotcer);
        }
    } else if (param == 4) {
        if (value == 1) {
            // Si es Tapete Nomad T3000 Logo
            var logt3 = $('#logo').val();
            var costlogot3 = $('#tn3l_cost').val();
            var logtot3ta = parseFloat(logt3) * parseFloat(costlogot3);
            var logtot3tadeci = Math.round(logtot3ta.toFixed(3));
            $('#tn3l_can').attr("value", logt3);
            $('#tn3l_ctot').attr("value", logtot3tadeci);
            //valor estandar del logo Tapete Nomad T1000 Logo
            var logtestand1 = $('#estandlog').val();
            var costlogtestand1 = $('#tn1l_cost').val();
            var logtotestand1 = parseFloat(logtestand1) * parseFloat(costlogtestand1);
            var logtotestand1deci = Math.round(logtotestand1.toFixed(3));
            $('#tn1l_can').attr("value", logtestand1);
            $('#tn1l_ctot').attr("value", logtotestand1deci);
            // valor estandar del logo Tapete Koreano Trafico Liviano Logo
            var logestanLiv = $('#estandlog').val();
            var costloglivestan = $('#tktll_cost').val();
            var logtotestandliv = Math.round(parseFloat(logestanLiv) * parseFloat(costloglivestan));
            $('#tktll_can').attr("value", logestanLiv);
            $('#tktll_ctot').attr("value", logtotestandliv);
        } else if (value == 2) {
            // Si es Tapete Nomad T1000 Logo
            var logt1 = $('#logo').val();
            var costlogot1 = $('#tn1l_cost').val();
            var logtot1ta = parseFloat(logt1) * parseFloat(costlogot1);
            var logtot1tadeci = Math.round(logtot1ta.toFixed(3));
            $('#tn1l_can').attr("value", logt1);
            $('#tn1l_ctot').attr("value", logtot1tadeci);
            // valor estandar del logo Tapete Nomad T3000 Logo
            var logestan3 = $('#estandlog').val();
            var costlogestan3 = $('#tn3l_cost').val();
            var logtotestand3 = parseFloat(costlogestan3) * parseFloat(logestan3);
            var logtotestand3deci = Math.round(logtotestand3.toFixed(3));
            $('#tn3l_can').attr("value", logestan3);
            $('#tn3l_ctot').attr("value", logtotestand3deci);
            // valor estandar del logo Tapete Koreano Trafico Liviano Logo
            var logestanLiv = $('#estandlog').val();
            var costloglivestan = $('#tktll_cost').val();
            var logtotestandliv = Math.round(parseFloat(logestanLiv) * parseFloat(costloglivestan));
            $('#tktll_can').attr("value", logestanLiv);
            $('#tktll_ctot').attr("value", logtotestandliv);

        } else if (value == 3) {
            // Si es Tapete Trafico Liviano Logo
            var logliv = $('#logo').val();
            var costlogoliv = $('#tktll_cost').val();
            var logtoliv = Math.round(parseFloat(logliv) * parseFloat(costlogoliv));
            $('#tktll_can').attr("value", logliv);
            $('#tktll_ctot').attr("value", logtoliv);
            //valor estandar del logo Tapete Nomad T1000 Logo
            var logtestand1 = $('#estandlog').val();
            var costlogtestand1 = $('#tn1l_cost').val();
            var logtotestand1 = parseFloat(logtestand1) * parseFloat(costlogtestand1);
            var logtotestand1deci = Math.round(logtotestand1.toFixed(1));
            $('#tn1l_can').attr("value", logtestand1);
            $('#tn1l_ctot').attr("value", logtotestand1deci);
            // valor estandar del logo Tapete Nomad T3000 Logo
            var logestan3 = $('#estandlog').val();
            var costlogestan3 = $('#tn3l_cost').val();
            var logtotestand3 = parseFloat(costlogestan3) * parseFloat(logestan3);
            var logtotestand3deci = Math.round(logtotestand3.toFixed(1));
            $('#tn3l_can').attr("value", logestan3);
            $('#tn3l_ctot').attr("value", logtotestand3deci);


        }
    }
}

function verifitape() {
    var isEmpty = false,
        base_anc = document.getElementById("base_anc").value,
        base_alt = document.getElementById("base_alt").value,
        anch_est = document.getElementById("anch_est").value,
        tip_manObra = document.getElementById("tip_manObra").value,
        tip_per = document.getElementById("tip_per").value,
        tip_tap = document.getElementById("tip_tap").value,
        cant_tap = document.getElementById("cant_tap").value;

    if (base_anc === "") {
        alert("Debes ingresar el ancho del tapete");
        isEmpty = true;
    } else if (base_alt === "") {
        alert("Debes ingresar el alto del tapete");
        isEmpty = true;
    } else if (anch_est === "") {
        alert("Debes ingresar el ancho estandar del tapete");
        isEmpty = true;
    } else if (tip_manObra === "") {
        alert("Debes ingresar el tipo de mano de obra ");
        isEmpty = true;
    } else if (tip_per === "") {
        alert("Debes ingresar el tipo de perfil");
        isEmpty = true;
    } else if (tip_tap === "") {
        alert("Debes ingresar el tipo de tapete");
        isEmpty = true;
    } else if (cant_tap === "") {
        alert("Debes Poner una cantidad  valida");
        isEmpty = true;
    }
    return isEmpty;
}

function calculartotTab() {
    if (!verifitape()) {
        var manse = $('#mans_ctot').val();
        var mancom = $('#mancom_ctot').val();
        var mansin = $('#mansin_ctot').val();
        var perM = $('#perM_ctot').val();
        var perG = $('#perG_ctot').val();
        var tap3 = $('#tap3_ctot').val();
        var tap1 = $('#tap1_ctot').val();
        var tkpb = $('#tkpb_ctot').val();
        var tktlb = $('#tktlb_ctot').val();
        var boston = $('#boston_ctot').val();
        var aqua = $('#aqua_ctot').val();
        var tnsb = $('#tnsb_ctot').val();
        var tn3l = $('#tn3l_ctot').val();
        var tn1l = $('#tn1l_ctot').val();
        var tktll = $('#tktll_ctot').val();
        var pegm = $('#pegm_ctot').val();
        var ppb = $('#ppb_ctot').val();
        var cant = $('#cant_tap').val();
        var totsuma = Math.round(parseFloat(manse) + parseFloat(mancom) + parseFloat(mansin) + parseFloat(perM) + parseFloat(perG) +
            parseFloat(tap3) + parseFloat(tap1) + parseFloat(tkpb) + parseFloat(tktlb) + parseFloat(boston) + parseFloat(aqua) +
            parseFloat(tnsb) + parseFloat(tn3l) + parseFloat(tn1l) + parseFloat(tktll) + parseFloat(pegm) + parseFloat(ppb));
        var pspv = Math.round(totsuma / 0.7);
        var totalde = parseFloat(cant) * parseFloat(pspv);
        $('#tot_cost').attr("value", totsuma);
        $('#pspv20').attr("value", totalde);
        $('#pspv20').removeAttr('readonly');
    }
}