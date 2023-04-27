document.addEventListener('DOMContentLoaded', function(){
	birthday_field = document.getElementById('birthday');
	for(let i = 1 ; i < 32 ; i ++){
		day = document.createElement('option');
		day.value = i;
		day.innerHTML = i;
		birthday_field.appendChild(day);
	}
	birthday_field.children[0].selected = true;
	

	birthmonth_field = document.getElementById('birthmonth');
	for(let i = 1 ; i < 13 ; i ++){
		month = document.createElement('option');
		month.value = i;
		month.innerHTML = i;
		birthmonth_field.appendChild(month);
	}
	birthmonth_field.children[0].selected = true;

	birthyear_field = document.getElementById('birthyear');
	for(let i = 1960 ; i < 2023 ; i ++){
		year= document.createElement('option');
		year.value = i;
		year.innerHTML = i;
		birthyear_field.appendChild(year);
	}
	birthyear_field.children[0].selected = true;
})


function check(){
    normalize();
    fname = document.getElementById('firstName');
    if(fname.value.length < 2 || fname.value.length > 30 ){
        fname.style.border = '2px solid red';
        document.getElementById('firstName_field').innerHTML = 'Firstname must between 2 and 30 character';
        return false;
    }
    lname = document.getElementById('lastName');
    if(lname.value.length < 2 || lname.value.length > 30 ){
        lname.style.border = '2px solid red';
        document.getElementById('lastName_field').innerHTML = 'Lastname must between 2 and 30 character';
        return false;
    }
    bday = document.getElementById('birthday').value;
    bmonth = document.getElementById('birthmonth').value;
    byear = document.getElementById('birthyear').value;
    if(bday.length==1) bday = '0' + bday;
    if(bmonth.length==1) bmonth = '0' + bmonth;
    bdate = bday + '/' + bmonth + '/' + byear;
    if(!moment(bdate,'DD/MM/YYYY',true).isValid()){
        document.getElementById('bdate_field').innerHTML = 'Invalid Date';
        return false;
    }
    password = document.getElementById('password');
    if(password.value.length < 2 || password.value.length > 30 ){
        lname.style.border = '2px solid red';
        document.getElementById('password_field').innerHTML = 'Password must between 2 and 30 character';
        return false;
    }
    confirm_password = document.getElementById('confirm_password');
    if(confirm_password.value != password.value){
        lname.style.border = '2px solid red';
        document.getElementById('confirmpassword_field').innerHTML = 'Input is not the same with password field';
        return false;
    }
    email = document.getElementById('emailAddress');
    if(email.value.match(/[A-Z_0-9a-z]+@[A-Z_0-9a-z]+\.com/)==null){
        document.getElementById('email_field').innerHTML = 'Invalid email';
        return false;
    }
    textarea = document.getElementById('about');
    if(textarea.value.length > 10000){
        document.getElementById('textarea_field').innerHTML = 'About field must less than 10000 characters' ;
        return false;
    }
    window.alert('Validation success');
    return true;
}

function ClearAll(){
    normalize();
    input = document.getElementsByTagName('input');
    length = input.length;
    for(i=0;i<length;i++){
        if(input[i].type=='button' || input[i].type=='submit') continue;
        input[i].value = '';
    }
}

function normalize(){
    document.getElementById('firstName').style.border = '1px solid black';
    document.getElementById('firstName_field').innerHTML = '';
    document.getElementById('lastName').style.border = '1px solid black';
    document.getElementById('lastName_field').innerHTML = '';
    document.getElementById('bdate_field').innerHTML = '';
    document.getElementById('textarea_field').innerHTML = '';
    document.getElementById('email_field').innerHTML = '';
    document.getElementById('password_field').innerHTML = '';
    document.getElementById('confirmpassword_field').innerHTML = '';
}