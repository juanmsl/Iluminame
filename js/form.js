let initFormById = function(formContainer, mainForm) {
	var form = '#' + formContainer;
	var mainForm = form + ' #' + mainForm;
	console.log(mainForm);
	$(mainForm).show();
	$(form + ' .fm-container_body').delay(500).slideDown(1000);
	$(form + ' .fm-form_link').on('click', function() {
		$(mainForm)[0].reset();
		$(mainForm).slideUp();
		mainForm = $(this).attr('target');
		$(mainForm).slideDown();
	});
}

initFormById('initial-form', 'login-form');
