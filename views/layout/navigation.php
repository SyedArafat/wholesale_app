<!-- navbar -->
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="<?php echo $home_url; ?>">Wholesale App</a>
        </div>

        <div class="navbar-collapse collapse">
            <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] === Statics::USER_TYPE_SELLER) { ?>
            <ul class="nav navbar-nav">
                <li <?php echo $page_title=="Index" ? "class='active'" : ""; ?>>
                    <a href="<?php echo $home_url; ?>">Home</a>
                </li>
                <li <?php echo $page_title=="Product Index" ? "class='active'" : ""; ?>>
                    <a href="<?php echo $home_url; ?>views/product-index.php">Products</a>
                </li>
                <li <?php echo $page_title=="Order List" ? "class='active'" : ""; ?>>
                    <a href="<?php echo $home_url; ?>views/order-list.php">Orders</a>
                </li>
            </ul>
            <?php } ?>

            <?php
            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
            ?>
                <ul class="nav navbar-nav navbar-right">
                    <li <?php echo $page_title=="Edit Profile" ? "class='active'" : ""; ?>>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <?php echo $_SESSION['name']; ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <form action="<?php echo $home_url; ?>views/logout.php" method="post">
                                <li><button class="submit-button-logout" type="submit">Logout</button></li>
                            </form>
                        </ul>
                    </li>
                </ul>
            <?php
            }

            else{
                ?>
                <ul class="nav navbar-nav navbar-right">
                    <li <?php echo $page_title=="Login" ? "class='active'" : ""; ?>>
                        <a href="<?php echo $home_url; ?>views/login.php">
                            <span class="glyphicon glyphicon-log-in"></span> Log In
                        </a>
                    </li>

                    <li <?php echo $page_title=="Register" ? "class='active'" : ""; ?>>
                        <a href="<?php echo $home_url; ?>views/register.php">
                            <span class="glyphicon glyphicon-check"></span> Register
                        </a>
                    </li>
                </ul>
                <?php
            }
            ?>

        </div>

    </div>
</div>
<!-- /navbar -->