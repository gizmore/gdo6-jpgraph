"use strict";
window.GDO.JPGraph = {
	
	initGraphFor: function(form) {
		console.log('GDO.JPGraph.initGraphFor()', form);
		this.setDisabledStateFor(form);
	},
			
	setDisabledStateFor: function(form) {
		var sel = form.find('select');
		var start = form.find('input[name=start]');
		var end = form.find('input[name=end]');
		console.log('GDO.JPGraph.setDisabledStateFor()', form, sel, start, end);
		switch (sel.val()) {
		case 'custom':
		start.prop('disabled', false);
		end.prop('disabled', false);
		break;
		default:
		start.prop('disabled', true);
		end.prop('disabled', true);
		break;
		}
	},

	renderImageFor: function(form) {
		console.log('GDO.JPGraph.renderImageFor()', form);
		var img = form.find('img');
		var src = img.attr('src');
		var sel = form.find('select');
		var start = form.find('input[name=start]');
		var newStart = "start="+start.val();
		var end = form.find('input[name=end]');
		var newEnd = "end="+end.val();
		var newDate = "date="+sel.val();
		src = src.replace(/date=[^&]*/, newDate);
		src = src.replace(/start=[^&]*/, newStart);
		src = src.replace(/end=[^&]*/, newEnd);
		src = src.replace(/&t=[0-9]+/, '');
		
		
		// Invalid custom date abort
		if (sel.val() === 'custom') {
			if ( (!start.val()) || (!end.val()) ) {
				return;
			}
		}
		src += '&t='+(new Date().getTime());
		console.log(src);
		img.attr('src', src);
	},
	
};

$(function(){

	$('.gdt-graph-select').each(function(){
		GDO.JPGraph.initGraphFor($(this));
	});

	$('.gdt-graph-select select').change(function(){
		var sel = $(this);
		var form = sel.closest('form');
		GDO.JPGraph.setDisabledStateFor(form);
		GDO.JPGraph.renderImageFor(form);
	});

	$('.gdt-graph-select input').change(function(){
		var input = $(this);
		var form = input.closest('form');
		GDO.JPGraph.renderImageFor(form);
	});

});
