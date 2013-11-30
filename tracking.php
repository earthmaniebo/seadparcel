<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Seadparcel</title>
    <?php $page = "tracking" ?>
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
    </script>
</head>
<body>
    <?php include "include/nav.php"; ?>
    <div class="container">
        <?php require_once "controller/guestController.php"; ?>
        <div style="float:left;"><h1>Tracking</h1></div><div style="margin:20px 0 0 630px;"><form class="form-inline" role="form" method="POST" action="tracking.php">
                    <div class="form-group">
                        <input type="text" class="form-control input-lg" id="seadawbnum" name="seadawbnum" placeholder="SEAD-AWB Number">
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg" name="track" onclick="return InputVal();">Track</button>
                    </div>
                </form>
                </div>
        <div style="clear:both;"></div>
        <hr>
        <div class="row">
            <div class="col-md-7 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div style="float: left;">
                        <?php if($viewShipment == null) {?>
                            <strong>SEAD-AWB Number not found.</strong>
                            </div>
                            <div style="clear:both;"></div>
                        <?php } else { ?>
                            <strong>
                                SEAD-AWB Number: <?php echo $viewShipment["seadawbnum"] ?>
                            </strong>
                        </div>
                        <div class="text-right">
                            <strong>
                                Status: <?php echo $viewShipment["status"] ?>
                            </strong>
                        </div>
                        <?php } ?>
                    </div>  
                    <div class="panel-body">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>SEAD-AWB Num:</td>
                                    <?php
                                    if($viewShipment["status"] == 'Received') {
                                        echo "<td>".$viewShipment["seadawbnum"]."</td>";
                                    }
                                    ?>
                                </tr>
                                <tr>
                                    <td>Shipper Name:</td>
                                    <?php
                                    if($viewShipment["status"] == 'Received') {
                                        echo "<td>".$viewShipment["shipperName"]."</td>";
                                    }
                                    ?>
                                </tr>
                                <tr>
                                    <td>Consignee Name:</td>
                                    <?php
                                    if($viewShipment["status"] == 'Received') {
                                        echo "<td>".$viewShipment["conName"]."</td>";
                                    }
                                    ?>
                                </tr>
                                <tr>
                                    <td>Consignee Address:</td>
                                    <?php
                                    if($viewShipment["status"] == 'Received') {
                                        echo "<td>".$viewShipment["conAddress"]."</td>";
                                    }
                                    ?>
                                </tr>
                                <tr>
                                    <td>Date and Time Received:</td>
                                    <?php
                                    if($viewPod != null) {
                                        echo "<td>".$viewPod["dateReceived"]." - ".$viewPod["timeReceived"]."</td>";
                                    }
                                    ?>
                                </tr>
                                <tr>
                                    <td>Received by:</td>
                                    <?php
                                    if($viewPod != null) {
                                        echo "<td>".$viewPod["receivedBy"]."</td>";
                                    }
                                    ?>
                                </tr>
                                <tr>
                                    <td>Relationship to Consignee:</td>
                                    <?php
                                    if($viewPod != null) {
                                        echo "<td>".$viewPod["relToCon"]."</td>";
                                    }
                                    ?>
                                </tr>
                                <tr></tr>
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include"include/footer.php"; ?>
    <?php include "include/bs-script.php"; ?>
</body>
</html>