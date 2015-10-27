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
	})
	$('#addrow').click(function(){
		$('#list_items').append('<li class="new" id="'+new_id()+'" data-id="'+new_id()+'"><input class="checkbox" type="checkbox" name="checklist_item_'+new_id()+'_completed"><div class="list_item_content"><textarea class="item_box" name="checklist_item_'+new_id()+'_description" placeholder="new list item"></textarea></div>');
	});
	/*$('a.updn').click(function(){
		var $self_li, $target_li, direction, target_id, temp_value, temp_completion, temp_check;
		$self_li = $(this).parent().parent();
		direction = $(this).attr('data-direction');
		if (direction == 'up') {
			target_id = $self_li.prev().attr('data-id');
		} else if (direction == 'dn') {
			target_id = $self_li.next().attr('data-id');
		} else {
			// do nothing because never called
		}
		$target_li = $self_li.parent().children('li[data-id="'+target_id+'"]');
		// temp = target
		temp_value = $target_li.children('div textarea').val();
		temp_completion = $target_li.children('input').val();
		temp_check = $target_li.children('input').checked;
		// target= self
		$target_li.children('div textarea').val( $self_li.children('div textarea').val() );
		$target_li.children('input').val( $self_li.children('input').val()					);
		$target_li.children('input').prop('checked', $self_li.children('input').checked );
		// self = temp
		$self_li.children('div textarea').val( temp_value );
		$self_li.children('input').val( temp_completion );
		$self_li.children('input').prop('checked', temp_check );
	});*/
});

function new_id(){
	var last_id;
	$('#list_items').children('li').each(function(){
		last_id = parseInt($(this).attr('data-id'));
	});
	return last_id+1;
}
