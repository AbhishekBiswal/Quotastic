/*$(document).ready(function(){

	$(".random").click(function(a){
		a.preventDefault();
		var id = $(this).attr("id");
		var data = "id="+id;
		$.ajax({
			url: "random.php",
			type: "post",
			data: data,
			cache: false,
			success: function(got)
			{
				$(".quote").html(got);
			}
		})
	})

})*/