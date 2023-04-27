



document.addEventListener('DOMContentLoaded', function(){

	quantity_fields = document.querySelectorAll('input[id^=quantity_]');
	quantity_fields.forEach(quantity_field => {
		let id = quantity_field.id.split('quantity_')[1];
		
		quantity_field.addEventListener('change', function(e){
			document.getElementById('quantity_err_'+id).innerHTML = '';
			if (quantity_field.value < 1){
				quantity_field.value = 1;
			}
			if (Number(quantity_field.value) > Number(quantity_field.max)){
				console.log(quantity_field.value);
				console.log(quantity_field.max);
				quantity_field.value = quantity_field.max;
			}
			$.ajax({
				url : "handler/update_quantity.php",
				type: 'post',
				data: {
					upd_id : id,
					amount: quantity_field.value
				},
				success: function(res){	
					let response = JSON.parse(res);
					if(typeof(response.amount_left) != "undefined"){
						document.getElementById('quantity_err_'+id).innerHTML = 'This product only has '+response.amount_left + ' left';
					}else{
						document.getElementById('subtotal_'+id).innerHTML = response.update_amount;
						updateTotal();
					}	
				}
			})
		})
	})

	close_btn = document.querySelectorAll('div[id^="close_"]');
	close_btn.forEach(btn => {
		let id = btn.id.split('close_')[1];
		btn.addEventListener('click', function(e) {
			$.ajax({
				url : "handler/remove.php",
				type: 'post',
				data: {
					rm_id : id
				},
				success: function(res){	
					document.getElementsByClassName('items')[0].removeChild(document.getElementById('product_'+id));
					updateTotal();
				}
			})
		})
	})
	
	document.getElementById('checkout').addEventListener('click', function(e){
		if(document.getElementsByClassName('items')[0].children.length == 0){
			console.log(document.getElementsByClassName('items')[0].children.length);
			e.preventDefault();
		}	
	})
})

function updateTotal(){
	let subtotalAll = 0;
	subtotal_fields = document.querySelectorAll('span[id^="subtotal_"')
	subtotal_fields.forEach(subtotal => {
		subtotalAll += Number(subtotal.innerHTML);
	})
	document.getElementById('subtotalAll').innerHTML = '$' +subtotalAll;
	let total = subtotalAll + subtotalAll*0.1;
	if(total == 0){
		document.getElementById('total').innerHTML = '$ 0';
		return;
	}
	document.getElementById('total').innerHTML ='$'+ Number(total);
	
}