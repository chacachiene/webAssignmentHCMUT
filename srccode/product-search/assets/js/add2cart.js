document.addEventListener("DOMContentLoaded",function(){
	let add2cart_btns = document.querySelectorAll('li[name^="add_"');
	add2cart_btns.forEach(btn => {
		btn.addEventListener('click',function(e){
			let add_id = $(this).attr('name').split('add_')[1];
			$.ajax({
				url : '../product-detail/add2cart.php',
				type: 'post',
				data: {
					id: add_id,
				},
				success : function (res){
					if(res){
						document.getElementById('alert-row').style.display = 'block';
						document.getElementById('alert-message').innerHTML = res;
					}else{
						document.getElementById('alert-row').style.display = 'block';
						document.getElementById('alert-message').innerHTML = 'Added';
					}
				},
				error: function(err){
					window.location.href = "/login/login.php";
				}
			})
		})
	})

	document.getElementById('close-alert').addEventListener('click', function(e){
		document.getElementById('alert-row').style.display = 'none';
	})
})