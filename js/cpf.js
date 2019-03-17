function validaSenha (input){ 
    if (input.value != document.getElementById('chave').value) {
    input.setCustomValidity('senha incorreta');
  } else {
    input.setCustomValidity('');
  }
} 

function validarCPF( cpf ){
	var filtro = /^\d{3}.\d{3}.\d{3}-\d{2}$/i;
	
	if(!filtro.test(cpf))
	{
		document.getElementById('cpf').style.borderColor= "red";
		document.getElementById('envia').disabled=true;
		return false;
	}
   
	cpf = remove(cpf, ".");
	cpf = remove(cpf, "-");
	
	if(cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" ||
		cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" ||
		cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" ||
		cpf == "88888888888" || cpf == "99999999999")
	{
		document.getElementById('cpf').style.borderColor= "red";
		document.getElementById('envia').disabled=true;
		return false;
   }

	soma = 0;
	for(i = 0; i < 9; i++)
	{
		soma += parseInt(cpf.charAt(i)) * (10 - i);
	}
	
	resto = 11 - (soma % 11);
	if(resto == 10 || resto == 11)
	{
		resto = 0;
	}
	if(resto != parseInt(cpf.charAt(9))){
		document.getElementById('cpf').style.borderColor= "red";
		document.getElementById('envia').disabled=true;
		return false;
	}
	
	soma = 0;
	for(i = 0; i < 10; i ++)
	{
		soma += parseInt(cpf.charAt(i)) * (11 - i);
	}
	resto = 11 - (soma % 11);
	if(resto == 10 || resto == 11)
	{
		resto = 0;
	}
	
	if(resto != parseInt(cpf.charAt(10))){
		document.getElementById('cpf').style.borderColor= "red";
		document.getElementById('envia').disabled=true;
		return false;
	}
	
	document.getElementById('cpf').style.borderColor= "darkgray";
	document.getElementById('envia').disabled=false;
	return true;
 }
 
function remove(str, sub) {
	i = str.indexOf(sub);
	r = "";
	if (i == -1) return str;
	{
		r += str.substring(0,i) + remove(str.substring(i + sub.length), sub);
	}
	
	return r;
}


function mascara(o,f){
	v_obj=o
	v_fun=f
	setTimeout("execmascara()",1)
}

function execmascara(){
	v_obj.value=v_fun(v_obj.value)
}

function cpf_mask(v){
	v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
	v=v.replace(/(\d{3})(\d)/,"$1.$2")    //Coloca ponto entre o terceiro e o quarto dígitos
	v=v.replace(/(\d{3})(\d)/,"$1.$2")    //Coloca ponto entre o setimo e o oitava dígitos
	v=v.replace(/(\d{3})(\d)/,"$1-$2")   //Coloca ponto entre o decimoprimeiro e o decimosegundo dígitos
	return v
}

function validaemail(field){
usuario = field.value.substring(0, field.value.indexOf("@"));
dominio = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);
if ((usuario.length <1) ||
    (dominio.length <3) || 
    (usuario.search("@")!=-1) || 
    (dominio.search("@")!=-1) ||
    (usuario.search(" ")!=-1) || 
    (dominio.search(" ")!=-1) ||
    (dominio.search(".")==-1) ||      
    (dominio.indexOf(".") <1)|| 
    (dominio.lastIndexOf(".") > dominio.length - 1))
{
	document.getElementById('e').style.borderColor= "red";
	document.getElementById('envia').disabled=true;
}
else{
document.getElementById('e').style.borderColor= "darkgray";
	document.getElementById('envia').disabled=false;
}
}

function checaridade(e){
	var data = new Date();
    var dia = data.getDate();
    if (dia.toString().length == 1)
      dia = "0"+dia;
    var mes = data.getMonth()+1;
    if (mes.toString().length == 1)
      mes = "0"+mes;
    var ano = data.getFullYear()-18;
	b=ano+"/"+mes+"/"+dia;
	c=e.substring(6)
	d=e.substring(5,3)
	f=e.substring(0,2)
	var idade=c+"/"+d+"/"+f
	if (idade>b){
		document.getElementById('data').style.borderColor= "red";
	document.getElementById('envia').disabled=true;
}
else{
document.getElementById('data').style.borderColor= "darkgray";
	document.getElementById('envia').disabled=false;
}
}

//Máscaras
function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
function mtel(v){
    v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
    return v;
}
function id( el ){
	return document.getElementById( el );
}

function mascara2(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}
function execmascara2(){
    v_obj.value=v_fun(v_obj.value)
}
function mtel2(v){
    v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
    return v;
}
function id2( el ){
	return document.getElementById( el );
}

function verificadata(e) {
var key;
  if (window.event) {
    key = window.event.key;
  }
  if (event.keyCode >='48' && event.keyCode<='57' || event.keyCode=='8' || event.keyCode=='46' || event.keyCode=='37' || event.keyCode=='39'){
	  return e
  }
  else
  {
	  return false
  }
 }
