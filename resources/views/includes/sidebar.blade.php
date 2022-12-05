<!-- MENU Start -->
<div class="navbar-custom">
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
			
            <ul class="navigation-menu">
                <li class="has-submenu {{ (!empty($route) && $route=='dashboard')?' active':'' }}">
                    <a href="{{ url('/admin/dashboard') }}"><i class="mdi mdi-airplay {{ (!empty($route) && $route=='dashboard')?' active':'' }}"></i>Dashboard</a>
                </li>
				@if(Auth::guard('admin')->user()->user_type ==1)
				<li class="has-submenu {{ (!empty($route) && ($route =='categories' || $route == 'categories'))?' active':'' }}"">
                    <a href="#"><i class="mdi mdi-layers"></i>Category</a>
                    <ul class="submenu">
					   <li><a href="{{ url('/admin/categories') }}">List</a></li>
                       <li><a href="{{ url('/admin/categories/top_rated') }}">Latest/Top Rated</a></li>
					</ul>
                </li>

               <li class="has-submenu {{ (!empty($route) && ($route =='business-listing' || $route == 'business-categories' || $route == 'business-review'))?' active':'' }}"">
                    <a href="#"><i class="mdi mdi-layers"></i>Business</a>
                    <ul class="submenu">
					   <li><a href="{{ url('/admin/business-listing') }}">Listing</a></li>
                       <li><a href="{{ url('/admin/business-categories') }}">Category</a></li>
					   <li><a href="{{ url('/admin/business-review') }}">Review</a></li>
                    </ul>
                </li>
				<li class="has-submenu {{ (!empty($route) && ($route=='users' || $route=='users-enquiry' || $route=='users-conatct' || $route=='faq'))?' active':'' }}">
				  <a href="#"><i class="mdi mdi-layers"></i>Users</a>
				  <ul class="submenu">
					   <li><a href="{{ url('/admin/users') }}">Listing</a></li>
                       <li><a href="{{ url('/admin/users/enquiry') }}">Enquiry</a></li>
					   <li><a href="{{ url('/admin/users/contacts') }}">Contacts</a></li>
					   <li><a href="{{ url('/admin/users/faq') }}">FAQ</a></li>
                  </ul>
                </li>
				<li class="has-submenu {{ (!empty($route) && ($route=='staff' || $route=='role'))?' active':'' }}">
				<a href="#"><i class="mdi mdi-layers"></i>Admin Users</a>
				  <ul class="submenu">
				       <li><a href="{{ url('/admin/staff/role') }}">Role</a></li>
					   <li><a href="{{ url('/admin/staff') }}">Listing</a></li>
                       
			      </ul>
                    
                </li>
				
				<li class="has-submenu {{ (!empty($route) && (($route=='newsletter') || ($route=='help') || ($route=='api-settings') || ($route=='contactus-enquiry')))?' active':'' }}">
				<a href="#"><i class="mdi mdi-layers"></i>Settings</a>
				  <ul class="submenu">
				       <li><a href="{{ url('/admin/newsletters') }}">Newsletter</a></li>
					   <li><a href="{{ url('/admin/help') }}">Help</a></li>
					   <li><a href="{{ url('/admin/contactus-enquiry') }}">Contactus Enquiry</a></li>
					   <li class="has-submenu {{ (!empty($route) && ($route=='api-settings'))?' active':'' }}">
						<a href="#">Api Settings</a>
						<ul class="submenu">
							<li><a href="{{ url('/admin/api-settings/google') }}">Google Api</a></li>
						   <li><a href="{{ url('/admin/api-settings/facebook') }}">Facebook Api</a></li>
						   <li><a href="{{ url('/admin/api-settings/outlook') }}">Outlook Api</a></li>
						   <li><a href="{{ url('/admin/api-settings/yelp') }}">Yelp Api</a></li>
						   <li><a href="{{ url('/admin/api-settings/stripe') }}">Stripe Api</a></li>
						</ul>
					</li> 
					   
                       
			      </ul>
                    
                </li>
				<li class="has-submenu {{ (!empty($route) && (($route=='seo-setting') || ($route=='page')))?' active':'' }}">
				<a href="#"><i class="mdi mdi-layers"></i>Pages</a>
				  <ul class="submenu">
				       <li><a href="{{ url('/admin/pages') }}">Pages</a></li>
					   <li><a href="{{ url('/admin/seo-setting') }}">Seo Pages</a></li>
					   
                       
			      </ul>
                    
                </li>
				<li class="has-submenu {{ (!empty($route) && ($route=='stripe' || $route=='stripe'))?' active':'' }}">
                    <a href="#"><i class="mdi mdi-layers"></i>Stripe</a>
                    <ul class="submenu">
                        <li><a href="{{ url('/admin/users/subscription') }}">Subscription</a></li>
                        <li><a href="{{ url('/admin/users/payment') }}">Payment</a></li>

                    </ul>
                </li>
				
		     @else
				 @php $getObjCategoryRole = \App\RoleHasPermission::where('role_id',Auth::guard('admin')->user()->role)->where('name','category')->first();@endphp
			 <?php //echo "<pre>";var_dump($getObjCategoryRole);?>
			     @if(!empty($getObjCategoryRole))
					<li class="has-submenu {{ (!empty($route) && $route=='categories')?' active':'' }}">
						<a href="{{ url('/admin/categories') }}"><i class="mdi mdi-layers {{ (!empty($route) && $route=='categories')?' active':'' }}"></i>Category</a>
					</li>
                @endif
				@php $getObjBusinessRole = \App\RoleHasPermission::where('role_id',Auth::guard('admin')->user()->role)->where('name','business')->first();@endphp
				@php $getObjBusinessCategoryRole = \App\RoleHasPermission::where('role_id',Auth::guard('admin')->user()->role)->where('name','business-category')->first();@endphp
				@php $getObjBusinessReviewRole = \App\RoleHasPermission::where('role_id',Auth::guard('admin')->user()->role)->where('name','business-review')->first();@endphp
			     @if(!empty($getObjBusinessRole) || !empty($getObjBusinessCategoryRole) || !empty($getObjBusinessReviewRole))
				   <li class="has-submenu {{ (!empty($route) && ($route =='business-listing' || $route == 'business-categories' || $route == 'business-review'))?' active':'' }}"">
						<a href="#"><i class="mdi mdi-layers"></i>Business</a>
						<ul class="submenu">
						@if(!empty($getObjBusinessRole))
						   <li><a href="{{ url('/admin/business-listing') }}">Listing</a></li>
					    @endif
						@if(!empty($getObjBusinessCategoryRole))
						   <li><a href="{{ url('/admin/business-categories') }}">Category</a></li>
					   @endif
					   @if(!empty($getObjBusinessReviewRole))
						   <li><a href="{{ url('/admin/business-review') }}">Review</a></li>
					   @endif
						</ul>
					</li>
					@endif
				@php $getObjUserRole = \App\RoleHasPermission::where('role_id',Auth::guard('admin')->user()->role)->where('name','users')->first();@endphp
				@php $getObjUserEnquiryRole = \App\RoleHasPermission::where('role_id',Auth::guard('admin')->user()->role)->where('name','users-enquiry')->first();@endphp
				@php $getObjUserContactRole = \App\RoleHasPermission::where('role_id',Auth::guard('admin')->user()->role)->where('name','users-contact')->first();@endphp
				@php $getObjFaqRole = \App\RoleHasPermission::where('role_id',Auth::guard('admin')->user()->role)->where('name','faq')->first();@endphp
			     @if(!empty($getObjUserRole) || !empty($getObjUserEnquiryRole) || !empty($getObjUserContactRole) || !empty($getObjFaqRole))
					<li class="has-submenu {{ (!empty($route) && ($route=='users' || $route=='users-enquiry' || $route=='users-conatct' || $route=='faq'))?' active':'' }}">
					  <a href="#"><i class="mdi mdi-layers"></i>Users</a>
					  <ul class="submenu">
					       @if(!empty($getObjUserRole))
						    <li><a href="{{ url('/admin/users') }}">Listing</a></li>
					       @endif
						   @if(!empty($getObjUserEnquiryRole))
						     <li><a href="{{ url('/admin/users/enquiry') }}">Enquiry</a></li>
					       @endif
					      @if(!empty($getObjUserContactRole))
						   <li><a href="{{ url('/admin/users/contacts') }}">Contacts</a></li>
					      @endif
					     @if(!empty($getObjFaqRole))
						   <li><a href="{{ url('/admin/users/faq') }}">FAQ</a></li>
					     @endif
					  </ul>
					</li>
				@endif 
				@php $getObjAdminUserRole = \App\RoleHasPermission::where('role_id',Auth::guard('admin')->user()->role)->where('name','users-role')->first();@endphp
				@php $getObjAdminUser = \App\RoleHasPermission::where('role_id',Auth::guard('admin')->user()->role)->where('name','admin_users')->first();@endphp
			     @if(!empty($getObjAdminUserRole) || !empty($getObjAdminUser))
					<li class="has-submenu {{ (!empty($route) && ($route=='staff' || $route=='role'))?' active':'' }}">
					<a href="#"><i class="mdi mdi-layers"></i>Admin Users</a>
					  <ul class="submenu">
					     @if(!empty($getObjAdminUserRole))
					       <li><a href="{{ url('/admin/staff/role') }}">Role</a></li>
					     @endif
						 @if(!empty($getObjAdminUser))
						   <li><a href="{{ url('/admin/staff') }}">Listing</a></li>
					     @endif
				       </ul>
						
					</li>
				 @endif
             @endif
			 @php $getObjNewsletterRole = \App\RoleHasPermission::where('role_id',Auth::guard('admin')->user()->role)->where('name','newsletter')->first();@endphp
				@php $getObjHelpRole = \App\RoleHasPermission::where('role_id',Auth::guard('admin')->user()->role)->where('name','help')->first();@endphp
				@php $getObjApiSettingsRole = \App\RoleHasPermission::where('role_id',Auth::guard('admin')->user()->role)->where('name','api-settings')->first();@endphp
				@if(!empty($getObjNewsletterRole) || !empty($getObjHelpRole))
				<li class="has-submenu {{ (!empty($route) && (($route=='newsletter') || ($route=='help')))?' active':'' }}">
				<a href="#"><i class="mdi mdi-layers"></i>Settings</a>
				  <ul class="submenu">
				  @if(!empty($getObjNewsletterRole))
				       <li><a href="{{ url('/admin/newsletters') }}">Newsletter</a></li>
				   @endif
				   @if(!empty($getObjHelpRole))
					   <li><a href="{{ url('/admin/help') }}">Help</a></li>
					@endif   
					@if(!empty($getObjApiSettingsRole))
						 <li class="has-submenu {{ (!empty($route) && ($route=='api-settings'))?' active':'' }}">
							<a href="#">Api Settings</a>
							<ul class="submenu">
								<li><a href="{{ url('/admin/api-settings/google') }}">Google Api</a></li>
							   <li><a href="{{ url('/admin/api-settings/facebook') }}">Facebook Api</a></li>
							   <li><a href="{{ url('/admin/api-settings/outlook') }}">Outlook Api</a></li>
							   <li><a href="{{ url('/admin/api-settings/yelp') }}">Yelp Api</a></li>
							   <li><a href="{{ url('/admin/api-settings/stripe') }}">Stripe Api</a></li>
							</ul>
						</li> 
					@endif
			      </ul>
                    
                </li>
				@endif
				@php $getObjPageRole = \App\RoleHasPermission::where('role_id',Auth::guard('admin')->user()->role)->where('name','pages')->first();@endphp
				@php $getObjSeoPageRole = \App\RoleHasPermission::where('role_id',Auth::guard('admin')->user()->role)->where('name','seo')->first();@endphp
				@if(!empty($getObjPageRole) || !empty($getObjSeoPageRole))
					<li class="has-submenu {{ (!empty($route) && (($route=='seo-setting') || ($route=='page')))?' active':'' }}">
					<a href="#"><i class="mdi mdi-layers"></i>Pages</a>
					  <ul class="submenu">
					  @if(!empty($getObjPageRole))
						   <li><a href="{{ url('/admin/pages') }}">Pages</a></li>
					   @endif
					   @if(!empty($getObjSeoPageRole))
						   <li><a href="{{ url('/admin/seo-setting') }}">Seo Pages</a></li>
					   @endif
						   
						   
					  </ul>
						
					</li>
				@endif
				@php $getObjPaymentRole = \App\RoleHasPermission::where('role_id',Auth::guard('admin')->user()->role)->where('name','payment')->first();@endphp
				@if(!empty($getObjPaymentRole))
				<li class="has-submenu {{ (!empty($route) && ($route=='stripe' || $route=='stripe'))?' active':'' }}">
                    <a href="#"><i class="mdi mdi-layers"></i>Stripe</a>
                    <ul class="submenu">
                        <li><a href="{{ url('/admin/users/subscription') }}">Subscription</a></li>
                        <li><a href="{{ url('/admin/users/payment') }}">Payment</a></li>

                    </ul>
                </li>
				@endif
                <!-- <li class="has-submenu {{ (!empty($route) && $route=='stats')?' active':'' }}">
                    <a href="{{ url('admin/stats') }}"><i class="mdi mdi-airplay {{ (!empty($route) && $route=='stats')?' active':'' }}"></i>Stats</a>
                </li> -->
                <li class="has-submenu {{ (!empty($route) && ($route=='stats' || $route=='role'))?' active':'' }}">
                    <a href="#"><i class="mdi mdi-layers"></i>Stats</a>
                      <ul class="submenu">
                           <li><a href="{{ url('/admin/stats') }}">Business Stats</a></li>
                           <li><a href="{{ route('admin.referral.stat') }}">Referral Stats</a></li>
                       </ul>
                        
                </li>
				<li class="has-submenu {{ (!empty($route) && $route=='comissions')?' active':'' }}">
                    <a href="{{ url('admin/comissions') }}"><i class="mdi mdi-airplay {{ (!empty($route) && $route=='comissions')?' active':'' }}"></i>Commissions</a>
                </li>

            </ul>
            <!-- End navigation menu -->
        </div> <!-- end #navigation -->
    </div> <!-- end container -->
</div> <!-- end navbar-custom -->
<!-- End Navigation Bar-->
