@extends('layouts.app')
@section('content')
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group pull-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Business Category</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Business Category List</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}  
                    </div><br />
                    @endif
                    @if(session()->has('error'))
                    <div class=" col-sm-6 alert alert-success">
                        <ul>
                            <li>{{ session()->get('error') }}</li>
                        </ul>
                    </div>@endif
                    <div class="card-body">
					
						<form method="get" id="form-search">
					       <div class="row">
								<div class="col-md-4">
									<label>Search By Business Name</label>
									 <input type="text" name="b_name" id="search" value="{{ !empty($get['b_name']) ? $get['b_name'] : ''}}" class="form-control" placeholder="Search By Business Name">
								 </div>
								 <div class="col-md-4">
									<label>Search By Category Name</label>
									 <input type="text" name="cat" id="type" value="{{ !empty($get['cat']) ? $get['cat'] : ''}}" class="form-control" placeholder="Search by Category Name">
								 </div>
								 <div class="col-md-4 pt-4 mt-2">
								   <label>&nbsp;</label>
								   <button type="submit" class="btn btn-primary">Search</button>
								 </div>
							</div>
							
						</form>
						<div class="clearfix">&nbsp;</div>
						<a href="javascript:;" class="btn btn-success pull-right ml-1 delete_multiple_cat">Delete</a>
                        <!-- <a href="{{ url('/admin/category/add') }}" class="btn btn-success mt-0  m-b-30 pull-right">Add New Category</a> -->
                        <div class="table-rep-plugin">
                            <div class="table-responsive b-0" data-pattern="priority-columns">
                                <table id="tbl_multiple_cat" class="table  table-striped">
                                    <thead>
                                       <tr>
									        <th><input type="checkbox" id="chk_all_cat" /> Select all</th>
                                            <th>S.NO.</th>
											<th>Business Name</th>
                                            <th>Category Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @if(!empty($businessCategoryListing[0]))
                                       @foreach ($businessCategoryListing as $item)
								       @php
									    $getBusiness = \App\BusinessListing::where('id',$item->business_id)->first(); 
										$getCat = \App\Category::where('alias',$item->business_category_alias)->first();
									  @endphp

                                        <tr>
										     <td>
											  <input type="checkbox" name="select_all_cat_id[]" class="checkbox_cat" value="{{ $item->bcatId }}"/>
											</td>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{ !empty($getBusiness->business_name) ? $getBusiness->business_name : '' }}</td>
                                            <td>{{ !empty($getCat->name) ? $getCat->name : '' }}</td>
											<td class="td-actions">
                                               <!-- <a href="{{ url('admin/category/edit/'.$item->category_id) }}" class="btn btn-primary btn-icon rounded-circle"  title="Edit">
                                                    <div><i class="fa fa-edit"></i></div>
                                                </a>&nbsp; -->
                                                <a data-href="{{ url('admin/business-category/delete/'.$item->bcatId) }}" href="javascript:;" id="remove-category"  class="btn btn-primary btn-icon rounded-circle trash-category-{{ $item->bcatId }}"  title="Delete" onClick="trashCategory({{ $item->bcatId }})">
                                                    <div><i class="fa fa-trash"></i></div>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="5">
                                                <p class="text-center">No Record found.</p>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="ht-80 bd d-flex align-items-center justify-content-end">
                                    <ul class="pagination pagination-basic pagination-primary mg-r-10">
                                        {{ $businessCategoryListing->appends(request()->except('page'))->render() }}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
</div>
<div class="modal fade" id="status_popup" role="dialog">
    <div class="modal-dialog w-100">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Category Status</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12 form-group">
                    <span class="styled-select">
                        <select name="select_member" id="selectStatus"  class="form-control">
                            <option value="0">DeActivate</option>
                            <option value="1">Activate</option>
                        </select>
                    </span>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="chId" id="ch_row_id" value="">
                <button type="button" class="btn btn-success" id="ticket_change_status">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!----------------    Remove Business Category   -------------->
 <div id="remove-categories" class="modal fade">
            <div class="modal-dialog modal-dialog-vertical-center" role="document">
              <div class="modal-content bd-0 tx-14">
                <div class="modal-header pd-y-20 pd-x-25">
                  <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Remove Business Category</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body pd-25">
                  <h5 class="lh-3 mg-b-20"><a href="" class="tx-inverse hover-primary">Are you sure you want to remove this business category?</a></h5>
                  <p class="mg-b-5">After click on "Yes Sure" this business category will remove from the records. </p>
                </div>
                <div class="modal-footer">
                  <a type="button" class="iam-sure btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Yes Sure</a>
                  <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div><!-- modal-dialog -->
          </div><!-- modal -->
		  <!----------------    Remove Business Category   -------------->
		  <!----------------    Remove Multiple Category   -------------->
       <div id="remove-multiple-categories" class="modal fade">
            <div class="modal-dialog modal-dialog-vertical-center" role="document">
			<form class="form" action="{{ url('admin/business-categories/deleteMultipleCategory') }}" method="post" id="form-delete-multiple-category" >
             {{ csrf_field()}}             
			 <div class="modal-content bd-0 tx-14">
                <div class="modal-header pd-y-20 pd-x-25">
                  <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Remove Category</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body pd-25">
                  <h5 class="lh-3 mg-b-20"><a href="" class="tx-inverse">Are you sure you want to remove checked category?</a></h5>
                  <p class="mg-b-5">After click on "Yes Sure" checked category will remove from the records. </p>
                </div>
                <div class="modal-footer">
				<input type="hidden" name="hid_multiple_cat" id="hid_multiple_cat">
                  <a type="button" class="iam-sure-cat btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Yes Sure</a>
                  <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Cancel</button>
                </div>
              </div>
			  </form>
            </div><!-- modal-dialog -->
          </div><!-- modal -->
		  <!----------------    Remove Multiple Category  -------------->
          <div  class="clearfix">&nbsp;</div>
@endsection
@section('extracontent')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $(document).ready(function () {
		$('#chk_all_cat').on('click',function(){
			if(this.checked){
				$('.checkbox_cat').each(function(){
					this.checked = true;
				});
			}else{
				 $('.checkbox_cat').each(function(){
					this.checked = false;
				});
			}
		});
        $('body').on('click', '#status_change', function (e) {
            $('#status_popup').modal({show: true});
            var statusId = $(this).attr('data-id');
            $('#ch_row_id').val(statusId);
        });
        $('body').on('click', '#ticket_change_status', function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo url('restaurant/category/change-status') ?>",
                type: "POST",
                data: {status: $('#selectStatus').val(), rowid: $('#ch_row_id').val()},
                success: function () {
                    window.location.reload();
                }
            });
        });
    });
	function trashCategory(id){
            var dataHref = $(".trash-category-"+id).attr('data-href');
			$(".iam-sure").attr('href',dataHref);
        }
	$("body").on("click","#remove-category",function(){
		 $('#remove-categories').modal('show', {backdrop: 'static'});
	 });
    $("body").on("click",".delete_multiple_cat",function(){
		     var selected = new Array();
			 $("#tbl_multiple_cat .checkbox_cat:checked").each(function () {
			   selected.push(this.value);
			  });
			 if (selected.length > 0) {
				var select_cat_id = selected.join(",");
				$('#remove-multiple-categories').modal('show', {backdrop:'static',keyboard:false}); 
				$('#hid_multiple_cat').val(select_cat_id);
				
			 }else{
				 alert('Select at least one category');
				 return false;
			 }
		  });
		  $("body").on("click",".iam-sure-cat",function(){
			  $(".iam-sure-cat").html("Loading...");
			  $('#form-delete-multiple-category').submit();
		     
		  });  



</script>
@endsection
