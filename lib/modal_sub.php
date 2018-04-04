<!--Modal Sub Group-->
<div class="modal fade" id="ModalSub" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="form-Sub">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">เพิ่มประเภทสินค้าย่อย</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label">รหัสประเภทสินค้าย่อย</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="Sub_Id" name="Sub_Id" placeholder="" required="" value="" readonly> <!--disabled=""-->
                                </div>
                                <label for="" class="col-sm-4 control-label"></label>                                        
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label">ประเภทสินค้าหลัก</label>
                                <div class="col-sm-8">
                                    <!--<input type="text" class="form-control" id="Sub_Name" name="Sub_Name" placeholder="" required="">-->                                            
                                    <select class="form-control select2" id="DDgroup" name="DDgroup" style="width:65%"></select>                                            
                                </div>                                                                              
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label">ชื่อประเภทสินค้าย่อย</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="Sub_Name" name="Sub_Name" placeholder="" required="" value=""> <!--disabled=""-->
                                </div>
                                <label for="" class="col-sm-4 control-label"></label>                                        
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!--<input type="hidden" id="action-sub" name="action-sub" value="insert" >-->
                    <button type="submit" class="btn btn-success">บันทึก</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Sub Group Edit -->
<div class="modal fade" id="ModalSub-edit" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="form-Sub-edit">
                <div class="modal-header bg-yellow-gradient">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class="fa fa-pencil"></span> แก้ไขประเภทสินค้าย่อย</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label">รหัสประเภทสินค้าย่อย</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="Sub_Id-edit" name="Sub_Id-edit" placeholder="" required="" value="" readonly> <!--disabled=""-->
                                </div>
                                <label for="" class="col-sm-4 control-label"></label>                                        
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label">ประเภทสินค้าหลัก</label>
                                <div class="col-sm-8">
                                    <!--<input type="text" class="form-control" id="Sub_Name" name="Sub_Name" placeholder="" required="">-->
                                    <div class="form-group" style="margin-left:1px;">
                                        <select class="form-control select2" id="DDgroup-edit" name="DDgroup-edit" style="width:65%">
                                        </select>
                                    </div>
                                </div>
                                <!--<label for="" class="col-sm-3 control-label"></label>-->                                        
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label">ชื่อประเภทสินค้าย่อย</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="Sub_Name-edit" name="Sub_Name-edit" placeholder="" required="" value=""> <!--disabled=""-->
                                </div>
                                <label for="" class="col-sm-4 control-label"></label>                                        
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="action-sub" name="action-sub" value="update" >
                    <button type="submit" class="btn bg-yellow-gradient">แก้ไข</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                </div>
            </form>
        </div>
    </div>
</div>        

<!-- Modal Sub Group Cancel -->
<!--        <div class="modal fade" id="ModalSub-cancel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" id="form-Sub-cancel">
                        <div class="modal-header bg-red-active color-palette">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">ยกเลิกประเภทสินค้าย่อย</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="Cancel_Id_Sub" name="Cancel_Id_Sub" value="">
                            <label id="mes-cancel-sub"></label>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="action-sub" name="action-sub" value="cancel" >
                            <button type="submit" class="btn bg-red-active color-palette">ยืนยัน</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                        </div>
                    </form>
                </div>
            </div>
        </div>-->
<!-- Modal Sub Group Open -->
<!--        <div class="modal fade" id="ModalSub-open" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" id="form-Sub-open">
                        <div class="modal-header bg-aqua-active color-palette">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">เปิดใช้ประเภทสินค้าย่อย</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="Open_Id_Sub" name="Open_Id_Sub" value="">
                            <label id="mes-open-sub"></label>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="action-sub" name="action-sub" value="open" >
                            <button type="submit" class="btn bg-aqua-active color-palette">ยืนยัน</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                        </div>
                    </form>
                </div>
            </div>
        </div>-->