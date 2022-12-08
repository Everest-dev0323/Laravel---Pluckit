@if(empty(Auth::user()))
<section class="section page-head-search pt-4">
	<div class="container">
	<form class="form style2" method="get" action="{{ url('/search')}}" id="search_form_first" onsubmit="return false">
	  <ul class="list-unstyled clearfix">
		<li class="categories">
			<input type="text" class="form-control" id="categories" name="cat" placeholder="Search for an Electrician, a Plumber, etc." value="{{ !empty($get['cat']) ? $get['cat'] : '' }}">
			  <span class="loader loader-category d-none">
				<i class="fa fa-spin fa-spinner"></i>
			  </span>
		</li>
		<li class="location">
		  <input type="text" class="form-control" id="location" name="loc" placeholder="Suburb or postcode" value="{{ !empty($get['loc']) ? $get['loc'] : '' }}">
		  <span class="loader loader-location d-none">
			  <i class="fa fa-spin fa-spinner"></i>
		  </span>
		</li>
		
		<li>
		<input type="hidden" name="near_postcode" id="near_postcode" value="50">
			<input type="hidden" name="hid_type" id="hid_type" value="{{ !empty($get['hid_type']) ? $get['hid_type'] : '' }}">
			<input type="hidden" name="parent_cat" id="parent_cat" value="{{ !empty($get['parent_cat']) ? $get['parent_cat'] : '' }}">
			<input type="hidden" name="catval" id="catval" value="{{ !empty($get['catval']) ? $get['catval'] : '' }}">
			<button type="submit" class="btn btn-primary search_form_button">SEE RECOMMENDATIONS</button>
	    </li>
	  </ul>
	</form>
	</div>
</section>
@endif