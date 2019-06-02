				
				
				
				
				var CHART_WIDTH = 300;
				var CHART_HEIGHT = 300;

				
	
			
				// create y scale, ranging from 0 to 100
	
				var yScale = d3.scale.linear()
					.domain([0, 100])
					.range([CHART_HEIGHT, 0]);
	
				//this reverses the scale from data to pixle to pixels to data. For example, domain and range in the original order do data
				//to pixels but when reversed executes pixels (from the dragging bar) to data, which we want
	
				var yReverse = d3.scale.linear()
					.range([0, 100])
					.domain([0, CHART_HEIGHT]);
	
				// create y axis. For x axis, we're just using a line
	
				var yAxis = d3.svg.axis()
					.scale(yScale)
					.orient("left");
	
		
	
				d3.select("#yAxis").call(yAxis);
	
		
	
				
	
				// create two dummy bars as place holders to drag onto
	
				// that way, the viewer has an intution of were to drop the bar
	
				var dummyBar1 = d3.select("#chart").append("rect")
	
					.attr('x', 100)
					.attr('y', yScale(100))
					.attr('width', 100)
					.attr('height', CHART_HEIGHT - yScale(100))
					.attr('class', 'dummyBar1')
	
				d3.select("#chart").append("text")
					.attr('y' , yScale(102))
					.attr('x', 130)
					.html('100' + '%')
					.attr('class', 'barText')
	
				
					

					
						
		
	
				// Am I over dummy1? 
	
				var overDummyBar1 = false;
				dummyBar1.on("mouseover", function() 
	
				{
					console.log("Over dummyBar 1");
					overDummyBar1 = true;
				});
	
		
	
				dummyBar1.on("mouseout", function() 
				{
					console.log("no longer over dummyBar 1");
					overDummyBar1 = false;
				})
	
	
	
				//set global var for down dummy on mouse down click
	
				var downDummy1 = false;
				var downDummy2 = false;
				var mousestate;
				var barLength;
				var yBar;
		
	
				//Am I over dummy2
	
				var overDummyBar2 = false;
				dummyBar2.on("mouseover", function() 
				{
					console.log("Over dummyBar 2");
					overDummyBar2 = true;
				});
	
		
	
				dummyBar2.on("mouseout", function() 
				{
					console.log("no longer over dummyBar 2");
					overDummyBar2 = false;
				})
	
		
	
				// create event handler for dragging/drag and drop square
	
				d3.select("#dragme")
					.on('mousedown', function() 
					{
	
		
	
						// remember the coordinates of the rectangle
	
						var rectX = +d3.select("#dragme").attr('x');
						var rectY = +d3.select("#dragme").attr('y');
	
		
	
						// create a new event handler that's tied to the document (i.e., the whole page), and that will be called whenever the mouse is moved
	
						d3.select(document).on('mousemove', function() 
	
						{
	
							// get the coordinates of mouse pointer relative to the SVG
	
							var mouseCoord = d3.mouse(d3.select("svg").node());
	
		
	
							// move the rectangle to those new coordinates, added +5
	
							d3.select("#dragme")
								.attr('x', mouseCoord[0] + 5)
								.attr('y', mouseCoord[1] + 5)
	
							
	
						});
	
					
	
		
	
						// create another event handler when the mouse is released
	
						d3.select(document).on('mouseup', function() {
	
							
	
		
	
							// return the 'dragme' rectnagle to the original position (since we've probably moved it since)
	
							d3.select("#dragme")
								.attr('x', rectX)
								.attr('y', rectY);
	
		
	
							// and, remove the mousemove event handler (we don't need it)
	
							d3.select(document).on('mousemove', null);
							d3.select(document).on('mouseup', null);
	
							
	
							
	
							// ***** NOW, this is where we get to tell it how to react when
	
							// releasing over the dummies							
	
							if (overDummyBar1 == true) {
								// we've release the blue square over dummy1
								console.log("**** Released square over dummy 1**** "); 
								var overDummy1 = d3.select("#chart").append("rect")
									.attr('x', 25)
									.attr('y', yScale(30))
									.attr('width', 50)
									.attr('height', CHART_HEIGHT - yScale(30))
									.attr('fill', 'steelblue')
									.attr('class', 'dummy1');
	
								d3.select("#chart").append("text")
									.attr('y' , yScale(30))
									.attr('x', 30)
									.html('30' + '%')
									.attr('class', 'barText')
	
								//mouse down on dummy 1 within if function
	
								overDummy1.on("mousedown", function() 
								{
									console.log("down on dummy 1");
									downDummy1 = true;
	
									
										//mouse state for mousedown
										mousestate = d3.mouse(d3.select("svg").node());
											console.log("mouse state  " + mousestate)
	
										//store bar length for height of dummy
										barLength = +d3.select(".dummy1")
														.attr("height");
														console.log("length of bar " + barLength)
	
										//****trying yBarLength by adding Y, we needed to update the Y and not the height
										yBar = +d3.select(".dummy1")
														.attr("y");
														console.log("length of y in bar " + yBar)
	
	
										//create a new event handler that's tied to the document (i.e., the whole page), and that will be called whenever the mouse is moved
	
										d3.select(document).on('mousemove', function() 
										{
	
										// get the coordinates of mouse pointer relative to the SVG
	
										var mouseCoord = d3.mouse(d3.select("svg").node());
	
										//mouse move ending point
	
										var offset = mouseCoord[1] - mousestate[1] 
											console.log("mouse offset " + offset)
	
	
										var newBarLength = offset*-1 + barLength;
											console.log("calculated new length " + newBarLength);
					
										var yBarLength = offset + yBar;
											console.log("updated ybar length " + yBarLength);
	
	
										d3.select('.dummy1')
											//.attr('x', mouseCoord[0] - 150)
											//.attr('y', mouseCoord[1] - 80)
											.attr('height', newBarLength) 
											.attr('y', yBarLength);
										
										var reScaledLength = yReverse(newBarLength);
											console.log("scaled length " + reScaledLength);
											
	
										reScaledLength = Math.floor(reScaledLength);


										d3.select(".barText")
											.attr('y', yBarLength)
											.html(reScaledLength + '%');
																	
	
	
	
											
	
										
	
										
	
										});
	
					
	
		
	
										// create another event handler when the mouse is released
										d3.select(document).on('mouseup', function() {
	
	
										// and, remove the mousemove event handler (we don't need it)
	
											d3.select(document).on('mousemove', null);
											d3.select(document).on('mouseup', null);
	
										});
	
								});	
	
		
	
								overDummy1.on("mouseup", function() 
								{
									console.log("no longer down on dummy 1");
									downDummy1 = true;
								});
	
								
	
							}	
	
							else if (overDummyBar2) {
								// we've release the blue square over dummy1
								console.log("**** Released square over dummy 2 **** "); 
								var overDummy2 = d3.select("#chart").append("rect")
									.attr('x', 175)
									.attr('y', yScale(30))
									.attr('width', 50)
									.attr('height', CHART_HEIGHT - yScale(30))
									.attr('fill' , 'steelblue')
									.attr('class', 'dummy2');
	
		
	
								//mouse down on dummy 1 within if function
	
								overDummy2.on("mousedown", function() 
								{
									console.log("down on dummy 2");
									downDummy2 = true;
	
									
										//mouse state for mousedown
										mousestate = d3.mouse(d3.select("svg").node());
											console.log("mouse state  " + mousestate)
	
										//store bar length for height of dummy
										barLength = +d3.select(".dummy2")
														.attr("height");
														console.log("length of bar " + barLength)
	
										//****trying yBarLength by adding Y, we needed to update the Y and not the height
										yBar = +d3.select(".dummy2")
														.attr("y");
														console.log("length of y in bar " + yBar)
	
	
										//create a new event handler that's tied to the document (i.e., the whole page), and that will be called whenever the mouse is moved
	
										d3.select(document).on('mousemove', function() 
										{
	
										// get the coordinates of mouse pointer relative to the SVG
	
										var mouseCoord = d3.mouse(d3.select("svg").node());
	
										//mouse move ending point
	
										var offset = mouseCoord[1] - mousestate[1] 
											console.log("mouse offset " + offset)
	
	
										var newBarLength = offset*-1 + barLength;
											console.log("calculated new length " + newBarLength);
					
										var yBarLength = offset + yBar;
											console.log("updated ybar length " + yBarLength);
	
	
										d3.select('.dummy2')
											//.attr('x', mouseCoord[0] - 150)
											//.attr('y', mouseCoord[1] - 80)
											.attr('height', newBarLength) 
											.attr('y', yBarLength)
	
										var reScaledLength = yReverse(newBarLength);
											console.log("scaled length " + reScaledLength);
																	
	
	
	
											
	
										
	
										
	
										});
	
	
					
	
		
	
										// create another event handler when the mouse is released
	
										d3.select(document).on('mouseup', function() {
	
														
			
										// and, remove the mousemove event handler (we don't need it)
	
										d3.select(document).on('mousemove', null);
										d3.select(document).on('mouseup', null);
	
										});
	
								});	
	
								overDummy2.on("mouseup", function() 
							{
	
									console.log("no longer down on dummy 2");
									downDummy2 = true;
	
								
	
								});
	
							
	
							
	
						}
	
								
								
									
	
						})
	
					});
	
					
	
		
	
		