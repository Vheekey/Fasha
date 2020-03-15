<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Vendor | Fasha</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		@include('header')
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{ url('/') }}">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
										<li><a href="{{ url('/shop') }}">Products</a></li>
										<li><a href="{{ url('/product-details') }}">Product Details</a></li> 
										<li><a href="{{ url('/checkout') }}">Checkout</a></li> 
										<li><a href="{{ url('/cart') }}" >Cart</a></li> 
										<li><a href="{{ url('/login') }}">Login</a></li>
                                        <li><a href="{{ url('/vendor') }}" class="active">Vendor</a></li> 

                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
										<li><a href="{{ url('/blog') }}">Blog List</a></li>
										<li><a href="{{ url('/blog-single') }}">Blog Single</a></li>
                                    </ul>
                                </li> 
								<li><a href="{{ url('/404') }}">404</a></li>
								<li><a href="{{ url('/contactus') }}">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

    <section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Add Products </h2>
                        @include('flashmessage')
						<form action="/uploadProduct" method="post" class="login-form" enctype="multipart/form-data" >
                            <label for="">Product</label>
                            <input type="text" name="prodName" id="" placeholder = "Product Name" class="form-control">
                            <p></p>
                            <label for="">Product Description</label>
                            <input type="text" name="prodDesc" id="" placeholder = "Product Description" class="form-control">
                            <p></p>
                            <label for="">Amount</label>
                            <input type="text" name="prodAmount" id="" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder = "500" class="form-control">
                            <p></p>
                            <label for="">Product Image</label>
                            <input type="file" name="prodImage" id="" accept="image/*" class="form-control">
                            <input type = "hidden" name = "_token" value="{{csrf_token()}}">
                            <p></p>
                            <button type="submit"  class="btn  btn-dark pull-right" style="background-color:#FE980F; color:white; font-weight:bold" >Create</button>
                            
                        </form>
					
				
						
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Featured Items</h2>
                        <div id="disp"></div>
                    </div>


						
				</div>
			</div>
		</div>
	</section>

    <script src="//code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script type="text/javascript"> 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $(document).ready(function(){ 
            
            console.log('black');
            $.ajax({
                type:'GET',
                url:"{{ route('getProducts') }}",
                data:{'_token':'{{ csrf_token() }}'},
                success:function(data){
                    var results = JSON.parse(data);
                    console.log(results);
                    var tb = "";

                for (j = 0; j < results.length; j++) { 
                    

                    tb += '<div class="col-sm-4"><div class="product-image-wrapper"><div class="single-products"><div class="productinfo text-center"><img src="images/'+results[j].productImage+'" alt="" /><h2>$'+results[j].productPrice+'</h2><p>'+results[j].productName+'</p><strong style="color: #FE980F">Status: '+results[j].productStatus+'</strong></div><div class="product-overlay"><div class="overlay-content"><h2>'+results[j].productPrice+'</h2><p>'+results[j].productName+'</p><a href="#" class="btn btn-default add-to-cart">Status: '+results[j].productStatus+'</a></div></div></div></div></div></div>';                    
                } 


                document.getElementById("disp").innerHTML = tb;

                }
            }); 
        });
    </script>