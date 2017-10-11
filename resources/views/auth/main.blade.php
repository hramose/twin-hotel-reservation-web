<!DOCTYPE html>
<html>
    <head>
        <title>Twin Hotel</title>
        <link rel="stylesheet" type="text/css" href="{{URL::to('user/style.css')}}">
    </head>
    <body>
        <header>
            <h1>Twin Lodge</h1>
        </header>
        
        <aside>
            <h2>TARIFF RATES</h2>
            
            <div id="tbl">
                <table>
                    <tr>
                        <td>Single Room</td>
                        <td>800.00</td>
                    </tr>

                    <tr>
                        <td>Family Room</td>
                        <td>1,300.00</td>
                    </tr>

                    <tr>
                        <td>Deluxe Room</td>
                        <td>2,000.00</td>
                    </tr>

                    <tr>
                        <td>Matrimonial Room</td>
                        <td>1,800.00</td>
                    </tr>

                    <tr>
                        <td>Regular Room</td>
                        <td>1,200.00</td>
                    </tr>

                    <tr>
                        <td>Additional Guest</td>
                        <td>150/head</td>
                    </tr>
                </table>
            </div>

             @if(Auth::check())
                @if(Auth::user()->role_id == 2)
                     <div id="main">
                        <a href="{{route('customer_logout')}}">LOG OUT</a>
                    </div>
                @endif
                

            @else
                 <div id="main">
                    <a href="{{route('register')}}">REGISTER</a>
                    <a href="{{route('login')}}">SIGN IN</a>
                    <div class="clearer"></div>
                </div>
            @endif
            
           
        </aside>
        
        <section>
            <nav>
                <a href="{{url('/')}}" class="active">DASHBOARD</a>
                <a href="{{route('rooms')}}" >VIEW ROOMS</a>
                <a href="{{route('tariff')}}" >TARIFF RATES</a>
               
                @if(Auth::check())
                <a href="{{route('customer_activity')}}">MY ACTIVITY</a>
                @endif

            </nav>
            
            <img src="{{URL::to('image/2.png')}}" alt="Backgound Image">
            
            <footer>
                <p id="address"><span>ADDRESS</span> NATIONAL HIGHWAY, TACURENA CITY, SULTAN KUDARAT</p>
                <p id="telno"><span>TELEPHONE:</span> 0909-000-000</p>
            </footer>
        </section>
        
        <div class="clearer"></div>
    </body>
</html>