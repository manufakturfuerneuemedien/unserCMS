var wWidth;
var wHeight;
var content_container_width;

$(document).ready(function()
{	
	resize();
	
	$(window).resize(function()
	{
		resize();
	});
});

function resize()
{
	wWidth = $(window).width();
	wHeight = $(window).height();
	
	
	if(wWidth < 1200)
	{
		$('#content, #header, #footer_content').css({width: 800});
		$('#tips').css({width: 400, 'margin': '40px auto 0px auto'});
		$('.tip_border').hide();
		$('.tip').css({'margin': '10px 0px'});
		$('#header').css({height: 300});
		$('.header_img').css({width: 370});
		$('.header_img').find('img').css({height: 'auto'});
		$('.mainmenu_item').css({'padding': '0px 0px 0px 5px'});
		$('#menutop, .submenu').css({width: 800});
		$('.submenu_container').css({width: 800});
		$('.submenu_img').hide();
		$('.submenu_items').css({width: '100%', 'text-align':'center'});
		$('#subsite_header, #content_container').css({width: 780});
		$('#subsite_header').css({height: 'auto'});
		$('#subsite_header').find('img').css({width: 800, height: 'auto'});
		$('#content_container_big').css({width: 800});
		$('.mainmenu_item').css({'font-size': '17px'});
		$('#content_container_small').css({'position': 'relative', right: ''});
		$('#menulogo').css({width: 170, 'margin-top': '30px'});
		$('.search_icon').css({'padding': '0px 0px 0px 30px'});
	}
	
/*	if(wWidth < 800)
	{
		$('#content, #header, #footer_content').css({width: 400});
		$('#tips').css({width: 400, 'margin': '0px auto'});
		$('.tip_border').hide();
		$('.tip').css({'margin': '10px 0px'});
		$('#header_img').css({width: 400});
		$('#header_img img').css({height: ''});
	}
*/	
	if(wWidth >= 1200)
	{
		$('#content, #header, #footer_content').css({width: 1200});
		$('#tips').css({width: 1150, 'margin': '15px 0px 0px 0px'});
		$('.tip_border').show();
		$('.tip').css({'margin': 'none'});
		$('#header').css({height: 500});
		$('.header_img').css({width: 770});
		$('.header_img img').css({height: '100%'});
		$('.mainmenu_item').css({'padding': '0px 0px 0px 60px'});
		$('#menutop, .submenu').css({width: 1198});
		$('.submenu_container').css({width: 1198});
		$('.submenu_img').show();
		$('.submenu_items').css({width: '550px', 'text-align':'left'});
		
		$('#subsite_header, #content_container').css({width: 1198});
		$('#subsite_header').css({height: 498});
		$('#subsite_header').find('img').css({width: 1200, height: '500px'});
		$('#content_container_big').css({width: 810});
		$('.mainmenu_item').css({'font-size': '20px'});
		$('#content_container_small').css({'position': 'fixed', right: (wWidth-1200)/2});
		$('#menulogo').css({width: 235, 'margin-top': '15px'});
		$('.search_icon').css({'padding': '0px 0px 0px 80px'});
		//fixSubmenus();
	}
	
	
}

