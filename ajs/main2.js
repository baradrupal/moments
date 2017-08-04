function showP1(id)
{	jQuery('#'+id+'-p1').show();
	jQuery('#'+id+'-p2').hide();
	jQuery('#'+id+'-btn').html('More');
}
function hideP1(id)
{	jQuery('#'+id+'-p1').hide();
	jQuery('#'+id+'-p2').show();
	jQuery('#'+id+'-btn').html('Less');
}
function _el(id) { return document.getElementById(id); }
function contact()
{	if(_el('contact-submit').innerHTML != 'Submit')
		return;
	_el('contact-submit').innerHTML = 'Saving...'
	_el('txtName').disabled = true
	_el('txtLocation').disabled = true
	_el('txtPhone').disabled = true
	_el('txtEmail').disabled = true
	_el('txtMessage').disabled = true
	jQuery.ajax({
		url: 'contact.php',
		type: 'POST',
		data: {
			Name: jQuery('#txtName').val(),
			Location: jQuery('#txtLocation').val(),
			Phone: jQuery('#txtPhone').val(),
			Email: jQuery('#txtEmail').val(),
			Message: jQuery('#txtMessage').val()
		},
		success: function(response) {
			if(response == 'sent') {
				_el('contact-msg').innerHTML = "<div>Thank you for your inquiry. We will get in touch with you soon.</div>";
				//document.getElementById('frmContact').reset()
				_el('contact-submit').innerHTML = 'Saved : )'
			} else {
				unlockContact()
			}
		},
		error: function(jqXHR, status, err) {
			unlockContact(status, err)
		}
	});
}
function unlockContact(status, err)
{	_el('txtName').disabled = false
	_el('txtLocation').disabled = false
	_el('txtPhone').disabled = false
	_el('txtEmail').disabled = false
	_el('txtMessage').disabled = false
	_el('contact-msg').innerHTML = "<div>Unable to save your contact details.</div>"+status+'<br>'+err;
	_el('contact-submit').innerHTML = 'Submit'
}
