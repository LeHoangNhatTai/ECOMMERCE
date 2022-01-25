@extends('web.master')

@section('title', 'Product Details')

@section('content')
            <div class="cart-table-area section-padding-100">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="cart-title mt-50">
                                <h2>Shopping Cart</h2>
                            </div>

                            <div class="cart-table clearfix">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>    
                                        @foreach($cart as $orderDetail)              
                                        <tr>
                                            <td class="cart_product_img">
                                                <a href="#"><img src="./assets/img/bg-img/cart1.jpg" alt="Product"></a>
                                            </td>
                                            <td class="cart_product_desc">
                                                <h5>{{ $orderDetail['name'] }}</h5>
                                            </td>
                                            <td class="price">
                                                <span>{{ $orderDetail['price'] }}</span>
                                            </td>
                                            <td class="qty">
                                                <div class="qty-btn d-flex">
                                                    <p>{{ $orderDetail['price'] * $orderDetail['quantity'] }}</p>
                                                    <div class="quantity">
                                                        <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="300" name="quantity" value="1">
                                                        <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="actions" >
                                                <button class="btn btn-info btn-sm update-cart" data-id=""><i class="fa fa-refresh"></i></button>
                                                <button class="btn btn-danger btn-sm remove-from-cart" data-id=""><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="cart-summary">
                                
                                <h5>Cart Total</h5>
                                <ul class="summary-table">
                                    <li><span>subtotal:</span> <span>$140.00</span></li>
                                    <!-- <li><span>delivery:</span> <span>Free</span></li> -->
                                    <li><span>total:</span> <span></span></li>
                                </ul>
                                <div class="cart-btn mt-100">
                                    <a href="cart.php" class="btn amado-btn w-100">Checkout</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ##### Main Content Wrapper End ##### -->
    </body>
@endsection
@section('scripts')


    <script type="text/javascript">

        $(".update-cart").click(function (e) {
           e.preventDefault();

           var ele = $(this);

            $.ajax({
               url: '{{ url('update-cart') }}',
               method: "patch",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
               success: function (response) {
                   window.location.reload();
               }
            });
        });

        $(".remove-from-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });

    </script>

@endsection