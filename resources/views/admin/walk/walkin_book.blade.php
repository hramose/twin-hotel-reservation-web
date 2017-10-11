<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Twin Hotel Reservation</title>

    
    <link href="{{URL::to('css/bootstrap.min.css')}}" rel="stylesheet">

   
    <link href="{{URL::to('css/sb-admin.css')}}" rel="stylesheet">

   
    <link href="{{URL::to('css/plugins/morris.css')}}" rel="stylesheet">

 

<style type="text/css">
    #txt{
        font-size: 48px;
    }
    .navbar {
     background: #2c3e50 !important;
   }
   #sides ul {
    background: #2c3e50 !important;
   }
   body {
    background: #2c3e50;
   }
   span{
    font-size: 40px;
   }
</style>

</head>

<body>

    <div id="wrapper">

       
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
           
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" data-toggle="modal" data-target="#test"></a>
            </div>
            
            <ul class="nav navbar-right top-nav">
               
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{Auth::user()->email}} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                       
                        
                        <li>
                            <a href="{{route('admin_profile')}}"><i class="fa fa-fw fa-gear"></i> Profile</a>
                        </li>
                         <li>
                            <a href="{{route('admin_settings')}}"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{route('logout')}}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
           
            <div class="collapse navbar-collapse navbar-ex1-collapse" id="sides">
                <ul class="nav navbar-nav side-nav">
                	
                    <li>
                       <a href="#">
                       		<p class="text-center" style="color: #fff">{{Auth::user()->fname}} {{Auth::user()->lname}}</p>
                       		
                       
                       </a>
                    </li>
                    <li >
                      <a href="{{route('admin_main')}}" ><i class="glyphicon glyphicon-home"></i> Home</a>
                    </li>
                     <li class="active">
                      <a href="{{route('admin_walkin')}}" ><i class="glyphicon glyphicon-home"></i> Walk-in</a>
                    </li>
                    <li >
                      <a href="{{route('admin_rooms')}}" ><i class="glyphicon glyphicon-home"></i> Room Maps</a>
                    </li>
                    <li >
                      <a href="{{route('admin_reports')}}" ><i class="glyphicon glyphicon-th-list"></i> Report</a>
                    </li>
                    
                    <li >
                      <a href="{{route('admin_users')}}" ><i class="glyphicon glyphicon-th-list"></i> Users</a>
                    </li>
                    
                </ul>
            </div>
           
        </nav>

        <div id="page-wrapper">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="text-center">{{$find->category->category_name}} Room # {{$find->room_number}}</h3>
            </div>
            <div class="panel-body">
                @if(Session::has('yes'))
                    <div class="alert alert-info alert-dismissable">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Information!</strong>{{Session::get('yes')}}
                    </div>
                  @endif

                <div class="col-md-6">
                  <h3 class="text-center">BOOK HERE</h3>
                     <form action="{{route('admin_walk_me_yes',['room_no'=> $find->room_number,'customer_id'=> $user->id])}}" method="POST" id="wakoForm">
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
          </div>

        </div>
           

        </div>
       
       

      

    </div>
   

   
    <script src="{{URL::to('js/jquery.js')}}"></script>

    
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>

    <script src="{{URL::to('js/sweet.js')}}"></script> 
    <script type="text/javascript">
     @if(Session::has('no'))
           swal("Error", "Date has been already taken, kindly choose another date.!", "warning");
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
 

</body>

</html>
