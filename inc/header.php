<div class="empty-space"></div>
<div data-role="header" data-position="fixed" data-fullscreen="true">
	<a href="/" ><img src="/img/logo.png" id="logo"></a>
</div>

<script>
$(function() {
	var emptyspace = $(".ui-header").height()+10;
	$(".empty-space").css("height",emptyspace+"px");
	$(window).resize(function(){
		var emptyspace = $(".ui-header").height()+10;
		$(".empty-space").css("height",emptyspace+"px");
	});
/*	$('#logo').click(function(){
		console.log("Logo click");
		window.location.href = "/";
	});*/
})
</script>