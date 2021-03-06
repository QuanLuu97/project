@extends('layout.index')
@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ route('home') }}">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">eCommerce</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{ route('indexNews') }}">News</a>

        </li>
    </ul>
    <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm btn-default" data-container="body"
             data-placement="bottom" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp; <i
                    class="fa fa-angle-down"></i>
        </div>
    </div>
</div>

<div class="col-md-12 portlet box green-haze">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>List News

		</div>
		
	</div>
	<div class="col-md-12 portlet-body">
		<a href="{{ route('addNews') }}" class="btn btn-success">ADD</a>
		<table class="table table-striped table-bordered table-hover" id="sample_2">
			<thead>
				<tr>
					<th class="col-md-1 text-center">
						Id
					</th >
					<th class="col-md-2 text-center">
						Title
					</th >					
					<th class="col-md-3 text-center">
						Image
					</th>
					<th class="col-md-4 text-center">
						Description
					</th>
					<th class="col-md-1 text-center" colspan="2">
						
					</th>
				</tr>
			</thead>
			<tbody>
			@foreach($newss as $news)
				<tr>
					<td class="text-center">{{ $news->id }}</td>
					<td class="text-center">{{ $news->title }}</td>
					
					<td class="text-center">
						@if($news->image == null)
							<img src="" width="200px" height="200px" alt="null">
						@endif
						@if($news->image != null)
							<img src="{{ asset('image/'.$news->image) }}" width="200px" height="200px">
						@endif
					</td>
					<td class="text-center">{!! $news->description !!}</td>
					<td>
						<a class="glyphicon btn btn-primary" id="delete" onclick='deleteItem(<?php echo $news->id; ?>)'" >&#xe020;</a>
					</td>
	               <!--  goi route -->
	                <td>
	                    <a href="{{ route('editNews', $news->id) }}" class="glyphicon btn btn-primary">&#x270f;</a>
	                </td>
				</tr>
				
			@endforeach   

			</tbody>
		</table>
		
	</div>
</div>
<a href="{{ route('addNews') }}" class="btn btn-success">ADD</a>
<script type="text/javascript">
	// delete item with  swal
	function deleteItem (id) {
		swal({
		  title: 'Are you sure?',
		  text: "You won't be able to revert this!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
		  if (result.value) {
		  	$.ajax({
		  		url: "../admin/news/delete/"+id,
		  		type:'get',
		  		data: {
		  			id:id
		  		},
		  		success:function(res) {
		  			if(res.code == 200) {
		  				swal(
							'Deleted!',
						     res.msg,
							'success'
						).then((result) => {
							if(result.value) {
								location.reload();
							}
							
						});
		  			}
		  			else {
		  				swal({
							  type: 'error',
							  title: 'Oops...',
							  text: res.msg+'!'
						})
		  			}
		  		},

		  	});    
		  }
		});
			
	};

</script>
<script type="text/javascript">

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#image_tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image").change(function(){
        readURL(this);
    });
</script>

@endsection