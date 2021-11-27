<div class="modal fade modal bs-modal-lg fade" id="confirmPurchaseModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>Confirm Purchase</b></h4>
            </div>
            <div class="modal-body">
                <form id="product_purchase" action="<?php echo $home_url ?>controller/purchase_logic.php" method="post">
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="row">
                        <div class="form-group-custom">
                            <label class="col-md-3 control-label">Product Title</label>
                            <div class="col-md-9">
                                <label id="productTitle" class="control-label">Product Title</label>
                            </div>
                        </div>
                        <br/>

                        <div class="form-group-custom">
                            <label class="col-md-3 control-label">Regular Price</label>
                            <div class="col-md-9">
                                <label id="productPrice" class="control-label">Regular Price</label>
                            </div>
                        </div>
                        <br>

                        <div class="form-group-custom">
                            <label class="col-md-3 control-label">Wholesale Price</label>
                            <div class="col-md-9">
                                <label id="wholesalePrice" class="control-label">Wholesale Price</label>
                            </div>
                        </div>
                        <br>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default btn-outline">Close</button>
                <button type="submit" class="btn btn-primary">Confirm</button>
            </div>
            </form>
        </div>

    </div>
</div>