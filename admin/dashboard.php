<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
checklogin();
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">

    <title>DashBoard</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/fileinput.min.css">

    <link rel="stylesheet" href="css/style.css">
<style>
    
</style>

</head>

<body style="background-color: #f4f4f4; ">



    <?php include("includes/header.php"); ?>

    <div class="ts-main-content">
        <?php include("includes/sidebar.php"); ?>
        <div class="content-wrapper">
            <div class="container-fluid">

                <div>
                    <div>
                        <!-- <img src="img/second.jpg" alt="oh shit!!"> -->
                      

                        <br>
                        <h2 class="page-title" style="font-size: 2.5rem; color: yellowgreen; text-align: center;">Dashboard</h2>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="panel panel-default" style="background-color: #3498db;">
                                            <div class="panel-body bk-primary text-light">
                                                <div>

                                                    <?php
                                                    $result = "SELECT count(*) FROM hostelbook ";
                                                    $stmt = $mysqli->prepare($result);
                                                    $stmt->execute();
                                                    $stmt->bind_result($count);
                                                    $stmt->fetch();
                                                    $stmt->close();
                                                    ?>

                                                    <div class="stat-panel-number h1" style="font-size: 2rem;"><?php echo $count; ?></div>
                                                    <div style="font-size: 1.5rem;">Students</div>
                                                </div>
                                            </div>
                                            <a href="manage-students.php" class="block-anchor panel-footer" style="font-size: 1.5rem; color: #fff;">Full Detail <i ><?php echo "\u{2192}"?></i></a><br>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="panel panel-default" style="background-color: #1abc9c;">
                                            <div class="panel-body bk-success text-light">
                                                <div class="stat-panel text-center">

                                                    <?php
                                                    $result1 = "SELECT count(*) FROM rooms ";
                                                    $stmt1 = $mysqli->prepare($result1);
                                                    $stmt1->execute();
                                                    $stmt1->bind_result($count1);
                                                    $stmt1->fetch();
                                                    $stmt1->close();
                                                    ?>
                                                    <div class="stat-panel-number h1" style="font-size: 2rem;"><?php echo $count1; ?></div>
                                                    <div class="stat-panel-title text-uppercase" style="font-size: 1.5rem;">Total Rooms</div>
                                                </div>
                                            </div>
                                            <a href="manage-rooms.php" class="block-anchor panel-footer text-center" style="font-size: 1.5rem; color: #fff;">See All &nbsp; <i ><?php echo "\u{2192}"?> </i></a>
                                        </div>
                                    </div>
                                 </div>
                                    <img src="img/haha.jpg" alt="" style="width: 100%; height: auto;">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="js/jquery.min.js"></script>

    <script src="js/jquery.dataTables.min.js"></script>

    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>

    <script>
        window.onload = function () {

           
            var ctx = document.getElementById("dashReport").getContext("2d");
            window.myLine = new Chart(ctx).Line(swirlData, {
                responsive: true,
                scaleShowVerticalLines: false,
                scaleBeginAtZero: true,
                multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
            });

            
            var doctx = document.getElementById("chart-area3").getContext("2d");
            window.myDoughnut = new Chart(doctx).Pie(doughnutData, {
                responsive: true
            });

           
            var doctx = document.getElementById("chart-area4").getContext("2d");
            window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {
                responsive: true
            });

        }
    </script>

</body>

</html>
