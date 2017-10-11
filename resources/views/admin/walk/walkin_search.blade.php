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

                <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#newCustomer">New Walk-In</a>  
               
               <table class="table">
                 <thead>
                   <th>First Name</th>
                   <th>Last Name</th>
                   <th>Username</th>
                   <th>Email</th>
                   <th>Contact</th>
                   <th>Action</th>
                 </thead>
                 <tbody>
                   @foreach($users as $user)
                    <tr>
                      <td>{{$user->fname}}</td>
                      <td>{{$user->lname}}</td>
                      <td>{{$user->username}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->contact}}</td>
                      <td>
                        <a href="{{route('admin_walkin_boow_now', ['room_no'=> $find->room_number, 'customer_id'=> $user->id])}}" class="btn btn-danger btn-xs">BOOK NOW</a>
                      </td>
                    </tr>
                   @endforeach
                 </tbody>
               </table> 


                
              
            </div>
          </div>

        </div>
           

        </div>
       
       

      <div class="modal fade" id="newCustomer">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="text-center">Enter New Customer Informations</h3>
            </div>
            <div class="modal-body">
              <form action="{{route('admin_walkin_new')}}" method="POST">
                <div class="form-group">
                  <label>First Name</label>
                  <input type="text" name="fname" class="form-control" required="" maxlength="20">
                </div>
                <div class="form-group">
                  <label>Last Name</label>
                  <input type="text" name="lname" class="form-control" required="" maxlength="20">
                </div>
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control" required="" maxlength="20">
                </div>
                <div class="form-group">
                  <label>Contact</label>
                  <input type="text" name="contact" class="form-control" required="" maxlength="20">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" required="" maxlength="30">
                </div>
                {{csrf_field()}}
                <button type="submit" class="btn btn-primary">SUBMIT</button>
                 <button type="submit" class="btn btn-default">CLEAR</button>
              </form>
            </div>
          </div>
        </div>
      </div> 

    </div>
   

   
    <script src="{{URL::to('js/jquery.js')}}"></script>

    
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>

    
 

</body>

</html>
