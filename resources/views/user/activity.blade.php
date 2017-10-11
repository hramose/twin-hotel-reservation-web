<!DOCTYPE html>
<html>
    <head>
        <title>Twin Hotel</title>
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::to('user/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::to('user/style2.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::to('user/style5.css')}}">
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
                        <td><a class="active" href="{{route('customer_activity')}}" >ACTIVITY</a></td>
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
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Room Type</th>
                                <th>Room #</th>
                                <th>Date of Transaction</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>  
                        <tbody>
                             @foreach($activity as $act)
                                <tr>
                                    <td>{{$act->room->category->category_name}}</td>
                                    <td>{{$act->room_id}}</td>
                                    <td>{{$act->created_at}}</td>
                                    <td>{{$act->status->status_name}}</td>
                                    <td>
                                        <a href="{{route('customer_activity_view', ['id'=> $act->id])}}" class="btn btn-info btn-xs">View</a>
                                    </td>
                                </tr>
                             @endforeach
                        </tbody>  
                    </table>
                   
                     
                @endif
            </div>
          
           
        </section>
        
        <div class="clearer"></div>
    </body>
    <script src="{{URL::to('js/jquery.js')}}"></script>
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>
   
</html>