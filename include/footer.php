        
        <div class="footer">
        <div class="footerAddress">
            <em><h4>Contact Address</h4></em>
            <p>4113 Kalayaan Avenue<br>Brgy Olympia<br>Makati City</p>
        </div>
        <div class="footerContact">
            <em><h4>Contact Number</h4></em>
            <p>890.63.87<br>890.92.59<br>533.05.96</p>
        </div>
        <div class="footerMap">
            <em><h4>Map</h4></em>
            <div id='googleMap' style='width:500px;height:150px;'>
                <script>
                    var latitude = 14.567889;
                    var longitude = 121.020487;
                    function initialize()
                    {
                     var mapProp = {
                     center: new google.maps.LatLng(latitude,longitude),
                     zoom:16,
                     mapTypeId: google.maps.MapTypeId.ROADMAP
                      };
                      var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
                      
                      marker=new google.maps.Marker({
                      position:new google.maps.LatLng(latitude,longitude),
                      animation:google.maps.Animation.BOUNCE
                      });
                    
                      marker.setMap(map);
                    }
                    
                    function loadScript()
                    {
                      var script = document.createElement("script");
                      script.type = "text/javascript";
                      script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false&callback=initialize";
                      document.body.appendChild(script);
                    }
                    
                    window.onload = loadScript;
                </script>
            </div>
        </div>
        <div class="clear"></div>
    </div>
