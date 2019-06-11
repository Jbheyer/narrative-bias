d3.select("#showMe")
	.on("click", function() {
	//requires the users to make selections by scaling, bc if not the interaction errors out, with NaN for no action
	if(pred1.pred1 === undefined || pred2.pred2 === undefined){
	alert("Please make a prediction in the input fields below")
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
