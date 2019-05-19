				
				
				
				
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
	
					.attr('x', 50)
					.attr('y', yScale(30))
					.attr('width', 100)
					.attr('height', CHART_HEIGHT - yScale(30))
					.attr('class', 'dummyBar1')
	
				//create dummy bar 3 

				var dummyBar3 = d3.select("#chart").append("rect")
								
					.attr("height", yScale(1))
					.attr('x', 200)
					.attr('y', yScale(2))
					.attr('width', 100)
					.attr('height', CHART_HEIGHT - yScale(2))
					.attr('class', 'dummyBar3')
					.style('fill' , 'none');
	
				
	
		
	
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
				//var downDummy2 = false;
				var mousestate;
				var barLength;
				var yBar;
				var prediction1;
				var dummyBarText3;
	
				//Am I over dummy2
	
				
		
	
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
									.attr('x', 50)
									.attr('y', yScale(30))
									.attr('width', 100)
									.attr('height', CHART_HEIGHT - yScale(30))
									.attr('fill', 'steelblue')
									.attr('class', 'dummy1');
	
								d3.select("#chart").append("text")
									.attr('y', yScale(30))
									.attr('x', '88')
									.html('30' + '%')
									.attr('class', 'barText1')
	
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
	
																				
										var reScaledLength = yReverse(newBarLength);
											console.log("scaled length " + reScaledLength);
											
										reScaledLength = Math.floor(reScaledLength);

										prediction1 = reScaledLength;
										
										//limits the scaling of the bar to 100
										if (reScaledLength > 100) {
											reScaledLength = 100;
											newBarLength = CHART_HEIGHT;
											yBarLength = CHART_HEIGHT - newBarLength;
										}	

										//limits the bar from being dragged -
										else if (reScaledLength < 2) {
											reScaledLength = 2;
											newBarLength = CHART_HEIGHT - yScale(2);
											yBarLength = CHART_HEIGHT - newBarLength;
										}

										
										
										d3.select('.dummy1')
											//.attr('x', mouseCoord[0] - 150)
											//.attr('y', mouseCoord[1] - 80)
											.attr('height', newBarLength) 
											.attr('y', yBarLength);

										d3.select(".barText1")
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

							//onlick funtion to set up click of button and append dummies and text
							d3.select("#showMe")
							.on("click", function() {
								//requires the users to make selections by scaling, bc if not the interaction errors out, with NaN for no action
								if(prediction1 === undefined){
									alert("PLEASE USE THE SCALE BAR TO MAKE A PREDICTION")
									return;
								}

								//start on dummy 3
								//append dummy 3
								dummyBar3 = d3.select("#chart").append("rect")
									.attr("heignt", yScale(1))
									.attr('x', 190)
									.attr('y', yScale(2))
									.attr('width', 100)
									.attr('height', CHART_HEIGHT - yScale(2))
									.attr('class', 'dummyBar3')
									.style('fill' , 'orange')
									.style('stroke', 'black')
									.style('stroke-width', '1pt')

								//append text to dummy 3
								dummyBarText3 = d3.select("#chart").append("text")
									.attr('y', yScale(2))
									.attr('x', 220)
									.html('82' + '%')
									.attr('class', 'dummyBarText3')

								//append circle to dummy 3 for gap
								d3.select("#chart").append("circle")
									.attr('cx', 240)
									.attr('cy', -10)
									.attr('r', 25)
									.attr('class', 'circle1');

								//text anchor to circle1
								d3.select("#chart").append("text")
									.attr('x', 240)
									.attr('y', -5)
									.html(prediction1 - 82 + '%')
									.style('fill', 'white')
									.attr('text-anchor', 'middle');

								//grow text with bar
								dummyBarText3.transition()
									.attr('height', CHART_HEIGHT - yScale(82))
									.attr("y", yScale(82))											
									.duration(1700);

								//animate bar
								dummyBar3.transition()
									.attr('y', yScale(82))
									.attr("height", CHART_HEIGHT - yScale(82))
									.duration(1700);


								//set Timeout feature here, look at w3 schools to load this code. Simple, remove alert part from code and add the d3 code below
								d3.select('#subject1')
									.style('visibility', 'visible');

								d3.select('#textContentTwo')
									.style('visibility', 'visible');
								
								d3.select('#showMe')
									.style('visibility', 'hidden');
	
						});
								
					}
					
										
			
				);

			})
	
							
	
							
	
						
	
								
								
									
	
						
	
					
	
					
	
		
	
		