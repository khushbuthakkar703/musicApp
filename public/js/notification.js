// --- Main function
function timeAgo(dateParam) {
	/*
	*  seconds = 12
temp = 0
for(var k in m){
	if(m[k] > temp ){
		console.log(seconds/m[k], k)
		break
	}
}
	*
	*
	*
	*
	* */
	if (!dateParam) {
		return null;
	}

	const date = typeof dateParam === 'object' ? dateParam : new Date(dateParam);
	// const DAY_IN_MS = 86400000; // 24 * 60 * 60 * 1000
	const now = new Date();
	// const yesterday = new Date(today - DAY_IN_MS);
	const seconds = Math.round((now - date) / 1000);
	const minutes = Math.round(seconds / 60);
	const hours = Math.round(minutes / 60);
	const days = Math.round(hours / 24 );
	const weeks = Math.round(days / 7);
	const months = Math.round(days / 30);
	const years = Math.round(months / 12);

	if (seconds < 5) {
		return 'now';
	} else if (seconds < 60) {
		return `${ seconds } seconds ago`;
	} else if (seconds < 90) {
		return 'about a minute ago';
	} else if (minutes < 60) {
		return `${ minutes  } minutes ago`;
	} else if (hours == 1){
		return 'about a hour ago';
	} else if (hours < 24){
		return `${ hours } hours ago`;
	} else if(days == 1){
		return `yesterday`;
	}else if (days < 14){
		return `${ days } days ago`;
	}else if (weeks < 6){
		return `${ weeks } weeks ago`;
	}else if (months < 12){
		return `${ months+1 } months ago`;
	}else if (years < 10){
		return `${ years } year ago`;
	}
}



$.get("/notifications", function(json){
        count = json[0]
        data = json[1]
        messages = json[2].messages;
        $('.unseen-noification-count').text(count)
		$('#notificationsCount').attr("data-badge",count);
       
		//var message = [];
        if(Array.isArray(data)) {
	        for(var i=0; i < data.length; i++){
                var image=data[i].audioImage;
                var html_data='';
				var time_ago = '';
				if(timeAgo(data[i].created_at) != null) {
					time_ago = timeAgo(data[i].created_at);
				}
                if(image)
                {
					html_data = '<li><a class="dropdown-menu-notifications-item" href="' + data[i].href + '"  data-id="' + data[i].id + '"><span class="dropdown-menu-notifications-item-content"><span style="position: relative;"><img src="'+image+'" height="35px" width="35px" style="border-radius: 40px;"/><span style="position: absolute;background-color: #148ff0;height: 20px;width: 20px;border-radius: 100%;top: 20px;left: 20px;"><i class="fa fa-video" style="margin: 7px 0px 0px 5px;font-size: 10px;"></i></span></span><span style="width: 245px;"> <p>' + data[i].message + '</p><p style="font-size: 11px;color: #4691f4;font-weight: bold;">' + time_ago + '</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>';
                }
                else {
					html_data = '<li><a class="dropdown-menu-notifications-item" href="' + data[i].href + '"  data-id="' + data[i].id + '"><span class="dropdown-menu-notifications-item-content"><span style="position: relative;"><img src="'+data[i].image+'" height="35px" width="35px" style="border-radius: 40px;"/><span style="position: absolute;background-color: #56ba6f;height: 20px;width: 20px;border-radius: 100%;top: 20px;left: 20px;"><i class="fa fa-comment-alt" style="margin: 7px 0px 0px 5px;font-size: 10px;"></i></span></span><span style="width: 245px;"><p>' + data[i].message + '</p><p style="font-size: 12px;color: #4691f4;font-weight: bold;">' + time_ago + '</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>';
                }
	            $('.dropdown-menu-notifications').append(html_data);
	        }
    	}
		if(messages != null) {
			$('.content').append('<div id="nutip-e2-bluejay" class="nutip nugget bluejay" style="top: 30px; right: 10px; display: block; color: #000;"><p class="nutip-message">' + messages + '</p></div>');
			setTimeout(function(){
				$('.nutip').hide();
			},120000);
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
		$('#notificationsCount').attr("data-badge","0");
		$('.nutip').hide();
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
