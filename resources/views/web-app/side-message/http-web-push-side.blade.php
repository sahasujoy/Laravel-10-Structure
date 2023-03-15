
<div class="report-content">

    <p class="">For push notification integration on your website, kindly follow the below instructions. </p>

{{--    <h4>Add Code to Site</h4>--}}
    <ol>
        <li>Click <span><a href="{{ route('sdk-download-one-signal') }}" class="">Download</a></span>  push notification SDK files. (You can also
            <span><a href="{{ route('sdk-download-one-signal') }}" class="">download the file from here</a></span>). Unzip the downloaded file. There may be multiple files.</li>

        <li>
            Once you have  downloaded the library (push notification SDK) files, you will need to connect to your website's server. You can do this using an FTP client, such as FileZilla, cpanel etc. You will need your server's login credentials to connect.
        </li>

        <li>
            Once connected, navigate to the root directory (public) of your website. This is the main folder where all the files that make up your website are stored.
        </li>

        <li>
            Now, upload the library (push notification SDK) files that you have downloaded in step 1 to the root directory. Make sure to upload them to the correct location and keep the folder structure of the downloaded files intact.
        </li>

        <li>You must copy and paste the following code in the page  <code> &lt;head&gt; </code> where you wish to display notifications on the page in order to enable Push notifications on your site.
            You'll need to ask your developer for assistance if you don't have access to the code for your website.
            <br/>
            <strong>Your Code :</strong>
            <div class="alert alert-danger mt-1 alert-validation-msg d-none re_copy" role="alert">
                <div class="alert-body">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info mr-50 align-middle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                    <span>Please copy and replace your previous code into your website's <code> &lt;head&gt; </code>.Otherwise, new configuration will not be effective</span>
                </div>
            </div>

            <div class="form-group text-right">
                <button class="btn btn-outline-primary waves-effect copy__btn mb-2" onclick="copyCaption()">Copy Code</button>
                <textarea id="shareCaption" class="form-control shareCaptionTextArea" rows="25">
                {!! $script !!}
                </textarea>

            </div>
        </li>


{{--        <li>Unzip the download file. There may be multiple file, upload all t at the top-level root of your site.--}}
{{--        </li>--}}
{{--        <li><strong>Hosting the file:</strong>--}}
{{--            <br>--}}
{{--            The push notification SDK files must be publicly accessible and can be placed at the top-level root of your site.--}}
{{--        </li>--}}
    </ol>

    <h4>Subscribe and Send Yourself a Notification</h4>
    <ol>
        <li>
            Visit your website, and you should be prompted to subscribe to push notifications based on the prompt settings you setup.
        </li>
    </ol>

</div>
