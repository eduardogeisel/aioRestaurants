<?php

    class ChartPage{

        public static function pageLeftMenu(){
            $leftMenu = ' 
                <!-- Left column -->
                <div class="priori-flex-row" id="page-body">
                    <div class="priori-sidebar">
                        <header class="priori-site-header">
                        <i class="fas fa-money-check"></i>
                        <img src="images/dashboard-icon.png" width="50" height="50">
                       
                        <h1>aioRestaurant</h1>
                        </header>
                        <div class="profile-photo-container">
                        <img src="images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">  
                        <div class="profile-photo-overlay"></div>
                        </div>      
                        <!-- Search box -->
                        <form class="priori-search-form" role="search">
                        <div class="input-group">
                            <button type="submit" class="fa fa-search"></button>
                            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">           
                        </div>
                        </form>
                        <div class="mobile-menu-icon">
                            <i class="fa fa-bars"></i>
                        </div>
                        <nav class="priori-left-nav">          
                        <ul>
                            <li><a href="?page=dashboard"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
                            <li><a href="?page=charts" class="active"><i class="fa fa-bar-chart fa-fw"></i>Charts</a></li>
                            <li><a href="data-visualization.html"><i class="fa fa-database fa-fw"></i>Data Visualization</a></li>
                            <!--<li><a href="maps.html"><i class="fa fa-map-marker fa-fw"></i>Maps</a></li>-->
                            <li><a href="?page=tables"><i class="fa fa-users fa-fw"></i>Tables</a></li>
                            <li><a href="preferences.html"><i class="fa fa-sliders fa-fw"></i>Preferences</a></li>
                            <li><a href="login.html"><i class="fa fa-eject fa-fw"></i>Sign Out</a></li>
                        </ul>  
                        </nav>
                    </div>
                
            ';
            echo $leftMenu;
        }
        
        public static function pieChartOrder($productArray){


            $dataAddRows = "
                    data.addRows([";
            for($i = 0; $i < count($productArray); $i++){
                if($i == count($productArray)-1){
                    $dataAddRows .= "['".$productArray[$i]->getProductName()."',".$productArray[$i]->getQuantity()."]
                    ";
                } else {
                    $dataAddRows .= "['".$productArray[$i]->getProductName()."',".$productArray[$i]->getQuantity()."],
                    ";
                }
            }


            $dataAddRows .= "]);";

            $script = "
            <script>
                /* Google Chart 
                -------------------------------------------------------------------*/
                // Load the Visualization API and the piechart package.
                google.load('visualization', '1.0', {'packages':['corechart']});

                // Set a callback to run when the Google Visualization API is loaded.
                google.setOnLoadCallback(drawChart); 
                
                // Callback that creates and populates a data table,
                // instantiates the pie chart, passes in the data and
                // draws it.
                function drawChart() {

                    // Create the data table.
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Topping');
                    data.addColumn('number', 'Slices');";
            $script .= $dataAddRows;
            $script .= "
                    // Set chart options
                    var options = {'title':'How Much Pizza I Ate Last Night'};

                    // Instantiate and draw our chart, passing in some options.
                    var pieChart = new google.visualization.PieChart(document.getElementById('pie_chart_div'));
                    pieChart.draw(data, options);

                    var barChart = new google.visualization.BarChart(document.getElementById('bar_chart_div'));
                    barChart.draw(data, options);
                }

                $(document).ready(function(){
                    if($.browser.mozilla) {
                    //refresh page on browser resize
                    // http://www.sitepoint.com/jquery-refresh-page-browser-resize/
                    $(window).bind('resize', function(e)
                    {
                        if (window.RT) clearTimeout(window.RT);
                        window.RT = setTimeout(function()
                        {
                        this.location.reload(false); /* false to get page from cache */
                        }, 200);
                    });      
                    } else {
                    $(window).resize(function(){
                        drawChart();
                    });  
                    }   
                });
                
                </script>
            ";

            echo $script;
        }
    }