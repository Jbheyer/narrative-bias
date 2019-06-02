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
						
			


	




				

});
