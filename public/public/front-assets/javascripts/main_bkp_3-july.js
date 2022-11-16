var fullUrl = "{{ url()->full() }}";
function send_ajax_request(objData, callback) {
var returnData = '';
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
        callback(response);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
        returnData = errorThrown;
        }
   });
   return returnData;
};
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
$(document).ready(function(){
	if (/Edge\/\d./i.test(navigator.userAgent)){
      $('html').addClass('ie');
  };

  // Match height
  $(".equal-height, .gallery ul li").matchHeight();

  // Fixed header
//   $(window).scroll(function(){
//      if ($(window).scrollTop() >= 38) {
//         $('#top-bar').addClass('fixed-header box-shadow');
//     }
//     else {
//         $('#top-bar').removeClass('fixed-header box-shadow');
//     }
//   });
$(window).on("scroll", function() {
    var width = $(window).width();
    if (width <= 767) {
        if ($(window).scrollTop() >= 38) {
            $('#top-bar').addClass('fixed-header box-shadow');
        }
        else {
            $('#top-bar').removeClass('fixed-header box-shadow');
        }
    }
    else {
        if ($(window).scrollTop() >= 710) {
            $('#header').addClass('fixed-header box-shadow');
        }
        else {
            $('#header').removeClass('fixed-header box-shadow');
        }
    }
});

$(window).on("resize", function() {
    var width = $(window).width();
    if (width <= 767) {
        if ($(window).scrollTop() >= 38) {
            $('#top-bar').addClass('fixed-header box-shadow');
        }
        else {
            $('#top-bar').removeClass('fixed-header box-shadow');
        }
    }
    else {
        if ($(window).scrollTop() >= 140) {
            $('#header').addClass('fixed-header box-shadow');
        }
        else {
            $('#header').removeClass('fixed-header box-shadow');
        }
    }
});

$(window).on("load", function() {
    var width = $(window).width();
    if (width <= 767) {
        if ($(window).scrollTop() >= 38) {
            $('#top-bar').addClass('fixed-header box-shadow');
        }
        else {
            $('#top-bar').removeClass('fixed-header box-shadow');
        }
    }
    else {
        if ($(window).scrollTop() >= 140) {
            $('#header').addClass('fixed-header box-shadow');
        }
        else {
            $('#header').removeClass('fixed-header box-shadow');
        }
    }
});


 //Background image
 $("#banner, .section .figure1, .popular-tradies .figure").each(function () {
  var src = $(this).find("img").attr("src");
  $(this).find('img').css("visibility", "hidden");
  $(this).css("background-image", "url(" + src + ")");
  $(this).css("background-repeat", "no-repeat");
  $(this).css("background-position", "center center");  
  $(this).css("background-size", "cover");
});


var options = {
    
};
$("#categories").easyAutocomplete({
url: BASE_URL + "/searchCat",

    categories: [
        {   //Category fruits
            listLocation: "categories",
			maxNumberOfElements: 5,
			header: "-- Category --"
        },
        {   //Category vegetables
            listLocation: "businesslist",
			maxNumberOfElements: 5,
			header: "-- Business --"
        }
    ],
	getValue: function(element) {
        return element.item;
    },
	list: {
        maxNumberOfElements: 10,
        match: {
            enabled: true
        },
        sort: {
            enabled: true
        },
		onClickEvent: function() {
            var value = $("#categories").getSelectedItemData().type;
			if(value == 'category'){
				$('#hid_type').val('category');
			}else{
				$('#hid_type').val('business');
			}
            
        },
		
    },
	
    theme: 'square'
}
);
var optionsTop = {
    url: BASE_URL + "/searchCat",

    categories: [
        {   //Category fruits
            listLocation: "categories",
			maxNumberOfElements: 5,
			header: "-- Category --"
        },
        {   //Category vegetables
            listLocation: "businesslist",
			maxNumberOfElements: 5,
			header: "-- Business --"
        }
    ],
	getValue: function(element) {
        return element.item;
    },
	list: {
        maxNumberOfElements: 10,
        match: {
            enabled: true
        },
        sort: {
            enabled: true
        },
		onClickEvent: function() {
            var value = $("#categories-top").getSelectedItemData().type;
			if(value == 'category'){
				$('#hid_type_top').val('category');
			}else{
				$('#hid_type_top').val('business');
			}
            
        },
    },
	
    theme: 'square'
};
$("#categories-top").easyAutocomplete(optionsTop);

var options = {
	//super heroes
	url: BASE_URL + "/searchLocation",
	list: {
        maxNumberOfElements: 5,
        match: {
            enabled: true
        },
        sort: {
            enabled: true
        }
    },
	theme: 'square'
};

$("#location").easyAutocomplete(options);
var optionsTop = {
	//super heroes
	url: BASE_URL + "/searchLocation",
	list: {
        maxNumberOfElements: 5,
        match: {
            enabled: true
        },
        sort: {
            enabled: true
        }
    },
	theme: 'square'
};

$("#locations-top").easyAutocomplete(optionsTop);
var optionsCategorySignup = {
	//super heroes
	url: BASE_URL + "/searchCatgorySignup",
	getValue: function(element) {
        return element.item;
    },
	list: {
        maxNumberOfElements: 5,
        match: {
            enabled: true
        },
        sort: {
            enabled: true
        },
		onClickEvent: function() {
            var value = $("#signup_category").getSelectedItemData().itemalias;
			$('#hid_category_alias').val(value);
            
        },
    },
	theme: 'square'
};
$("#signup_category").easyAutocomplete(optionsCategorySignup);
var optionsBusinessSignup = {
	//super heroes
	url: BASE_URL + "/searchBusinessSignup",
	list: {
        maxNumberOfElements: 5,
        match: {
            enabled: true
        },
        sort: {
            enabled: true
        },
		
    },
	theme: 'square'
};
$("#business_name").easyAutocomplete(optionsBusinessSignup);
// Jquery autocomplete 1
$("#categoriesss").autocomplete({
    source: function (request, response) {
        var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
        var serviceUrl = BASE_URL + '/searchCategory';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $(".loader-category").removeClass('d-none');
        $.ajax({
            url: serviceUrl,
            type: 'post',
            data: {
                data: JSON.stringify({
                    'term': request.term,
                })
            },
            success: function (result) {
                $(".loader-category").addClass('d-none');
                if (result.status == 200) {
                    response(result.sug.slice(0, 10));
                    //console.log(result.sug)
                    $(".ui-autocomplete").width($(".categories").width());
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                $(".loader-category").addClass('d-none');
                returnData = errorThrown;
            }
        });
    },
    _renderItem: function (ul, item) {
        return $("<li>")
            .attr("data-value", item.id)
            .append(item.name)
            .appendTo(ul);
    },
    _renderMenu: function (ul, items) {
        var that = this;
        $.each(items, function (index, item) {
            that._renderItemData(ul, item);
        });
        $(ul).addClass('list-unstyled');
        $(ul).find("li:odd").addClass("odd");
    },
    select: function (event, ui) {
        Id = ui.item.id;
        courseName = ui.item.label;
        //var urlData = "{{ url('/search') }}?clavel="+$(".course_level").val()+"&sub="+ui.item.label+"&subId="+ui.item.id
        //window.location.href=(urlData);
    }
});

// Jquery autocomplete 2
$("#locationss").autocomplete({
    source: function (request, response) {
        var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
        var serviceUrl = BASE_URL + '/searchLocation';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $(".loader-location").removeClass('d-none');
        $.ajax({
            url: serviceUrl,
            type: 'post',
            data: {
                data: JSON.stringify({
                    'term': request.term,
                })
            },
            success: function (result) {
                $(".loader-location").addClass('d-none');
                if (result.status == 200) {
                    response(result.sug.slice(0, 10));
                    //console.log(result.sug)
                    $(".ui-autocomplete").width($(".location").width());
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                $(".loader-location").addClass('d-none');
                returnData = errorThrown;
            }
        });
    },
    _renderItem: function (ul, item) {
        return $("<li>")
            .attr("data-value", item.id)
            .append(item.name)
            .appendTo(ul);
    },
    _renderMenu: function (ul, items) {
        var that = this;
        $.each(items, function (index, item) {
            that._renderItemData(ul, item);
        });
        $(ul).addClass('list-unstyled');
        $(ul).find("li:odd").addClass("odd");
    },
    select: function (event, ui) {
        courseId = ui.item.id;
        courseName = ui.item.label;
        //var urlData = "{{ url('/search') }}?clavel="+$(".course_level").val()+"&sub="+ui.item.label+"&subId="+ui.item.id
        //window.location.href=(urlData);
    }
});

// tabMenu [Business dashboard]
$(document).ready(function () {
    $("#tabMenu").click(function () {
      $("#myTab").slideToggle("slow");
    });
  });


// Banner 
$(".slideshow").owlCarousel({    
  items : 1, 
  itemsDesktop : false,
  itemsDesktopSmall : false,
  itemsTablet: false,
  itemsMobile : false,
  autoplay:true,
  slideSpeed : 5000,
  autoplayTimeout:5000,
  autoplayHoverPause:false, //Set AutoPlay to 3 seconds
  nav : true,
  dots: false,
  loop:true,
});
//Fancybox on search page
$('[data-fancybox="images"]').fancybox({
    loop    : true,
    arrows  : false,
    infobar : false,
    margin  : [44,0,22,0],
    buttons : [
      'arrowLeft',
      'counter',
      'arrowRight',
      'close'
    ],
    thumbs : {
      autoStart : true,
      axis : 'x'
    }
  });
  $('[data-fancybox="cerificate-images"]').fancybox({
    loop    : true,
    arrows  : false,
    infobar : false,
    margin  : [44,0,22,0],
    buttons : [
      'arrowLeft',
      'counter',
      'arrowRight',
      'close'
    ],
    thumbs : {
      autoStart : true,
      axis : 'x'
    }
  });
});


$(window).load(function() {
// Image object fit 
objectFitImages();

});
$(".viewWorkingHoursModal").click(function(){
$('.viewWorkingHoursModals').modal('show', {backdrop: 'static'});
$id = $(this).attr('data-id');
var objData = {};
var sendData = {};
sendData = {
	id: $(this).attr('data-id'),
	};
	objData = {
      url: BASE_URL + '/view-workinghours',
	  type: 'post',
	  sendData: sendData
	 };
	$(".working-hours-display").html('Loading...');
	send_ajax_request(objData, function (callback) {
	  if (callback.status == "200") {
		$(".working-hours-display").html('');
		$(".working-hours-display").html(callback.result);
	  }
	 });
});

