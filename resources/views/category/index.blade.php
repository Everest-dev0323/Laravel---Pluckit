@extends('layouts.front-end.app')
@section('content')
 <!-- Content -->
  <div id="content" class="pt-0">

    <!-- Section -->
    <section class="section categories border-top pt-4">
      <div class="container">
		<h2 class="heading-style">All Categories</h2>
		@if(!empty($allCatgories[0]))
		<ul class="list-unstyled list-category">
		 @foreach($allCatgories as $category)
           <li>
		      <h4>{{ $category->name }}</h4>
			  @if ($category->children)
				<ul class="list-unstyled">
			       @foreach ($category->children as $child)
				     <li><a href="{{ url('/search?cat='.$child->name.'&hid_type=category'.'&parent_cat='.$category->name.'&catval='.$child->id) }}">{{ $child->name }}</a></li>
				   @endforeach

				</ul>
				@endif
		   </li>
		  @endforeach

		</ul>
		@endif
        <div class="row mb-lg-5 d-none">
		@if(!empty($allCatgories[0]))
			@php $i=1; @endphp
		 @foreach($allCatgories as $category)
		 @php
		    $varRating = 0;
			$varReviewCount = 0;
			$varCount = 0;
			$varTotalRating = 0;
		    $categoryRating = \App\BusinessListingCategory::where('business_listing_categories.business_category_alias',$category->alias)->get(['business_listing_categories.business_id']);
			if(!empty($categoryRating[0])){
				$varCount = count($categoryRating);
				foreach($categoryRating as $ratingCategory){
					$businessReview = \App\BusinessListing::where('id',$ratingCategory->business_id)->first();
					if(!empty($businessReview) > 0) {
						$varReviewCount = $varReviewCount+$businessReview->business_review_count;
						$varRating = $varRating+$businessReview->business_rating;
					}

				}
				$varTotalRating = round(($varRating/$varCount),1);
			}
		@endphp
          <div class="col-6 col-md-6 col-lg-3">
            <div class="card border-0 card-hover">
			<a href="{{ url('/search?cat='.$category->name.'&hid_type=category'.'&parent_cat='.$category->name.'&catval='.$category->id) }}">
			@if(!empty($category->category_image))
              <img class="card-img-top rounded-1" src="{{ $category->category_image }}" alt="Image">
		    @else
			  <img class="card-img-top rounded-1" src="{{ ('/public') }}/front-assets/images/default-image.jpg" alt="Image">
			@endif
			</a>
              <div class="card-body pt-3 p-0">
                <div class="row">
                  <div class="col-8 pr-0">
                    <h5><a href="{{ url('/search?cat='.$category->name.'&hid_type=category'.'&parent_cat='.$category->name.'&catval='.$category->id) }}">{{ $category->name }}</a></h5>
                    <div class="rating d-flex justify-content-start align-items-center">
                      <div class="view-count mr-sm-2">
                        {{ $varTotalRating }}
                      </div>
                      <ul class="list-unstyled">
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                      </ul>
                      <div class="reviews ml-sm-2 ml-1">
                        <a href="#">({{ $varReviewCount }} reviews)</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-4 text-right">
				  @if(!empty($category->category_icon))
                    <img class="icon img-fluid" src="{{ $category->category_icon }}" alt="icon">
				  @else
					  <img class="icon img-fluid" src="{{ ('/public') }}/front-assets/images/category-default-icon.png" alt="icon">
				  @endif
                  </div>
                </div>
              </div>
            </div>
          </div>

		  @if(($i%4==0) && (count($allCatgories) > $i))
			  </div>
		  <div class="d-none row mb-lg-5 {{ ($i==20)? 'd-none':'' }}">
		  @endif
		   @php $i=$i+1;@endphp
		  @endforeach
		  @endif

        </div>
        <div class="ht-80 bd d-flex align-items-center justify-content-end">
			<ul class="pagination pagination-basic pagination-primary mg-r-10">
				{{ $allCatgories->render() }}
			</ul>
		</div>
      </div>
    </section>

  </div>
  <!-- /content -->
@endsection
