
var Util = {
	view_path: 'view/',

};

Util.gerar_html_id = function(text){ 
  return md5(Math.random()+new Date()+Math.random()+text);
};

Util.define_language = function(){

  var idioma = (navigator.browserLanguage!= undefined)?  navigator.browserLanguage : navigator.language;
  $('#container').find('label').attr('language', idioma);
  
}

Util.upload_dropable = function (){
    
  document.addEventListener("dragover", function( event ) {
    event.preventDefault();
    event.stopPropagation();
  });

  document.addEventListener("dragleave", function( event ) {
    event.preventDefault();
    event.stopPropagation();
  }); 

  document.addEventListener("drop", function( event ) {

    event.preventDefault();
    event.stopPropagation();
    //console.log(event);
    //console.log(event.dataTransfer);
    var length = event.dataTransfer.items.length;
    console.log(event.dataTransfer);
    for (var i = 0; i < length; i++) {
        //var entry = event.dataTransfer.items[i];//.webkitGetAsEntry();
        //console.log(entry);
        // if (entry.isFile) {
        //   console.log(entry);
        // } else if (entry.isDirectory) {
        //   console.log(entry);
        // }
    }
  
  });
}

Util.load_pag = function(caminho, callback){

	caminho = Util.view_path+caminho;

  var html_id = Util.gerar_html_id(caminho);
  $('#container').append('<div view_html_id="'+html_id+'" path="'+caminho+'">');
	$('[view_html_id="'+html_id+'"]').load(caminho+'.html', function(html_string, error){
        
    if(error == 'error'){
      console.log('erro ao carregar pag');
      return;
    }
    Util.define_language();
    require([caminho+'.js'], function(obj_class){
        
        if(typeof obj_class == 'function'){
        	var object = new obj_class(html_id);
          if(typeof callback != 'undefined'){
            callback(html_id, object);
          }
        }
        
    });
	});
}

Util.post = function(route, params, fn_success){

  var parametros = {
    route: route,
    params: params,
    fn_success: fn_success
  }
  
  if(typeof route == 'object'){
    parametros = route;
  }

  parametros.params.route = parametros.route;

  $.ajax(
    {
      url: '/',
      data: parametros.params,
      dataType: 'JSON',
      method: 'POST',
      success: function(response, status, xhr){

        if(typeof parametros.fn_success == 'function'){
          parametros.fn_success(response);
        }
      }
    }
  );
}

Util.get = function(route, params, fn_success){

  var parametros = {
    route: route,
    params: params,
    fn_success: fn_success
  }
  
  if(typeof route == 'object'){
    parametros = route;
  }

  parametros.params.route = parametros.route;

  $.ajax(
    {
      url: '/',
      data: parametros.params,
      dataType: 'JSON',
      method: 'GET',
      success: function(response, status, xhr){

        if(typeof parametros.fn_success == 'function'){
          parametros.fn_success(response);
        }
      }
    } 
  );
}

Util.notification = function(title, fn_click, fn_close){

  if(Notification.permission != 'granted'){
    Notification.requestPermission();
  }else{
    var notification = new Notification('Title', {body: '<span class="label label-danger"></span>'});
    notification.onclose = function(){
      console.log(123);
    }
    notification.onclick = function(){
      console.log(456);
    }
  }
 

}

$.fn.in_array = function(valor, indice){

  var arr = this.filter(function(i, obj){
    
    if(indice){
      obj = obj[indice];
    }

    if(obj === valor){
      return true;
    }

    return false;
  });

  return (arr.length > 0 ? true : false);
}