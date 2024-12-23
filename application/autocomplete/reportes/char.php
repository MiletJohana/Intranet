<div id="char">
<script type="text/javascript">
$(function () {
			$('#container2').highcharts({
			    chart: {
			        plotBackgroundColor: null,
			        plotBorderWidth: null,
			        plotShadow: false
			    },
			    title: {
			        text: 'Efectividad de las diligencias'
			    },
			    tooltip: {
			        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			    },
			    plotOptions: {
			        pie: {
			            allowPointSelect: true,
			            cursor: 'pointer',
			            dataLabels: {
			                enabled: true,
			                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
			                style: {
			                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			                }
			            }
			        }
			    },
			    series: [{
			        type: 'pie',
			        name: 'Diligencias',
			        data: 
			        [
			            <?php
			            $mes1=date("Y-m-01");
			            $mes2=date("Y-m-d");
			            $sql5="SELECT COUNT(efc_dlg),efc_dlg from mq_dlg WHERE efc_dlg is not null";
			            if(isset($_POST['mes1'])){
			            	$sql5.=" AND fec_cre BETWEEN '".$_POST['mes1']."' AND '".$_POST['mes2']."' group by efc_dlg";
			            }else{
			            	$sql5.=" AND fec_cre BETWEEN '2018-01-01' AND '2018-10-31' group by efc_dlg";
			            }
			            $query5=$conexion->query($sql5);
			            while ($r5=$query5->fetch(PDO::FETCH_ASSOC))
			            {
			            ?>
			            ['<?php if($r5["efc_dlg"]==1){ echo 'SI';}else{ echo 'NO';} ?>',<?php echo $r5["COUNT(efc_dlg)"];?> ],
			            <?php
			            }?>                
			        ]
			    }]
			});
			});
</script>
</div>

<?php
$mes1=date("Y-m-01");
$mes2=date("Y-m-d");
$sql5="SELECT COUNT(efc_dlg),efc_dlg from mq_dlg WHERE efc_dlg is not null";
if(isset($_POST['mes1'])){
	$sql5.=" AND fec_cre BETWEEN '".$_POST['mes1']."' AND '".$_POST['mes2']."' group by efc_dlg";
}else{
	$sql5.=" AND fec_cre BETWEEN '2018-01-01' AND '2018-10-31' group by efc_dlg";
}
echo $sql5;
?>