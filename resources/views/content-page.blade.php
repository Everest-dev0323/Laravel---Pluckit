@extends('layouts.front-end.app')
@section('content')
 <!-- Content -->
  <div id="content">
   
    <!-- Section -->
    <section class="section text-section border-top pt-3">
      <div class="container">
        <h2 class="mb-3"> {{ $getPages->page_name }}</h2>	
        <!-- s   -->
          <?php echo !empty($getObjSeoSetting->content) ? $getObjSeoSetting->content : '';?>   
          <!-- <div class="row justify-content-center align-items-center mt-5">
            <div class="col-md-8">
                <div class="box bg-gray-light box-shadow">
                  <form action="" class="form form-layout2">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <input type="tel" class="form-control" placeholder="Number">
                    </div>
                    <div class="form-group">
							         <textarea name="message" id="message" class="form-control" placeholder="Enquire details"></textarea>
                    </div>
                    <div class="text-right">
                      <button type="submit" class="btn btn-primary rounded">Submit</button>
                    </div>
                  </form>
                </div>
            </div>
          </div> -->
   </div>
    </section>
   
  </div>
  <!-- /content -->
@endsection
