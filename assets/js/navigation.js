(function () {
	var header = document.querySelector('.fsw-header');
	var button = document.querySelector('.fsw-nav-toggle');
	var nav = document.querySelector('.fsw-nav');
	if (!header || !button || !nav) return;
	header.classList.add('has-nav-toggle');
	button.hidden = false;
	button.addEventListener('click', function () {
		var open = button.getAttribute('aria-expanded') === 'true';
		button.setAttribute('aria-expanded', String(!open));
		button.setAttribute('aria-label', open ? button.dataset.openLabel : button.dataset.closeLabel);
		nav.classList.toggle('is-open', !open);
		if (open) button.focus();
	});
	document.addEventListener('keydown', function (event) {
		if (event.key === 'Escape' && button.getAttribute('aria-expanded') === 'true') button.click();
	});
}());
