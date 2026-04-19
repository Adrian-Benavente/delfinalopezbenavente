/**
 * Carrusel de Servicios con efecto péndulo (GSAP + Swiper).
 *
 * @package Delfina_Lopez_Benavente
 */
(function () {
	'use strict';

	/** Ajuste fino del vaivén final al soltar (GSAP elastic). */
	var DLB_SERVICIOS_SETTLE_DURATION = 1.68;
	var DLB_SERVICIOS_SETTLE_EASE = 'elastic.out(1.45, 0.38)';

	function prefersReducedMotion() {
		return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	}

	function settlePendulums(carouselEl) {
		if (typeof gsap === 'undefined') {
			return;
		}
		carouselEl.querySelectorAll('.dlb-servicios__pendulum').forEach(function (pel) {
			gsap.killTweensOf(pel);
			gsap.to(pel, {
				rotation: 0,
				duration: DLB_SERVICIOS_SETTLE_DURATION,
				ease: DLB_SERVICIOS_SETTLE_EASE,
			});
		});
	}

	function attachPendulum(swiper) {
		if (typeof gsap === 'undefined') {
			return;
		}

		var carousel = swiper.el;
		var pendulums = function () {
			return carousel.querySelectorAll('.dlb-servicios__pendulum');
		};

		var prevTranslate = swiper.translate;
		var pointerDragging = false;
		var pointerStartTranslate = swiper.translate;
		var lastFrameTime =
			typeof performance !== 'undefined' && performance.now
				? performance.now()
				: Date.now();
		var smoothedVelPxMs = 0;

		function nowMs() {
			return typeof performance !== 'undefined' && performance.now
				? performance.now()
				: Date.now();
		}

		swiper.on('touchStart', function () {
			pointerDragging = true;
			pointerStartTranslate = swiper.translate;
			prevTranslate = swiper.translate;
			smoothedVelPxMs = 0;
			lastFrameTime = nowMs();
			pendulums().forEach(function (pel) {
				gsap.killTweensOf(pel);
			});
		});

		swiper.on('touchCancel', function () {
			pointerDragging = false;
		});

		swiper.on('setTranslate', function (sw) {
			var t = sw.translate;
			var now = nowMs();
			var dt = Math.max(now - lastFrameTime, 1);
			lastFrameTime = now;
			var delta = t - prevTranslate;
			prevTranslate = t;

			var instantVel = Math.abs(delta) / dt;
			smoothedVelPxMs = smoothedVelPxMs * 0.62 + instantVel * 0.38;

			var gestureAmp = 1;
			if (pointerDragging) {
				var travelPx = Math.abs(t - pointerStartTranslate);
				var velNorm = Math.min(smoothedVelPxMs / 0.9, 1);
				var velFactor = 0.52 + velNorm * 1.12;
				var distNorm = Math.min(travelPx / 150, 1);
				var distFactor = 0.58 + distNorm * 0.95;
				gestureAmp = Math.min(2.35, velFactor * distFactor);
			}

			var gain = 0.14 * gestureAmp;
			var maxDeg = Math.min(13, 8 * gestureAmp);
			var base = Math.max(-maxDeg, Math.min(maxDeg, -delta * gain));

			pendulums().forEach(function (pel, i) {
				var stagger = Math.sin(i * 0.72 + t * 0.0025) * 2.8;
				var rot = Math.max(-maxDeg, Math.min(maxDeg, base + stagger * 0.42));
				gsap.set(pel, { rotation: rot, transformOrigin: 'top center' });
			});
		});

		function onTransitionDone() {
			settlePendulums(carousel);
			prevTranslate = swiper.translate;
		}

		swiper.on('transitionEnd', onTransitionDone);

		/* Respaldo: con freeMode, asegurar settle si transitionEnd no dispara. */
		swiper.on('touchEnd', function () {
			pointerDragging = false;
			var attempts = 0;
			function trySettle() {
				attempts += 1;
				if (attempts > 60) {
					onTransitionDone();
					return;
				}
				if (swiper.animating) {
					window.requestAnimationFrame(trySettle);
					return;
				}
				onTransitionDone();
			}
			window.requestAnimationFrame(trySettle);
		});
	}

	function init() {
		var carousel = document.querySelector('.dlb-servicios__carousel');
		if (!carousel || typeof Swiper === 'undefined') {
			return;
		}

		var carouselWrap = carousel.closest('.dlb-servicios__carousel-wrap');
		if (!carouselWrap) {
			return;
		}

		var reduced = prefersReducedMotion();

		var swiper = new Swiper(carousel, {
			slidesPerView: 1.15,
			spaceBetween: 16,
			speed: reduced ? 480 : 320,
			grabCursor: true,
			resistance: false,
			watchOverflow: true,
			freeMode: reduced
				? false
				: {
						enabled: true,
						momentum: false,
						sticky: false,
					},
			navigation: {
				nextEl: carouselWrap.querySelector('.dlb-servicios__next'),
				prevEl: carouselWrap.querySelector('.dlb-servicios__prev'),
			},
			breakpoints: {
				640: {
					slidesPerView: 2,
					spaceBetween: 20,
				},
				1024: {
					slidesPerView: 2.5,
					spaceBetween: 24,
				},
				1280: {
					slidesPerView: 3,
					spaceBetween: 24,
				},
			},
			a11y: {
				prevSlideMessage: 'Servicio anterior',
				nextSlideMessage: 'Servicio siguiente',
			},
			on: {
				init: function (sw) {
					if (!reduced) {
						attachPendulum(sw);
					}
				},
			},
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
