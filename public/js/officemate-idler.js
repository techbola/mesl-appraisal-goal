var custom_config = {
	logout_url : $('[name=logout-url]').attr('content')
} 
$(document).idle({
  onIdle: function(){
    swal({
    	title:'Timed Out!',
    	html: '<p>You have been timed out due to inactivity.</p>', 
    	type:"warning",
    	showCancelButton:!0,
    	confirmButtonClass:"btn btn-danger",
    	cancelButtonClass:"btn btn-success",
    	confirmButtonText:"Leave",
    	cancelButtonText:"Stay Active", 
    	animation: true, 
    	toast:true,
    	customClass: '',
    	allowOutsideClick: false 
    }).then(function(result){ 
    	// log out user forcefully
    	document.location.href = custom_config.logout_url;
    }).catch(function(){

    });
  },
  onActive: function(){
    
  },
  idle: 60000 //Idle after 10 mins
});