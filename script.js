function getXmlHttp()
{
	var xmlhttp;
	try
	{
		xmlhttp = new ActiveXbject("Msxml2.XMLHTTP");
	} catch (e) {
		try{
			xmlhttp = new ActiveXbject("Microsoft.XMLHTTP");
		} catch (e) {
			xmlhttp = false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest != 'undefined')
	{
		xmlhttp = new XMLHttpRequest();
	}
		return xmlhttp;
}
function checklogin(login)
{
	var xmlhttp = getXmlHttp();
	xmlhttp.open('POST', 'check_login.php', true);//Открыли соединение
	xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');//Отправили тип содержимого
	xmlhttp.send("login="+encodeURIComponent(login));//отправили запрос
	xmlhttp.onreadystatechange = function() { //ждем ответа
		if (xmlhttp.readyState == 4) {//ответ пришел
			if (xmlhttp.status == 200) {//Сервер вернул код 200 (что есть хорошо)
					document.getElementById("check_login").innerHTML = xmlhttp.responseText;
					//
				}
		}
	}
}
function mylogin()
{
	var pass = $('input[name=pass]').val();
	var login = $('input[name=login]').val();
	document.getElementById("my_login").innerHTML = '';
	if (pass != '' && login != '')
	{
		var xmlhttp = getXmlHttp();
		xmlhttp.open('POST', 'my_login.php', true);//Открыли соединение
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');//Отправили тип содержимого
		xmlhttp.send("login="+encodeURIComponent(login));//отправили запрос
		document.getElementById('responseajax').innerHTML += '</br>Отправили тип содержимого';
		xmlhttp.onreadystatechange = function() { //ждем ответа
		document.getElementById('responseajax').innerHTML += '</br>ждем ответа';
		if (xmlhttp.readyState == 4) {//ответ пришел
		document.getElementById('responseajax').innerHTML += '</br>ответ пришел';
			if (xmlhttp.status == 200) {//Сервер вернул код 200 (что есть хорошо)
					 var basepass = xmlhttp.responseText;
				 if (pass != basepass)
					 {
						 document.getElementById("my_login").innerHTML = "Невірна комбінація<br />"; 
						 document.getElementById("enter").disabled = true;
			} else {
				document.getElementById("enter").disabled = false;
				}
				}
		   }   
	   }
	   
	} 
}
function enablebutton()
{
	with (document.forms.registration)
	{
		if (login.value != "" && pass.value !="" && document.getElementById('check_login').innerHTML == "")
		{
			newuser.disabled = false;
		} else {
			newuser.disabled = true;
		}
	}
}
$(document).ready(function() {
	var overlay = $('#overlay');	
	var open_modal = $('.open_modal');
	var close = $('.modal_close, #overlay');
	var modal = $('.modal_div');
	open_modal.click( function(event){ // лoвим клик пo ссылкe
		event.preventDefault(); // выключaем стaндaртную рoль элементa
		var div = $(this).attr('href');
		$('#overlay').fadeIn(500, // снaчaлa плaвнo пoкaзывaем темную пoдлoжку
		 	function(){ // пoсле выпoлнения предъидущей aнимaции
				$(div) 
					.css('display', 'block') // убирaем у мoдaльнoгo oкнa display: none;
					.animate({opacity: 1, top: '50%'}, 200); // плaвнo прибaвляем прoзрaчнoсть oднoвременнo сo съезжaнием вниз
		});
	});
	/* Зaкрытие мoдaльнoгo oкнa, тут делaем тo же сaмoе нo в oбрaтнoм пoрядке */
	close.click( function(){ // лoвим клик пo крестику или пoдлoжке
		modal.animate({opacity: 0, top: '45%'}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
				function(){ // пoсле aнимaции
					$(this).css('display', 'none'); // делaем ему display: none;
					$('#overlay').fadeOut(400); // скрывaем пoдлoжку
				}
			);
	});
});
function registrationmodal()
{
	var overlay = $('#overlay');	
	var close = $('.modal_close, #overlay');
	var modal = $('#entr');
		event.preventDefault(); // выключaем стaндaртную рoль элементa
		$('#overlay').fadeIn(500, // снaчaлa плaвнo пoкaзывaем темную пoдлoжку
		 	function(){ // пoсле выпoлнения предъидущей aнимaции
				$(modal) 
					.css('display', 'block') // убирaем у мoдaльнoгo oкнa display: none;
					.animate({opacity: 1, top: '50%'}, 200); // плaвнo прибaвляем прoзрaчнoсть oднoвременнo сo съезжaнием вниз
		});
	/* Зaкрытие мoдaльнoгo oкнa, тут делaем тo же сaмoе нo в oбрaтнoм пoрядке */
	close.click( function(){ // лoвим клик пo крестику или пoдлoжке
		modal.animate({opacity: 0, top: '45%'}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
				function(){ // пoсле aнимaции
					$(modal).css('display', 'none'); // делaем ему display: none;
					$('#overlay').fadeOut(400); // скрывaем пoдлoжку
				}
			);
	});
}
function viewbutton()
{
	var overlay = $('#overlay');	
	var close = $('.modal_close, #overlay');
	var modal = $('#entrnews');
		$('#overlay').fadeIn(500, // снaчaлa плaвнo пoкaзывaем темную пoдлoжку
		 	function(){ // пoсле выпoлнения предъидущей aнимaции
				$(modal) 
					.css('display', 'block') // убирaем у мoдaльнoгo oкнa display: none;
					.animate({opacity: 1, top: '50%'}, 200); // плaвнo прибaвляем прoзрaчнoсть oднoвременнo сo съезжaнием вниз
		});
	/* Зaкрытие мoдaльнoгo oкнa, тут делaем тo же сaмoе нo в oбрaтнoм пoрядке */
	close.click( function(){ // лoвим клик пo крестику или пoдлoжке
		modal.animate({opacity: 0, top: '45%'}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
				function(){ // пoсле aнимaции
					$(modal).css('display', 'none'); // делaем ему display: none;
					$('#overlay').fadeOut(400); // скрывaем пoдлoжку
				}
			);
	});
}
function likeclik(record)
{
	var xmlhttp = getXmlHttp();
		xmlhttp.open('POST', 'likeenable.php', true);//Открыли соединение
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');//Отправили тип содержимого
		xmlhttp.send("record="+encodeURIComponent(record));//отправили запрос
		xmlhttp.onreadystatechange = function() { //ждем ответа
		if (xmlhttp.readyState == 4) {//ответ пришел
			if (xmlhttp.status == 200) {//Сервер вернул код 200 (что есть хорошо)
				 document.getElementById("countlike").innerHTML = xmlhttp.responseText;
				}
		   }   
	   }
	   countlikebutton();
}
function notlikeclik(record)
{
		var xmlhttp = getXmlHttp();
		xmlhttp.open('POST', 'notlikeenable.php', true);//Открыли соединение
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');//Отправили тип содержимого
		xmlhttp.send("record="+encodeURIComponent(record));//отправили запрос
		xmlhttp.onreadystatechange = function() { //ждем ответа
		if (xmlhttp.readyState == 4) {//ответ пришел
			if (xmlhttp.status == 200) {//Сервер вернул код 200 (что есть хорошо)
				 document.getElementById("notlikeclik").innerHTML = xmlhttp.responseText;
				}
		   }   
	   }
	   countlikebutton();
}
function countlikebutton()
{
	var likebutton = document.getElementById("like");
	var notlikebutton = document.getElementById("notlike");
	likebutton.disabled = true;
	notlikebutton.disabled = true;
}
function deleteimage(name)() {
	var xmlhttp = getXmlHttp();
		xmlhttp.open('POST', 'deleteImage.php', true);//Открыли соединение
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');//Отправили тип содержимого
		xmlhttp.send("name="+encodeURIComponent(name));//отправили запрос
		xmlhttp.onreadystatechange = function() { //ждем ответа
		if (xmlhttp.readyState == 4) {//ответ пришел
			if (xmlhttp.status == 200) {//Сервер вернул код 200 (что есть хорошо)
			if (xmlhttp.responseText == 'Yes') {
				document.getElementById(id).innerHTML = '';
			} else {
				document.getElementById(id).innerHTML += "</br>Помилка! Спробуйте ще раз!";
				 }
		   }
      }
   }
}