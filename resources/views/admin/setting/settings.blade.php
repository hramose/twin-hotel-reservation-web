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
                     
                    <li >
                      <a href="{{route('admin_users')}}" ><i class="glyphicon glyphicon-th-list"></i> Users</a>
                    </li>
                    
                </ul>
            </div>
           
        </nav>

        <div id="page-wrapper">
         <div class="panel panel-primary">
           <div class="panel-heading">
             <h3 class="text-center">Admin Settings</h3>
           </div>
           <div class="panel-body">
             <div class="col-md-6 col-md-offset-3">
                @if(Session::has('change'))
                            <div class="alert alert-success">
                              
                              {{Session::get('change')}}
                            </div>
                          @endif
                 @if(Session::has('no'))
                            <div class="alert alert-danger">
                              
                              {{Session::get('no')}}
                            </div>
                          @endif          
               <form action="{{route('admin_password_change')}}" method="POST">
                <div class="form-group {{$errors->has('old_password') ? 'has-error': ''}}">
                   <label>Old Password</label>
                   <input type="password" name="password" class="form-control">
                   @if($errors->has('old_password'))
                    <i class="help-block">{{$errors->first('old_password')}}</i>
                   @endif
                 </div>

                 <div class="form-group {{$errors->has('new_password') ? 'has-error': ''}}">
                   <label>New Password</label>
                   <input type="password" name="new_password" class="form-control">
                   @if($errors->has('new_password'))
                    <i class="help-block">{{$errors->first('new_password')}}</i>
                   @endif
                 </div>
                 <div class="form-group {{$errors->has('retype_password') ? 'has-error': ''}}">
                   <label>Re-type Password</label>
                   <input type="password" name="retype_password" class="form-control">
                    @if($errors->has('retype_password'))
                    <i class="help-block">{{$errors->first('retype_password')}}</i>
                   @endif
                 </div>

                 {{csrf_field()}}
                 <button type="submit" class="btn btn-primary">SUBMIT</button>
               </form>
             </div>
           </div>
         </div>
        </div>
           

        </div>
       
       

    </div>
   

   
    <script src="{{URL::to('js/jquery.js')}}"></script>

    
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>

    
 

</body>

</html>
