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
	$.getJSON("jumlah_pengunjung.php", function(jumlah_pengunjung) {
		$("table").empty();
		var no = 1;
		$.each(count1.result, function() {
			$("table").append
			("<tr><td>"+"Jumlah Pengunjung : "+this['count1']+		
			"</td></tr>");
		});
	});

}

