$(function(){
'use strict';
//Dashbord
$('.toggle-info ').click(function(){
  $(this).toggleClass('selected').parent().next('.card-body').fadeToggle(100);
  if($(this).hasClass('selected')){
  $(this).html('<i class="fa fa-minus fa-lg"></i>');
  }else{
    $(this).html('<i class="fa fa-plus fa-lg"></i>');
  }
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

// convert passwors filed to text flide on hover

var passFild = $('.password');
$('.show-pass').hover(function(){
  passFild.attr('type','text');
}, function () {
  passFild.attr('type','password');
});
// confirmation // message on button
$('.confirm').click(function(){

  return confirm ('Are you suer?');
});

// category viwe option
$('.cat h3').click(function(){
$(this).next('.full-view').fadeToggle(200);
  
});
$('.option span').click(function(){
$(this).addClass('active').siblings('span').removeClass('active');
if($(this).data('view') === 'full'){
  $('.cat .full-view').fadeIn(200);
}else{
  $('.cat .full-view').fadeOut(200);
}

});

// show Delete Button On child cats

$('.child-link').hover(function(){
$(this).find('.show-delete').fadeIn(400);
},function(){
  $(this).find('.show-delete').fadeOut(400);
});



});

