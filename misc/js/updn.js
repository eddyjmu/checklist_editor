$('a.updn').click(function(){
	var $self_li, $target_li, direction, target_id, temp_value, temp_completion, temp_check;
	$self_li = $(this).parent().parent();
	direction = $(this).attr('data-direction');
	if (direction == 'up') {
		target_id = $self_li.prev().attr('data-id');
	} else if (direction == 'dn') {
		target_id = $self_li.next().attr('data-id');
	} else {
		//	do nothing because never called
	}
	$target_li = $self_li.parent().children('li[data-id="'+target_id+'"]');
	//	temp = target
	temp_value = $target_li.children('div').children('textarea').val();
	temp_completion = $target_li.children('input').val();
	temp_check = $target_li.children('input').prop('checked');
	//	target= self
	$target_li.children('div').children('textarea').val( $self_li.children('div').children('textarea').val() );
	$target_li.children('input').val( $self_li.children('input').val()					);
	$target_li.children('input').prop('checked', $self_li.children('input').prop('checked') );
	//	self = temp
	$self_li.children('div').children('textarea').val( temp_value );
	$self_li.children('input').val( temp_completion );
	$self_li.children('input').prop('checked', temp_check );
});


/*

where the actual link structure would look something like this:

<ul>
	<li data-id="" prev>
	<li data-id="">
		<input check value="completion">
		<div>
			<textarea>value</textarea>
			<a done>
			<a data-direction="up" class="updn">&#8593;</a>
			<a data-direction="dn" class="updn">&#8595;</a>
		</div>
	</li>
	<li next>
</ul>

	

	(arrows from http://character-code.com/arrows-html-codes.php)

*/
