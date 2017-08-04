<!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            	
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Moments</a>

            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> <?php echo $_SESSION['admin_name']; ?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                   <!--<li><a href="#">Profile</a></li>
                    <li class="divider"></li>-->
                    <li><a href="admin_logout.php">Logout</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->


            <ul class="collapse navbar-collapse nav navbar-nav top-menu pull-right">
               
            </ul>

        </div>
    </div>
    <!-- topbar ends -->