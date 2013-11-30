<?php
    
    /**
    * Instantiate the AuditTrail model.
    * @param int
    * @param string
    * @return boolean
    */
    function auditTrail($empID, $action) {

        /** Instantiate the AuditTrail model. **/
        $auditTrail = new AuditTrail();

        /** Assign variables. **/
        $auditTrail->setEmpID($empID);
        $auditTrail->setAction($action);

        return $auditTrail->addAuditTrail($auditTrail->getEmpID(), $auditTrail->getAction());
    }
?>