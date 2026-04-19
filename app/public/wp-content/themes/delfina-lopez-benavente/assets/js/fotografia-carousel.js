/**
 * Carrusel de la sección Fotografía — autoplay en bucle.
 *
 * @package Delfina_Lopez_Benavente
 */
(function () {
	'use strict';

	function init() {
		const carousel = document.querySelector('.dlb-fotografia__carousel');
		if (!carousel || typeof Swiper === 'undefined') {
			return;
		}

		const slideCount = carousel.querySelectorAll('.swiper-slide').length;
		if (slideCount < 1) {
			return;
		}

		const reducedMotion = window.matchMedia(
			'(prefers-reduced-motion: reduce)'
		).matches;

		const useLoop = slideCount >= 3;

		new Swiper('.dlb-fotografia__carousel', {
			slidesPerView: 1.15,
			spaceBetween: 16,
			loop: useLoop,
			rewind: !useLoop && slideCount > 1,
			speed: 700,
			grabCursor: true,
			navigation: {
				nextEl: carousel.querySelector('.dlb-fotografia__next'),
				prevEl: carousel.querySelector('.dlb-fotografia__prev'),
			},
			autoplay: reducedMotion
				? false
				: {
						delay: 3200,
						disableOnInteraction: false,
						pauseOnMouseEnter: true,
					},
			breakpoints: {
				480: {
					slidesPerView: 2,
					spaceBetween: 16,
				},
				768: {
					slidesPerView: 3,
					spaceBetween: 16,
				},
				1100: {
					slidesPerView: 4,
					spaceBetween: 16,
				},
			},
			a11y: {
				prevSlideMessage: 'Fotografía anterior',
				nextSlideMessage: 'Fotografía siguiente',
			},
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
