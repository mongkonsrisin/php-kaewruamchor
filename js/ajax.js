// JavaScript Document
$(document).ready(function(){
		$.ajax({
			  url: "getdata.php",
			  global: false,
			  type: "GET",
			  data: ({TYPE : "faculty"}),
			  dataType: "JSON",
			  async:false,
			  success: function(jd) {
							var opt="<option value=\"0\" selected=\"selected\">---เลือกคณะ---</option>";
							$.each(jd, function(key, val){
								opt +="<option value='"+ val["fa_id"] +"'>"+val["fa_thainame"]+"</option>"
    						});
							$("#faculty").html( opt );
		   	  }
		});

});