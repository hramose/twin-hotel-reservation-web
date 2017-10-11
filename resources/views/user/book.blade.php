<!DOCTYPE html>
<html>
    <head>
        <title>Twin Hotel</title>
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::to('user/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::to('user/style2.css')}}">
    </head>
    <body>
        <header>
            <h1>Twin Lodge</h1>
        </header>
        
        <aside>
            
            
            <h2>SELECTED</h2>
            
            <div id="tbl">
                <table>
                    <tr>
                        <td>ROOM TYPE:</td>
                        <td>{{$find->category->category_name}}</td>
                    </tr>

                    <tr>
                        <td>ROOM NUMBER:</td>
                        <td>{{$find->room_number}}</td>
                    </tr>
                </table>
            </div>
            
            @if(Auth::check())
                @if(Auth::user()->role_id == 2)
                     <div id="main">
                        <a href="{{route('customer_logout')}}">LOG OUT</a>
                    </div>
                @endif

              @endif
        </aside>
        
        <section>
            <nav>
                <a href="{{url('/')}}">DASHBOARD</a>
                <a href="{{route('rooms')}}" class="active">VIEW ROOMS</a>
                <a href="{{route('tariff')}}">TARIFF RATES</a>
               
                 @if(Auth::check())
                <a href="{{route('customer_activity')}}">MY ACTIVITY</a>
                @endif
            </nav>
            
           
            
           <?php $id = $_GET['id'];?>
            <div class="panel-body">
                @if(Session::has('yes'))
                    <div class="alert alert-info alert-dismissable">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Information!</strong>{{Session::get('yes')}}
                    </div>
                  @endif

                <div class="col-md-6">
                  <h3 class="text-center">BOOK HERE</h3>
                     <form action="{{route('book_now', ['id'=> $id])}}" method="POST" id="wakoForm">
                         <div class="form-group">
                            <label>Price: {{$find->category->price}}</label>
                        </div>

                        <div class="form-group">
                            <label>Check-in Time: </label>
                            <input type="time" name="check_in_time" class="form-control" required="" id="check_in_time">
                        </div>
                        <div class="form-group">
                            <label>Check-in Date: </label>
                            <input type="date" name="check_in_date" class="form-control" required="" id="check_in_date" min="<?php echo date("Y-m-d"); ?>" >
                        </div>
                        <div class="form-group">
                            <label>Check-out Date: </label>
                            <input type="date" name="check_out_date" class="form-control" required="" id="check_out_date" min="<?php echo date("Y-m-d"); ?>">
                        </div>
                        <div class="form-group">
                            <label>Occupants: {{$find->category->person}}</label>
                            <input type="number" name="occupants_one" placeholder="Additional occupants 150/head" class="form-control" min="0" id="person">
                        </div>
                       
                        
                        <div class="form-group">

                            <label id="web_total"></label><br>
                            <label id="web_total2"></label><br>
                            <label id="web_person"></label><br>
                            <label id="web_total3"></label>
                            <input type="hidden" name="totalprice" id="totalprice">
                            <input type="hidden" name="total_amenity" id="total_amenity">
                            <input type="hidden" name="total_quantity" id="total_quantity">
                            <input type="hidden" name="occupants" id="real_person" value="{{$find->category->person}}">
                        </div>
                        {{csrf_field()}}
                       
                </div>

                <div class="col-md-6">
                  <h3 class="text-center">Add on Amenities</h3>
                  <table class="table">
                    <thead>
                      <th>Name</th>
                      <th>Price</th>
                      <th>Quantity</th>
                    </thead>

                    <tbody>
                      @foreach($ams as $am)
                        <tr>
                          <td>{{$am->amenities_name}}</td>
                          <td class="price">{{$am->price}}</td>
                          <td>
                            <input class="quantity" type="text" name="{{$am->amenities_name}}" value="0" id="{{$am->id}}" >
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
               
                 <button id="sub_total" type="button" class="btn btn-info">TOTAL</button>
                        <button type="button" class="btn btn-primary" id="submitBtn" disabled="">SUBMIT</button>
                    </form>
            </div>
           
        </section>
        
        <div class="clearer"></div>
    </body>
    <script src="{{URL::to('js/jquery.js')}}"></script>
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>
    <script src="{{URL::to('js/sweet.js')}}"></script> 
    <script type="text/javascript">
     @if(Session::has('no'))
           swal("Error", "This room has been occupied by this date of reservation.", "warning");
    @endif
       
    @if(Session::has('ok'))
           swal("Success", "Thank You for booking us.", "success");
    @endif


        $(document).ready(function(){
             var days = 0;
            $("#sub_total").click(function(){
                  var price = {{$find->category->price}};
                  check_in = $("#check_in_date").val();
                  check_out =  $("#check_out_date").val();
                  var date2 = new Date(check_in);
                  var date1 = new Date(check_out);
                  var timeDiff = Math.abs(date1.getTime() - date2.getTime());
                  days = Math.ceil(timeDiff / (1000 * 3600 * 24));
                  var add_occupants = $("#person").val();
                  var person_price = $("#person").val() * 150;
                  var prices = document.querySelectorAll('.price');
                  var quantities = document.querySelectorAll('.quantity');
                  var subTotal= 0;
                  var amenities = '';
                  var quantities2 = '';
                  var real_person = $("#real_person").val();
                  var add_person = $("#person").val();
                  var total_person = parseInt(real_person) + parseInt(add_person);

                  for(var i = 0; i < prices.length; i++) {
                    subTotal += prices[i].innerHTML * quantities[i].value;
                  }

                  for(var i = 0; i < quantities.length; i++) {
                    if (quantities[i].value != 0) {
                      amenities += quantities[i].getAttribute('id') + ' ';
                      quantities2 += quantities[i].value + ' ';
                    }
                  }
                  
               

                  $("#web_total").text("Sub Total: "+days * price);
                  $("#web_total2").text("Additional Amenities: "+subTotal);
                  $("#web_total3").text("Total Payments: "+((days * price) + subTotal + person_price));
                  $("#web_person").text("Additional Occupants: "+add_occupants +" = "+ person_price);
                  $("#totalprice").val(((days * price) + subTotal + person_price) );

                  $("#total_amenity").val(amenities);
                  $("#total_quantity").val(quantities2);
                  $("#real_person").val(total_person);


                  console.log(quantities);
            });

            $("#submitBtn").click(function(){
                if(days > 2){
                    swal("Error", "You are only allowed to stay in 2 days", "warning");
                   
                }else{
                     $("#wakoForm").submit();
                }
            });

            $("#sub_total").click(function(){
              var d = new Date();
              var curDate = d.getFullYear() + "-" +0+parseInt( d.getUTCMonth() + 1 )   + "-" +d.getDate();


              var check_in_time = $("#check_in_time").val();
              var check_in_date = $("#check_in_date").val();
              var check_out_date = $("#check_out_date").val();

              if(check_in_time == "" || check_in_date == "" || check_out_date == ""){
               swal("Error", "All fields are strickly required!", "warning");
                
              }else{
                if(days > 2){
                    swal("Error", "You are only allowed to stay in 2 days", "warning");
                   
                }

                if(curDate > check_in_date){
                  swal("Error", "You are not allowed reserve below present date, Try another date.", "warning");
                }

                $("#submitBtn").removeAttr("disabled");
               
              }

             

            });
          

        });

    </script>
   
</html>