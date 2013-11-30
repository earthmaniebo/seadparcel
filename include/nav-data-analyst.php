    
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
                        <li id="nav-my-clients"><a href="my-clients.php">My Clients</a></li>
                        <li id="nav-transactions"><a href="transactions.php">Transactions</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="shipment.php">Shipment</a></li>
                                <li><a href="pod.php">Proof of Delivery</a></li>
                                <li><a href="billing.php">Billing</a></li>
                            </ul>
                        </li>
                        <li id="nav-my-account"><a href="index.php">My Account</a></li>
                    </ul>
                    <div style="margin:15px 10px 0 200px; float:left; color:white"> Welcome Data Analyst <?php echo $_SESSION["username"]; ?></div>
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

            case 'my-clients':
                echo "<script>
        document.getElementById('nav-my-clients').className = 'active';
    </script>";
                 break;

            case 'transactions':
            case 'add-transaction':
            case 'edit-transaction':
                echo "<script>
        document.getElementById('nav-transactions').className = 'active';
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