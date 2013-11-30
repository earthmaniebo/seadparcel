<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Seadparcel</title>
    <?php $page = "index" ?>
    <?php include "include/headtags.php"; ?>
    <script type="text/javascript">
        function InputVal() {
            var seadawbnum = document.getElementById("seadawbnum").value;
            var numbers = /[^0-9]/g;

            var result = numbers.test(seadawbnum);
            
            if(seadawbnum == "") {
                alert("SEAD-AWB Number field is empty.");
                return false;
            }

            else if(result) {
                alert("Letters and specials characters are not allowed in SEAD-AWB Number.");
                return false;
            }

            else if(seadawbnum.length < 6 || seadawbnum.length > 8) {
                alert("SEAD-AWB Number should be between 6-8 numbers.");
                return false;
            }
        }

        function InputVal2() {
            var name = document.getElementById("inputName");
            var email = document.getElementById("inputEmail");
            var subject = document.getElementById("inputSubject");
            var comments = document.getElementById("inputComments");

            if(name.value == "" || email.value == "" || comments.value == "") {
                alert("Please fill in all the required fis.");
                return false;
            }
        }
    </script>
    <link rel="stylesheet" href="css/themes/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/themes/light/light.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/themes/dark/dark.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/themes/bar/bar.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
</head>
<body>
    <?php include "include/nav.php"; ?>
    <div class="container">
    <?php require_once "controller/guestController.php"; ?>
    <?php if($isSent == true) { ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Thank you for your comments and suggestions.</strong>
                </div>
    <?php } ?>
    <?php if(isset($_SESSION["admin"]) || isset($_SESSION["dataAnalyst"])) header("Location: login.php"); ?>  
        <div id="wrapper">
            <div class="slider-wrapper theme-default">
                <div id="slider" class="nivoSlider">
                    <img src="img/slider/responsibility.jpg" data-thumb="images/toystory.jpg" alt=""/>
                    <img src="img/slider/services_offered.jpg" data-thumb="images/up.jpg" alt="" />
                    <img src="img/slider/serve.jpg" data-thumb="images/walle.jpg" alt="" data-transition="slideInLeft" />
                    <img src="img/slider/quality_service_2.jpg" data-thumb="images/nemo.jpg" alt=""/>
                </div>
            </div>
        </div>
            <div class="content-right">
                <div class="tracking">
                <h1 class="text-center">Track and Trace</h1>
                    <form class="form-inline" role="form" method="POST" action="tracking.php">
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" id="seadawbnum" name="seadawbnum" placeholder="SEAD-AWB Number">
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg" name="track" onclick="return InputVal();">Track</button>
                        </div>
                    </form>
                </div>
                <br><br>
                <div class="trackingText" style="width:350px" ><p align="justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec placerat non eros sed vestibulum. Morbi eu nibh facilisis, pellentesque tellus sit amet, congue diam. Morbi eleifend ipsum nec volutpat dictum. Suspendisse potenti. Vestibulum ac euismod nunc. Nam eleifend, dui vel venenatis ultricies, lacus tellus lacinia est, id pellentesque neque mi a nisi. Morbi malesuada ut neque ac mattis. Ut hendrerit eleifend cursus. </p>

                <p align="justify">Suspendisse eget dolor eget ipsum condimentum lacinia sit amet sit amet urna. Nulla a pretium lacus. Sed hendrerit tincidunt posuere. Suspendisse potenti. Vestibulum convallis mauris mi. Donec aliquam mollis libero et pulvinar.</p></div>
            </div>
            <div class="clear"></div>
            <div class="company-profile">
                <h2 class="text-center">Company Profile</h2>
                <p>SEAD PARCEL SERVICES is a full service in logistics firm with worldwide Courier and Freight Cargo services based in Manila, Philippines. We are an aggressive, organized, high professional field personnel and proactive goal. Our goal will always be provide safe,  on time and quality services to build customer partnership by “doing it right”  the first time.</p>

<p align="center">Furthermore, we are most reliable in courier services and freight cargo forwarding with immediate response time and very competitive rates.</p>

<p align="center">Having served big and small firms, we have a built reputation for speed and reliability while adhering to the specific needs of our customers.</p>

<p align="center">Our current clients have come to appreciate our honesty and work ethic with the help of our positively minded team of professionals that takes pride in providing the highest level of operational efficiency, integrity, high quality performance and customer responsive.</p>

<p align="center">With an eye of the future, we continually strive to improve communications with the courier and the forwarding industry to easily monitor shipments from port of origin until reach its final destination. We are equipped with the latest IT system to update our clients and monitor every shipment of the clients.</p>

<p align="center">With the experienced staff of our agents and counterparts around the world, we have intimate knowledge of local markets and conditions. We are ready to offer expert advice in every aspect of shipping and cargo handling operations ensuring your documents, parcels and cargo shipments reaches its destination on time.</p>

<p align="center">Our goal is to exceed our customers’ expectations by ensuring quality service and excellence performance in every aspect of our business. We do providing complete global logistics services and multi-model transportations for our customers.</p>

<p align="center">By placing emphasis on employee satisfaction, we will ensure our success in market leadership, shareholder value and most importantly, customer satisfaction service, reliability and quality service are the keystones on SEAD PARCEL SERVICES.</p>
            </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Contact Us</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="POST" action="index.php">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Full Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="name" placeholder="Full Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSubject" class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSubject" name="subject" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputComments" class="col-sm-2 control-label">Comments</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" rows="5" id="inputComments" name="comments" placeholder="Your comments here.."></textarea>
                        </div>
                    </div>
            </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="send" onclick="return InputVal2();">Send</button>
        </form>
        </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    <?php include "include/footer.php"; ?>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
</body>
</html>