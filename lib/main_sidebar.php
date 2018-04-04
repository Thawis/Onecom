    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu">      
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="../img/employee/<?php echo $ImgName; ?>" class="img-circle" alt="User Image" style="width: 45px; height: 65px;">
                    </div>
                    <div class="pull-left info">
                        <p style="margin-top: 10px;"><i class="fa fa-user-circle text-success"></i> รหัส : <?php echo $Eid; ?></p>
                        <p>ตำแหน่ง : <?php echo $emp_type_show ?></p>
                        <!--<p><i class="fa fa-circle text-success"></i> Online</p>-->
                    </div>
                </div>
                <?php include '../lib/sidemenu.php'; ?>
            </ul>
        </section>
    </aside>