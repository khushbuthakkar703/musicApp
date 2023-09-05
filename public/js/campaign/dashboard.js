$(function (){
    $('#txtSearch').on("input", function() {
        var dInput = this.value;
        console.log(dInput);
        $.ajax({
            type: "GET",
            url: "/campaign/getspintable/api",
            data: {
                campaignId: $(".campaign-select option:selected").val(),
                txtSearch: dInput
            },

            success: function(result) {
                var data
                console.log(result)

                for (var i = 0; i < result.length; i++) {
                    if(result[i].downloaded === 0)
                        icon = '<span class="fa inbox-sidebar-icon fa-circle text-danger"></span>'
                    else
                        icon =  '<span class="fa inbox-sidebar-icon fa-circle text-success"></span>'


                    data +=  `<tr style="font-size: small;" class="text-muted">
                <td role="cell">`+(i+1)+`</td>
                <td  role="cell"><a href='/dj/profile/`+result[i].dj_id+`'>`+result[i].dj_name+`</a></td>
                <td role="cell"  >`+result[i].city+`</td>
                <td role="cell" >`+result[i].club+`</td>
                <td role="cell" >`+result[i].capacity+`</td>
                <td role="cell"><a href="/campaign/getspintable?week=0`+`">`+result[i].lw+`</a></td>
                <td role="cell"><a href="/campaign/getspintable?week=1`+`">`+result[i].tw+`</a></td>
                <td role="cell"><a href="/campaign/getspintable?week=1`+`">`+result[i].total+`</a></td>
                <td role="cell">`+icon+`</td>
                <td role="cell">`+result[i].manager+`</td>
            </tr>`
                }

            $('.spin-details').html(data)

            },
            error: function(result) {
                //alert("Unable to load data")
            }
        });
    });
    
	$.ajax({
		type: "GET",
        url: "/campaign/getspintable/api",
		data: {
			campaignId: $(".campaign-select option:selected").val(),
            txtSearch: $("#txtSearch").val()
		},

        success: function(result) {
        	var data
        	console.log(result)

        	for (var i = 0; i < result.length; i++) {
        		if(result[i].downloaded === 0)
        			icon = '<span class="fa inbox-sidebar-icon fa-circle text-danger"></span>'
        		else
        			icon =  '<span class="fa inbox-sidebar-icon fa-circle text-success"></span>'


        		data +=  `<tr style="font-size: small;" class="text-muted">
            <td role="cell">`+(i+1)+`</td>
            <td  role="cell"><a href='/dj/profile/`+result[i].dj_id+`'>`+result[i].dj_name+`</a></td>
            <td role="cell"  >`+result[i].city+`</td>
            <td role="cell" >`+result[i].club+`</td>
            <td role="cell" >`+result[i].capacity+`</td>
            <td role="cell"><a href="/campaign/getspintable?week=0`+`">`+result[i].lw+`</a></td>
            <td role="cell"><a href="/campaign/getspintable?week=1`+`">`+result[i].tw+`</a></td>
            <td role="cell"><a href="/campaign/getspintable?week=1`+`">`+result[i].total+`</a></td>
            <td role="cell">`+icon+`</td>
            <td role="cell">`+result[i].manager+`</td>
        </tr>`
        	}

        $('.spin-details').html(data)

        },
        error: function(result) {
            //alert("Unable to load data")
        }
    });
})
