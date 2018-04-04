<?php
if ($_SESSION['login_type'] == "admin" || $_SESSION['login_type'] == "root") {
    ?>
    <li class="header">เมนูหลัก</li>
    <li><a href="index.php"><i class="fa fa-home"></i> หน้าแรก </a></li>
    <li class="treeview">
        <a href="#"><i class="fa fa-shopping-cart"></i><span>การขายสินค้า</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
        <ul class="treeview-menu">
            <li><a href="M_Sell.php"><i class="fa fa-cart-arrow-down"></i> ขายสินค้า</a></li>
            <li><a href="M_Sell_Record.php"><i class="fa fa fa-calendar-check-o"></i> ประวัติการขายสินค้า</a></li>
        </ul>
    </li>  
    <li class="treeview">
        <a href="#">
            <i class="fa fa-wrench"></i> 
            <span>งานซ่อม</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="M_Repair.php"><i class="fa  fa-wrench"></i> <span>เพิ่มรายการรับซ่อม</span></a></li>
            <li><a href="M_Repair_Claim.php"><i class="fa  fa-exclamation-triangle"></i> <span>รายการรับซ่อมในประกัน</span></a></li>
            <li><a href="M_Repair_List.php"><i class="fa fa-list-alt"></i> รายการงานซ่อม</a></li>
            <li><a href="M_Repair_History.php"><i class="fa fa-calendar-check-o"></i> ประวัติการซ่อม</a></li>
            <li><a href="M_MyWork.php"><i class="fa fa-gavel"></i> งานซ่อมของฉัน</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-truck"></i> 
            <span>รายการเคลมสินค้า</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="M_Claim.php"><i class="fa fa-list-alt"></i> <span>รายการเคลมสินค้า</span></a></li>
            <li><a href="M_Claim_Add.php"><i class="fa fa-cart-arrow-down"></i> รับเข้าสินค้าเคลม</a></li>
        </ul>
    </li>     

    <li class="treeview">
        <a href="#">
            <i class="fa fa-cube"></i> 
            <span>จัดการสินค้า</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="M_Add_ProductList.php"><i class="fa fa-plus-square"></i> เพิ่มรายการสินค้า</a></li>
            <li><a href="M_Product_List.php"><i class="fa fa-list-alt"></i> รายการสินค้า</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-sign-in"></i> 
            <span>รับเข้าสินค้า</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="M_Import.php"><i class="fa fa-cart-plus"></i> สินค้าขาย</a></li>
            <li><a href="M_Import_List.php"><i class="fa fa-list-alt"></i> รายการรับเข้าสินค้า</a></li>
        </ul>
    </li>
    <li><a href="M_SMS.php"><i class="fa  fa-commenting-o"></i> <span>การแจ้งเตือน SMS</span></a></li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-folder"></i> 
            <span>ออกรายงาน</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="R_Employee.php"><i class="fa fa-file-text-o"></i> รายงานพนักงาน</a></li>
            <li><a href="R_ProductList.php"><i class="fa fa-file-text-o"></i> รายงานข้อมูลสินค้า</a></li>
            <li><a href="R_Import.php"><i class="fa fa-file-text-o"></i> รายงานการรับเข้าสินค้า</a></li>
            <li><a href="R_Claim.php"><i class="fa fa-file-text-o"></i> รายงานการรับสินค้าเคลม</a></li>
            <li><a href="R_Sell.php"><i class="fa fa-file-text-o"></i> รายงานการขายสินค้า</a></li>
            <li><a href="R_Customer.php"><i class="fa fa-file-text-o"></i> รายงานลูกค้า</a></li>
            <li><a href="R_Repair.php"><i class="fa fa-file-text-o"></i> รายงานการซ่อม</a></li>
            <li><a href="R_SMS.php"><i class="fa fa-file-text-o"></i> รายงานการแจ้งเตือน</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-cog"></i> <span>ตั้งค่าระบบ</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="M_Log.php"><i class="fa  fa-eye"></i> <span>บันทึกการเข้าใช้งานระบบ</span></a></li>
            <li><a href="M_Shop_Detail.php"><i class="fa  fa-bank"></i> <span>รายละเอียดข้อมูลร้าน</span></a></li>
            <li><a href="M_GroupProduct.php"><i class="fa  fa-th-large"></i> <span>จัดการประเภทสินค้า - ยี่ห้อ</span></a></li>
            <li><a href="M_Service_Menu.php"><i class="fa  fa-navicon"></i> <span>จัดการเมนูซ่อมสินค้า</span></a></li>
            <li><a href="M_Warranty.php"><i class="fa fa-calendar"></i> <span>จัดการระยะเวลาประกัน</span></a></li>
            <li><a href="M_Customer.php"><i class="fa fa-users"></i> <span>จัดการข้อมูลลูกค้า</span></a></li>
            <li>
                <a href="#"><i class="fa fa-user-o"></i><span>ข้อมูลพนักงาน</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="M_Add_Employee.php"><i class="fa fa-user-plus"></i> เพิ่มข้อมูลพนักงาน</a></li>
                    <li><a href="M_Employee.php"><i class="fa fa-user-circle-o"></i> จัดการข้อมูลพนักงาน</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-user-secret"></i><span>ข้อมูลตัวแทนขายสินค้า</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="M_Add_Dealer.php"><i class="fa fa-user-plus"></i> เพิ่มข้อมูลตัวแทน</a></li>
                    <li><a href="M_Dealer.php"><i class="fa fa-user-circle-o"></i> จัดการข้อมูลตัวแทน</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li><a href="M_Logout.php"><i class="fa   fa-power-off"></i> <span>ออกจากระบบ</span></a></li>
    <!-- USER MENU -->  
<?php } else if ($_SESSION['login_type'] == "user") {
    ?>
    <li class="header">เมนูหลัก</li>
    <li><a href="index.php"><i class="fa fa-home"></i> หน้าแรก </a></li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-shopping-cart"></i> 
            <span>การขายสินค้า</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="M_Sell.php"><i class="fa fa-cart-arrow-down"></i> ขายสินค้า</a></li>
            <li><a href="M_Sell_Record.php"><i class="fa fa fa-calendar-check-o"></i> ประวัติการขายสินค้า</a></li>
        </ul>
    </li>  
    <li class="treeview">
        <a href="#">
            <i class="fa fa-wrench"></i> 
            <span>งานซ่อม</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="M_Repair.php"><i class="fa  fa-wrench"></i> <span>เพิ่มรายการรับซ่อม</span></a></li>
            <li><a href="M_Repair_Claim.php"><i class="fa  fa-exclamation-triangle"></i> <span>รายการรับซ่อมในประกัน</span></a></li>
            <li><a href="M_Repair_List.php"><i class="fa fa-list-alt"></i> รายการงานซ่อม</a></li>
            <li><a href="M_Repair_History.php"><i class="fa fa-calendar-check-o"></i> ประวัติการซ่อม</a></li>
            <li><a href="M_MyWork.php"><i class="fa fa-gavel"></i> งานซ่อมของฉัน</a></li>
        </ul>
    </li>    
    <li class="treeview">
        <a href="#">
            <i class="fa fa-truck"></i> 
            <span>รายการเคลมสินค้า</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="M_Claim.php"><i class="fa fa-list-alt"></i> <span>รายการเคลมสินค้า</span></a></li>
            <li><a href="M_Claim_Add.php"><i class="fa fa-cart-arrow-down"></i> รับเข้าสินค้าเคลม</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-cube"></i> 
            <span>จัดการสินค้า</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="M_Add_ProductList.php"><i class="fa fa-plus-square"></i> เพิ่มรายการสินค้า</a></li>
            <li><a href="M_Product_List.php"><i class="fa fa-list-alt"></i> รายการสินค้า</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-sign-in"></i> 
            <span>รับเข้าสินค้า</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="M_Import.php"><i class="fa fa-cart-plus"></i> สินค้าขาย</a></li>
            <li><a href="M_Import_List.php"><i class="fa fa-list-alt"></i> รายการรับเข้าสินค้า</a></li>
        </ul>
    </li>
    <li><a href="M_SMS.php"><i class="fa  fa-commenting-o"></i> <span>การแจ้งเตือน SMS</span></a></li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-cog"></i> <span>ตั้งค่าระบบ</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="M_GroupProduct.php"><i class="fa  fa-th-large"></i> <span>จัดการประเภทสินค้า - ยี่ห้อ</span></a></li>
            <li><a href="M_Customer.php"><i class="fa  fa-users"></i> <span>จัดการข้อมูลลูกค้า</span></a></li>
            <li>
                <a href="#"><i class="fa fa-user-o"></i><span>ข้อมูลพนักงาน</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="M_Add_Employee.php"><i class="fa fa-user-plus"></i> เพิ่มข้อมูลพนักงาน</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-user-secret"></i><span>ข้อมูลตัวแทนขายสินค้า</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="M_Add_Dealer.php"><i class="fa fa-user-plus"></i> เพิ่มข้อมูลตัวแทน</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li><a href="M_Logout.php"><i class="fa   fa-power-off"></i> <span>ออกจากระบบ</span></a></li>
    <?php } ?>
    
