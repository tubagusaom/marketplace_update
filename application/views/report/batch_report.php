 <head>
<?php
foreach($query as $value){
    $dtstr[]=array($value['name'],(int)$value['data']);
}
          
$dtstring = json_encode($dtstr);
?>

 <style type="text/css">
            ${demo.css}
		</style>
<script type="text/javascript">
		var base_url = "<?php echo base_url() ?>";
	</script>       	
<script src="<?php echo base_url()."assets/js/public/lokal_highcart.js";?>"></script>
<script type="text/javascript">
        var $ = $.noConflict();

$(document).ready(function(){
    var source_data='<?=$dtstring; ?>';
    //console.log(source_data);
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Statistik Student Aeroflyer Insitute'
        },
        subtitle: {
            text: 'Source: <a href="http://aeroflyer.co.id">Aeroflyer Information System</a>'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Student'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: '<b>{point.y} Student</b>'
        },
        series: [{
            data:JSON.parse(source_data),//[['2009',1],['2010',2],['2011',3],['2012',16],['2013',47],['2014',33],['2015',27]],
            dataLabels: {
                enabled: true,
                //rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y} Student', // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '10px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
    //});
});

</script>
 </head> 
 <div style="padding: 5px;">  <div id="p" class="easyui-panel" title="Dashboard Batch Report Student" 
            style="width:auto;height:450px;padding:10px;background:#fafafa;"
            data-options="closable:false,
                    collapsible:false,minimizable:false,maximizable:false">
    <div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
    </div>
</div>