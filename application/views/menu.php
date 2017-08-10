

<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
<!--        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#ip-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                Menu &nbsp; <i class="fa fa-bars"></i>
            </button>
        </div>-->
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#ip-navbar-collapse" aria-expanded="true">
                <i class="fa fa-bars"></i>
            </a> 
            <div class="logo">
               <a href="<?php echo base_url().'dashboard'; ?>" style="font-size: 30px; color: snow;">Invoice</a>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="ip-navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo base_url();?>dashboard" class="hidden-md">Dashboard</a>                    <a href="dashboard" class="visible-md-inline-block"><i class="fa fa-dashboard"></i></a>                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-caret-down"></i> &nbsp;
                        <span class="hidden-md">Customers</span>
                        <i class="visible-md-inline fa fa-users"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url();?>customers/add">Add Customer</a></li>
                        <li><a href="<?php echo base_url();?>customers">View Customers</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-caret-down"></i> &nbsp;
                        <span class="hidden-md">Invoices</span>
                        <i class="visible-md-inline fa fa-file-text"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url();?>invoices/add" class="create-invoice">Create Invoice</a></li>
                        <li><a href="<?php echo base_url();?>invoices">View Invoices</a></li>
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-caret-down"></i> &nbsp;
                        <span class="hidden-md">Purchase</span>
                        <i class="visible-md-inline fa fa-file-text"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url();?>purchase/add" class="create-invoice">Create purchase</a></li>
                        <li><a href="<?php echo base_url();?>purchase">View purchase</a></li>
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-caret-down"></i> &nbsp;
                        <span class="hidden-md">Products</span>
                        <i class="visible-md-inline fa fa-database"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url();?>product">View products</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-caret-down"></i> &nbsp;
                        <span class="hidden-md">Reports</span>
                        <i class="visible-md-inline fa fa-bar-chart"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url();?>invoices/report">Invoice Report</a></li>
                        <li><a href="<?php echo base_url();?>purchase/report">Purchase Report</a></li>
                    </ul>
                </li>

            </ul>

            
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?php echo base_url().'setting';?>"
                       class="tip icon" data-placement="bottom"
                       title="<?php echo isset($_SESSION['user']) ? $_SESSION['user']['firstname']:'admin'; ?>">
                        <i class="fa fa-user"></i>
                        <span class="visible-xs">&nbsp;<?php echo isset($_SESSION['user'])?$_SESSION['user']['firstname']:'admin'; ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url().'Login/logout'; ?>"
                       class="tip icon logout" data-placement="bottom"
                       title="Logout">
                        <i class="fa fa-power-off"></i>
                        <span class="visible-xs">&nbsp;Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="main-area">
        <div id="main-content">
        

