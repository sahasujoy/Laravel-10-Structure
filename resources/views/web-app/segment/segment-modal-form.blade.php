<!-- Start : Segment name input -->
<div class="row">
    <!-- Start col  -->
    <div class="col-lg-6 col-sm-12">
        <div class="form-group">
            <label for="exampleInputEmail1">Name of segment <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control segment_name"
                name="segment_name"
                id="exampleInputEmail1"
                aria-describedby="emailHelp"
                placeholder="Enter email"
            />
            <span class="text-danger error-text segment_name_err"></span>
        </div>

        <label for="exampleInputEmail1">Name of segment <span class="text-danger">*</span></label>
        <input
            type="text"
            class="form-control hidden"
            name="segment_id"
            id="segment_id"
            value=""
        />
    </div>

    <!-- end col  -->
    <!-- Start col  -->
    <div class="col-lg-6 col-sm-12">
        <div class="pr-2 text-right">
{{--            <p class="text-dark">Total subscriptions (estimate)</p>--}}
{{--            <h3 class="text-dark">Pending</h3>--}}
        </div>
    </div>
    <!-- end col  -->
    <p class="pl-2">Users in this segment must meet these rules:</p>
</div>
<!-- End : Segment name input -->

<!-- Start input field  -->
<div class="row segment_filter_input">
    <!-- Append filter input here -->
</div>
<!-- End input field  -->

