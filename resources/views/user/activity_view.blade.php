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
                    <tr >
                        <td><a href="{{route('customer_activity')}}" >ACTIVITY</a></td>
                        <td><a href="{{route('customer_setting')}}">SETTINGS</a></td>
                    </tr>

                    <tr>
                        <td><a href="{{route('customer_profile')}}">PROFILE</a></td>
                        <td></td>
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
                <a href="{{route('rooms')}}" >VIEW ROOMS</a>
                <a href="{{route('tariff')}}">TARIFF RATES</a>
                
                 @if(Auth::check())
                <a href="{{route('customer_activity')}}" class="active">MY ACTIVITY</a>
                @endif
            </nav>
            
           
            <div class="col-md-12">
                <h1 class="text-center">ACTIVITY LIST</h1>
                @if(Auth::user()->role_id == 2)
                <div class="row">
                        <div class="col-md-6">
                          <ul class="list-group">
                              <li class="list-group-item">Name: {{$find->user->fname}} {{$find->user->lname}}</li>
                              <li class="list-group-item">Room Type:{{$find->room->category->category_name}} </li>
                              <li class="list-group-item">Room No#: {{$find->room_id}}</li>
                              <li class="list-group-item">Price: {{$find->room->category->price}}</li>
                              <li class="list-group-item">Number of Days: {{$days}}</li>
                              <li class="list-group-item">Additional Occupants : {{$find->occupants - $find->room->category->person}} </li>
                            </ul>

                         
                       </div>

                         <div class="col-md-6">
                            <ul class="list-group">
                              <li class="list-group-item">Bill: {{$find->bill}}</li>
                              
                              <li class="list-group-item">Check-in-time: {{$find->check_in_time}}</li>
                              <li class="list-group-item">Check-in-date: {{$find->check_in}}</li>
                              <li class="list-group-item">Check-out-date: {{$find->check_out}}</li>
                              
                              
                            </ul>

                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th>Amenity Name</th>
                                  <th>Price</th>
                                  <th>Quantity</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($amenities as $am)
                                <tr>
                                  <td>{{$am->amenity->amenities_name}}</td>
                                  <td>{{$am->amenity->price}}</td>
                                  <td>{{$am->quantity}}</td>

                                </tr>
                              @endforeach
                              </tbody>
                            </table>

                         </div>

                  </div>   
                  <div class="row">
                      <div class="col-md-12">
                           @if(Session::has('ok'))
                            <div class="alert alert-success alert-dismissable">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              {{Session::get('ok')}}
                            </div>
                          @endif
                          <form action="{{route('customer_payment', ['id'=> $find->id])}}" method="POST" enctype="multipart/form-data">
                              <div class="form-group {{$errors->has('proof') ? 'has-error': ''}}">
                                  <label>Upload Proof of Payment</label>
                                  <input type="file" name="proof" class="form-control">
                              </div>
                              {{csrf_field()}}
                              <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
                          </form>

                          <div style="margin-top: 30px">
                              
                            @if($find->proof)
                               <img src="data:image/png;base64,{{$find->proof->image}}">
                            @else
                                <h3 class="text-center">No Proof of Payment yet</h3>
                            @endif
                           </div>
                      </div>
                      
                  </div>          
                   
                     
                @endif
            </div>
          
           
        </section>
        
        <div class="clearer"></div>
    </body>
    <script src="{{URL::to('js/jquery.js')}}"></script>
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>
   
</html>