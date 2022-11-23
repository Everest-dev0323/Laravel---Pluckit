
<div class="share-page-content pt-3">
<div class="logo mb-4">
<a href="{{ url('/business/'.$getObjBusiness->business_slug) }}">
  <img class="img-fluid" src="{{ (!empty($getObjBusiness->business_image)) ? $getObjBusiness->business_image : url('/public/front-assets/images/default-image.jpg') }}" alt="{{ $getObjBusiness->business_name }}">
</div>
<h4>{{ $getObjBusiness->business_name }}</h4>
</a>
</figure>
<div class="form-group">
 <?php echo $shareLink;?>
 </div>
