<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Data Analyst | My Clients</title>
    <?php include "../include/headtags.php"; ?>
    <?php $page = "my-clients" ?>
</head>
<body>
    <?php include "../include/nav-data-analyst.php"; ?>
    <div class="container">
        <?php require_once "controller/clientController.php" ?>
        <div class="row">
            <div class="col-md-12">
                <h2>My Clients</h2>
                <hr>
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <form class="form-inline pull-right" role="form" action="my-clients.php" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" id="inputSearch" placeholder="Search" name="search">
                            </div>
                            <button type="submit" class="btn btn-default" name="searchButton">
                                <span class="glyphicon glyphicon-search"></span> Search
                            </button>
                        </form>
                        <div class="clearfix"></div>                 
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th class="text-center">Client ID</th>
                                    <th class="text-center">Company Name</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Contact Number</th>
                                    <th class="text-center">Contact Person</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($selectMyClient as $row) { ?>
                                <tr>
                                    <td class="client text-center"><?php echo $row["clientID"] ?></td>
                                    <td class="client text-center"><?php echo $row["name"] ?></td>
                                    <td class="client text-center"><?php echo $row["cAddress"] ?></td>
                                    <td class="client text-center"><?php echo $row["contactNum"] ?></td>
                                    <td class="client text-center"><?php echo $row["contactPerson"] ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="footer" style="margin: 70px 0 -40px 0;">
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

    <?php include "../include/bs-script.php"; ?>
</body>
</html>