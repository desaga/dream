$(document).ready(function() { 
    var options = {
		//beforeSubmit:  $("input[value='Войти']").attr("disabled","disabled"),
        success: authvalidate  // post-submit callback 
 
        // other available options: 
        //url:       url         // override for form's 'action' attribute 
        //type:      type        // 'get' or 'post', override for form's 'method' attribute 
        //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful submit 
 
        // $.ajax options can be used here too, for example: 
        //timeout:   3000 
    }; 
 
    // bind form using 'ajaxForm' 
    $('#authform').ajaxForm(options); 
}); 

/*
function authonforum() {
	
	$.ajaxSetup({
				cache: false,
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert("Ошибка сервера при авторизации. Обратитесь к администратору. "+XMLHttpRequest.status);
					//alert(errorThrown);
					//alert(XMLHttpRequest.responseText);
					//alert(XMLHttpRequest.status);
					$("input[value='Войти']").removeAttr("disabled");
				}
			});
	
	$("input[value='Войти']").attr("disabled","disabled");
	
	var fm_log=$("input[name='username']").val();
	var fm_pas=$("input[name='password']").val();


	$.post(
		   "./forum/login.php", 
		   { username: fm_log, password: fm_pas, login: "Вход" }, 
		   authvalidate
	);	
	
}
*/

function authvalidate(htmldata) {
   $("input[value='Войти']").attr("disabled","disabled");
   $.getJSON(
		 "authvalidate_json.php", 
		 {}, 
		 function(data) {
			//alert(data.isauth); 
			$("input[value='Войти']").removeAttr("disabled");
			if(data.isauth==1) {
				//alert(data.isneedspecinfo);
				if(data.isneedspecinfo) {
					openupdateinfodialog();
				} 
				else {
					window.location.href=$("input[name='return']").val();
				}
			}
			else {
				alert("Введен неверный логин или пароль! Логин и пароль необходимо использовать как при входе на форум!");
			}
		}
	) 
}

function openupdateinfodialog() {
		$("#specinfo").dialog({
		autoOpen: true, 
		width: 650,
		modal:true,
		resizable: false,
		buttons: {"Отправить": dialogsubmit, "Отменить": function(){$(this).dialog("close")} },
		close: function() {$("input:text").val('').removeClass('ui-state-error');}
	});	
}

function dialogsubmit() {
	//alert(1);
	var bValid = true;
	$("input:text").removeClass('ui-state-error');

	//alert($("input[name='spec_fam']").val());
	//return true;
	
	bValid = bValid && checkNoEmpty($("input[name='spec_fam']"),"Фамилия");
	bValid = bValid && checkNoEmpty($("input[name='spec_name']"));
	bValid = bValid && checkNoEmpty($("input[name='spec_otch']"));	
	bValid = bValid && checkRegexp($("input[name='spec_birth']"),/(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d/,"Неверный формат даты рождения, пример: 04.08.1980");
	bValid = bValid && checkRegexp($("input[name='spec_start']"),/(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d/,"Неверный формат даты начала работы, пример: 05.10.2007");
	bValid = bValid && checkNoEmpty($("input[name='spec_nacleader']"),"Фамилия национального лидера");
	bValid = bValid && checkNoEmpty($("input[name='spec_phone']"),"Телефон");
	bValid = bValid && checkLength1($("input[name='spec_groupnumber']"),"номера бизнес-группы", 9);
	
	if (bValid) {
		$.ajaxSetup({
			error: function(XMLHttpRequest, textStatus, errorThrown){updateTips("Произошла непредвиденная ошибка сервера, просим прощения. ["+textStatus+XMLHttpRequest.responseText+"]")}
					});
		
		$.post(
			   "auth_sendspecinfo.php", 
			   {
				    spec_fam: $("input[name='spec_fam']").val(),
				    spec_name: $("input[name='spec_name']").val(),
					spec_otch: $("input[name='spec_otch']").val(),
					spec_status: $("select[name='spec_status'] :selected").text(),
					spec_groupnumber: $("input[name='spec_groupnumber']").val(),
					spec_birth: $("input[name='spec_birth']").val(),
					spec_lfio: $("input[name='spec_lfio']").val(),
					spec_leml: $("input[name='spec_leml']").val(),
					spec_start: $("input[name='spec_start']").val(),
					spec_stleader: $("input[name='spec_stleader']").val(),
					spec_nacleader: $("input[name='spec_nacleader']").val(),
					spec_phone: $("input[name='spec_phone']").val(),
					email: $("input[name='email']").val(),
					spec_address: $("textarea[name='spec_address']").text()
				},
			   analizeResults,
			   "json"
		);
	}
}


function analizeResults(data) {
	if(data.errortext!=0) {
		updateTips(data.errortext)
	} else {
		//authonforum();//данные отправлены, необходима авторизацияна форуме
		$("#authform").ajaxSubmit({success: authvalidate});
		//$("#specinfo").dialog('close');
		//window.location.href="./"
	}
}

function updateTips(t) {
	$("#validateTips").text(t).effect("highlight",{},1500);
}

function checkNoEmpty(o,n) {

	if ( o.val().length == 0) {
		o.addClass('ui-state-error');
		updateTips("Поле «" + n + "» не может быть пустым.");
		return false;
	} else {
		return true;
	}
}
function checkLength(o,n,min,max) {

	if ( o.val().length > max || o.val().length < min ) {
		o.addClass('ui-state-error');
		updateTips("Длина " + n + " должна быть от "+min+" до "+max+" символов.");
		return false;
	} else {
		return true;
	}
}
function checkLength1(o,n,count) {

	if ( o.val().length != count) {
		o.addClass('ui-state-error');
		updateTips("Длина " + n + " должна быть "+count+" символов.");
		return false;
	} else {
		return true;
	}
}

function checkRegexp(o,regexp,n) {

	if ( !( regexp.test( o.val() ) ) ) {
		o.addClass('ui-state-error');
		updateTips(n);
		return false;
	} else {
		return true;
	}
}

function testajax() {
	/*
	$.ajax({
			url: "forum/login.php", 
			dataType: "html",
			type: "post",
			data: "username=admin&password=gorshok&log=asdasd",
			cache: false,
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert("error!");
				alert("errorThrown: "+XMLHttpRequest.errorThrown);
			},
		   success: function(data) {
			   alert("success");
			   alert(data);
		   	}
	});
	
		var fm_log=$("input[name='username']").val();
	var fm_pas=$("input[name='password']").val();
	
	$.post(
		   "./forum/login.php", 
		   { username: fm_log, password: fm_pas, login: "Вход" }, 
		   function(htmldata) {
			   alert("dd"); 
			   $.getJSON(
					 "authvalidate_json.php", 
					 {}, 
					 function(data) {
						alert("ddd"); 
						$("input[value='Войти']").removeAttr("disabled");
						if(data.isauth==1) {
							alert("isauth=1");
							if(data.isneedspecinfo) {
								openupdateinfodialog();	//показать диалог со спец. полями
								//после заполнения послать письмо и установить параметр успешного обновления инфы
								//закрыть диалог и перейти на главную
							} 
							else {
								window.location.href="./"
							}
						}
						else {
							alert("Введен неверный логин или пароль! Логин и пароль необходимо использовать как при входе на форум!");
						}
					}
				) 
		   	}
	);
	*/
	
}