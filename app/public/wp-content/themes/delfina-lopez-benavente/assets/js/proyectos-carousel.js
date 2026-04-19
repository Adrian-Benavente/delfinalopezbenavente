/**
 * Carrusel de proyectos - Delfina López Benavente
 *
 * Inicializa Swiper solo cuando hay más de 3 proyectos.
 * Si hay 3 o menos, se muestra una cuadrícula estática.
 *
 * @package Delfina_Lopez_Benavente
 */
(function () {
	'use strict';

	function init() {
		const section = document.querySelector('.dlb-proyectos--carousel');
		const carousel = document.querySelector('.dlb-proyectos__carousel');
		if (!section || !carousel || typeof Swiper === 'undefined') return;

		const count = parseInt(section.getAttribute('data-proyectos-count'), 10);
		if (count <= 3) return;

		new Swiper('.dlb-proyectos__carousel', {
			slidesPerView: 3,
			spaceBetween: 24,
			loop: count > 3,
			navigation: {
				nextEl: '.dlb-proyectos__next',
				prevEl: '.dlb-proyectos__prev',
			},
			breakpoints: {
				320: {
					slidesPerView: 1,
					spaceBetween: 16,
				},
				640: {
					slidesPerView: 2,
					spaceBetween: 20,
				},
				1024: {
					slidesPerView: 3,
					spaceBetween: 24,
				},
			},
			a11y: {
				prevSlideMessage: 'Proyecto anterior',
				nextSlideMessage: 'Proyecto siguiente',
			},
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
