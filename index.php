<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once './banco/mysqlconecta.php';
require_once './banco/mysqlexecuta.php';
?>
<html>
    <head>
        <meta charset="UTF-8">        
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css">

        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>




        <script type="text/javascript"
                src="https://www.google.com/jsapi?autoload={
                'modules':[{
                'name':'visualization',
                'version':'1',
                'packages':['corechart']
                }]
        }"></script>

        <script type="text/javascript" src="https://www.google.com/jsapi"></script>

        <script type="text/javascript">
                           

                    function cad() {

                    var estacao = $("#estacao").val();
                            var tp = $("#tipo").val();
                            var prevDate = $("#prevDate").val();
                            var prevHour = $("#prevHour").val();
                            var prevValue = $("#prevValue").val();
                            //var destw="cadprev.php?estacao=" +estacao+"&prevDate="+prevDate+"&prevValue="+prevValue";
                            //alert(destw);

                            $.ajax({
                            type: "post",
                                    url: "cadprev.php",
                                    data: "estacao=" + estacao + "&tp=" + tp + "&prevDate=" + prevDate + "&prevValue=" + prevValue + "&prevHour=" + prevHour,
                                    success: function(data) {
                                    $("#result").html(data);
                                    }
                            });
                    }

                    function sel(){
                    var m = $("#cidade").val();
                            $.ajax({
                            type: "post",
                                    url: "json/getAnos.php?muni=" + m,
                                    success: function(data) {
                                    $("#ano1").html(data);
                                            $("#ano2").html(data);
                                            $("#ano3").html(data);
                                            //alert(data);
                                            //alert($("#cidade").val());
                                    }
                            });
                    }
                    function getDado(){
                    alert(("#inicio").val() + " " + ("#fim").val());
                            // alert("hegre");
                    }
                    $("#cidade").val('1');
                            sel();
                            //getDado();





                            // Load the Visualization API and the piechart package.
                            google.load('visualization', '1', {'packages':['corechart']});
                            // Set a callback to run when the Google Visualization API is loaded.
                            google.setOnLoadCallback(drawChart);
                            function drawChart() {
                            var jsonData = $.ajax({
                            url: "json/getDados.php?muni="+$("#cidade").val(),
                                    dataType:"json",
                                    async: false
                            }).responseText;
                                    // Create our data table out of JSON data loaded from server.
                                    var data = new google.visualization.DataTable(jsonData);
                                    // Instantiate and draw our chart, passing in some options.
                                    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                                    chart.draw(data);
                            }

        </script>
    </head>
    <body>
        <div id="top">
            <h1>Base de Dados niveis de Rios</h1>
        </div>
        <?php
        $sql = "SELECT municipio_nome FROM `municipios` ORDER BY municipio_nome";
        $res = \mysqlexecuta($id, $sql, $erro = 1);
        ?>
        <div class="menu">
            <?php
            while ($row = mysqli_fetch_array($res)) {
                #echo "$row[municipio_nome]<br>";
                echo "<a href='#' class='btn'>$row[municipio_nome]</a>";
            }
            ?>
        </div>
        <div class="menubar">
            <a>Munucipio: </a>
            <select id='cidade' onchange="sel()">
                <?php
                $sql = "SELECT municipio_id,municipio_nome FROM `municipios` ORDER BY municipio_nome";
                $res = \mysqlexecuta($id, $sql, $erro = 1);
                while ($row = mysqli_fetch_array($res)) {
                    echo "<option value=\"$row[municipio_id]\">$row[municipio_nome]</option>";
                }
                ?>
            </select>

            <select id="numLinhas">
                <?php
                $i = 1;
                while ($i < 13) {
                    echo "<option value=\"$i\">$i</option>";
                    $i++;
                }
                ?>
            </select>

            <input type="checkbox" id="chkAno3">
            <select id='ano1'></select>
            <input type="checkbox" id="chkAno1">
            <select id='ano2'></select>
            <input type="checkbox" id="chkAno2">
            <select id='ano3'></select>


            <input type="checkbox" id="chkAnoTodos">
            <a>Todos</a>
            <input type="date" id="inicio">

            <input type="date" id="fim">
            <a class="btn" onclick="drawChart()" href="#">Gerar</a>            
        </div>
        <div id="curve_chart"></div>
        <div id="chart_div"></div>
    </body>
</html>
