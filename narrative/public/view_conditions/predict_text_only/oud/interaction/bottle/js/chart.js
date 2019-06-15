//onlick funtion to set up click of button and append dummies and text
d3.select("#showMe")
.on("click", function() {
	//requires the users to make selections by scaling, bc if not the interaction errors out, with NaN for no action
	console.log("being clicked")
	var pred1Value = document.getElementById('pred1').value
	if (!pred1Value.match(/\S/))
	{
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

	d3.select("#afterPredict1")
		.style('visibility', 'visible');
		
						
	

	

	
		




				

});
