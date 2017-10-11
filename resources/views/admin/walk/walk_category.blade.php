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
              <h3 class="text-center">{{$find->category_name}} Room</h3>
            </div>
            <div class="panel-body">
             

                  @foreach($cats as $cat)
                 
                    <div class="col-md-4">
                      <div class="panel panel-danger">
                        <div class="panel-heading">
                         <a href="{{route('admin_walkin_book', ['room_no'=> $cat->room_number])}}"> Room: {{$cat->room_number}}</a>
                        </div>
                        <div class="panel-body">
                          Reserve:  <a href="{{route('admin_reserve_view_modal', ['id'=> $cat->id])}}" class="badge">{{$cat->reserve($cat->room_number)}}</a>

                          Occupied: <a href="{{route('admin_walk_checkin_view', ['id'=> $cat->room_number])}}" class="badge">{{$cat->occupied($cat->room_number)}}</a>
                          
                        </div>
                      </div>
                      
                    </div>
                 
                   
                  @endforeach 
              
            </div>
          </div>

        </div>
           

        </div>
       
       
     
          
    </div>
   

   
    <script src="{{URL::to('js/jquery.js')}}"></script>

    
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>

   

</body>

</html>
