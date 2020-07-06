$(function(){
'use strict';

//switch Between login $ signup

$('.login-page h1 span').click(function(){
  $(this).addClass('selected').siblings().removeClass('selected');
  $('.login-page form').hide();
$('.' + $(this).data('class')).fadeIn(100);
});

//Trigger The sleectbox
$("select").selectBoxIt({
  autoWidth: false
});

//hid placeholder on form focus

$('[placeholder]').focus(function () {

  $(this).attr('data-text', $(this).attr('placeholder'));
  $(this).attr('placeholder','');
}).blur(function (){

  $(this).attr('placeholder',$(this).attr('data-text'));

});

// Add Asterisk on Required field

$('input').each(function(){

if($(this).attr('required') === 'required'){
$(this).after('<span class="asterisk"> * </span>');

}
});


// confirmation // message on button
$('.confirm').click(function(){

  return confirm ('Are you suer?');
});


$('.live').keyup(function(){

 $($(this).data('class')).text($(this).val());

});






});

