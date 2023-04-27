document.addEventListener("DOMContentLoaded",function(){
	document.getElementsByName('change-pass-btn')[0].addEventListener('click',function(e){

		let flag = false;
		if(document.getElementsByName('old-pass')[0].value.length == 0){
			flag = true;
			document.getElementsByName('old-pass')[0].style.border = "2px red solid";
		}
		if(document.getElementsByName('new-pass')[0].value.length == 0){
			flag = true;
			document.getElementsByName('new-pass')[0].style.border = "2px red solid";
		}
		if(document.getElementsByName('retype-new-pass')[0].value.length == 0){
			flag = true;
			document.getElementsByName('retype-new-pass')[0].style.border = "2px red solid";
		}
		
		if(document.getElementsByName('new-pass')[0].value != document.getElementsByName('retype-new-pass')[0].value){
			flag = true;
			document.getElementById('retype-err').style.display="block";
			document.getElementById('retype-err').innerHTML = "New password and retype does not match";
		}

		if(flag) return;

		let old_pass = document.getElementsByName('old-pass')[0].value;
		let new_pass = document.getElementsByName('new-pass')[0].value;
		let retype = document.getElementsByName('retype-new-pass')[0].value;
		$.ajax({
			url : 'changepass.php',
			type: 'post',
			data: {
				old : old_pass,
				new : new_pass,
				rt	: retype
			},
			success: function(res){
				if(res.length != 0){
					document.getElementById('retype-err').style.display="block";
					document.getElementById('retype-err').innerHTML = res;
				}else{
					document.getElementsByName("exit-btn-pass")[0].click();
					document.getElementById('alert-box').style.display = 'block';
				}
			}
		});
	})

	document.getElementById('showchangeModal').addEventListener('click',function(e){
		document.getElementsByName('retype-new-pass')[0].style.border = "1px black solid";
		document.getElementsByName('new-pass')[0].style.border = "1px black solid";
		document.getElementsByName('old-pass')[0].style.border = "1px black solid";
		document.getElementById('retype-err').style.display="none";

		document.getElementsByName('old-pass')[0].value = "";
		document.getElementsByName('new-pass')[0].value = "";
		document.getElementsByName('retype-new-pass')[0].value = "";
	})

	document.getElementById('close-alert').addEventListener('click',function(e){
		document.getElementById('alert-box').style = 'display: none !important';
	})
})
