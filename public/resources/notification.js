$.get("/notifications", function(json){
        count = json[0]
        data = json[1]
        $('.unseen-noification-count').text(count)
       
        if(Array.isArray(data)) {
	        for(var i=0; i < data.length; i++){
	        	var image=data[i].audioImage;
                var html_data='';

                if(image)
				{
                    var html_data = '<li><a class="dropdown-menu-notifications-item" href="' + data[i].href + '"  data-id="' + data[i].id + '"><span class="dropdown-menu-notifications-item-content"> <span><img src="'+image+'"  height="35px"/></span><span> <p>' + data[i].subject + '</p><p>' + data[i].message + '</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>';

                }
				else {
                    var html_data = '<li><a class="dropdown-menu-notifications-item" href="' + data[i].href + '"  data-id="' + data[i].id + '"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>' + data[i].subject + '</p><p>' + data[i].message + '</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>';
                }
	            $('.dropdown-menu-notifications').append(html_data)
	        }
    	}
        // $('.dropdown-menu-notifications').append('<li><a class="dropdown-menu-link-md" href="/notifications"><small><span class="fa fa-bell"></span> See Notification History</small></a></li>')
        //$('.dropdown-menu-notifications').append('<li style="text-align: center; onclick="markread()">Mark all as Read</li>')
    });

$(document).on('click','.getAllNotifications',function(e) {
	$this = $(this);
	e.preventDefault();
	$.ajax({
	'type':'get',
	'url':'/read_notification',
	'data':'',
	success:function(res) {
		$this.find('.badge').html('0');
	} 
  })
	return false; 
});


$(document).on('click','.dropdown-menu-notifications-item',function(e) {
	e.preventDefault();
	var id=$(this).data(id);
	var $this=$(this);
	$.ajax({
	'type':'post',
	'url':'/read_signle_notification',
	'data':{id:id},
	success:function(res) {
		window.location.href=$this.attr('href');
	}
	
  })
	return false; 
});
