//onlick funtion to set up click of button and append dummies and text
d3.select("#showMe")
.on("click", function() {
	//requires the users to make selections by scaling, bc if not the interaction errors out, with NaN for no action
	console.log("being clicked");

	if(textPred1 === undefined) {
		alert("Please use the bars below to make a prediction")
		return;
	}
	
	
	
	
	d3.select('#subject1')
		.style('visibility', 'visible');

	d3.select('#textContentTwo')
		.style('visibility', 'visible');

	d3.select('#showMe')
		.style('visibility', 'hidden');

	d3.select('#arrowHolder')
		.style('visibility', 'visible');

	d3.select('#afterPredict1')
		.style('visibility', 'visible');

/*
	d3.select('#textPred2').append('text')
		.attr('x', 550)
		.attr('y', 550)
		.html('100% of people receiving treatment at an opioid treatment program have been diagnosed with an opioid use disorder');
						
	

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

	//text anchor to circle2
	
	d3.select("#visualizationHolder").append("text")
		.attr('x', 165)
		.attr('y', 35)
		.html(textPred2 - 13 + '%')
		.style('fill', 'white')
		.attr('text-anchor', 'middle');

	*/
												
	//set Timeout feature here, look at w3 schools to load this code. Simple, remove alert part from code and add the d3 code below
	
	
		




				

});
