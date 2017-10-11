<!DOCTYPE html>
<html>
    <head>
        <title>Twin Hotel</title>
        <link rel="stylesheet" type="text/css" href="{{URL::to('user/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::to('user/style4.css')}}">
    </head>
    <body>
        <header>
            <h1>Twin Lodge</h1>
        </header>
        
        <aside>
            <div id="tbl">
                <table>
                    <tr>
                        <td><img src="not-found.img" alt="Background Image"></td>
                        <td>Single Room</td>
                    </tr>

                    <tr>
                        <td><img src="not-found.img" alt="Background Image"></td>
                        <td>Family Room</td>
                    </tr>

                    <tr>
                        <td><img src="not-found.img" alt="Background Image"></td>
                        <td>Deluxe Room</td>
                    </tr>

                    <tr>
                        <td><img src="not-found.img" alt="Background Image"></td>
                        <td>Matrimonial Room</td>
                    </tr>

                    <tr>
                        <td><img src="not-found.img" alt="Background Image"></td>
                        <td>Regular Room</td>
                    </tr>

                    <tr>
                        <td><img src="not-found.img" alt="Background Image"></td>
                        <td>Additional Guest</td>
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
               <a href="{{url('/')}}" >DASHBOARD</a>
                <a href="{{route('rooms')}}" >VIEW ROOMS</a>
                <a href="{{route('tariff')}}" >TARIFF RATES</a>
                <a href="{{route('amenities')}}" class="active">AMENITIES</a>
                 @if(Auth::check())
                <a href="{{route('customer_activity')}}">MY ACTIVITY</a>
                @endif
            </nav>
            
            <h1>SINGLE ROOM</h1>
            
            <div>
                <p>AMENITIES:</p>
                <p>
                    Non-air condition room <br>
                    Free bath soap <br>
                    Blanket <br>
                    Towerl
                </p>
            </div>
        </section>
        
        <div class="clearer"></div>
    </body>
</html>