@extends('layout.admin_master')
@push('css-script')
<style type="text/css">
	.product__rating {
	    display: block;
	    font-size: 10px;
	    line-height: 1.3;
	}
	.rating {
	    display: inline-block;
	    height: 13px;
	    width: 78px;
	    margin-right: 5px;
	    background: url({{asset('big-star1.png')}}) 0 -13px no-repeat;
	    vertical-align: middle;
	}
    .rating .rating__star {
            display: inline-block;
		    height: inherit;
		    background: url({{asset('big-star1.png')}}) 0 0 no-repeat;
		    text-indent: -9999px;
    }
    .product-list{
    	font-size: 10px;	
    }
  </style>
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Scrapping
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Your Page Content Here -->
      <form action="" class="form-horizontal" method="GET">
		<div class="form-group">
			<div class="col-sm-10">
				<input type="text" name="keyword" class="form-control" placeholder="Search Product">
			</div>
			<div class="col-md-2">
				<input type="submit" name="" class="btn btn-default" value="Submit">
			</div>
		</div>
	</form>
	<hr>
	@if($products != null)
		<div class="row product-list">
		@foreach($products as $product)
			
		  <div class="col-sm-6 col-md-3 col-xs-12" style="height: 350px;">
		    <div class="thumbnail">
		      <img src="{{$product['3']}}" class="img-responsive" width="174" height="174" alt="...">
		      <div class="caption">
		        <h5>{{$product['0']}}</h5>
		        <p>Rp.{{number_format($product['1'],0,',','.')}}</p>
		        <p><a href="{{$product['2']}}" class="btn btn-primary btn-xs" role="button">Original Product</a> <a href="#" class="btn btn-default btn-xs" role="button">Button</a></p>
		      </div>
		      @if(isset($product['4']))
		      <div class="product__rating">
		      	<?php
		      		if($product['4'] != ''){
		      			$substr_rating = substr($product['4'],0,3);
		      			$rating_width = $substr_rating/5*100;
		      			$review = substr($product['4'],3,4);
		      		}else{
		      			$rating_width = 0;
		      			$review = 0;
		      		}
		      		
		      		
		      	?>
				<span class="rating" title="{{$product[4]}}"><span class="rating__star js-rating-star" style="width:{{$rating_width}}% ">4.7</span></span><a class="review__aggregate" href=""><span>{{$review}}</span></a>
			  </div>
			  @endif
		    </div>
		  </div>
		@endforeach
		</div>
	@endif

    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->		
	
@endsection

