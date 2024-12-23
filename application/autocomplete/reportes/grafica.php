<?php include 'consultas.php'; ?>
<script type="text/javascript">
  function crearCadena(json){
    var parsed = JSON.parse(json);
    var arr = [];
    for (var x in parsed){
      arr.push(parsed[x]);
    }
    return arr;
  }
</script>
<script type="text/javascript">
  var datosY=crearCadena('<?php echo $datosY; ?>');
  var datosX=crearCadena('<?php echo $datosX; ?>');
  var datosN=crearCadena('<?php echo $datosN; ?>');
  var fecha=crearCadena('<?php echo $fecha; ?>');
  var fecha2=crearCadena('<?php echo $fecha2; ?>');
  var usuario=crearCadena('<?php echo $usuario; ?>');
  var valoresDili=crearCadena('<?php echo $valoresDili; ?>');
var trace1 = {
  x: datosN,
  y: datosY,
  name: 'Datos',
  marker: {color: 'rgb(55, 83, 109)'},
  type: 'bar'
};


var data = [trace1];



var layout = {
  title: 'Diligencias '+fecha+' a '+fecha2,
  xaxis: {
    title: 'Tip. Dlg',
    titlefont: {
      size: 16,
      color: 'rgb(107, 107, 107)'
    },
    tickfont: {
      size: 14,
      color: 'rgb(107, 107, 107)'
    }},
  yaxis: {
    title: 'Diligencias',
    titlefont: {
      size: 16,
      color: 'rgb(107, 107, 107)'
    },
    tickfont: {
      size: 14,
      color: 'rgb(107, 107, 107)'
    }
  },
  legend: {
    x: 0,
    y: 1.0,
    bgcolor: 'rgba(255, 255, 255, 0)',
    bordercolor: 'rgba(255, 255, 255, 0)'
  },
  barmode: 'stack',
  bargap: 0.15,
  bargroupgap: 0.1
};
Plotly.newPlot('grafica', data, layout);

var data={valoresDili:valoresDili,cant:datosY,nom:datosN};
/*$.ajax({
  url:'table.php';
  type:'POST',
  data: data,
  success: function(resp){
    $('#table').html(resp);
  }
});*/
</script>