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
                     <li >
                      <a href="{{route('admin_walkin')}}" ><i class="glyphicon glyphicon-home"></i> Walk-in</a>
                    </li>
                    <li >
                      <a href="{{route('admin_rooms')}}" ><i class="glyphicon glyphicon-home"></i> Room Maps</a>
                    </li>
                    <li >
                      <a href="{{route('admin_reports')}}" ><i class="glyphicon glyphicon-th-list"></i> Report</a>
                    </li>
                    
                    <li class="active">
                      <a href="{{route('admin_users')}}" ><i class="glyphicon glyphicon-th-list"></i> Users</a>
                    </li>
                    
                </ul>
            </div>
           
        </nav>

        <div id="page-wrapper">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="text-center">Users List</h3>
            </div>
            <div class="panel-body">
              @if(Session::has('cancel'))
                    <div class="alert alert-info alert-dismissable">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Information!</strong>{{Session::get('cancel')}}
                    </div>
                  @endif

               @if(Session::has('paid'))
                    <div class="alert alert-info alert-dismissable">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Information!</strong>{{Session::get('paid')}}
                    </div>
                  @endif   
              
              <ul class="nav nav-tabs">
              <li role="presentation" ><a href="{{route('admin_users')}}">Admin</a></li>
              <li role="presentation" class="active"><a href="{{route('admin_customers')}}">Customer</a></li>
              
            </ul>    
              <div class="col-md-6 col-md-offset-3">
                <form action="{{route('admin_walkin_new')}}" method="POST">
                <div class="form-group {{$errors->has('fname') ? 'has-error': ''}}">
                  <label>First Name</label>
                  <input type="text" name="fname" class="form-control"  maxlength="20">
                  @if($errors->has('fname'))
                    <i class="help-block">{{$errors->first('fname')}}</i>
                  @endif
                </div>
                <div class="form-group {{$errors->has('lname') ? 'has-error': ''}}">
                  <label>Last Name</label>
                  <input type="text" name="lname" class="form-control"  maxlength="20">
                   @if($errors->has('lname'))
                    <i class="help-block">{{$errors->first('lname')}}</i>
                  @endif
                </div>
                <div class="form-group {{$errors->has('username') ? 'has-error': ''}}">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control"  maxlength="20">
                   @if($errors->has('username'))
                    <i class="help-block">{{$errors->first('username')}}</i>
                  @endif
                </div>
                <div class="form-group {{$errors->has('contact') ? 'has-error': ''}}">
                  <label>Contact</label>
                  <input type="text" name="contact" class="form-control"  maxlength="20">
                   @if($errors->has('contact'))
                    <i class="help-block">{{$errors->first('contact')}}</i>
                  @endif
                </div>
                <div class="form-group {{$errors->has('email') ? 'has-error': ''}}">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control"  maxlength="30">
                   @if($errors->has('email'))
                    <i class="help-block">{{$errors->first('email')}}</i>
                  @endif
                </div>
                {{csrf_field()}}
                <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
                 
              </form>
              </div>
            </div>
          </div>

        </div>
           

        </div>
       
       

    </div>
   

   
    <script src="{{URL::to('js/jquery.js')}}"></script>

    
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>

    <script src="{{URL::to('js/sweet.js')}}"></script> 
    

 

</body>

</html>
