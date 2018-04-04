<!--Modal Brand-->
<div class="modal fade" id="ModalBrand" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="form-addBrand">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">เพิ่มยี่ห้อสินค้า</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">รหัสยี่ห้อสินค้า</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="Brand_Id" name="Brand_Id" placeholder="" required="" value="" readonly> <!--disabled=""-->
                                </div>
                                <label for="" class="col-sm-5 control-label"></label>                                        
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">ชื่อยี่ห้อสินค้า</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="Brand_Name" name="Brand_Name" placeholder="" required="">
                                </div>
                                <label for="" class="col-sm-1 control-label"></label>                                        
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="action-brand" name="action_brand" value="insert" >
                    <button type="submit" class="btn btn-success">บันทึก</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                </div>
            </form>
        </div>
    </div>
</div>
<!--Modal Brand Edit-->
<div class="modal fade" id="ModalBrand-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="form-brand-edit">
                <div class="modal-header bg-yellow-gradient">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class="fa fa-pencil"></span> แก้ไขยี่ห้อสินค้า</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">รหัสยี่ห้อสินค้า</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="Brand_Id-edit" name="Brand_Id-edit" placeholder="" required="" value="" readonly> <!--disabled=""-->
                                </div>
                                <label for="" class="col-sm-5 control-label"></label>                                        
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">ชื่อยี่ห้อสินค้า</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="Brand_Name-edit" name="Brand_Name-edit" placeholder="" required="">
                                </div>
                                <label for="" class="col-sm-1 control-label"></label>                                        
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="action-brand" name="action_brand" value="update" >
                    <button type="submit" class="btn bg-yellow-gradient">แก้ไข</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                </div>
            </form>
        </div>
    </div>
</div>