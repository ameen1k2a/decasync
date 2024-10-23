<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="" >
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--Meta Responsive tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Favicon Icon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!--Bootstrap CSS-->
   
    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/quicksand.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-jvectormap-2.0.2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap_calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">

    <style>
        #alertMessage {
            position: fixed; /* Fixed position */
            top: 20px; /* Distance from the top */
            right: 20px; /* Distance from the right */
            z-index: 1050; /* Bootstrap's default modal z-index is 1050 */
            width: auto; /* Allow auto width */
            max-width: 300px; /* Maximum width for the alert */
            transition: opacity 0.5s ease; /* Smooth transition for fading */
        }
    </style>

    <style>
        .product-image {
            margin-top: 20px;
        }
        .Image-upload {
            position: relative;
            display: inline-block;
            margin-right: 10px;
        }
        .image-option-close {
            position: absolute;
            top: -10px;
            right: -10px;
            cursor: pointer;
            color: red;
            font-weight: bold;
            font-size: 18px;
        }
        .item_images {
            width: 100px; /* Set the width of images */
            height: auto; /* Maintain aspect ratio */
            margin-top: 5px;
        }
    </style>


    <title>Dacasync - Ameen</title>
  </head>
  <body>
    <!--Page loader-->
    <div class="loader-wrapper">
        <div class="loader-circle">
            <div class="loader-wave"></div>
        </div>
    </div>
    <!--Page loader-->
    
    <!--Page Wrapper-->

    <div class="container-fluid">

        <div id="alertMessage" class="alert alert-dismissible fade show" role="alert" style="display: none;">
            <span id="alertText">This is an alert message!</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!--Header-->
        <div class="row header shadow-sm">
            
            <!--Logo-->
            <div class="col-sm-3 pl-0 text-center header-logo">
               <div class="bg-theme mr-3 pt-3 pb-2 mb-0">
                    <h3 class="logo"><a href="#" class="text-secondary logo"><i class="fa fa-rocket"></i> Sleek<span class="small">admin</span></a></h3>
               </div>
            </div>
            <!--Logo-->

            <!--Header Menu-->
            <div class="col-sm-9 header-menu pt-2 pb-0">
                <div class="row">
                    
                   

                    
                </div>    
            </div>
            <!--Header Menu-->
        </div>
        <!--Header-->

        <!--Main Content-->
        
        
        <div class="row main-content">

           
            <div class="col-sm-3 col-xs-6 sidebar pl-0">
                <div class="inner-sidebar mr-3">
                    <!--Image Avatar-->
                    <div class="avatar text-center">
                        <img src="assets/img/client-img4.png" alt="" class="rounded-circle" />
                        <p><strong>Jonathan Clarke</strong></p>
                       {{--  <span class="text-primary small"><strong>UI/UX Designer</strong></span> --}}
                    </div>
                    <!--Image Avatar-->

                    <!--Sidebar Navigation Menu-->
                    <div class="sidebar-menu-container">
                        <ul class="sidebar-menu mt-4 mb-4">
                            
        
                            <li class="parent">
                                <a href="{{ route('suppliers.index') }}" class=""><i class="fa fa-users mr-3"></i>
                                    <span class="none">Suppliers</span>
                                </a>
                            </li>
                            
                            <li class="parent">
                                <a href="{{ route('items.index') }}" class=""><i class="fa fa-cubes mr-3"></i>
                                    <span class="none">Items</span>
                                </a>
                            </li>
                            
                            <li class="parent">
                                <a href="{{ route('purchases.index') }}" class=""><i class="fa fa-shopping-cart mr-3"> </i>
                                    <span class="none">Purchases</span>
                                </a>
                            </li>
                            <li class="parent">
                                <a href="{{ route('purchases.list') }}" class=""><i class="fa fa-list-ul mr-3"> </i>
                                    <span class="none">Purchase List</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                    <!--Sidebar Naigation Menu-->
                </div>
            </div>

            {{ $slot }}

                <!--Footer-->
                <div class="row mt-5 mb-4 footer">
                    <div class="col-sm-8">
                        <span>&copy; Muhammed Ameen <a class="text-theme" href="#"></a></span>
                    </div>
                    <div class="col-sm-4 text-right">
                        <a href="#" class="ml-2"> </a>
                        <a href="#" class="ml-2"></a>
                    </div>
                </div>
                <!--Footer-->

            </div>
        </div>

       

    </div>

    <!--Page Wrapper-->


   
    <!-- JavaScript Assets -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/progressbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.flot.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.flot.pie.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.flot.categories.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.flot.stack.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/js/chartist-data.js') }}"></script>
    <script src="{{ asset('assets/js/demo.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/js/jvector-maps.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap_calendar.js') }}"></script>
    <script src="{{ asset('assets/js/nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>

    <script>
       

       function showAlert(message, alertType = 'success', duration = 4000) {
            var alertDiv = $('#alertMessage');
            var alertText = $('#alertText');

            alertDiv.removeClass('alert-success alert-danger alert-warning alert-info');
            alertDiv.addClass('alert-' + alertType);
            alertText.text(message);

            alertDiv.fadeIn();

            setTimeout(function() {
                alertDiv.fadeOut();
            }, duration);
        }



    </script>

    @php
      
        $fullControllerName = request()->route()->getAction()['controller'];
        // Extract only the controller name (without method)
        $controllerName = class_basename(explode('@', $fullControllerName)[0]);
        
    @endphp
    
    @if($controllerName == 'PurchaseOrderController')
        @include('partials.purchase_order_js')
    @elseif($controllerName == 'ItemController')
        @include('partials.item_js')
    @elseif($controllerName == 'SupplierController')
        @include('partials.supplier_js')
    @endif

    
  </body>
</html>