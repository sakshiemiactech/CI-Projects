        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <?php if($sorted_by == 6){
                $status = 'Weekly';
            }elseif($sorted_by == 0){ 
                $status = 'Daily';
            }else{ 
                $status = 'Monthly';
            }
        ?>
        <script>
        if($('#container').hasClass('graph')){
            Highcharts.chart('container', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'My <?php echo $status; ?> Impressions'
            },
            subtitle: {
                text: 'Source: davsy.com'
            },
            xAxis: {
                categories: [<?php foreach($weekly_views as $key=> $views){  echo "'";?> <?php echo $views['date'];  ?> <?php echo "',";} ?>]
            },
            yAxis: {
                title: {
                    text: 'Impressions'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'IMPRESSIONS',
                data: [<?php foreach($weekly_views as $key=> $views){   echo $views['day_views'].','; } ?>]
            },]
        });
        
        Highcharts.chart('container1', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'My <?php echo $status; ?> Clicks'
            },
            subtitle: {
                text: 'Source: davsy.com'
            },
            xAxis: {
                categories: [<?php foreach($weekly_views as $key=> $views){  echo "'";?> <?php echo $views['date'];  ?> <?php echo "',";} ?>]
            },
            yAxis: {
                title: {
                    text: 'Clicks'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'CLICKS',
                data: [<?php foreach($weekly_views as $key=> $views){  echo $views['day_clicks'].',';} ?>]
            },]
        });
        }
       
        if($('.highcharts-credits').hasClass('highcharts-credits')){ $('.highcharts-credits').css('display','none'); }
         $('.highcharts-menu').children('.highcharts-menu-item').eq(8).css('display','none');
        </script>