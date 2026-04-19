/**
 * Scroll-triggered animations - Delfina López Benavente
 *
 * Añade clases cuando las secciones entran en el viewport.
 *
 * @package Delfina_Lopez_Benavente
 */
(function () {
	'use strict';

	const SECTIONS = [
		{ selector: '.dlb-servicios', class: 'dlb-servicios--in-view' },
		{ selector: '.dlb-como-trabajo', class: 'dlb-como-trabajo--in-view' },
		{ selector: '.dlb-proyectos', class: 'dlb-proyectos--in-view' },
		{ selector: '.dlb-fotografia', class: 'dlb-fotografia--in-view' },
		{ selector: '.dlb-instagram', class: 'dlb-instagram--in-view' },
		{ selector: '.dlb-sobre-mi', class: 'dlb-sobre-mi--in-view' },
		{ selector: '.dlb-contacto', class: 'dlb-contacto--in-view' },
	];

	function init() {
		const observerOptions = {
			root: null,
			rootMargin: '0px 0px -50px 0px',
			threshold: 0.1,
		};

		const observer = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (!entry.isIntersecting) return;
				const config = SECTIONS.find(function (s) {
					return entry.target.matches(s.selector);
				});
				if (config) {
					entry.target.classList.add(config.class);
				}
			});
		}, observerOptions);

		SECTIONS.forEach(function (config) {
			const els = document.querySelectorAll(config.selector);
			els.forEach(function (el) {
				observer.observe(el);
			});
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
