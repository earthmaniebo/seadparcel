    
    <div class="container">
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>  
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">Sead Parcel</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li id="nav-index"><a href="index.php">Home</a></li>
                    </ul>
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

            case 'contact-us':
                echo "<script>
        document.getElementById('nav-contact-us').className = 'active';
    </script>";
                 break;

            default:
                # code...
                break;
        }
    ?>