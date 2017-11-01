$(function() {
	var data = [],
		series = Math.floor(Math.random() * 6) + 3;

	for (var i = 0; i < series; i++) {
		data[i] = {
			label: "Series" + (i + 1),
			data: Math.floor(Math.random() * 100) + 1
		}
	}
	$.plot("#placeholdernolegend", data, {
		series: {
			pie: {
				show: true
			}
		},
		legend: {
			show: false
		}, colors: [ '#418BCA', '#ee6f00', '#4caf50', '#EF6F6C', '#67C5DF']
	});
	$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
});

$(function() {
	var data = [],
		series = Math.floor(Math.random() * 6) + 3;

	for (var i = 0; i < series; i++) {
		data[i] = {
			label: "Series" + (i + 1),
			data: Math.floor(Math.random() * 100) + 1
		}
	}
	$.plot('#placeholderradiuslabel', data, {
		series: {
			pie: {
				show: true,
				radius: 1,
				label: {
					show: true,
					radius: 3/4,
					formatter: labelFormatter,
					background: {
						opacity: 0.5
					}
				}
			}
		},
		legend: {
			show: false
		}, colors: [ '#418BCA', '#ee6f00', '#4caf50', '#EF6F6C', '#67C5DF']
	});
	$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
});
//end of label radius pie charts

$(function() {
	var data = [],
		series = Math.floor(Math.random() * 6) + 3;

	for (var i = 0; i < series; i++) {
		data[i] = {
			label: "Series" + (i + 1),
			data: Math.floor(Math.random() * 100) + 1
		}
	}
	$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
});
//end of Styled labeld pie charts

$(function() {
	var data = [],
		series = Math.floor(Math.random() * 6) + 3;

	for (var i = 0; i < series; i++) {
		data[i] = {
			label: "Series" + (i + 1),
			data: Math.floor(Math.random() * 100) + 1
		}
	}

	$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
});
//end of Styled labeld pie charts
$(function() {
	var data = [],
		series = Math.floor(Math.random() * 6) + 3;

	for (var i = 0; i < series; i++) {
		data[i] = {
			label: "Series" + (i + 1),
			data: Math.floor(Math.random() * 100) + 1
		}
	}
	$.plot('#placeholderrectangularpie', data, {
		series: {
			pie: {
				show: true,
				radius: 500,
				label: {
					show: true,
					formatter: labelFormatter,
					threshold: 0.1
				}
			}
		},
		legend: {
			show: false
		}, colors: [ '#418BCA', '#ee6f00', '#4caf50', '#EF6F6C', '#67C5DF']
	});
	$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
});
//end of Rectangular pie charts

$(function() {
	var data = [],
		series = Math.floor(Math.random() * 6) + 3;

	for (var i = 0; i < series; i++) {
		data[i] = {
			label: "Series" + (i + 1),
			data: Math.floor(Math.random() * 100) + 1
		}
	}
	$.plot('#placeholdertiltedpie', data, {
		series: {
			pie: {
				show: true,
				radius: 1,
				tilt: 0.5,
				label: {
					show: true,
					radius: 1,
					formatter: labelFormatter,
					background: {
						opacity: 0.8
					}
				},
				combine: {
					color: "#999",
					threshold: 0.1
				}
			}
		},
		legend: {
			show: false
		}, colors: [ '#418BCA', '#ee6f00', '#4caf50', '#EF6F6C', '#67C5DF']
	});

	$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
});
//end of Tilted pie charts

$(function() {
	var data = [],
		series = Math.floor(Math.random() * 6) + 3;

	for (var i = 0; i < series; i++) {
		data[i] = {
			label: "Series" + (i + 1),
			data: Math.floor(Math.random() * 100) + 1
		}
	}
	$.plot('#placeholderdonuthole', data, {
		series: {
			pie: {
				innerRadius: 0.5,
				show: true
			}
		}, colors: [ '#418BCA', '#ee6f00', '#4caf50', '#EF6F6C', '#67C5DF']
	});
	$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
});
//end of Donet Hole pie charts
function labelFormatter(label, series) {
	return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
}


