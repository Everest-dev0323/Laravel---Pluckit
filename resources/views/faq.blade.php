@extends('layouts.front-end.app')
@section('content')
<!-- Content -->
    <div id="content" class="pt-0">
      <!-- Signup -->
      <section class="section border-top faq-content">
        <div class="container">
          <div class="accordion" id="accordionExample">
		   @if(!empty($getObjFaq[0]))
			   @php $i=1; @endphp
			   @foreach($getObjFaq as $faq)
					<div class="card">
					  <div class="card-header" id="heading{{ $i }}">
						<h2 class="mb-0">
						  <button class="btn btn-link clearfix" type="button" data-toggle="collapse" data-target="#collapse{{ $i }}"
							aria-expanded="true" aria-controls="collapse{{ $i }}">
							{{ $faq->faq_question }} <i class="icon plusminus float-right"></i>
						  </button>
						</h2>
					  </div>

					  <div id="collapse{{ $i }}" class="collapse {{ ($i==1)?'show':'' }}" aria-labelledby="heading{{ $i }}" data-parent="#accordionExample">
						<div class="card-body">
						  <p>{{ $faq->faq_answer }}</p>
						</div>
					  </div>
					</div>
					@php $i=$i+1; @endphp
			@endforeach
			@else
				 <h2>No Faq Found</h2>
		   @endif
            
			
			
          </div>
        </div>
      </section>
      <!-- /Signup-->
    </div>
    <!-- /content -->
@endsection