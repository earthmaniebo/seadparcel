<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php include "../include/headtags.php"; ?>
    <script type="text/javascript">
        function InputVal() {
            var seadawbnum = document.getElementById('inputSEAD-AWB');
            var refNum = document.getElementById('inputRefNum');
            var shipperName = document.getElementById('inputShipperName');
            var conName = document.getElementById('inputConName');
            var conAddress = document.getElementById('inputConAddress');
            var state = document.getElementById('inputState');
            var conContactNum = document.getElementById('inputConContactNum');
            var descOfGoods = document.getElementById('inputDGoods');
            var totalWeight = document.getElementById('inputTotalWeight');
            var remarks = document.getElementById('inputRemarks');

            var freightCharge = document.getElementById('inputFreightCharge');
            var addOnCharge = document.getElementById('inputAddOnCharge');
            var cratingCharge = document.getElementById('inputCratingCharge');
            var osaCharge = document.getElementById('inputOsaCharge');
            var valuationCharge = document.getElementById('inputValuationCharge');

            var numbers = /[^0-9]/g;
            var floating = /[^0-9,.]/g;
            var result3 = numbers.test(seadawbnum.value);
            var result4 = numbers.test(refNum.value);
            var result5 = floating.test(totalWeight.value);

            var result6 = floating.test(freightCharge.value);
            var result7 = floating.test(addOnCharge.value);
            var result8 = floating.test(cratingCharge.value);
            var result9 = floating.test(osaCharge.value);
            var result10 = floating.test(valuationCharge.value);

            if(result3) {
                alert("Letters and specials characters are not allowed in SEAD-AWB Number.");
                return false;
            }
            if(seadawbnum.value.length < 6 || seadawbnum.value.length > 8) {
                alert("SEAD-AWB Number should be between 6-8 numbers.");
                return false;
            }

            if(result5) {
                alert("Letters and specials characters are not allowed in Total Weight.");
                return false;
            }

            if(result6) {
                alert("Letters and specials characters are not allowed in Freight Charge.");
                return false;
            }

            if(result7) {
                alert("Letters and specials characters are not allowed in Add-on Charge.");
                return false;
            }

            if(result8) {
                alert("Letters and specials characters are not allowed in Crating Charge.");
                return false;
            }

            if(result9) {
                alert("Letters and specials characters are not allowed in OSA Charge.");
                return false;
            }

            if(result10) {
                alert("Letters and specials characters are not allowed in Valuation Charge.");
                return false;
            }

            if(seadawbnum.value == "" || refNum.value == "" || shipperName.value == "" || conName.value == "" || conAddress.value == "" || state.value == "" || conContactNum.value == "" || descOfGoods.value == "" || totalWeight.value == "" || remarks.value == "") {
                alert("Please fill in all the required fields.");
                return false;
            }
        }

        function sum() {
            var txt1 = document.getElementById('inputFreightCharge').value;
            var txt2 = document.getElementById('inputAddOnCharge').value;
            var txt3 = document.getElementById('inputCratingCharge').value;
            var txt4 = document.getElementById('inputOsaCharge').value;
            var txt5 = document.getElementById('inputValuationCharge').value;
            var result = parseFloat(txt1) + parseFloat(txt2) + parseFloat(txt3) + parseFloat(txt4) + parseFloat(txt5);
            if (!isNaN(result)) {
                document.getElementById('inputTotalCharge').value = result;
            }
        }

        function addDecimal(id) {
            var txt = document.getElementById(id).value;
            var temp = txt.substring(txt.indexOf("."), txt.length);
            if(txt == "") {
                document.getElementById(id).value = "0.00";
            }

            else if(txt.indexOf(".") != -1 && temp.length == 2) {
                var convert = txt + "0";
                document.getElementById(id).value = convert;
            }

            else if(txt.indexOf(".") == -1) {
                var convert = txt + ".00";
                document.getElementById(id).value = convert;
            }
        }

        function chooseShipper(data) {
            document.getElementById("inputShipperName").value = data.options[data.selectedIndex].text
        }
    </script>
    <title>Data Analyst | Edit Transaction</title>
    
    <?php $page = "edit-transaction" ?>
</head>
<body>
    <?php include "../include/nav-data-analyst.php"; ?>
    <div class="container">
        <?php require_once "controller/dataAnalystController.php"; ?>
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" role="form" method="POST" action="edit-transaction.php">
                 <input type='hidden' name='shipmentID' value='<?php echo $shipmentID ?>'>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Shipment Details
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputCompany" class="col-sm-4 control-label">Company</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="clientID" id="inputClient" onchange="chooseShipper(this)">
                                                <option value="<?php echo $originalClient['clientID']?>"><?php echo $originalClient['name']?></option>
                                                <?php foreach($selectMyClient as $row) { ?>
                                                <option value="<?php echo $row['clientID']?>" text="<?php echo $row['name']?>"><?php echo $row['name']?></option>";
                                                <?php } ?>
                                            </select></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputSEAD-AWB" class="col-sm-4 control-label">SEAD-AWB No.</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" id="inputSEAD-AWB" name="seadawbnum" placeholder="SEAD-AWB No." value="<?php echo $selectShipment['seadawbnum']?>"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputRefNum" class="col-sm-4 control-label">Reference No.</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" id="inputRefNum" name="refNum" placeholder="Reference No." value="<?php echo $selectShipment['refNum']?>"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputShipperName" class="col-sm-4 control-label">Shipper Name</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" id="inputShipperName" name="shipperName" placeholder="Shipper Name" value="<?php echo $selectShipment['shipperName']?>"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputConName" class="col-sm-4 control-label">Consignee Name</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" id="inputConName" name="conName" placeholder="Consignee Name" value="<?php echo $selectShipment['conName']?>"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDesignation" class="col-sm-4 control-label">Designation</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" id="inputDesignation" name="designation" placeholder="Designation" value="<?php echo $selectShipment['designation']?>"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputConAddress" class="col-sm-4 control-label">Consignee Address</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" id="inputConAddress" name="conAddress" placeholder="Consignee Address" value="<?php echo $selectShipment['conAddress']?>"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputstate" class="col-sm-4 control-label">City / State / Province</label>
                                            <div class="col-sm-7"><input type="text" class="form-control" id="inputState" name="state" placeholder="City / State / Province" value="<?php echo $selectShipment['state']?>"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputConContactNum" class="col-sm-4 control-label">Consignee Contact #</label>
                                            <div class="col-sm-7"><input type="text" class="form-control" id="inputConContactNum" name="conContactNum" placeholder="Consignee's Contact No."  value="<?php echo $selectShipment['conContactNum']?>"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPickUpDate" class="col-sm-4 control-label">Pick-up Date</label>
                                            <div class="col-sm-7"><input type="date" class="form-control" id="inputPickUpDate" name="pickUpDate" placeholder="Description of Goods" value="<?php echo $selectShipment['pickUpDate']?>"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDGoods" class="col-sm-4 control-label">Description of Goods</label>
                                            <div class="col-sm-7"><input type="text" class="form-control" id="inputDGoods" name="descOfGoods" placeholder="Description of Goods"  value="<?php echo $selectShipment['descOfGoods']?>"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputWeight" class="col-sm-4 control-label">Total Weight</label>
                                            <div class="col-sm-7"><input type="text" class="form-control" id="inputTotalWeight" name="totalWeight" placeholder="Total Weight"  value="<?php echo $selectShipment['totalWeight']?>" onblur="addDecimal('inputTotalWeight');" ></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputRemarks" class="col-sm-4 control-label">Remarks</label>
                                            <div class="col-sm-7"><input type="text" class="form-control" id="inputRemarks" name="remarks" placeholder="Remarks" value="<?php echo $selectShipment['remarks']?>"></div>
                                        </div>
                                        <center><div class="form-group">
                                            <button type="submit" class="btn btn btn-success" name="updateButton" onclick="return InputVal();"><span class="glyphicon glyphicon-refresh"></span> Update</button>
                                            <a class="btn btn btn-danger" href="transactions.php">Cancel</a>
                                        </div></center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Proof of Delivery Details
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputReceivedBy" class="control-label col-sm-5">Received By</label>
                                            <div class="col-sm-7"><input type="text" class="form-control" id="inputReceivedBy" name="receivedBy" placeholder="Received By" <?php if($hasPod == "Y") ?> value="<?php echo $selectPod['receivedBy'] ?>"></div>
                                        </div><br><br>
                                        <div class="form-group">
                                            <label for="inputDateReceived" class="control-label col-sm-5">Date Received</label>
                                            <div class="col-sm-7"><input type="date" class="form-control" id="inputDateReceived" name="dateReceived" <?php if($hasPod == "Y") ?> value="<?php echo $selectPod['dateReceived'] ?>"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputTimeReceived" class="control-label col-sm-5">Time Received</label>
                                            <div class="col-sm-6"><input type="time" class="form-control" id="inputTimeReceived" name="timeReceived" <?php if($hasPod == "Y") ?> value="<?php echo $selectPod['timeReceived'] ?>"></div>
                                        </div><br><br>
                                        <div class="form-group">
                                            <label for="inputRelToCon" class="control-label col-sm-5">Relationship</label>
                                            <div class="col-sm-6"><input type="text" class="form-control" id="inputRelToCon" name="relToCon" placeholder="To Consignee" <?php if($hasPod == "Y") ?> value="<?php echo $selectPod['relToCon'] ?>"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="inputPODremarks" class="control-label col-sm-1">Remarks</label>
                                            <div class="col-sm-10 col-sm-offset-1"><input type="text" class="form-control" id="inputPODremarks" name="remarksPod" placeholder="Remarks" <?php if($hasPod == "Y") ?> value="<?php echo $selectPod['remarksPod'] ?>"></div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Billing Details
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <center><label for="inputFreightCharge" class="control-label">Freight</label></center>
                                            <input type="text" class="form-control" id="inputFreightCharge" name="freightCharge" placeholder="Charge" onkeyup="sum();" <?php if($hasBilling == "Y") ?> value="<?php echo $selectBilling['freightCharge'] ?>" onblur="addDecimal('inputFreightCharge');">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <center><label for="inputAddOnCharge" class="control-label">Add-on</label></center>
                                            <input type="text" class="form-control" id="inputAddOnCharge" name="addOnCharge" placeholder="Charge" onkeyup="sum();" <?php if($hasBilling == "Y") ?> value="<?php echo $selectBilling['addOnCharge'] ?>" onblur="addDecimal('inputAddOnCharge');">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <center><label for="inputCratingCharge" class="control-label">Crating</label></center>
                                            <input type="text" class="form-control" id="inputCratingCharge" name="cratingCharge" placeholder="Charge" onkeyup="sum();" <?php if($hasBilling == "Y") ?> value="<?php echo $selectBilling['cratingCharge'] ?>" onblur="addDecimal('inputCratingCharge');">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <center><label for="inputOsaCharge" class="control-label">OSA / ODA</label></center>
                                            <input type="text" class="form-control" id="inputOsaCharge" name="osaCharge" placeholder="Charge" onkeyup="sum();" <?php if($hasBilling == "Y") ?> value="<?php echo $selectBilling['osaCharge'] ?>" onblur="addDecimal('inputOsaCharge');">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <center><label for="inputValuationCharger" class="control-label">Valuation</label></center>
                                            <input type="text" class="form-control" id="inputValuationCharge" name="valuationCharge" placeholder="Charge" onkeyup="sum();" <?php if($hasBilling == "Y") ?> value="<?php echo $selectBilling['valuationCharge'] ?>" onblur="addDecimal('inputValuationCharge');">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <center><label for="inputTotalCharger" class="control-label">TOTAL</label></center>
                                            <input type="text" class="form-control" id="inputTotalCharge" name="totalCharge" placeholder="CHARGE" onkeyup="sum();" <?php if($hasBilling == "Y") ?> value="<?php echo $selectBilling['totalCharge'] ?>" onblur="addDecimal('inputTotalCharge');">
                                        </div>
                                    </div>
                                </div>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div></form>
    </div>
    <?php include"../include/footer.php"; ?>
    <?php include "../include/bs-script.php"; ?>
</body>
</html>