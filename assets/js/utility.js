var stringToColour = function(str) {
    var hash = 0;
    for (var i = 0; i < str.length; i++) {
        hash = str.charCodeAt(i) + ((hash << 5) - hash);
    }
    var colour = '#';
    for (var i = 0; i < 3; i++) {
        var value = (hash >> (i * 8)) & 0xFF;
        colour += ('00' + value.toString(16)).substr(-2);
    }
    return colour;
}
var stringToLabelColor = function(str) {
	var colors = ['red','orange','yellow','olive','green','teal','blue','violet','purple','pink','brown','grey'];
    var hash = 0;
    for (var i = 0; i < str.length; i++) {
        hash += str.charCodeAt(i);
    }
	var index = hash % colors.length;
    return colors[index];
}