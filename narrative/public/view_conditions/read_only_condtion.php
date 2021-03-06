<!DOCTYPE html>
<html lang="en">
<?php
session_start();

?>

<head>
    <meta charset="UTF-8">
    <style>
    .bar1 { fill: powderblue; stroke: black; }
    .bar2 { fill: lightsteelblue; stroke: black;}
    .bar3 { fill: steelblue; stroke: black;}
    .bar:hover {fill: orange; }
    .dot:hover {fill: black; }
    .axis--x path { display: none; }
    .line {
        fill: none;
        stroke:red;
        stroke-width: 3;
        
    }
    .dot {
        fill: red;
        stroke: black;
    }
    .axis { font-size: 15px sans-serif; }

    </style>
    <title>Drug Overdose Deaths</title>
    <link type="text/css" rel="stylesheet" href="css/styles.css"/>
    <!--added link for pop up test-->
    <link rel="stylesheet" href="https://www.jacklmoore.com/colorbox/example1/colorbox.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://www.jacklmoore.com/colorbox/jquery.colorbox.js"></script>
    <script src="https://d3js.org/d3.v4.min.js"></script>
    <script type="text/javascript">
        function checkTasks() {

            var data =<?php echo json_encode($_SESSION['tasks']); ?>;
            console.log(data);
            if(data!=null) {
                check = 0
                if (data.includes("ARREST") == true) {
                    var svgParent = document.getElementById("theSVG");
                    console.log(svgParent.getElementsByClassName("ARREST")[0])
                    svgParent.getElementsByClassName("ARREST")[0].style.fill = "green"
                    check = check + 1
                }
                if (data.includes("OUD") == true) {
                    var svgParent = document.getElementById("theSVG");
                    svgParent.getElementsByClassName("OUD")[0].style.fill = "green"
                    check = check + 1
                }
                if (data.includes("SSP") == true) {
                    var svgParent = document.getElementById("theSVG");
                    svgParent.getElementsByClassName("SSP")[0].style.fill = "green"
                    check = check + 1
                }
                if (check==3)
                {
                    setTimeout(function(){// wait for 5 secs(2)
                        location.href = '../survey/post_survey.html'; // then reload the page.(3)
                    }, 10);
                }


            }

        }
    </script>
</head>

<body onload="checkTasks();">
    
<div id="wrapper">
<div id="contentHolderOne">
<div id="verticalOne">
    <div id="horizontalTitle">
        
    </div>

    <div class="verticalImageHolder">
        <!--Put your image here for left column-->
        <img src="sad.png" class="verticalImage"/>
    </div>
</div>
<div id="verticalTwo">

    <!--Descriptions for Chart-->
    <div id="chartDescHolder">
        <div class="mainHeaderText">
    <h2><b><span id="drugDeath">1,852</span> Drug Overdose Deaths in <span id="drugState"> Indiana </span>2017</b></h2>
        <p class="subTextOne">As the numbers of overdoses related to drug use continue to rise, there appears to be no solution in sight.</p>
        <p class="subTextTwo">Total Drug Overdoses Deaths: Underlying cause of X40-X44, X60-X64, X85 or Y10-Y14. Age adjusted per 100,000 people</p>
    </div>
    </div>

    

    <!--Place Chart/Populate Chart Here-->
    <div id="chartHolder">
        
            
           
            <script>


                var line;
                /*
                function openColorBox(){
                    
                    $.colorbox({iframe:true, width:"30%", height:"30%"});
                }
                
                function countDown(){
                    seconds--
                    $("#seconds").text(seconds);
                    if (seconds === 0){
                    openColorBox();
                    clearInterval(i);
                    }
                }

                var seconds = 5,
                    i = setInterval(countDown, 500);
                */


                    //adding datasets for for main chart and updates Indiana 1852
                    var dataset = [
                    ["2006",3, 12],
                    ['2007',4,13],
                    ['2008',5,14],
                    ['2009',5,15],
                    ['2010',5,15],
                    ['2011',6,16],
                    ['2012',6, 17],
                    ['2013',6, 17],
                    ['2014',7, 19],
                    ['2015',9, 21],
                    ['2016',13, 25],
                    ['2017',14, 30],
                ];


                var datasetIN = [
                    ["2006",3, 12],
                    ['2007',4,13],
                    ['2008',5,14],
                    ['2009',5,15],
                    ['2010',5,15],
                    ['2011',6,16],
                    ['2012',6, 17],
                    ['2013',6, 17],
                    ['2014',7, 19],
                    ['2015',9, 21],
                    ['2016',13, 25],
                    ['2017',14, 30],
                ];

                //KY 1566
                var datasetKy = [
                    ['2006',8,17],
                    ['2007',8,17],
                    ['2008',9,18],
                    ['2009',10,18],
                    ['2010',14,24],
                    ['2011',16,25],
                    ['2012',16, 25],
                    ['2013',15, 24],
                    ['2014',17, 25],
                    ['2015',21, 30],
                    ['2016',24, 34],
                    ['2017',24, 37],
                ];

                var kybtn;
                var textKy = "1,566 Drug Overdose Deaths in Indiana 2017";

                //OH 5111
                var datasetOh = [
                    ['2006',6,13],
                    ['2007',6,14],
                    ['2008',7,15],
                    ['2009',6,11],
                    ['2010',10,16],
                    ['2011',11,18],
                    ['2012',12, 19],
                    ['2013',15, 21],
                    ['2014',19, 25],
                    ['2015',25, 30],
                    ['2016',33, 39],
                    ['2017',33, 46],
                ];
            
                //MI 2694
                var datasetMi = [
                    ['2006',6,12],
                    ['2007',5,12],
                    ['2008',7,13],
                    ['2009',8,15],
                    ['2010',7,14],
                    ['2011',8,14],
                    ['2012',7, 14],
                    ['2013',9, 16],
                    ['2014',11, 18],
                    ['2015',14, 20],
                    ['2016',19, 24],
                    ['2017',21, 28],
                ];

                //IL 2778
                var datasetIl = [
                    ['2006',7,11],
                    ['2007',6,9],
                    ['2008',7,11],
                    ['2009',7,11],
                    ['2010',7,10],
                    ['2011',7,11],
                    ['2012',9, 13],
                    ['2013',8, 12],
                    ['2014',9, 13],
                    ['2015',11, 14],
                    ['2016',15, 19],
                    ['2017',17, 21],
                ];

                //WV 974 
                var datasetWv = [
                    ['2006',16,20],
                    ['2007',19,22],
                    ['2008',21,26],
                    ['2009',10,12],
                    ['2010',26,29],
                    ['2011',32,36],
                    ['2012',27, 32],
                    ['2013',28, 32],
                    ['2014',32, 36],
                    ['2015',36, 42],
                    ['2016',43, 52],
                    ['2017',50, 58],
                ];

                //Vi 1507
                var datasetVi = [
                    ['2006',5,8],
                    ['2007',6,9],
                    ['2008',6,9],
                    ['2009',6,9],
                    ['2010',5,7],
                    ['2011',7,10],
                    ['2012',7, 9],
                    ['2013',8, 10],
                    ['2014',9, 12],
                    ['2015',10, 12],
                    ['2016',14, 17],
                    ['2017',14, 18],
                ];

                    var margin = {top: 20, right: 20, bottom: 30, left: 40},
                        width = 960,
                        height = 500;
            
                    var xScale = d3.scaleBand()
                            .rangeRound([0, width])
                            .padding(0.1)
                            .domain(dataset.map(function(d) {
                              return d[0];
                            }));

                    yScale = d3.scaleLinear()
                            .rangeRound([height, 0])
                            .domain([0, 60]);
                            /*
                            .domain([0, d3.max(dataset, (function (d) {
                              return d[2];
                            }))]);
                            */

                                       
                    // Define the div for the tooltip
                    var div = d3.select("body").append("div")	
                        .attr("class", "tooltip")				
                        .style("opacity", 0);

                    var svg = d3.select("#chartHolder").append("svg")
                        .attr("width", width + margin.left + margin.right)
                        .attr("height", height + margin.top + margin.bottom)
                        .attr('id', 'theSVG');
            
                    var g = svg.append("g")
                        .attr("transform", "translate(" + margin.left + "," + margin.top + ")")
                        .attr("width", '900')
                        .attr('height', '400');
                    
            
                    // axis-x years move
                    g.append("g")
                        .attr("class", "axis axis--x")
                        .attr("transform", "translate(0," + height + ")")
                        .style('font-weight', 'bold')
                        .call(d3.axisBottom(xScale));

                    
                    // axis-y
                    g.append("g")
                        .attr("class", "axis axis--y")
                        .style('font-weight', 'bold')
                        .call(d3.axisLeft(yScale));
                    
                    //y Axis label        
                    svg.append("text")
                        .attr("transform", "rotate(-90)")
                        .attr("y", '-45')
                        .attr("x", '-220')
                        .attr("dy", "1em")
                        .style("text-anchor", "middle")
                        .attr("font-size", "18pt")
                        .text("Drug Overdose Deaths");


                    svg.append("text")
                        .attr("transform", "rotate(-90)")
                        .attr("y", '-14')
                        .attr("x", '-225')
                        .attr("dy", "1em")
                        .style("text-anchor", "middle")
                        .attr("font-size", "12pt")
                        .text("per 100,000 people");

                    //x Axis label        
                    svg.append("text")
                        .attr("transform", "rotate(-360)")
                        .attr("y", '550')
                        .attr("x", '550')
                        .attr("dy", "1em")
                        .style("text-anchor", "middle")
                        .attr("font-size", "18pt")
                        .text("Years");
                    
                    //legend 
                    //y legend       
                    svg.append("text")
                        .attr("transform", "rotate(-0)")
                        .attr("y", '18')
                        .attr("x", '90')
                        .attr("dy", "1em")
                        .style("text-anchor", "middle")
                        .attr("font-size", "12pt")
                        .text("All Drugs")
                        
                        
                    var rect1 = svg.append("rect")
                        .attr('x', 140)
                        .attr('y', 20)
                        .attr('width', 15)
                        .attr('height', 15)
                        .style('fill', "lightblue")
                        .style('stroke', 'black')
                        .style('stroke-width', '1.5px');

                    //x legend       
                      svg.append("text")
                        .attr("transform", "rotate(-0)")
                        .attr("y", '45')
                        .attr("x", '90')
                        .attr("dy", "1em")
                        .style("text-anchor", "middle")
                        .attr("font-size", "12pt")
                        .text("Opioids")
                        
                        
                    var rect1 = svg.append("rect")
                        .attr('x', 140)
                        .attr('y', 50)
                        .attr('width', 15)
                        .attr('height', 15)
                        .style('fill', "red")
                        .style('stroke', 'black')
                        .style('stroke-width', '1.5px');      

                    //x Axis label        
                    svg.append("text")
                        .attr("transform", "rotate(-360)")
                        .attr("y", '550')
                        .attr("x", '550')
                        .attr("dy", "1em")
                        .style("text-anchor", "middle")
                        .attr("font-size", "18pt")
                        .text("Years");




                    var bar = g.selectAll("g.barChartGroup")
                        .data(dataset)
                        .enter().append("g")
                        .attr('class', 'barChartGroup');
                    
                    // bar chart
                    bar.append("rect")
                        .attr("x", function(d) { return xScale(d[0]); })
                        .attr("y", function(d) { return yScale(d[2]); })
                        .attr("width", xScale.bandwidth())
                        .attr("height", function(d) { return height - yScale(d[2]); })
                        .attr("class", function(d) {
                        var s = "bar ";
                        if (d[1] < 400) {
                            return s + "bar1";
                        } else if (d[1] < 800) {
                            return s + "bar2";
                        } else {
                            return s + "bar3";
                        }
                        });
                    
                    // labels on the bar chart
                    bar.append("text")
                        .attr("dy", "1.3em")
                        .attr("x", function(d) { return xScale(d[0]) + xScale.bandwidth() / 2; })
                        .attr("y", function(d) { return yScale(d[2]); })
                        .attr("text-anchor", "middle")
                        .attr("font-family", "sans-serif")
                        .attr("font-size", "15px")
                        .attr("fill", "black")
                        .attr("font-weight", "bold")
                        .text(function(d) {
                        return d[2];
                        });

                    
                    
                    // line chart
                    line = d3.line()
                        .x(function(d, i) { return xScale(d[0]) + xScale.bandwidth() / 2; })
                        .y(function(d) { return yScale(d[1]); })
                        .curve(d3.curveMonotoneX);
                    
                    bar.append("path")
                        .attr("class", "line") // Assign a class for styling
                        .attr("d", line(dataset)); // 11. Calls the line generator
                    
                    bar.append("circle") // Uses the enter().append() method
                        .attr("class", "dot") // Assign a class for styling
                        .attr("cx", function(d, i) { return xScale(d[0]) + xScale.bandwidth() / 2; })
                        .attr("cy", function(d) { return yScale(d[1]); })
                        .attr("r", 5);
                        //this is how I am creating the annonation for the circles BUT how do I get just the opioids to show?
                        	
                        ;

                                      
                     //udpates to data on hover       
                    function updateBarChart(myData, state, death)
                    {

                        d3.select("#drugState").html(state);
                        d3.select("#drugDeath").html(death);

                        var bar =d3.select('#theSVG').selectAll("g.barChartGroup")
                            .data(myData)

                            // bar chart
                        bar.select("rect").transition()
                            .attr("x", function(d) { return xScale(d[0]); })
                            .attr("y", function(d) { return yScale(d[2]); })
                            .attr("width", xScale.bandwidth())
                            .attr("height", function(d) { return height - yScale(d[2]); })
                            .attr("class", function(d) {
                            var s = "bar ";
                            if (d[1] < 400) {
                                return s + "bar1";
                            } else if (d[1] < 800) {
                                return s + "bar2";
                            } else {
                                return s + "bar3";
                            }
                            });
                        
                        // labels on the bar chart
                        bar.select("text").transition()
                            .attr("dy", "1.3em")
                            .attr("x", function(d) { return xScale(d[0]) + xScale.bandwidth() / 2; })
                            .attr("y", function(d) { return yScale(d[2]); })
                            .attr("text-anchor", "middle")
                            .attr("font-family", "sans-serif")
                            .attr("font-size", "15px")
                            .attr("fill", "black")
                            .attr("font-weight", "bold")
                            .text(function(d) {
                            return d[2];
                            });
                    
                         
                         // line chart
                        var line = d3.line()
                            .x(function(d, i) { return xScale(d[0]) + xScale.bandwidth() / 2; })
                            .y(function(d) { return yScale(d[1]); })
                            .curve(d3.curveMonotoneX);
                        
                        bar.select("path")
                            .attr("class", "line") // Assign a class for styling
                            .attr("d", line(myData)); // 11. Calls the line generator
                        
                        bar.select("circle") // Uses the enter().append() method
                            .attr("cx", function(d, i) { return xScale(d[0]) + xScale.bandwidth() / 2; })
                            .attr("cy", function(d) { return yScale(d[1]); })
                            .attr("r", 5);
                            //this is how I am creating the annonation for the cirles BUT how do I get just the opioids to show?
                        	
                        };

                        //append circles for check list
                        d3.select("#theSVG").append("circle")

                            .attr('cx', 1078)
							.attr('cy', -52)
                            .attr('r', 15)
                            .style('fill', 'none')
                            .style('stroke', 'black')
                            .style('stroke-width','2pt black')
							.attr('class', 'ARREST');

                        d3.select("#theSVG").append("circle")
                            .attr('cx', 1078)
							.attr('cy', 182)
                            .attr('r', 15)
                            .style('fill', 'none')
                            .style('stroke', 'black')
                            .style('stroke-width','2pt black')
                            .attr('class', 'OUD');
                            
                        d3.select("#theSVG").append("circle")
                            .attr('cx', 1078)
							.attr('cy', 442)
                            .attr('r', 15)
                            .style('fill', 'none')
                            .style('stroke', 'black')
                            .style('stroke-width','2pt black')
                            .attr('class', 'SSP');
                            
                        //write the code to append a check mark to the circle once the page has been completed

                    
                       
                    
                    
                        
            </script>
        
    </div>
</div>
    

    <!---->
    <!--Right Side box-->
<div id="verticalThree">
    <div class="boxHolder">
        <h1 class="boxHeader">Arrest Rates</h1>
        <div class="boxArea1">
            <a href="read_only/avg_arrest/primer/hamilton/index.html"> <img src="cuffs.png" class="arrestRates1"/></a>
            <!--<img src="arrestRates.PNG" class="arrestRates1"/>-->
            
            
        </div>
    </div>
     <div class="boxHolder">
        <h1 class="boxHeader">Opioid Use Disorder</h1>
        <div class="boxArea2">
            <a href="read_only/oud/primer/brain/index.html"> <img src="brain1.PNG"/></a>
            
        </div>
    </div>
     <div class="boxHolder">
        <h1 class="boxHeader">Syringe Exchange Programs</h1>
        <div class="boxArea3">
            <a href="read_only/ssp/primer/hiv1/index.html"><img src="syringe.jpg"/></a>
        </div>
    </div>
</div>

</div>

<!--Bottom Section Content-->
<div id="contentHolderBottom">
    <p class="bottomContentParagraphHolder"><b>Indiana is not the only state in the grip of a drug overdose crisis</b> – this data ranges from 2006-2017 
        </p>
    <div class="bottomContentBoxHolder">
    <div id="bottomBoxHolder">
    <div class="boxHolder">
        <h1 class="boxHeader">Kentucky 2006-2017</h1>
        <div class="boxArea4">
            <img class="KY" src="ky.PNG"/>
            <button id="kybtn" onmouseover="updateBarChart(datasetKy, 'Kentucky ', '1,566')"></button>
            
        </div>
    </div>
    <div class="boxHolder">
        <h1 class="boxHeader">Ohio 2006-2017</h1>
        <div class="boxArea5">
            <img src="ohio.PNG"/>
            <button id="ohbtn"  onmouseover="updateBarChart(datasetOh, 'Ohio ', '5,111')"></button>
        </div>
    </div>
    <div class="boxHolder">
        <h1 class="boxHeader">Michigan 2006-2017</h1>
        <div class="boxArea6">
            <img src="mich.PNG"/>
            <button id="michbtn"  onmouseover="updateBarChart(datasetMi, 'Michigan ' , '2,694')"></button>
        </div>
    </div>
    <div class="boxHolder">
        <h1 class="boxHeader">Illinois 2006-2017</h1>
        <div class="boxArea7">
            <img src="ill.PNG"/>
            <button id="illbtn"  onmouseover="updateBarChart(datasetIl, 'Illinois ', '2,778')"></button>
        </div>
    </div>
    <div class="boxHolder">
        <h1 class="boxHeader">West Virginia 2006-2017</h1>
        <div class="boxArea8">
            <img src="westv.PNG"/>
            <button id="westbtn"  onmouseover="updateBarChart(datasetWv, 'West Virginia ', '974')"></button>
        </div>
    </div>
        <div class="boxHolder">
        <h1 class="boxHeader">Indiana 2006-2017</h1>
            <div class="boxArea9">
            <img src="vir.PNG"/>
            <button id="virbtn"  onmouseover="updateBarChart(datasetIN, 'Indiana ', '1,852')"></button>
            
        </div>
            </div>
            
        </div>
    </div>
</div>
</div>

<div class="arrow_box"; style="position: absolute; left: 535px; top: 605px; width: 130px; height: 70px; font-size: 12.75pt;
text-align: center; visibility: hidden;"> Hover over the charts below for more information</div>

<div class="arrow_box2"; style="position: absolute; left: 782px; top: 218px; width: 320px; height: 165px; font-size: 12.75pt;
text-align: center; visibility: hidden;"> Click on any of the charts to the right to begin the interaction <p><br> Each chart has a new series of questions and interactions</p> 
<br> Once an interaction is completed the circle will turn green</div>

<script>

    setTimeout (function() {
        d3.select(".arrow_box").style("visibility", "visible");
        }, 2000);

        setTimeout (function() {
        d3.select(".arrow_box").style("visibility", "hidden");
        }, 8000);

    setTimeout (function() {
        d3.select(".arrow_box2").style("visibility", "visible");
        }, 12000);

    setTimeout (function() {
        d3.select(".arrow_box2").style("visibility", "hidden");
        }, 24000);

//onlick funtion to set up click of button and append dummies and text
                                /*
								d3.select("#kybtn")
									.on("click", function() {
										//requires the users to make selections by scaling, bc if not the interaction errors out, with NaN for no action
                                        console.log("updating to KY data")
                                        updateBarChart(datasetKy);
										
										
										
										
										
                                            
                                    })

                                */
  </script>

  </div>
</body>
</html>