@extends('layouts.front-end.app')
@section('content')
 <!-- Content -->
  <div id="content">
   
    <!-- Section -->
    <section class="section text-section border-top pt-3">
      <div class="container">
        <h2> Terms of Service</h2>		  
          <?php echo !empty($getObjSeoSetting[0]->content) ? $getObjSeoSetting[0]->content : '';?>   
   </div>
    </section>
   
  </div>
  <!-- /content -->
@endsection
