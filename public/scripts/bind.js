$(function(){
	//Select inputs
	$('select').wrap('<div class="select-cont"><div class="select-in">').before('<div class="select-value"></div>');
	$('.select-in select').change(function(){
		$(this).parents('.select-in').find('.select-value').html(
			this.options[this.selectedIndex].text
		)
	})
	$('.select-in select').change();

	//Wide images?
	$('.wide-centered-image > img').each(function(){
		$(this).parent().css({backgroundImage : 'url(' + $(this).attr('src') + ')'});
		$(this).css({visibility : 'hidden'});
	})

	//Radios
	$('.radios-row input[type="radio"]').click(function(){
		if(this.checked){
			$(this).parents('.radios-wrap').find('.radios-row').removeClass('active');
			$(this).parents('.radios-row').addClass('active');
		}
	})
})