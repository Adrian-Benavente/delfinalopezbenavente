(function ($) {
	$(function () {
		var $addNew = $(".wrap .page-title-action").first();
		var $form = $("#dlb-fotografia-bulk-form");
		var $input = $("#dlb-fotografia-ids");
		if (!$addNew.length || !$form.length) {
			return;
		}

		var labels =
			typeof window.DLB_FOTO !== "undefined" ? window.DLB_FOTO : {};
		var btnLabel = labels.btnLabel || "Añadir desde Biblioteca";
		var mediaTitle = labels.mediaTitle || "Selecciona fotografías";
		var mediaButton = labels.mediaButton || "Crear fotografías";

		var $btn = $(
			'<a href="#" class="page-title-action" id="dlb-fotografia-open-media"></a>'
		).text(btnLabel);
		$addNew.after(" ", $btn);

		var frame;
		$btn.on("click", function (e) {
			e.preventDefault();
			if (frame) {
				frame.open();
				return;
			}
			frame = wp.media({
				title: mediaTitle,
				button: { text: mediaButton },
				library: { type: "image" },
				multiple: "add",
			});
			frame.on("select", function () {
				var ids = frame
					.state()
					.get("selection")
					.map(function (a) {
						return a.id;
					});
				if (!ids.length) {
					return;
				}
				$input.val(ids.join(","));
				$form.trigger("submit");
			});
			frame.open();
		});
	});
})(jQuery);
