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
	 $(".search_button").html('See Recommendations');
	if (/Edge\/\d./i.test(navigator.userAgent)){
      $('html').addClass('ie');
  };

  // Match height
  $(".equal-height, .gallery ul li").matchHeight();
  
// Add minus icon for collapse element which is open by default
$(".collapse.show").each(function(){
    $(this).prev(".card-header").addClass("show-desc");
});

// Toggle plus minus icon on show hide of collapse element
$(".collapse").on('show.bs.collapse', function(){
    $(this).prev(".card-header").addClass("show-desc");
}).on('hide.bs.collapse', function(){
    $(this).prev(".card-header").removeClass("show-desc");
});


//sticky header
$(window).on("scroll", function() {
    var width = $(window).width();
	var headerHeight = $('#header').height();
	var bannerHeight = $('#banner').height();
	var totalHeight = headerHeight+bannerHeight;
	var totalDHeight = headerHeight*2;
    if (width <= 767) {
        if ($(window).scrollTop() >= 38) {
            $('#top-bar').addClass('fixed-header box-shadow');
        }
        else {
            $('#top-bar').removeClass('fixed-header box-shadow');
        }
    }
    else {
		if ($(window).scrollTop() >= totalHeight) {
            $('#header').addClass('fixed-header box-shadow');
            $('#content').css('margin-top' , totalDHeight);
			$('.page-head-search').addClass('d-none');
        }
        else {
            $('#header').removeClass('fixed-header box-shadow');
            $('#content').css('margin-top' , '0px');
			$('.page-head-search').removeClass('d-none');
        }
    }
});

$(window).on("resize", function() {
	var headerHeight = $('#header').height();
	var bannerHeight = $('#banner').height();
	var totalHeight = headerHeight+bannerHeight;
	var totalDHeight = headerHeight*2;
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
        if ($(window).scrollTop() >= totalHeight) {
            $('#header').addClass('fixed-header box-shadow');
			$('#content').css('margin-top' , totalDHeight);
			$('.page-head-search').addClass('d-none');
        }
        else {
            $('#header').removeClass('fixed-header box-shadow');
			$('#content').css('margin-top' , '0px');
			$('.page-head-search').removeClass('d-none');
        }
    }
});

$(window).on("load", function() {
	var headerHeight = $('#header').height();
	var bannerHeight = $('#banner').height();
	var totalHeight = headerHeight+bannerHeight;
	var totalDHeight = headerHeight*2;
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
        if ($(window).scrollTop() >= totalHeight) {
            $('#header').addClass('fixed-header box-shadow');
			$('#content').css('margin-top' , totalDHeight);
			$('.page-head-search').addClass('d-none');
        }
        else {
            $('#header').removeClass('fixed-header box-shadow');
			$('#content').css('margin-top' , '0px');
			$('.page-head-search').removeClass('d-none');
        }
    }
});


 //Background image
 $("#banner, .section .figure1, .popular-tradies .figure, .recommendations .figure").each(function () {
  var src = encodeURI($(this).find("img").attr("src"));;
  $(this).find('img').css("visibility", "hidden");
  $(this).css("background-image", "url(" + src + ")");
  $(this).css("background-repeat", "no-repeat");
  $(this).css("background-position", "center center");  
  $(this).css("background-size", "cover");
});


var options = {
    url: function(){
        var query = $("#categories").val();
        console.log(query);
        return BASE_URL + "/searchCat?s="+query;
    },

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
			var parentCat = $("#categories").getSelectedItemData().parent_cat;
			if(value == 'category'){
				$('#hid_type').val('category');
				$('#parent_cat').val(parentCat);
			}else{
				$('#hid_type').val('business');
			}
            
        },
		
    },
	
    theme: 'square'
};
$("#categoriess").easyAutocomplete(options);
var optionsTop = {
    url: function(){
        var query = $("#categories-top").val();
        console.log(query);
        return BASE_URL + "/searchCat?s="+query;
    },

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
			var parentCat = $("#categories-top").getSelectedItemData().parent_cat;
			if(value == 'category'){
				$('#hid_type_top').val('category');
				$('#parent_cat_top').val(parentCat);
			}else{
				$('#hid_type_top').val('business');
			}
            
        },
    },
	
    theme: 'square'
};
$("#categories-tops").easyAutocomplete(optionsTop);

var optionsLocation = {
	//super heroes
	url: function(){
        var query = $("#location").val();
        return BASE_URL + "/searchLocation?s="+query;
    },
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

$("#location").easyAutocomplete(optionsLocation);
var optionsLocationTop = {
	url: function(){
        var query = $("#locations-top").val();
        return BASE_URL + "/searchLocation?s="+query;
    },
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

$("#locations-top").easyAutocomplete(optionsLocationTop);
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
$("#business_name_recommend").autocomplete({
    source: function (request, response) {
		$('#trade').removeClass('d-none');
        var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
        var serviceUrl = BASE_URL + '/searchBusinessRecommendation';
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
                    response(result.sug.slice(0, 20));
                    console.log(result.sug.slice(0))
					$.each(result.sug.slice(0), function(key, value) {
						  //alert(value)
					});
                   // $(".ui-autocomplete").width($(".categories").width());
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
		$('#hid_business_id').val(ui.item.id);
		if(Id != 0 || Id !=''){
		  $('#trade').addClass('d-none');	
		 }
		 // $('.thumbs_up').attr('data-like',ui.item.likecount);
		// $('.thumbs_down').attr('data-unlike',ui.item.unlikecount);
		// $('.thumbs_up').html('<i class="far fa-thumbs-up mr-2"></i> '+ui.item.likecount);
		// $('.thumbs_down').html('<i class="far fa-thumbs-down mr-2"></i> '+ui.item.unlikecount);
        
    }
});
$("#suburb_recommendation").autocomplete({
    source: function (request, response) {
        var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
        var serviceUrl = BASE_URL + '/searchBusinessSuburbRecommendation';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
       $(".loader-suburb").removeClass('d-none');
        $.ajax({
            url: serviceUrl,
            type: 'post',
            data: {
                data: JSON.stringify({
                    'term': request.term,
                })
            },
            success: function (result) {
                $(".loader-suburb").addClass('d-none');
                if (result.status == 200) {
                    response(result.sug.slice(0, 20));
                    //console.log(result.sug)
                   // $(".ui-autocomplete").width($(".categories").width());
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                $(".loader-suburb").addClass('d-none');
                returnData = errorThrown;
            }
        });
    },
    
});
$("#postcode_recommendation").autocomplete({
    source: function (request, response) {
        var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
        var serviceUrl = BASE_URL + '/searchBusinessPostcodeRecommendation';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $(".loader-postcode").removeClass('d-none');
        $.ajax({
            url: serviceUrl,
            type: 'post',
            data: {
                data: JSON.stringify({
                    'term': request.term,
                })
            },
            success: function (result) {
                $(".loader-postcode").addClass('d-none');
                if (result.status == 200) {
                    response(result.sug.slice(0, 20));
                    //console.log(result.sug)
                   // $(".ui-autocomplete").width($(".categories").width());
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                $(".loader-postcode").addClass('d-none');
                returnData = errorThrown;
            }
        });
    },
    
});
// Jquery autocomplete 1
$("#categories").autocomplete({
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
                    response(result.sug.slice(0, 20));
                    //console.log(result.sug)
                   // $(".ui-autocomplete").width($(".categories").width());
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
		$('#hid_type').val(ui.item.type);
		$('#parent_cat').val(ui.item.parent_cat);
        $('#catval').val(ui.item.id);
    }
});
$("#categories-top").autocomplete({
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
                    response(result.sug.slice(0, 20));
                    //console.log(result.sug)
                   // $(".ui-autocomplete").width($(".categories").width());
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
		$('#hid_type_top').val(ui.item.type);
		$('#parent_cat_top').val(ui.item.parent_cat);
		$('#catval_top').val(ui.item.id);
        
    }
});

$("#categories-dash").autocomplete({
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
                    response(result.sug.slice(0, 20));
                    //console.log(result.sug)
                   // $(".ui-autocomplete").width($(".categories").width());
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
		$('#hid_type_dash').val(ui.item.type);
		$('#parent_cat_dash').val(ui.item.parent_cat);
		$('#catval_dash').val(ui.item.id);
        
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

// slider
var checkWidth = $(document).width();
if(checkWidth <=575){
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
}
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
 $(".search_button").on('click', function(){
         $(".search_button").html('<i class="fa fa-spinner fa-spin"></i>Loading...');
         $(".home-search").after(`<section class="search-waiting mt-3"> <div class="container"> <p class=" text-white"><i class="fa fa-spinner fa-spin"></i>  Hold your horses, we’re just fetching the recommendations for you... </p></div></section>`);
		 $('#search_form').attr('onsubmit','return true');
		
 });
 $(".search_form_button").on('click', function(){
     $(".search_form_button").html('<i class="fa fa-spinner fa-spin"></i>Loading...');
     $(".page-head-search").after(`<section class="search-waiting"> <div class="container"> <p><i class="fa fa-spinner fa-spin"></i>  Hold your horses, we’re just fetching the recommendations for you... </p></div></section>`);
	 $('#search_form_first').attr('onsubmit','return true');
	
 });
 $(".search_button_after_login").on('click', function(){
     $(".search_button_after_login").html('<i class="fa fa-spinner fa-spin"></i>Loading...');
     $(".page-head-search").after(`<section class="search-waiting"> <div class="container"> <p><i class="fa fa-spinner fa-spin"></i>  Hold your horses, we’re just fetching the recommendations for you... </p></div></section>`);
	 $('#search_form_after_login').attr('onsubmit','return true');
	
 });
 $(".search_button_before_login").on('click', function(){
     $(".search_button_before_login").html('<i class="fa fa-spinner fa-spin"></i>Loading...');
     $(".page-head-search").after(`<section class="search-waiting"> <div class="container"> <p><i class="fa fa-spinner fa-spin"></i>  Hold your horses, we’re just fetching the recommendations for you... </p></div></section>`);
	 $('#search_form_before_login').attr('onsubmit','return true');
	
 });

$(window).load(function() { 
    $(".menu-btn").on("click", function() { 
        $("body").toggleClass("open-menu");
        return false;
    }); 
}); 
$(".scrollTopHome").click(function(){
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
})

