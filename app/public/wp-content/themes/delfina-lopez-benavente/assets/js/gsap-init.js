/**
 * GSAP + ScrollTrigger entry — Delfina López Benavente
 *
 * Register plugins and add scroll-driven animations here.
 * Respects prefers-reduced-motion.
 *
 * @package Delfina_Lopez_Benavente
 */
(function () {
	'use strict';

	if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
		return;
	}

	gsap.registerPlugin(ScrollTrigger);

	const prefersReducedMotion = window.matchMedia(
		'(prefers-reduced-motion: reduce)'
	);

	if (prefersReducedMotion.matches) {
		return;
	}

	// Add GSAP timelines / ScrollTrigger animations below.
})();
