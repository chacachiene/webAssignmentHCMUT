document.getElementById('add2cart').addEventListener('click', function(e){
	let add_id = this.value;
	$.ajax({
		url : "/product-detail/add2cart.php",
		type: "post",
		data: {
			id : add_id,
		},
		success : function (res){
			console.log(res);
			if(res){
				document.getElementById('alert-row').style.display = 'block';
				document.getElementById('alert-message').innerHTML = res;
			}else{
				document.getElementById('alert-row').style.display = 'block';
				document.getElementById('alert-message').innerHTML = 'Added';
			}
			
		}
	});
})

document.getElementById('close-alert').addEventListener('click', function(e){
	document.getElementById('alert-row').style.display = 'none';
})