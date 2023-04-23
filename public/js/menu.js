let burger = document.getElementById('burger'),
	 nav   = document.getElementById('main-nav'),
	 body  = document.querySelector('body');
	

burger.addEventListener('click', function(e){
	this.classList.toggle('is-open');
	nav.classList.toggle('is-open');
	body.hasAttribute('style') ? body.removeAttribute('style') : body.setAttribute('style','overflow: hidden;')
});



