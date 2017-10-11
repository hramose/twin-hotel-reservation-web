<!DOCTYPE html>
<html>
    <head>
        <title>Twin Hotel</title>

        <link rel="stylesheet" type="text/css" href="{{URL::to('user/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::to('user/style2.css')}}">

        <style>
            ul {
                list-style-type: none;
                width: 420px;
                margin: 0 auto;   
            }

            ul:after {
                content: "";
                display: block;
                clear: both;
            }

            ul a {
                color: #fff;
                text-decoration: none;
                display: block;
                padding: 20px;
            }

            ul li {
                background-color: #3498db;
                text-align: center;
                float: left;
                box-sizing: border-box;
                width: 200px;
                border: solid #000 5px;
                border-radius: 5px;
                margin: 5px;
            }

            #desc {
                display: none;
            }
        </style>
    </head>
    <body>
        <header>
            <h1>Twin Lodge</h1>
        </header>
        
        <aside>
            <select name="cat_room" id="cat_room">
                <option value="">Select Room Category</option>
                @foreach($cat_rooms as $one)
                    <option value="{{$one->id}}" id="{{$one->id}}">{{$one->category_name}}</option>
                @endforeach
            </select>


            <div id="desc">
                <h2>DESCRIPTION</h2>
                
                <div id="tbl">
                   
                    <table>
                        <tr>
                            <td>CAPACITY:</td>
                            <td id="person_num">1 PERSON</td>
                        </tr>

                        <tr>
                            <td>ROOM RATE:</td>
                            <td id="price">800.00</td>
                        </tr>
                    </table>
                </div>
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
            
            <h1>List of Rooms</h1>
            
            <ul id="rooms">

            </ul>
        </section>
        
        <div class="clearer"></div>
    </body>
    <script src="{{URL::to('js/jquery.js')}}"></script>
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>
    <<script type="text/javascript">
        $(document).ready(function(){
            $("#cat_room").change(function(){
                var aw = $("#cat_room").val();
                var token = '{{Session::token()}}';
                var url = '{{route('get_rooms')}}';
                
                $.ajax({
                    method: 'POST',
                    url: url,
                    data: {id: aw, _token : token},

                })
                .done(function(msg){
                    if(msg['category'] == null)
                        document.querySelector("#desc").style.display = "none";
                    else
                        document.querySelector("#desc").style.display = "block";

                    var person = document.querySelector('#person_num');
                    var price = document.querySelector('#price');
                    
                    person.innerHTML = msg['category']['person'];
                    price.innerHTML = msg['category']['price'];

                    var roomList = document.querySelector('#rooms');
                    roomList.innerHTML = "";

                    for(var i = 0; i < msg['rooms'].length; i++) {
                        var li = document.createElement('li');
                        var a = document.createElement('a');
                        var aCont = document.createTextNode(msg['rooms'][i]['room_number']);

                        a.setAttribute('href', "{{route('tambook')}}?id="+msg['rooms'][i]['id']);
                        a.appendChild(aCont);
                        li.appendChild(a);
                        roomList.appendChild(li);
                    }
                });

                var changeBg = document.querySelector('section');
                changeBg.style.background = 'url(../image/' + aw + '.png)';
                changeBg.style.backgroundSize = 'cover';
            });
        });
    </script>
</html>