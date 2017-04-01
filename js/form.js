var form = '#main-form';
$(form).show();
$('.fm-container_body').delay(500).slideDown(1000);

$('.fm-form_link').on('click', function() {
	$(form)[0].reset();
	$(form).slideUp();
	form = $(this).attr('target');
	$(form).slideDown();
});
