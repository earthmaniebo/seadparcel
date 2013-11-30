    
    <div class="container">
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>  
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/seadparcel/index.php">Sead Parcel</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li id="nav-clients"><a href="clients.php">Clients</a></li>
                        <li id="nav-employees"><a href="employees.php">Employees</a></li>
                        <li id="nav-reports" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="shipment.php">Shipment</a></li>
                                <li><a href="billing.php">Billing</a></li>
                                <li><a href="pod.php">Proof of Delivery</a></li>
                                <li><a href="audit-trail.php">Audit Trail</a></li>
                                <li><a href="company-profile.php">Print Company Profile</a></li>
                            </ul>
                        </li>
                        <li id="nav-archives" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Archives <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="employees-archive.php">Employees</a></li>
                                <li><a href="clients-archive.php">Clients</a></li>
                                <li><a href="shipment-archive.php">Shipment</a></li>
                                <li><a href="billing-archive.php">Billing</a></li>
                                <li><a href="pod-archive.php">Proof of Delivery</a></li>
                            </ul>
                        </li>
                        <li id="nav-my-account"><a href="index.php">My Account</a></li>
                    </ul>
                    <div style="margin:15px 10px 0 250px; float:left; color:white"> Welcome Admin <?php echo $_SESSION["username"]; ?></div>
                    <div style="margin:15px 0 0 0;"><form class="form-inline" method="POST" action="logout.php" style="display:inline;"><button type="submit" class="btn btn-danger btn-xs" name="logout">Logout</button></form></div>
                </div>
            </div>
        </div>
    </div>

    <?php
        switch ($page) {
            case 'index':
                echo "<script>
        document.getElementById('nav-index').className = 'active';
    </script>";
                 break;

            case 'clients':
            case 'add-client':
                echo "<script>
        document.getElementById('nav-clients').className = 'active';
    </script>";
                 break;

            case 'employees':
            case 'add-employee':
                echo "<script>
        document.getElementById('nav-employees').className = 'active';
    </script>";
                 break;

            case 'reports':
            case 'pod-reports':
            case 'audit-trail':
                echo "<script>
        document.getElementById('nav-reports').className = 'active';
    </script>";
                 break;

            case 'employees-archive':
            case 'clients-archive':
            case 'shipment-archive':
            case 'pod-archive':
            case 'billing-archive':
                echo "<script>
        document.getElementById('nav-archives').className = 'active';
    </script>";
                 break;

            case 'my-account':
                echo "<script>
        document.getElementById('nav-my-account').className = 'active';
    </script>";
                 break;

            default:
                # code...
                break;
        }
    ?>