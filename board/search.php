<?php
	echo '<script>
		$(document).ready(function() {
			$("#search").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#post_table #article_list").filter(function() {
					var t_value = $(this).toggle($(this).children("td:eq(1)").text().toLowerCase().indexOf(value) > -1);
					console.log(this)
					total = $("#post_table #article_list").length;
					var temp_number = 0;
					$("#post_table #article_list").each(function(i, k) {
						if ($(k).attr("style") == "display: none;") {
							temp_number += 1;
							if (temp_number == total) {
								$("h1").text("검색 결과가 없습니다.")
							} else {
								$("h1").text("게시판")
							}
						}
					});
				});
			});
		});
	</script>'	
?>