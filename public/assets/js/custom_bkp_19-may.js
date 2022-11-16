function send_ajax_request(objData, callback) {
        var returnData = '';
    //alert($('meta[name="_token"]').attr('content'));
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
        $.ajax({
                url: objData.url,
                type: objData.type,
            data: {    
                     data: JSON.stringify(objData.sendData)
                },
                success: function (response) {
                         //location.reload();
                         callback(response);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                            returnData = errorThrown;
                }
       });
       return returnData;
}
function preview_image(event,id) 
	{
	 var reader = new FileReader();
	 reader.onload = function()
	 {
	  var output = document.getElementById(id);
	  output.src = reader.result;
	 }
	reader.readAsDataURL(event.target.files[0]);
	}
if($().select2) {
	/*
    $('.select2').select2({
      minimumResultsForSearch: Infinity
    });
*/
    // Select2 by showing the search
    $('.select2-show-search').select2({
      minimumResultsForSearch: ''
    });
/*
    // Select2 with tagging support
    $('.select2-tag').select2({
      tags: true,
      tokenSeparators: [',', ' ']
    });
	*/
  };
  $("body").on("change","#business_country",function(){
     var business_country_code = $("#business_country").val();
    
     var objData = {};
     var sendData = {};
        sendData = {
            business_country_code: business_country_code,
        };
         objData = {
                  url: BASE_URL + '/admin/business-listing/chkStates',
                  type: 'post',
                  sendData: sendData
         };
        send_ajax_request(objData, function (callback) {
            if (callback.status == "200") {
				$('.select2-show-search').select2({
				  minimumResultsForSearch: ''
				});
                //$("#states").val('Semester '+callback.result);
                $("#business_city").html(callback.result);
            }
         });
     
 });
 $("body").on("keyup","#business_abn",function(){
	 $("#abn-error").addClass('d-none');
     var business_abn = $("#business_abn").val();
	 var hid_business_abn = $("#hid_business_abn").val();
	 
    if(business_abn != ''){
		if(business_abn != hid_business_abn){
			 var objData = {};
			 var sendData = {};
				sendData = {
					business_abn: business_abn,
				};
				 objData = {
					      url: BASE_URL + '/admin/business-listing/chkDuplicateAbn',
					      type: 'post',
					      sendData: sendData
				 };
				send_ajax_request(objData, function (callback) {
					if (callback.status == "200") {
						$("#abn-error").removeClass('d-none');
						$("#abn-error").html(callback.result);
						$('#btnSubmit').attr("disabled",true);	
					}else{
						$("#abn-error").addClass('d-none');
						$('#btnSubmit').attr("disabled",false);	
					}
				 });
	}
	}else{
		$("#abn-error").addClass('d-none');
	}
     
 });
$(function(){
	'use strict';

	// Summernote editor
	$('#summernote-working').summernote({
	  height: 150,
	  tooltip: false
	})
	$('#summernote').summernote({
	  height: 150,
	  tooltip: false
	})
	$('#summernote1').summernote({
	  height: 150,
	  tooltip: false
	})
  });
