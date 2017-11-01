<div class="modal fade select_package" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"></button>
                    <h4 style="color:red;">
                        <span class="glyphicon glyphicon-lock"></span>
                        Manual Package change
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="package">
                            {{--<span class="glyphicon glyphicon-user"></span>--}}
                            Package
                        </label>
                        @include('admin.layouts.components.input.select_package')
                    </div>
                    <div class="form-group">
                        <label for="psw">
                            {{--<span class="glyphicon glyphicon-eye-open"></span>--}}
                            Period Type
                        </label>
                        <select name="sub_type" class="form-control">
                            <option value="1">Yearly</option>
                            <option value="0">Monthly</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="psw">
                            Pay status
                        </label>
                        <select name="pay_status" class="form-control">
                            <option value="1">payed</option>
                            <option value="0">not payed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer form-group">
                    <label class="col-md-4 control-label" for=".select_package .package_save"> </label>
                    <div class="col-md-8 btn-group">
                        <button name="save" class="btn btn-success package_save">Save</button>
                        <button name="cancel" class="btn btn-default"  data-dismiss="modal">Cancel</button>
                    </div>
                </div>нас
            </form>
        </div>
    </div>
</div>
