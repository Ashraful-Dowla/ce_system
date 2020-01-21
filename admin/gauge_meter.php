<script src="https://cdn.zingchart.com/zingchart.min.js"></script>
<style>
        html,
        body {
            height: 100%;
            width: 100%;
        }
 
        #myChart {
            height: 40%;
            width: 50%;
            min-height: 50px;
        }
        
        #myChart1 {
            height: 40%;
            width: 50%;
            min-height: 50px;
        }
        .zc-ref {
            display: none;
        }
 
        zing-grid[loading] {
            height: 500px;
        }
</style>
<div class="col-sm-12">
    <div id='myChart' class="col-sm-6"><h1 style="text-align: center;"> Class Review Rating </h1><a class="zc-ref" href="https://www.zingchart.com/">Charts by ZingChart</a></div>
    <div id='myChart1' class="col-sm-6"><h1 style="text-align: center;"> Student Feedback </h1><a class="zc-ref" href="https://www.zingchart.com/">Charts by ZingChart</a></div>
</div>
<?php
    include('includes/db/connection_db.php'); 

    $dt = new DateTime();

    $dtt = $dt->format('y-m-d');

    /*------------------Class Review------------------------*/ 
    $sql = "SELECT * FROM class_review WHERE DATE(created_at)='$dtt'";
    $result = $conn->query($sql);
    $number_of_class_review = $result->num_rows;
    
    $sum_of_rating = 0;

    while($row = $result->fetch_assoc()){
        $sum_of_rating += $row['rating'];
    }

    if($number_of_class_review > 0){
        $class_review = $sum_of_rating/($number_of_class_review*5);
        $class_review *=100;
    }
    else{
        $class_review = 0;
    }


    $class_review = round($class_review);
    /*------------------------------------------------------*/


    /*------------------Student Feedback--------------------*/
    $sql_1 = "SELECT * FROM login WHERE user_type='3'";
    $result_1 = $conn->query($sql_1);

    $student_feedback = $number_of_class_review/$result_1->num_rows;

    $student_feedback *=100;

    $student_feedback = round($student_feedback);
    /*------------------------------------------------------*/

 ?>
<script>
ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "b55b025e438fa8a98e32482b5f768ff5"];
        window.feed = function(callback) {
            var tick = {};
            //tick.plot0 = Math.ceil(350 + (Math.random() * 500));
            tick.plot0 = <?php echo $class_review ?> ;
            callback(JSON.stringify(tick));
        };
 
        var myConfig = {
            type: "gauge",
            globals: {
                fontSize: 25
            },
            plotarea: {
                marginTop: 80
            },
            plot: {
                size: '100%',
                valueBox: {
                    placement: 'center',
                    text: '%v', //default
                    fontSize: 35,
                    rules: [{
                            rule: '%v >= 80',
                            text: '%v%<br>EXCELLENT'
                        },
                        {
                            rule: '%v < 79 && %v >= 70',
                            text: '%v%<br>Good'
                        },
                        {
                            rule: '%v < 69 && %v >= 60',
                            text: '%v%<br>Satisfactory'
                        },
                        {
                            rule: '%v < 59 && %v >= 50',
                            text: '%v%<br>Fair'
                        },
                        {
                            rule: '%v <  50',
                            text: '%v%<br>Bad'
                        }
                    ]
                }
            },
            tooltip: {
                borderRadius: 5
            },
            scaleR: {
                aperture: 180,
                minValue: 0,
                maxValue: 100,
                step: 10,
                center: {
                    visible: false
                },
                tick: {
                    visible: false
                },
                item: {
                    offsetR: 0,
                    rules: [{
                        rule: '%i == 9',
                        offsetX: 15
                    }]
                },
                labels: ['0', '', '', '', '', '50', '60', '70', '80', '', '100', ''],
                ring: {
                    size: 50,
                    rules: [{
                            rule: '%v >= 80',
                            backgroundColor: '#E53935' 
                        },
                        {
                            rule: '%v >=70 && %v < 80',
                            backgroundColor: '#EF5350'
                        },
                        {
                            rule: '%v >= 60 && %v < 70',
                            backgroundColor: '#FFA726'
                        },
                        {
                            rule: '%v >= 50 && %v < 60',
                            backgroundColor: '#1FC255'
                        },
                        {
                            rule: '%v < 50',
                            backgroundColor: '#29B6F6' 
                        }
                    ]
                }
            },
            refresh: {
                type: "feed",
                transport: "js",
                url: "feed()",
                interval: 1500,
                resetTimeout: 1000
            },
            series: [{
                values: [755], // starting value
                backgroundColor: 'black',
                indicator: [10, 10, 10, 10, 0.75],
                animation: {
                    effect: 2,
                    method: 1,
                    sequence: 4,
                    speed: 900
                },
            }]
        };

        window.feed1 = function(callback) {
            var tick = {};
            //tick.plot0 = Math.ceil(350 + (Math.random() * 500));
            tick.plot0 = <?php echo $student_feedback ?> ;
            callback(JSON.stringify(tick));
        };

        var myConfig1 = {
            type: "gauge",
            globals: {
                fontSize: 25
            },
            plotarea: {
                marginTop: 80
            },
            plot: {
                size: '100%',
                valueBox: {
                    placement: 'center',
                    text: '%v', //default
                    fontSize: 35,
                    rules: [{
                            rule: '%v >= 80',
                            text: '%v%'
                        },
                        {
                            rule: '%v < 79 && %v >= 70',
                            text: '%v%'
                        },
                        {
                            rule: '%v < 69 && %v >= 60',
                            text: '%v%'
                        },
                        {
                            rule: '%v < 59 && %v >= 50',
                            text: '%v%'
                        },
                        {
                            rule: '%v <  50',
                            text: '%v%'
                        }
                    ]
                }
            },
            tooltip: {
                borderRadius: 5
            },
            scaleR: {
                aperture: 180,
                minValue: 0,
                maxValue: 100,
                step: 10,
                center: {
                    visible: false
                },
                tick: {
                    visible: false
                },
                item: {
                    offsetR: 0,
                    rules: [{
                        rule: '%i == 9',
                        offsetX: 15
                    }]
                },
                labels: ['0', '', '', '', '', '50', '60', '70', '80', '', '100', ''],
                ring: {
                    size: 50,
                    rules: [{
                            rule: '%v >= 80',
                            backgroundColor: '#E53935' 
                        },
                        {
                            rule: '%v >=70 && %v < 80',
                            backgroundColor: '#EF5350'
                        },
                        {
                            rule: '%v >= 60 && %v < 70',
                            backgroundColor: '#FFA726'
                        },
                        {
                            rule: '%v >= 50 && %v < 60',
                            backgroundColor: '#1FC255'
                        },
                        {
                            rule: '%v < 50',
                            backgroundColor: '#29B6F6' 
                        }
                    ]
                }
            },
            refresh: {
                type: "feed",
                transport: "js",
                url: "feed1()",
                interval: 1500,
                resetTimeout: 1000
            },
            series: [{
                values: [755], // starting value
                backgroundColor: 'black',
                indicator: [10, 10, 10, 10, 0.75],
                animation: {
                    effect: 2,
                    method: 1,
                    sequence: 4,
                    speed: 900
                },
            }]
        };
 
        zingchart.render({
            id: 'myChart',
            data: myConfig,
            height: 400,
            width: '100%'
        });

        zingchart.render({
            id: 'myChart1',
            data: myConfig1,
            height: 400,
            width: '100%'
        });

        zingchart.render({
            id: 'myChart2',
            data: myConfig,
            height: 400,
            width: '100%'
        });

        zingchart.render({
            id: 'myChart3',
            data: myConfig,
            height: 400,
            width: '100%'
        });
</script>