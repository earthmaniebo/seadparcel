<?php
    require_once "include/database.php";
    require_once "include/globalFunctions.php";
    require_once "model/shipmentModel.php";
    require_once "model/podModel.php";

    
    /** If current page is index.php **/
    if($page == "index") {

        $isSent = false;

        /** If the send button is clicked. **/
        if(isset($_POST["send"])) {

            /** Get the variables. **/
            $name = $_POST["name"];
            $from = $_POST["email"];
            $subject = $_POST["subject"];
            $message = $_POST["comments"];

            /** To where the email will be sent. **/
            $to = "isadteam12345@gmail.com";
            $headers = "From:" . $from;

            /** Send the mail. **/
            mail($to,$subject,$message,$headers);
            $isSent = true;
        }
    }

    /** If current page is tracking.php **/
    if($page == "tracking") {

        /** If the track button is clicked. **/
        if(isset($_POST["track"])) {

            /** -- START -- Variables to be provided to view. **/

            $viewShipment = null;
            $viewPod = null;

            /** -- END -- Variables to be provided to view. **/

            /** Get the refNum. **/
            $seadawbnum = $_POST["seadawbnum"];

            /** Instantiate the Shipment model. **/
            $shipment = new Shipment();

            /** 
            * Call the function track from the Shipment model
            * and assign it to a variable.
            */
            $viewShipment = $shipment->track($seadawbnum);

            if($viewShipment["hasPod"] == "Y") {

                /** Instantiate the Pod model. **/
                $pod = new Pod();

                /** 
                * Call the function selectUsingShipmentID from the Pod model
                * and assign it to a variable.
                */
                $viewPod = $pod->selectUsingShipmentID($viewShipment["shipmentID"]);
            }
        }

        else {
            header("Location: index.php");
        }
    }
?>