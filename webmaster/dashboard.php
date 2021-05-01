<?php include("lib/common.php"); include("lib/session_check.php"); $menu='payments'; 
$customers=$objMain->getResultsCount("select id from customers");
$orders=$objMain->getResultsCount("select id from orders");
$neworders=$objMain->getResultsCount("select id from orders where status!='delivered' and status!='initiated'");
?>

<!DOCTYPE html> <?php $ptype='Dashboard'; ?>
<html lang="en">
<head>
    <?php include("inc/header_scripts.php"); ?>
    <title><?php echo $ptype; ?></title>
</head>
<body class="app header-fixed left-sidebar-fixed right-sidebar-fixed right-sidebar-overlay right-sidebar-hidden">

    <!--===========header start===========-->
   <?php include("inc/header.php"); ?>
    <!--===========header end===========-->

    <!--===========app body start===========-->
    <div class="app-body">
        
        <!--left sidebar start-->
        <?php include("inc/sidebar.php"); ?>
        <!--left sidebar end-->

        <!--main contents start-->
        <main class="main-content">

    
            <!--page title start-->
            <div class="page-title">
                <h4 class="mb-0"><?php echo $ptype; ?>
           
                </h4>
            </div>
            <!--page title end-->


            <div class="container-fluid">

                <!-- state start
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-shadow mb-4">
                            <div class="card-body pb-0 ">
                                <div class="btn-group float-right">
                                    <div class="dropdown ">
                                        <a href="#" class="btn btn-transparent default-color dropdown-hover p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class=" icon-options"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right ">
                                            <a class="dropdown-item" href="#"> <i class="icon-note text-info pr-2"></i> Edit</a>
                                            <a class="dropdown-item" href="#"><i class="icon-close text-danger pr-2"></i> Delete</a>
                                            <a class="dropdown-item" href="#"><i class="icon-shield text-warning pr-2"></i> Cancel</a>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mb-0 "><?php echo $customers; ?></h4>
                                <p class="">Registered Customers</p>
                            </div>
                            <div class="">
                                <canvas id="myChart-light" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-shadow mb-4">
                            <div class="card-body pb-0">
                                <div class="btn-group float-right">
                                    <div class="dropdown ">
                                        <a href="#" class="btn btn-transparent default-color dropdown-hover p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class=" icon-options"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right ">
                                            <a class="dropdown-item" href="#"> <i class="icon-note text-info pr-2"></i> Edit</a>
                                            <a class="dropdown-item" href="#"><i class="icon-close text-danger pr-2"></i> Delete</a>
                                            <a class="dropdown-item" href="#"><i class="icon-shield text-warning pr-2"></i> Cancel</a>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mb-0"><?php echo $orders; ?></h4>
                                <p class="">Total Orders</p>
                            </div>
                            <div class="px-">
                                <canvas id="myChart-tow-light" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-shadow">
                            <div class="card-body">
                                <div class="row pt-4 pb-3">
                                    <div class="col-12">
                                        <div class="float-right">
                                            <i class="f30 opacity-3 icon-basket-loaded"></i>
                                        </div>
                                        <h3 class="text-success"><?php echo $neworders; ?></h3>
                                        <p class="card-subtitle text-muted fw-500">New Orders</p>
                                    </div>
                                    <div class="col-12">
                                        <div class="progress mt-3 mb-1" style="height: 6px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 83%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> </div>
                                        </div>
                                        <div class="text-muted f12">
                                            <span>Progress</span>
                                            <span class="float-right">83%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->

                <div class="row">

<?php $results=$objMain->getResults("select * from orders where status!='initiated' and status='cancel-request' order by order_date desc limit 6");
                    if(!empty($results)){ ?>
                    <div class="col-md-12">
                        <div class="card card-shadow mb-4">
                            <div class="card-header">
                                <div class="card-title">
                                   Cancellation Requests
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-stripped">
                                    <thead>
                                    <tr>
                        <th>Order Date</th>
                        <th>Name</th>
                        <th>Mobile No</th>
                        <th>Location</th>
                        <th>Pincode</th>
                        <th>Net Amount</th>
                        <th>Status</th>
                        <th>View</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 

 $i=0;
                        foreach($results as $result){ $i++; 

                            ?>
                            <tr>
                                <td><?php echo date("d M - h:m A",strtotime($result['order_date'])); ?></td>
                                <td><?php echo $result['name']; ?></td>
                                <td><?php echo $result['mobileno']; ?></td>
                                <td><?php echo $result['city'].",".$result['state']; ?></td>
                                <td><?php echo $result['pincode']; ?></td>
                                <td><?php echo $objMain->INR($result['net_amount']); ?></td>
                                <td><?php echo $result['status']; ?></td>
                                <td>
                                    <a href="orders_view.php?id=<?php echo $result['id']; ?>" class="btn btn-danger btn-sm">View</a>
                            </tr>

                   <?php     }
                     ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                <?php } ?>
                    <!--Report widget end-->

                    <!--social feed widget start-->
                    <!--social feed widget end-->
                </div>

                    <!--Report widget start-->
                    <div class="col-md-12">
                        <div class="card card-shadow mb-4">
                            <div class="card-header">
                                <div class="card-title">
                                   Latest Order
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                        <th>Order Date</th>
                        <th>Name</th>
                        <th>Mobile No</th>
                        <th>Location</th>
                        <th>Pincode</th>
                        <th>Net Amount</th>
                        <th>Status</th>
                        <th>View</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 

$results=$objMain->getResults("select * from orders where status!='initiated' order by order_date desc limit 6");
                    if(!empty($results)){ $i=0;
                        foreach($results as $result){ $i++; 

                            ?>
                            <tr>
                                <td><?php echo date("d M - h:m A",strtotime($result['order_date'])); ?></td>
                                <td><?php echo $result['name']; ?></td>
                                <td><?php echo $result['mobileno']; ?></td>
                                <td><?php echo $result['city'].",".$result['state']; ?></td>
                                <td><?php echo $result['pincode']; ?></td>
                                <td><?php echo $objMain->INR($result['net_amount']); ?></td>
                                <td><?php echo $result['status']; ?></td>
                                <td>
                                    <a href="orders_view.php?id=<?php echo $result['id']; ?>" class="btn btn-danger btn-sm">View</a>
                            </tr>

                   <?php     }
                    } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--Report widget end-->

                    <!--social feed widget start-->
                    <!--social feed widget end-->
                </div>


                <!-- state end-->

            </div>
        </main>
        <!--main contents end-->

        <!--right sidebar start-->
        <?php include("inc/rightsidebar.php"); ?>
        <!--right sidebar end-->

    </div>
    <!--===========app body end===========-->

    <!--===========footer start===========-->
    <?php include("inc/footer.php"); ?>
        <!--===========footer end===========-->


    <?php include("inc/footer_scripts.php"); ?>

    <!--chartjs-->
    <script src="assets/vendor/chartjs/Chart.min.js"></script>

    <!--chartjs initialization-->
    <script>

        var ctx = document.getElementById('myChart-light').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "My First dataset",
                    backgroundColor: 'rgba(167,104,243,.2)',
                    borderColor: 'rgba(167,104,243,1)',
                    data: [0, 20, 9, 25, 15, 25,18]
                }]


            },

            // Configuration options go here
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },

                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }]
                },
                elements: {
                    line: {
                        tension: 0.00001,
                        //tension: 0.4,
                        borderWidth: 1
                    },
                    point: {
                        radius: 4,
                        hitRadius: 10,
                        hoverRadius: 4
                    }
                }
            }
        });


        var ctx = document.getElementById('myChart-tow-light').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "My First dataset",
                    backgroundColor: 'rgba(54,162,245,.2)',
                    borderColor: 'rgba(54,162,245,1)',
                    //data: [6.06, 82.2, -22.11, 21.53, -21.47, 73.61, -53.75, -60.32]
                    data: [70, 45, 65, 50, 65, 35, 50]
                }]


            },

            // Configuration options go here
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }]
                },
                elements: {
                    line: {
                        //tension: 0.00001,
                        tension: 0.4,
                        borderWidth: 1
                    },
                    point: {
                        radius: 4,
                        hitRadius: 10,
                        hoverRadius: 4
                    }
                }
            }
        });

    </script>

</body>
</html>
