<div class="modal fade" id="requestFrameModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Request Frame</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="requestFrameForm" role="form">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="requestFrame">Frame</label>
                            <select id="requestFrame" name="frame_id" class="select2" data-placeholder="Select frame"
                                style="width: 100%;">
                                <option selected="selected" disabled="disabled">
                                    Select frame
                                </option>
                                @forelse ($organization->frame()->latest()->get() as $frame)
                                    <option value="{{ $frame->id }}">
                                        Frame Code: {{ $frame->code }} -
                                        Frame Brand: {{ $frame->frame_brand->title }}
                                    </option>
                                @empty
                                    <option disabled="disabled">
                                        No Stock transfered yet
                                    </option>
                                @endforelse
                            </select>
                        </div>
                        <!-- /.col-md-6 -->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="requestFrameDate">
                                    Requested Date
                                </label>
                                <input type="text" id="requestFrameDate" name="request_date"
                                    class="form-control datepicker" placeholder="Request date" />
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="requestFrameGender">
                                    Gender
                                </label>
                                <select id="requestFrameGender" name="gender" class="form-control select2"
                                    style="width: 100%;">
                                    <option disabled='disabled' selected="selected">
                                        Choose Gender
                                    </option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Unisex">Unisex</option>
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!--/.col -->

                        <div class="col-md-6">
                            <label for="requestFrameQuantity">Quantity</label>
                            <input type="number" id="requestFrameQuantity" name="quantity" class="form-control"
                                placeholder="Quantity" />
                        </div>
                        <!-- /.col-md-6 -->
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="requestFrameColorId">
                                    Color
                                </label>
                                <select id="requestFrameColorId" name="color_id" class="form-control select2"
                                    style="width: 100%;">
                                    <option disabled='disabled' selected="selected">
                                        Choose Frame Color
                                    </option>
                                    @forelse ($organization->frame_color()->latest()->get() as $color)
                                        <option value="{{ $color->id }}">
                                            {{ $color->color }}
                                        </option>
                                    @empty
                                        <option disabled="disabled">No Frame Colors Found</option>
                                    @endforelse
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!--/.col -->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="requestFrameShapeId">
                                    Frame Shape
                                </label>
                                <select id="requestFrameShapeId" name="shape_id" class="form-control select2"
                                    style="width: 100%;">
                                    <option disabled='disabled' selected="selected">
                                        Choose Frame Shape
                                    </option>
                                    @forelse ($organization->frame_shape()->latest()->get() as $shape)
                                        <option value="{{ $shape->id }}">
                                            {{ $shape->shape }}
                                        </option>
                                    @empty
                                        <option disabled="disabled">No Frame Shapes Found</option>
                                    @endforelse

                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>
                    <!--/.row -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="requestFrameRemarks">Remarks</label>
                                <textarea id="requestFrameRemarks" name="remarks" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                            </div>
                        </div>
                    </div>
                    <!--/.row -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Request</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
