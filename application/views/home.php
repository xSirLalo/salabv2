<?php
if (isset($this->session->userdata['logged_in'])) {
$nombre_usr = ($this->session->userdata['logged_in']['nombre_usr']);
$email = ($this->session->userdata['logged_in']['email']);
} else {
redirect('login');
}
?>
<center><span id="liveclock"></span></center>

<div class="container">
    
</div>

<script type="text/javascript">
	
	function show5(){
    if (!document.layers&&!document.all&&!document.getElementById)
    return
    
     var Digital=new Date()
     var hours=Digital.getHours()
     var minutes=Digital.getMinutes()
     var seconds=Digital.getSeconds()
     var dn="Hrs"
     if (minutes<=9)
     	minutes="0"+minutes
     if (seconds<=9)
     	seconds="0"+seconds
    //change font size here to your desire
    myclock="<font color='black' size='12' face='Arial' ><b>"+hours+":"+minutes+":"
     +seconds+" "+dn+"</b></font>"
    if (document.layers){
    	document.layers.liveclock.document.write(myclock)
    	document.layers.liveclock.document.close()
    }else if (document.all)
    	liveclock.innerHTML=myclock
    else if (document.getElementById)
    	document.getElementById("liveclock").innerHTML=myclock
    setTimeout("show5()",1000)
     }
    window.onload=show5

</script>

