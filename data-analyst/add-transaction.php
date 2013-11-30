<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../include/headtags.php"; ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
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

            var numbers = /[^0-9]/g;
            var floating = /[^0-9,.]/g;
            var result3 = numbers.test(seadawbnum.value);
            var result4 = numbers.test(refNum.value);
            var result5 = floating.test(totalWeight.value);


            if(seadawbnum.value == "" || refNum.value == "" || shipperName.value == "" || conName.value == "" || conAddress.value == "" || state.value == "" || conContactNum.value == "" || descOfGoods.value == "" || totalWeight.value == "" || remarks.value == "") {
                alert("Please fill in all the required fields.");
                return false;
            }

            if(seadawbnum.value.length < 6 || seadawbnum.value.length > 8) {
                alert("SEAD-AWB Number should be between 6-8 numbers.");
                return false;
            }

            if(result3) {
                alert("Letters and specials characters are not allowed in SEAD-AWB Number.");
                return false;
            }
            
            if(result5) {
                alert("Letters and specials characters are not allowed in Total Weight.");
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
    <title>Data Analyst | Add Transaction</title>
    <?php $page = "add-transaction" ?>
</head>
<body>
    <?php include "../include/nav-data-analyst.php"; ?>
    <div class="container">
        <?php require_once "controller/dataAnalystController.php"; ?>
        <div class="row">
            <div class="col-md-12">
                <?php if($isAdded) { ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Transaction was successfully added.</strong>
                </div>
                <?php } ?>
                <form class="form-horizontal" role="form" method="POST" action="add-transaction.php">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <strong>Shipment Details</strong>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputCompany" class="col-sm-4 control-label">Company</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="clientID" id="inputClient" onchange="chooseShipper(this)">
                                                <option value=""></option>
                                                <?php foreach($selectMyClient as $row) { ?>
                                                <option value="<?php echo $row['clientID']?>" text="<?php echo $row['name']?>"><?php echo $row['name']?></option>";
                                                <?php } ?>
                                            </select></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputSEAD-AWB" class="col-sm-4 control-label">SEAD-AWB No.</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" id="inputSEAD-AWB" name="seadawbnum" placeholder="SEAD-AWB No."></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputRefNum" class="col-sm-4 control-label">Reference No.</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" id="inputRefNum" name="refNum" placeholder="Reference No."></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputShipperName" class="col-sm-4 control-label">Shipper Name</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" id="inputShipperName" name="shipperName" placeholder="Shipper Name"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputConName" class="col-sm-4 control-label">Consignee Name</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" id="inputConName" name="conName" placeholder="Consignee Name"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDesignation" class="col-sm-4 control-label">Designation</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" id="inputDesignation" name="designation" placeholder="Designation"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputConAddress" class="col-sm-4 control-label">Consignee Address</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" id="inputConAddress" name="conAddress" placeholder="Consignee Address"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label for="inputstate" class="col-sm-4 control-label">City / State / Province</label>
                                            <div class="col-sm-7"><input type="text" class="form-control" id="inputState" name="state" placeholder="City / State / Province"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputConContactNum" class="col-sm-4 control-label">Consignee Contact #</label>
                                            <div class="col-sm-7"><input type="text" class="form-control" id="inputConContactNum" name="conContactNum" placeholder="Consignee's Contact No."></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPickUpDate" class="col-sm-4 control-label">Pick-up Date</label>
                                            <div class="col-sm-7"><input type="date" class="form-control" id="inputPickUpDate" name="pickUpDate" placeholder="Description of Goods"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDGoods" class="col-sm-4 control-label">Description of Goods</label>
                                            <div class="col-sm-7"><input type="text" class="form-control" id="inputDGoods" name="descOfGoods" placeholder="Description of Goods"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputWeight" class="col-sm-4 control-label">Total Weight</label>
                                            <div class="col-sm-7"><input type="text" class="form-control" id="inputTotalWeight" name="totalWeight" placeholder="Total Weight" onblur="addDecimal('inputTotalWeight');"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputRemarks" class="col-sm-4 control-label">Remarks</label>
                                            <div class="col-sm-7"><input type="text" class="form-control" id="inputRemarks" name="remarks" placeholder="Remarks"></div>
                                        </div>
                                        <center><button type="submit" class="btn btn-success" name="addShipment" onclick="return InputVal();"><span class="glyphicon glyphicon-plus-sign"></span> Add</button>
                                            <a class="btn btn btn-danger" href="transactions.php"> Cancel</a></center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
            <?php include"../include/footer.php"; ?>
            <?php include "../include/bs-script.php"; ?>
        </body>
        </html>