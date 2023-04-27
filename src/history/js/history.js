$(document).ready(function () {
    $('#history-table').DataTable();
});

document.addEventListener("DOMContentLoaded",function(){
	let tbl_rows = document.querySelectorAll('tr[name^="bill_"]');
	tbl_rows.forEach(row => {
		row.addEventListener('click', function(e){
			let id = $(this).attr('name').split('bill_')[1];
			window.location.href = '/history/bill.php?id='+id;
		})
	})
})