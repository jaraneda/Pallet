/**********************************
 ******** Global Variables ********
 **********************************/

var summernote_objects = {};
var active_summernote = null;

var page_dimensions = {
	height: 29.7,
	width: 21,
	margin_top: 2,
	margin_botom: 2,
	margin_left: 2,
	margin_right: 2
};

/**********************************
 ************* Events *************
 **********************************/

/**
 * Get the custom action of Summernote
 */
$('.btn-action').click(function(event) {
	event.preventDefault();
	var action = $(this).attr('data-action');
	summernote_objects[active_summernote].summernote(action);
});

/**
 * Insert a new page on the document
 */
$('#agregar-pagina').click(function(event) {
	event.preventDefault();
	createNewPage(page_dimensions);
});

/**
 * Event for the selection of a "Campo Variable"
 */
$('#campos').on('click', '.campo', function(e) {
	e.preventDefault();
	$('#campos').find('.campo').removeAttr("selected");
	$('#campos').find('.campo>span').removeClass('label-success');
	$(this).attr("selected", "selected");
	$(this).find('span').addClass('label-success');
});

/**
 * Insert a "Campo Variable" in the selected segment of a page
 */
$('#page-container').on('click', '.note-editable>p', function(e) {
	e.preventDefault();

	var campo = $('#campos').find('.campo[selected="selected"]')[0];
	if (campo) {
		//var content = $('<variable/>').attr('data-node', $(campo).attr('data-node')).append($('<span/>').addClass('label label-danger').text($(campo).text()));
		var content = $('<variable/>').attr('data-node', $(campo).attr('data-node')).text("{{" + $(campo).text() + "}}");
		pasteHtmlAtCaret(content.wrap('<div/>').parent().html(), false);

		$('#campos').find('.campo').removeAttr("selected");
		$('#campos').find('.campo>span').removeClass('label-success');
	}
});

$('#submit-crear-documento').click(function(event) {
	event.preventDefault();

	var paginas = {};

	for (var property in summernote_objects) {
		if (summernote_objects.hasOwnProperty(property)) {
			paginas[property] = $(summernote_objects[property]).summernote('code');
		}
	}

	var documento = {
		'configuracion': page_dimensions,
		'paginas': paginas
	};

	$('input[name="documento_paginas"]').val( JSON.stringify(documento) );

	console.log(documento);

	//$('#formulario-crear-documento').submit();

	return;
});

/**********************************
 ************* Functions **********
 **********************************/

/**
 * Generación de UUID
 * @return {string} uuid
 */
function guidGenerator() {
	var S4 = function() {
		return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
	};
	return (S4() + S4() + "-" + S4() + "-" + S4() + "-" + S4() + "-" + S4() + S4() + S4());
}

/**
 * Insert text into textarea at cursor position
 * http://stackoverflow.com/questions/6690752/insert-html-at-cursor-in-a-contenteditable-div
 * @param  {string}		html 				DOM to be inserted
 * @param  {bool} 		selectPastedContent	If is required the selection of the resent pasted DOM
 * @return {void}		
 */
function pasteHtmlAtCaret(html, selectPastedContent) {
	var sel, range;
	if (window.getSelection) {
		// IE9 and non-IE
		sel = window.getSelection();
		if (sel.getRangeAt && sel.rangeCount) {
			range = sel.getRangeAt(0);
			range.deleteContents();

			// Range.createContextualFragment() would be useful here but is
			// only relatively recently standardized and is not supported in
			// some browsers (IE9, for one)
			var el = document.createElement("div");
			el.innerHTML = html;
			var frag = document.createDocumentFragment(),
				node, lastNode;
			while ((node = el.firstChild)) {
				lastNode = frag.appendChild(node);
			}
			var firstNode = frag.firstChild;
			range.insertNode(frag);

			// Preserve the selection
			if (lastNode) {
				range = range.cloneRange();
				range.setStartAfter(lastNode);
				if (selectPastedContent) {
					range.setStartBefore(firstNode);
				} else {
					range.collapse(true);
				}
				sel.removeAllRanges();
				sel.addRange(range);
			}
		}
	} else if ((sel = document.selection) && sel.type != "Control") {
		// IE < 9
		var originalRange = sel.createRange();
		originalRange.collapse(true);
		sel.createRange().pasteHTML(html);
		if (selectPastedContent) {
			range = sel.createRange();
			range.setEndPoint("StartToStart", originalRange);
			range.select();
		}
	}
}

/**
 * Add a new page to the current document
 * @param  {object} pageConfigurations Configuration object for a page
 * @return {void}
 */
function createNewPage(pageConfigurations, pageContent) {
	var custom_id = guidGenerator();
	var custom_height = (pageConfigurations.height - (pageConfigurations.margin_top + pageConfigurations.margin_botom));
	var custom_height_px = (custom_height * 37.795276).toFixed(0);

	// Summernote configuration object
	var summernote_config = {
		toolbar: false,
		height: custom_height_px,
		disableResizeEditor: true,
		disableDragAndDrop: true,
		callbacks: {
			onFocus: function(e) {
				active_summernote = $(e.target).closest('.page').attr('id');
			}
			//,onKeydown: function(e) {
				//console.log(e.target.offsetHeight, parseInt($(e.target).closest('.page-content').height(), 10));
				//if (e.target.offsetHeight > parseInt($(e.target).closest('.page-content').height(), 10)) {
				//	if (!$(e.target).closest('.page').next('.page').length) {
				//		var newCustomID = createNewPage(page_dimensions);
				//		$(summernote_objects[newCustomID]).find('.note-editable').trigger('focus');
				//	} else {
				//		$(e.target).closest('.page').next('.page').find('.note-editable').trigger('focus');
				//	}
				//}
			//}
			//,onPaste: function(e) {
			//	console.log('onPaste:', e);
			//}
		}
	};

	// Page creation and custom content
	var $page = $('<div/>').addClass('page').css({
		'width': pageConfigurations.width.toString() + 'cm',
		'height': pageConfigurations.height.toString() + 'cm'
	}).attr({
		id: custom_id,
	});

	var $content = $('<div/>').addClass('page-content').css({
		'margin-top': pageConfigurations.margin_top.toString() + 'cm',
		'margin-bottom': pageConfigurations.margin_botom.toString() + 'cm',
		'margin-left': pageConfigurations.margin_left.toString() + 'cm',
		'margin-right': pageConfigurations.margin_right.toString() + 'cm',
		'height': custom_height.toString() + 'cm'
	});

	var $edit = $('<div/>').addClass('page-edit').css({
		'height': '100%',
		'width': '100%'
	});

	if(typeof pageContent !== 'undefined') // If we have a content for the page
	{
		$edit.html(pageContent);
	}

	$('#page-container').append($page.append($content.append($edit)));
	// TODO: Agregar pagina despues de la siguiente pagina que tiene focus

	// Active summernote over an inner element of the page
	$edit.summernote(summernote_config);

	// Save the reference to a summernote object
	summernote_objects[custom_id] = $edit;

	return custom_id;
}