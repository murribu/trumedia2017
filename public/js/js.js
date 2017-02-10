var margin = {top: 20, right: 30, bottom: 30, left: 40},
    width = 500 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

var x = d3.scale.linear()
    .range([-width/2, width/2]);
    
var y = d3.scale.linear()
    .range([height, 0]);
    
var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom");
    
var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left");
    
var chart = d3.select(".chart")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
    .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

d3.json('/pitches_by_umpire?umpire_id=50', function(error, data){
    data = data.map(treat);
    // x.domain(data.map(function(d) { return d.id; }));
    // y.domain([0, d3.max(data, function(d) { return d.pz; })]);
    x.domain([-25.5, 25.5]); // inches (one plate's width outside, to one plate's width inside)
    y.domain([-1, 2]); //how many strike-zone-heights above the bottom of the strike zone

  chart.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(" + width/2 + "," + height + ")")
      .call(xAxis);

  chart.append("g")
        .attr("class", "y axis")
        .call(yAxis);

    chart.append("g")
        .attr("class", "zone")
        .append("rect")
        .attr("width", function(d){ return x(17); })
        .attr("height", function(d) { return y(1); })
        .attr("x", function(d){ return x(17); })
        .attr("y", function(d){ return y(1); })
    
    chart.selectAll(".pitch")
            .data(data)
        .enter().append("circle")
            .attr("class", "pitch")
            .attr("cx", function(d){ return x((d.px*12)+25.5) })
            .attr("cy", function(d){ return y((d.pz - d.szb)/(d.szt - d.szb)) })
            .attr("data-px", function(d){ return d.px; })
            .attr("data-pz", function(d){ return d.pz; })
            .attr("data-szt", function(d){ return d.szt; })
            .attr("data-szb", function(d){ return d.szb; })
            .attr("data-ord", function(d){ return d.ord; })
            .attr("r", function(d){ return 2; })
            .attr("fill", "red")
            ;
});

function treat(d) {
    d.px = (+d.px);
    d.pz = (+d.pz);
    d.szb = (+d.szb);
    d.szt = (+d.szt);
    return d;
}