<!--Modal Group-->
<div class="modal fade" id="ModalGroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="form-addGroup">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">เพิ่มประเภทสินค้า</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">รหัสประเภทสินค้า</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="Group_Id" name="Group_Id" placeholder="" required="" readonly> <!--disabled=""-->
                                </div>
                                <label for="" class="col-sm-5 control-label"></label>                                        
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">ชื่อประเภทสินค้า</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="Group_Name" name="Group_Name" placeholder="" required="">
                                </div>
                                <label for="" class="col-sm-1 control-label"></label>                                        
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!--<input type="hidden" id="action-group" name="action-group" value="insert" >-->
                    <button type="submit" class="btn btn-success">บันทึก</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                </div>
            </form>
        </div>
    </div>
</div>
<!--Modal Group Edit-->
<div class="modal fade" id="ModalGroup-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="form-edit-group">
                <div class="modal-header bg-yellow-gradient">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class="fa fa-pencil"></span> แก้ไขประเภทข้อมูลสินค้า</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">รหัสประเภทสินค้า</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="Group_Id-edit" name="Group_Id-edit" placeholder="" required="" readonly> <!--disabled=""-->
                                </div>
                                <label for="" class="col-sm-5 control-label"></label>                                        
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">ชื่อประเภทสินค้า</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="Group_Name-edit" name="Group_Name-edit" placeholder="" required="">
                                </div>
                                <label for="" class="col-sm-1 control-label"></label>                                        
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!--<input type="hidden" id="action-group" name="action-group" value="update" >-->
                    <button type="submit" class="btn bg-yellow-gradient">แก้ไข</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                </div>
            </form>
        </div>
    </div>
</div>