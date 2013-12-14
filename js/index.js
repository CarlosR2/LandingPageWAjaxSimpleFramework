
var webroot = 'http://entornonomada.com/landingpage';

var loading ='<img class="loading" src="'+webroot+'/css/images/ajax-loader.gif">';
var api_url = webroot+'/api.php'; 





///////// Collection of EVENTS

var Events = function(app){
	
	$('#contacto').click(function(){
		// button callback	
	});
			

	$('#a_random_button').click(function(event){
		var random_var  = $(this).val();		
		params = {}
		params.foo = random_var;
		cb = function(res){
			//do stuff after AJAX call
			alert(res);
		}
		cb_f = function(error){
			//in case the the api returned false
		}
		var ajax_call = app.Services._get('api_call_get',params,cb,cb_f);
		//OR POST 
		//var ajax_call = app.Services._post('ajax_call',params,cb,cb_f);		
	
	});
	
      return{
           
      }

}

///////// Collection of VIEWS  /////////
var View = function(app){
     
     var init = function(){
     	//do init stuff	
     }
     
      var show_popup = function(){
			$('#popup').show();
      }

 
      return{
            show_popup:show_popup,
            init:init
      }
}



///////// Collection of DATA and setters & getters/////////

var Data = function(app){

      var id_user = false;
	  var foo;	
	  init = function init(){
	  	foo = true;
	  }

      set_id_user = function (id_usuario_){
            id_usuario= id_usuario_;
            this.id_usuario = id_usuario_;
            set_cookie('usuario',id_usuario);
      }

      get_id_user = function(){
            if(!id_user){
                  return false;
            }
            return id_user;
      }

      set_cookie= function(name,value){
            days = 1;
            if (days) {
                  var date = new Date();
                  date.setTime(date.getTime()+(days*24*60*60*1000));
                  var expires = "; expires="+date.toGMTString();
            }
            else var expires = "";
            document.cookie = name+"="+value+expires+"; path=/";
      }

      get_cookie = function(name){
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0;i < ca.length;i++) {
                  var c = ca[i];
                  while (c.charAt(0)==' ') c = c.substring(1,c.length);
                  if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
      }

      delete_cookie = function(name){

            days=""
            value=0;
            if (days) {
                  var date = new Date();
                  date.setTime(date.getTime()+(days*24*60*60*1000));
                  var expires = "; expires="+date.toGMTString();
            }
            else var expires = "";
            document.cookie = name+"="+value+expires+"; path=/";


      }

    

      return{
            get_id_user:get_id_user,
            set_id_user:set_id_user,
            init:init
      }

}




///////// API CALLS

var Services=function(app){
      var _get = function(func,params,callback,callback_false){
            var req = $.getJSON(
                  api_url+'?op='+func,
                  params,
                  function(response){
                        if(response.status){
                              if(response.result)
                                    callback(response.result);
                              else
                                    callback();
                        }else{
                              if(response.result){
									 callback_false(response.result);
                              }
                              else
                                    callback_false();
                        }
                  });
            return req;      
      }


      var _post = function(func,params,callback,callback_false){
            var req = $.post(
                  api_url+'?op='+func,
                  params,
                  function(response){
                        if(response.status){
                              if(response.result)
                                    callback(response.result);
                              else
                                    callback();
                        }else{
                              if(response.result){
                                   callback_false(response.result);
                              }
                              else
                                    callback_false();
                        }
                  },'json');
             return req;     
      }

 

      return {
            _post:_post,
            _get:_get
      }
}







var app = function(){

      var myApp = {};
      myApp.Services =Services(myApp);
      myApp.Data =Data(myApp);
      myApp.View = View(myApp);
      myApp.Events =Events(myApp);

	  function init(){
			//do init stuff			
			myApp.Data.init();
			myApp.View.init();			
	  }

      return{
           init:init,
      }

}();




