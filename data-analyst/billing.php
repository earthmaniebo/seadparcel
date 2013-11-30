<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Data Analyst | Billing Reports</title>
    <?php include "../include/headtags.php"; ?>
    <?php $page = "reports" ?>
    <script type="text/javascript">
        function InputVal() 
        {
            var fromYear = document.getElementById('fromYear');
            var toYear = document.getElementById('toYear');
            var fromMonth = document.getElementById('fromMonth');
            var toMonth = document.getElementById('toMonth');
            var fromDay = document.getElementById('fromDay');
            var toDay = document.getElementById('toDay');
            var company = document.getElementById('company');

            if(company.value == 'DEFAULT') {
                if(fromYear.value != '' && toYear.value != '' && fromMonth.value != '' && toMonth.value != '' && fromDay.value != '' && toDay.value != '') {
                    return true;
                }

                else {
                    alert("Date fields are empty!");
                    return false;
                }
            }

            else if(company.value != 'DEFAULT') {
                if(fromYear.value != '' && toYear.value != '' && fromMonth.value != '' && toMonth.value != '' && fromDay.value != '' && toDay.value != '') {
                    return true;
                }

                else if(fromYear.value == '' && toYear.value == '' && fromMonth.value == '' && toMonth.value == '' && fromDay.value == '' && toDay.value == '') {
                    return true;
                }

                else {
                    alert("Date fields are empty!");
                    return false;
                }
            }
        }

        function addVat() {
            $( "<input type='hidden' id='vat' value=.12 name='vat'>" ).insertAfter( "#total" );
            alert("12% VAT added to computation.");
            $("#addVat").hide();
            $("#removeVat").show();
        }

        function removeVat() {
            alert("12% VAT was removed.");
            $("#addVat").show();
            $("#vat").remove();
            $("#removeVat").hide();
        }
    </script>
</head>
<body>
    <?php include "../include/nav-data-analyst.php"; ?>
    <div class="container">
    <?php require_once "controller/dataAnalystController.php"; ?>
        <div class="row">
            <div class="col-md-12 col-md-offset-">
                <?php
                    $content = '<table border="1" text-align="center">';
                ?>
                        <h2 class="text-center">Billing Reports</h2>
                        <br/>
                        <div class="row">
                        
                            <form class="form-inline" role="form" action="billing.php" method="POST">
                            <div class="col-md-4" style="margin-right: 60px;">
                                <strong>COMPANY:</strong>
                                <div class="form-group">
                                    <select class="form-control" name="company" id="company" style="width:250px;">
                                        <option value="DEFAULT"></option>
                                            <?php foreach($selectClient as $row){ ?>
                                                $name = $row["name"];
                                                <option value="<?php echo $row['name'] ?>" text="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option>";
                                            <?php } ?>
                                        </select>
                                </div>
                                   
                            </div>
                            <strong>FROM: </strong><div class="form-group">
                            <label class="sr-only" for="fromMonth">Email address</label>
                            <select class="form-control" name="fromMonth" id="fromMonth">
                                <option value="">MONTH</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                          </div> 
                          <div class="form-group daySelect">
                                <select class="form-control" name="fromDay" id="fromDay">
                                <option value="">DAY</option>
                            <option value="01">1</option>
                            <option value="02">2</option>
                            <option value="03">3</option>
                            <option value="04">4</option>
                            <option value="05">5</option>
                            <option value="06">6</option>
                            <option value="07">7</option>
                            <option value="08">8</option>
                            <option value="09">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="YEAR" size="5" id="fromYear" name="fromYear">
                            </div> <strong>TO: </strong> 
                          <div class="form-group">
                            <label class="sr-only" for="toMonth">Email address</label>
                            <select class="form-control" name="toMonth" id="toMonth">
                                <option value="">MONTH</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                          </div> <div class="form-group daySelect">
                                <select class="form-control" name="toDay" id="toDay">
                                <option value="">DAY</option>
                            <option value="01">1</option>
                            <option value="02">2</option>
                            <option value="03">3</option>
                            <option value="04">4</option>
                            <option value="05">5</option>
                            <option value="06">6</option>
                            <option value="07">7</option>
                            <option value="08">8</option>
                            <option value="09">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                            </div> <div class="form-group">
                                <input type="text" class="form-control" placeholder="YEAR" size="5" id="toYear" name="toYear">
                            </div>
                          <button type="submit" class="btn btn-success" onclick='return InputVal();' name="sort">Sort</button>
                        </form>
                        </div>
                        </div>
                        
                        <br>
                        <table class="table table-bordered table-striped text-center">
                            <?php $content .='<thead>
                                <tr>
                                    <th class="text-center">PICKUP<br/>DATE</th>
                                    <th class="text-center">AIR WAY<br/>BILL NO</th>
                                    <th class="text-center">CONSIGNEE NAME</th>
                                    <th class="text-center">DESIGNATION</th>
                                    <th class="text-center">STATE</th>
                                    <th class="text-center">DESCRIPTION</th>
                                    <th class="text-center">TOTAL<br/>WEIGHT</th>
                                    <th class="text-center">BASE<br/>CHARGE</th>
                                    <th class="text-center">DECLARE<br/>VALUE</th>
                                    <th class="text-center">TOTAL<br/>AMOUNT</th>
                                </tr>
                            </thead>
                            <tbody>';
                            ?>
                            <thead>
                                <tr>
                                    <th class="text-center">PICKUP<br/>DATE</th>
                                    <th class="text-center">AIR WAY<br/>BILL NO</th>
                                    <th class="text-center">CONSIGNEE NAME</th>
                                    <th class="text-center">DESIGNATION</th>
                                    <th class="text-center">STATE</th>
                                    <th class="text-center">DESCRIPTION</th>
                                    <th class="text-center">TOTAL<br/>WEIGHT</th>
                                    <th class="text-center">BASE<br/>CHARGE</th>
                                    <th class="text-center">DECLARE<br/>VALUE</th>
                                    <th class="text-center">TOTAL<br/>AMOUNT</th>
                                </tr>
                            </thead>
                            <tbody>
                <?php foreach($reportsView as $row) { ?>
                            <?php $content .= '<tr>
                                <td>'.$row["pickUpDate"].'</td>
                                <td>'.$row["seadawbnum"].'</td>
                                <td>'.$row["conName"].'</td>
                                <td>'.$row["designation"].'</td>
                                <td>'.$row["state"].'</td>
                                <td>'.$row["descOfGoods"].'</td>
                                <td>'.$row["totalWeight"].'</td>
                                <td>'.$row["freightCharge"].'</td>
                                <td>'.$row["osaCharge"].'</td>
                                <td>'.$row["totalCharge"].'</td>
                            </tr>';
                            $total += $row["totalCharge"];
                            ?>
                            <tr>
                                <td><?php echo $row["pickUpDate"];?></td>
                                <td><?php echo $row["seadawbnum"];?></td>
                                <td><?php echo $row["conName"];?></td>
                                <td><?php echo $row["designation"];?></td>
                                <td><?php echo $row["state"];?></td>
                                <td><?php echo $row["descOfGoods"];?></td>
                                <td><?php echo $row["totalWeight"];?></td>
                                <td><?php echo $row["freightCharge"];?></td>
                                <td><?php echo $row["osaCharge"];?></td>
                                <td><?php echo $row["totalCharge"];?></td>
                            </tr>
                <?php } ?>
                        <?php $content .= '</tbody>
                        </table>';
                        ?>
                        </tbody>
                        </table>
                        <form action="download-billing.php" method="POST" id="toPDF">
                            <input type="hidden" <?php echo "value='".$content."'"?> name="content">
                            <input type="hidden" <?php echo "value='".$fromDate."'"?> name="fromDate">
                            <input type="hidden" <?php echo "value='".$toDate."'"?> name="toDate">
                            <input type="hidden" <?php echo "value='".$total."'"?> name="total" id="total">
                            <input type="hidden" <?php echo "value='".$company."'"?> name="client" id="client">
                            <a onclick="addVat();" class="btn btn-warning" text-align='right' id="addVat">Add Vat</a>
                            <a onclick="removeVat();" style="display:none;" type="hidden" class="btn btn-danger" text-align='right' id="removeVat">Remove Vat</a>
                            <button type="submit" class="btn btn-primary" text-align='right'>Download</button>
                        </form>
                        
                        <br>
            </div>
        </div>
    </div>
    <?php include "../include/bs-script.php"; ?>
</body>
</html>