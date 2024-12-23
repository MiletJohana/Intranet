             var rIndex,
                 table = document.getElementById("table");

             function verificarProd() {
                 var isEmpty = false,
                     nom_pro = document.getElementById("nom_pro").value,
                     des_pro = document.getElementById("des_pro").value,
                     und_emp = document.getElementById("und_emp").value,
                     can_com = document.getElementById("can_com").value,
                     pre_pro = document.getElementById("pre_pro").value;

                 if (nom_pro === "") {
                     alertWarning("Debes Seleccionar un producto");
                     isEmpty = true;
                 } else if (und_emp === "") {
                     alertWarning("Debes ingresar un producto valido");
                     isEmpty = true;
                 } else if (pre_pro === "") {
                     alertWarning("Debes Poner un precio valido");
                     isEmpty = true;
                 } else if (can_com === "") {
                     alertWarning("Debes Poner una cantidad valida");
                     isEmpty = true;
                 }
                 return isEmpty;
             }

             function agregarProd() {
                 if (!verificarProd()) {
                     var newRow = table.insertRow(table.length),
                         cell1 = newRow.insertCell(0),
                         cell2 = newRow.insertCell(1),
                         cell3 = newRow.insertCell(2),
                         cell4 = newRow.insertCell(3),
                         cell5 = newRow.insertCell(4),
                         cell6 = newRow.insertCell(5),
                         cell7 = newRow.insertCell(6),
                         cell8 = newRow.insertCell(7),
                         nom_pro = document.getElementById("nom_pro").value,
                         des_pro = document.getElementById("des_pro").value,
                         und_emp = document.getElementById("und_emp").value,
                         can_com = document.getElementById("can_com").value;
                     pre_pro = document.getElementById("pre_pro").value;
                     cod_pro = document.getElementById("cod_pro").value;
                     cod_ref = document.getElementById("cod_ref").value;
                     obs_cot = document.getElementById("obs_cot").value;
                     can_emp = document.getElementById("can_emp").value;
                     newRow.setAttribute("id", cod_pro);
                     cell1.innerHTML = nom_pro;
                     cell2.innerHTML = des_pro;
                     cell3.innerHTML = obs_cot;
                     cell4.innerHTML = und_emp;
                     cell5.innerHTML = can_emp;
                     cell6.innerHTML = pre_pro;
                     cell7.innerHTML = can_com;
                     cell8.innerHTML = can_com * pre_pro * can_emp;
                     seleccionarProd();
                     document.getElementById("nom_pro").value = "";
                     document.getElementById("des_pro").value = "";
                     document.getElementById("und_emp").value = "";
                     document.getElementById("can_emp").value = "";
                     document.getElementById("pre_pro").value = "";
                     document.getElementById("cod_pro").value = "";
                     document.getElementById("cod_ref").value = "";
                     document.getElementById("can_com").value = "";
                     document.getElementById("obs_cot").value = "";
                 }
             }

             function seleccionarProd() {

                 for (var i = 1; i < table.rows.length; i++) {
                     table.rows[i].onclick = function() {
                         rIndex = this.rowIndex;
                         document.getElementById("nom_pro").value = this.cells[0].innerHTML;
                         document.getElementById("des_pro").value = this.cells[1].innerHTML;
                         document.getElementById("obs_cot").value = this.cells[2].innerHTML;
                         document.getElementById("und_emp").value = this.cells[3].innerHTML;
                         document.getElementById("can_emp").value = this.cells[4].innerHTML;
                         document.getElementById("pre_pro").value = this.cells[5].innerHTML;
                         document.getElementById("can_com").value = this.cells[6].innerHTML;
                         document.getElementById("agrega").style.visibility = "hidden";
                         document.getElementById("container-btnAgrega").style.display = "none";
                         document.getElementById("edita").style.visibility = "visible";
                         document.getElementById("elimina").style.visibility = "visible";
                         document.getElementById("cancela").style.visibility = "visible";
                     };
                 }
             }

             seleccionarProd();

             function editarProd() {
                 var nom_pro = document.getElementById("nom_pro").value,
                     des_pro = document.getElementById("des_pro").value,
                     und_emp = document.getElementById("und_emp").value,
                     can_emp = document.getElementById("can_emp").value;
                     pre_pro = document.getElementById("pre_pro").value;
                 can_com = document.getElementById("can_com").value;
                 obs_cot = document.getElementById("obs_cot").value;
                 can_emp = document.getElementById("can_emp").value;
                 if (!verificarProd()) {
                     table.rows[rIndex].cells[0].innerHTML = nom_pro;
                     table.rows[rIndex].cells[1].innerHTML = des_pro;
                     table.rows[rIndex].cells[2].innerHTML = obs_cot;
                     table.rows[rIndex].cells[3].innerHTML = und_emp;
                     table.rows[rIndex].cells[4].innerHTML = can_emp;
                     table.rows[rIndex].cells[5].innerHTML = pre_pro;
                     table.rows[rIndex].cells[6].innerHTML = can_com;
                     table.rows[rIndex].cells[7].innerHTML = can_com * pre_pro * can_emp;
                 }
                 document.getElementById("agrega").style.visibility = "visible";
                 document.getElementById("container-btnAgrega").style.display = "";
                 document.getElementById("edita").style.visibility = "hidden";
                 document.getElementById("elimina").style.visibility = "hidden";
                 document.getElementById("cancela").style.visibility = "hidden";
                 document.getElementById("nom_pro").value = "";
                 document.getElementById("des_pro").value = "";
                 document.getElementById("und_emp").value = "";
                 document.getElementById("can_emp").value = "";
                 document.getElementById("pre_pro").value = "";
                 document.getElementById("cod_pro").value = "";
                 document.getElementById("can_com").value = "";
                 document.getElementById("obs_cot").value = "";


             }

             function eliminarProd() {
                 var r = confirm("Estas seguro que deseas eliminar este producto");
                 if (r == true) {
                     table.deleteRow(rIndex);
                     document.getElementById("nom_pro").value = "";
                     document.getElementById("des_pro").value = "";
                     document.getElementById("und_emp").value = "";
                     document.getElementById("can_emp").value = "";
                     document.getElementById("pre_pro").value = "";
                     document.getElementById("cod_pro").value = "";
                     document.getElementById("obs_cot").value = "";
                     document.getElementById("can_com").value = "";
                     document.getElementById("agrega").style.visibility = "visible";
                     document.getElementById("container-btnAgrega").style.display = "";
                     document.getElementById("edita").style.visibility = "hidden";
                     document.getElementById("elimina").style.visibility = "hidden";
                     document.getElementById("cancela").style.visibility = "hidden";
                 }

             }

             function cancelarEditar() {
                 document.getElementById("nom_pro").value = "";
                 document.getElementById("des_pro").value = "";
                 document.getElementById("und_emp").value = "";
                 document.getElementById("can_emp").value = "";
                 document.getElementById("pre_pro").value = "";
                 document.getElementById("cod_pro").value = "";
                 document.getElementById("obs_cot").value = "";
                 document.getElementById("can_com").value = "";
                 document.getElementById("agrega").style.visibility = "visible";
                 document.getElementById("container-btnAgrega").style.display = "";
                 document.getElementById("edita").style.visibility = "hidden";
                 document.getElementById("elimina").style.visibility = "hidden";
                 document.getElementById("cancela").style.visibility = "hidden";
             }


             function quitarProd() {
                 var table = document.getElementById("table");
                 document.getElementById("totl_produ").remove();

                 for (var i = 0; i < table.rows.length; i++) {
                     var x = document.getElementById("totl_prod");
                     if (x != null) { x.remove(); }
                 }
             }