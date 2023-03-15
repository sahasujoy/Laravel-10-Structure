<!--Start: Segment Modal -->
<form class="segment_form form form-vertical">
<div
    class="modal fade text-left segment"
    id="inlineForm"
    tabindex="-1"
    role="dialog"
    aria-labelledby="myModalLabel33"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalScrollableTitle ">
                    New Segment
                </h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                    <!-- Start: Segment inputs section  -->
                    <div class="segment-filter-input">

                    </div>
                    <!-- End: Segment inputs section  -->
                    @include('web-app.segment.segment-filter-option')
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary mr-1 button-submit create_segment_button">
                    <div style="display:none;"
                         class="spinner-border spinner-border-sm button-loader"
                         role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Create Segment
                </button>

                <button class="btn btn-primary mr-1 button-submit edit_segment_button d-none">
                    <div style="display:none;"
                         class="spinner-border spinner-border-sm button-loader"
                         role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Edit Segment
                </button>
            </div>
        </div>
    </div>
</div>
<!--End : Segment Modal -->
</form>
