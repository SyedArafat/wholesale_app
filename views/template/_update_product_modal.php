<div class="modal fade modal bs-modal-lg fade" id="editProductModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>Update Payment Configuration</b></h4>
            </div>
            <div class="modal-body">
                <form action="/" method="post">
                <div class="row">
                    <div class="form-group-custom">
                        <label for="product_title" class="col-md-3 control-label">Product Title</label>
                        <div class="col-md-9">
                            <input class="form-control" value="" type="text" name="product_title" id="product_title" required>
                        </div>
                    </div>
                    <br/>

                    <div class="form-group-custom">
                        <label for="product_price" class="col-md-3 control-label">Product Price</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="product_price" id="product_price" required>
                        </div>
                    </div>
                    <br>
                    <br>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default btn-outline">Close</button>
                <button type="button" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>

    </div>
</div>

<style>
    .form-group-custom {
        margin-bottom: 33px;
    }

</style>