var custom_config = {
  logout_url : $('[name=logout-url]').attr('content'),
	timedout_url : $('[name=timeout-url]').attr('content')
} 
$(document).idle({
  onIdle: function(){
    document.location.href = custom_config.timedout_url
  },
  onActive: function(){
    return false
  },
  idle: 1800000 //Idle after 30 mins
   //idle: 5000 //Idle after 30 mins
});