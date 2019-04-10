				
				
				
				
				var width = 500;
				var CHART_HEIGHT = 500;

				
				

				var x = d3.scale.linear()
					.domain([1, 100])
					.range([0, width])
					.clamp(true);

				var dispatch = d3.dispatch("sliderChange");

				var slider = d3.select(".slider")
					.style("width", width + "px")
					

					
						

				var sliderTray = slider.append("div")
					.attr("class", "slider-tray");

				var sliderHandle = slider.append("div")
					.attr("class", "slider-handle");

				sliderHandle.append("div")
					.attr("class", "slider-handle-icon")
					
				

				slider.call(d3.behavior.drag()
					.on("dragstart", function() {
					dispatch.sliderChange(x.invert(d3.mouse(sliderTray.node())[0]));
					d3.event.sourceEvent.preventDefault();
					})
					.on("drag", function() {
					dispatch.sliderChange(x.invert(d3.mouse(sliderTray.node())[0]));
					}));

				dispatch.on("sliderChange.slider", function(value) {
				sliderHandle.style("left", x(value) + "px")
				});

				