function send_price_range(min,max) {
    var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		document.getElementById("checkAjax").innerHTML = this.responseText;
        document.getElementById("all_product").innerHTML = "";
	};
	xhttp.open("POST", "price-range.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("min=" + min+"&max="+max)
}