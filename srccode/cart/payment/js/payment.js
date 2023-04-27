document.getElementById('proceed').addEventListener('click', function(e){
	console.log()
	let flag = false;
	if(document.getElementById('tienmat').checked) {
		flag = true;
	}else if(document.getElementById('momo').checked) {
		flag = true;
	}else if(document.getElementById('zalopay').checked) {
		flag = true;
	}
	if(!flag){
		document.getElementById('method-err').style.display = "block";
		e.preventDefault();
	}
})