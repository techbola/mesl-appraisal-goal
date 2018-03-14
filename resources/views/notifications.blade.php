<script>
	function showNotification(style, msg, pos, timeout, type){
      var style = typeof style !== 'undefined' ? style : 'bar';  //   
      var msg = typeof msg !== 'undefined' ? msg : 'An Alert'; // 
      var pos = typeof pos !== 'undefined' ? pos : 'top'; //
      var timeout = typeof timeout !== 'undefined' ? timeout : 0; //
      var type = typeof type !== 'undefined' ? type : ''; // success, info, warning, danger
      
      $('body').pgNotification({
      	style: style,
      	message: msg,
      	position: pos,
      	timeout: timeout,
      	type: type
      }).show();
  }

</script>
@if(session('success'))
<script> 
	showNotification('bar', "{{ session('success')}} ", 'top', 5000, 'success');
</script>
@elseif(session('error'))
<script> 
      showNotification('bar', "{{ session('error')}} ", 'top', 5000, 'danger');
</script>
@elseif(session('info'))
<script> 
      showNotification('bar', "{{ session('info')}} ", 'top', 5000, 'info');
</script>
@elseif(session('warning'))
<script> 
      showNotification('bar', "{{ session('warning')}} ", 'top', 5000, 'warning');
</script>
@endif
