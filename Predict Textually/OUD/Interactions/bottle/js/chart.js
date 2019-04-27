//onlick funtion to set up click of button and append dummies and text
d3.select("#showMe")
.on("click", function() {
	//requires the users to make selections by scaling, bc if not the interaction errors out, with NaN for no action
	console.log("being clicked");

	if(textPred1 === undefined) {
		alert("PLEASE A TYPE PREDICTION FOR BOTH SPACES")
		return;
	}
	
	
	
	
	

	//append circle to dummy 4 for gap
	dummycircle = d3.select("#visualizationHolder").append("circle")
		.attr('cx', 150)
		.attr('cy', 130)
		.attr('r', 25)
		.attr('class', 'circle1');

	//text anchor to circle2
	dummycircleText = d3.select("#visualizationHolder").append("text")
		.attr('x', 265)
		.attr('y', 35)
		.html(textPred1 - 16 + '%')
		.style('fill', 'white')
		.attr('text-anchor', 'middle');


	//append circle to dummy 4 for gap
	d3.select("#visualizationHolder").append("circle")
		.attr('cx', 265)
		.attr('cy', 30)
		.attr('r', 25)
		.attr('class', 'circle2')
		.style('fill', 'black');

	

												
	//set Timeout feature here, look at w3 schools to load this code. Simple, remove alert part from code and add the d3 code below
	d3.select('#subject1')
		.style('visibility', 'visible');

	d3.select('#textContentTwo')
		.style('visibility', 'visible');
	
		




				

});
