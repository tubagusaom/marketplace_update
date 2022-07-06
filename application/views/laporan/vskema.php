

<script src="<?php echo base_url() ?>_assets/jquery/js/jquery.min.js"></script>     
    
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    var source_data='<?=$dtstring; ?>';
    
        Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Statistik Pemegang Sertifikat LSP COHESPA'
                },
                subtitle: {
                    text: 'Source: <a href="http://www.bnsp.go.id">Sistem Sertifikasi LSP</a>'
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
                        text: 'Pemegang Sertifikat'
                    }
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: 'Jumlah Pemegang Sertifikat: <b>{point.y} orang</b>'
                },
                series: [{
                    name: 'Population',
                    data:JSON.parse(source_data),
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y}', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                }]
            });
  })
</script>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
