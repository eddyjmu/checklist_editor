$(document).ready(function(){
	$('span.list_item_text').click(function(){
		$(this).removeClass('block');
		$(this).addClass('hidden');
		$(this).parent().children('textarea, a').removeClass('hidden');
	});
	$('a.done_editing').click(function(){
		$(this).parent().children('span').html($(this).parent().children('textarea').val());
		$(this).parent().children('span').removeClass('hidden');
		$(this).parent().children('span').addClass('block');
		$(this).parent().children('textarea, a').addClass('hidden');
	});
	$('input.checkbox').click(function(){
		$(this).parent().toggleClass('completed');
	});
	$('#addrow').click(function(){
		$('#list_items').append('<li class="new" id="'+new_id()+'" data-id="'+new_id()+'"><input class="checkbox" type="checkbox" name="checklist_item_'+new_id()+'_completed"><div class="list_item_content"><textarea class="item_box" name="checklist_item_'+new_id()+'_description" placeholder="new list item"></textarea></div>');
	});
	$('a.move').click(function(){
		var target_id, temp_value;
		var $self_li = $(this).parent().parent();
		var direction = $(this).attr('data-direction');
		if (direction == 'up') {
			target_id = $self_li.prev().attr('data-id');
		} else if (direction == 'dn') {
			target_id = $self_li.next().attr('data-id');
		} else {
			// do nothing because never called
		}
		var $target_li = $self_li.parent().children('li[data-id="'+target_id+'"]');
		var temp_value = $target_li.children('div.list_item_content').children('textarea').val();
		var temp_check = $target_li.children('input.checkbox').prop('checked');
		var self_value = $self_li.children('div.list_item_content').children('textarea').val();
		$target_li.children('div.list_item_content').children('span').html( self_value );
		$target_li.children('div.list_item_content').children('textarea').val( self_value );
		$target_li.children('input.checkbox').prop('checked', $self_li.children('input.checkbox').prop('checked') );
		$self_li.children('div.list_item_content').children('textarea').val( temp_value );
		$self_li.children('div.list_item_content').children('span').html( temp_value );
		$self_li.children('input').prop('checked', temp_check );
		$('input[type="checkbox"]').each(function(i){
			$(this).parent().removeClass('completed');
			if($(this).prop('checked')){
				$(this).parent().addClass('completed');
			}		
		});
	});
	// an attempt to make every list item's done checkmark disappear if nothing is in the textarea 
	/*$('li').each(function(i){
		var $content_box = $(this).children('div.list_item_content');
		if(!$content_box.children('textarea').val() == ''){
			$content_box.children('a').html('done&check;');
		} else {
			$content_box.children('a').html('');
		}
	});*/
});

function new_id(){
	var last_id;
	$('#list_items').children('li').each(function(){
		last_id = parseInt($(this).attr('data-id'));
	});
	return last_id+1;
}
