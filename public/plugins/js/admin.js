/* Upload Image in Admin */

function handleFileSelect(event) {
	var input = this;
	if (input.files && input.files.length) {
		var reader = new FileReader();
		this.enabled = false
		reader.onload = (function (e) {
			$("#hide").hide();
			$("#image_preview").html(['<img class="thumb" src="', e.target.result, '" title="', escape(e.name), '"/><span class="remove_img_preview"></span>'].join(''))
			$("#image_preview_create").html(['<img class="thumb" src="', e.target.result, '" title="', escape(e.name), '" style="width: 400px" /><span class="remove_img_preview"></span>'].join(''))
		});
		reader.readAsDataURL(input.files[0]);
	}
}
$('#image').change(handleFileSelect);
$('#image_preview').on('click', '.remove_img_preview', function () {
	$("#image_preview").empty();
	$("#image").val("");
});
/* End Upload Image */

/* Validation Number Format */
function isNumber(evt) {
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
	}
	return true;
}


function cekArray(i)
{
	var searchIDs = $("input:checkbox:checked").map(function(){
		return parseInt(this.value);
	}).toArray();

	$("#vals").val(searchIDs);

}

function cekValidasi()
{
	if($("#vals").val() == ''){
		$('#informasi').empty();
		$('#informasi').append("Anda Belum Memilih Kemasan");
		$("#valid").modal('show');

		return false;
	}
}

// Cek validasi stok
function cekValidate(i){

	var id      = $('#prod_id_'+i).val();
	var stok    = parseInt($('#stok-'+i).val());
	var qty     = parseInt($('#qty-'+i).val());
	var qtys    = parseInt($('#qtys-'+i).val());
	var kemasan = $('#kemasan_'+i).val();
	var rowid   = $('#rowid_'+i).val();

	var jmlstok = parseFloat(stok) + 1;

	if(qty >= jmlstok){
		$('#informasi').empty();
		$('#informasi').append("Kuantiti tidak bisa melebihi stok");
		$("#valid").modal('show');
		$('#qty-'+i).val(qtys);
	}else{
		$.ajaxSetup({
			headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
		});
		$.ajax({
			type: 'POST',
			url: '/ajax/autosave',
			data: {id: id, qty: qty, kemasan: kemasan, rowid: rowid, _token:$('input[name=_token]').val()},
			success: function(result){

			}

		});
	}

}

function cek() {
	var total = $('#grandtotals').val();

	if(total < 500000){
		$('#informasi').empty();
		$('#informasi').append(" Untuk menikmati harga terbaik grosir kami, minimum total pembelanjaan harus mencapai Rp. 500.000,-");
		$("#valid").modal('show');
		return false;
	}
}

function count(i){
	var row = $(this).closest("tr");
	var price = $('#price-'+i).val();
	var qty = $('#qty-'+i).val();
	var tot = parseFloat(price) * parseFloat(qty);
	var grandtotal = 0;
	$('#subtotal-'+i).empty();
	$('#subtotal-'+i).append(toRp(tot));

	$('#subtot-'+i).val(tot);

	calculate();

}
// Mengkalkulasikan grand total untuk di cart
function calculate(){

	var grandtotal = 0;
	var line = $('.subtots');
	var shipping = $('#shipping').val();

	$.each(line, function(i){

		grandtotal += parseFloat($(line[i]).val());

	});
	var tots = parseFloat(grandtotal) + parseFloat(shipping);
	$('#grandtotal').html(toRp(parseFloat(grandtotal).toFixed(2)));
	$('#grandtotals').val(parseFloat(grandtotal).toFixed(2));
	$('#gt').html(toRp(tots));

}

// Function untuk Rupiah
function toRp(angka){
	var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
	var rev2    = '';
	for(var i = 0; i < rev.length; i++){
		rev2  += rev[i];
		if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
			rev2 += '.';
		}
	}
	return rev2.split('').reverse().join('') + ',00';
}