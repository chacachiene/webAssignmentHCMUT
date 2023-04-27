document.getElementsByName('show-edit-box')[0].addEventListener('click', function(e){
	e.preventDefault();
	let product_id = this.id;
	document.getElementById('edit-comment').style.display ='block';
	document.getElementById('cur_comment').style.display = 'none';
})

document.getElementById("edit").addEventListener('click', function(e){
	let value = this.value;
	let comment = document.getElementById('edit-comment').value;
	$.ajax({
		url: "/product-detail/comment.php",
		type: 'post',
		data: {
			id : value,
			content: comment,
		},
		success: function(res){
				document.getElementById('edit-comment').style.display ='none';
				document.getElementById('cur_comment').style.display = 'block';
				document.getElementById('comment-content').innerHTML = comment;
		},
	})
})





