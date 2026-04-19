/**
 * Lightbox para la sección Fotografía - Delfina López Benavente
 *
 * Navegación entre imágenes con botones y teclado (flechas).
 *
 * @package Delfina_Lopez_Benavente
 */
(function () {
	'use strict';

	function init() {
		const triggers = document.querySelectorAll('[data-dlb-lightbox]');
		if (!triggers.length) return;

		const items = [];
		triggers.forEach(function (trigger) {
			const src = trigger.getAttribute('href') || trigger.dataset.dlbLightboxSrc || '';
			const caption = trigger.dataset.dlbCaption || '';
			items.push({ src: src, caption: caption });
		});

		let overlay = document.getElementById('dlb-lightbox');
		if (!overlay) {
			overlay = createLightbox();
			document.body.appendChild(overlay);
		}

		overlay._items = items;

		triggers.forEach(function (trigger, index) {
			trigger.addEventListener(
				'click',
				function (e) {
					e.preventDefault();
					e.stopPropagation();
					openLightbox(overlay, index);
				},
				true
			);
		});
	}

	function createLightbox() {
		const overlay = document.createElement('div');
		overlay.id = 'dlb-lightbox';
		overlay.className = 'dlb-lightbox';
		overlay.setAttribute('role', 'dialog');
		overlay.setAttribute('aria-modal', 'true');
		overlay.setAttribute('aria-label', 'Ver imagen ampliada');
		overlay.innerHTML =
			'<div class="dlb-lightbox__backdrop" aria-hidden="true"></div>' +
			'<div class="dlb-lightbox__content">' +
			'<button type="button" class="dlb-lightbox__prev" aria-label="Imagen anterior"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 12H6"/><path d="M12 6l-6 6 6 6"/></svg></button>' +
			'<button type="button" class="dlb-lightbox__next" aria-label="Imagen siguiente"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 12h12"/><path d="M12 6l6 6-6 6"/></svg></button>' +
			'<button type="button" class="dlb-lightbox__close" aria-label="Cerrar">×</button>' +
			'<img class="dlb-lightbox__image" src="" alt="" />' +
			'</div>';

		const backdrop = overlay.querySelector('.dlb-lightbox__backdrop');
		const closeBtn = overlay.querySelector('.dlb-lightbox__close');
		const prevBtn = overlay.querySelector('.dlb-lightbox__prev');
		const nextBtn = overlay.querySelector('.dlb-lightbox__next');

		function close() {
			overlay.classList.remove('dlb-lightbox--open');
			document.body.style.overflow = '';
			document.removeEventListener('keydown', handleKeydown);
		}

		function handleKeydown(e) {
			if (e.key === 'Escape') {
				close();
				return;
			}
			if (e.key === 'ArrowLeft') {
				overlay._goPrev?.();
			} else if (e.key === 'ArrowRight') {
				overlay._goNext?.();
			}
		}

		overlay._close = close;
		overlay._handleKeydown = handleKeydown;

		backdrop.addEventListener('click', close);
		closeBtn.addEventListener('click', close);
		prevBtn.addEventListener('click', function (e) {
			e.stopPropagation();
			overlay._goPrev?.();
		});
		nextBtn.addEventListener('click', function (e) {
			e.stopPropagation();
			overlay._goNext?.();
		});

		return overlay;
	}

	const FADE_DURATION = 200;

	function showImage(overlay, index, isNavigation) {
		const items = overlay._items || [];
		if (items.length === 0) return;
		if (overlay._transitioning) return;

		const idx = Math.max(0, Math.min(index, items.length - 1));
		const item = items[idx];
		const img = overlay.querySelector('.dlb-lightbox__image');
		const prevBtn = overlay.querySelector('.dlb-lightbox__prev');
		const nextBtn = overlay.querySelector('.dlb-lightbox__next');

		function applyImage() {
			img.src = item.src;
			img.alt = item.caption || '';
			overlay._currentIndex = idx;
			prevBtn.style.display = items.length > 1 && idx > 0 ? '' : 'none';
			nextBtn.style.display = items.length > 1 && idx < items.length - 1 ? '' : 'none';
		}

		if (isNavigation && img.src) {
			overlay._transitioning = true;
			img.style.opacity = '0';
			setTimeout(function () {
				applyImage();
				img.offsetHeight;
				img.style.opacity = '1';
				setTimeout(function () {
					overlay._transitioning = false;
				}, FADE_DURATION);
			}, FADE_DURATION);
		} else {
			img.style.opacity = '0';
			applyImage();
			img.offsetHeight;
			img.style.opacity = '1';
		}
	}

	function openLightbox(overlay, index) {
		overlay._goPrev = function () {
			if (overlay._currentIndex > 0) {
				showImage(overlay, overlay._currentIndex - 1, true);
			}
		};
		overlay._goNext = function () {
			const items = overlay._items || [];
			if (overlay._currentIndex < items.length - 1) {
				showImage(overlay, overlay._currentIndex + 1, true);
			}
		};

		showImage(overlay, index, false);

		overlay.classList.add('dlb-lightbox--open');
		document.body.style.overflow = 'hidden';
		if (overlay._handleKeydown) {
			document.addEventListener('keydown', overlay._handleKeydown);
		}
		overlay.querySelector('.dlb-lightbox__close').focus();
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
