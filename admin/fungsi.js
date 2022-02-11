$(document).ready(function() {
    selesai();
});
 
function selesai() {
	setTimeout(function() {
		update();
		selesai();
	}, 100);
}
 
function update() {
	$.getJSON("data.php", function(data) {
		$("table").empty();
		var no = 1;
		$.each(data.result, function() {
			$("table").append
			("<tr><td>"+"Suhu Tubuh	: "+this['data']+"°C"+
			"</td></tr><tr><td>"+(+this['data'] > 37.5 ? "Tinggi" : "Normal")+
			"</tr></td><tr><td>"+this['waktu']+			
			"</td></tr>");
		});
	});
}

