@extends('layouts.template')
@section('vendor-css')
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <!-- Row Group CSS -->
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@section('info-page')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
            {{ str_replace('-', ' ', Request::path()) }}</li>
    </ol>
    <h5 class="font-weight-bolder mb-0 text-capitalize">{{ str_replace('-', ' ', Request::path()) }}</h5>
@endsection
@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="container-fluid px-3 mt-2 flex-grow-1 container-p-y">
            <div class="card" id="card-block">  
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Add Assessment</h4>
                </div>
                <div class="card-body">
                    <form id="form" enctype="multipart/form-data">
                        <div class="row mt-2 mb-3">
                            <div class="col-md-4 mt-1">
                                <label for="submission_type" class="form-label">Submission Type 
                                    <i  class="fa-solid fa-circle-info" 
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="right" 
                                        data-bs-html="true" 
                                        data-bs-title="
                                        <ol class='text-start'>
                                            <li>Single file: each submission is represented with either a file or a sub-directory with one file.</li>
                                            <li>Multiple files in a directory: each submission is represented with a sub-directory containing multiple files. All files will be concatenated prior to comparison.</li>
                                            <li>Multiple files in a zip: each submission is represented with a zip. The zip will be unzipped and all of its files will be concatenated prior to comparison.</li>
                                        </ol>">
                                    </i> : 
                                </label> 
                                <select id="submission_type" name="submission_type" class="form-control selectpicker  form-select" data-live-search="true" onchange="toggleInputSubtype()" required>
                                    <option selected>Open this select menu</option>
                                    <option value="file">Single file</option>
                                    <option value="dir">Multiple files in a directory</option>
                                    <option value="zip">Multiple files in a zip</option>
                                </select>
                            </div>
                            <div class="col-md-8 mt-1" style="margin-bottom:4rem">
                                <div id="zipoption" style="visibility: hidden; position: absolute;width:97%" >
                                    <label for="zip_file_path" class="form-label">Zip File <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="This refers to a directory containing student submissions as zip files."></i> :</label>
                                    <input class="form-control w-100" type="file" id="zip_file_path" name="zip_file_path">
                                </div>
                                <div id="diroption" style="visibility: hidden; position: absolute;width:97%" >
                                    <label for="dir_file_path" class="form-label">Directory Path <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="This refers to a directory containing student submissions as directory path."></i> :</label>
                                    <input class="form-control w-100" type="text" id="dir_file_path" name="dir_file_path" placeholder="Please paste the assessment directory here">
                                </div>
                                <div id="expoption" style="visibility: visible; position: absolute;width:97%" >
                                    <label for="explaination" class="form-label">Submission Path</label>
                                    <input class="form-control w-100" type="text" id="explaination" name="explaination" value="Please select the available Submission Type" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-end mb-3">
                            <div class="col-md-4 mt-1">
                                <label for="submission_language" class="form-label">Submission Language <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The programming language of the submissions."></i> :</label>
                                <select id="submission_language" name="submission_language" class="form-control selectpicker  form-select" data-live-search="true" onchange="toggleInputLang()" required>
                                    <option selected>Open this select menu</option>
                                    <option value="java">Java</option>
                                    <option value="py">Python</option>
                                    <option value="web">Web (HTML,CSS,JS,PHP)</option>
                                    <option value="dart">Dart</option>
                                    <option value="csharp">C#</option>
                                </select>
                            </div>
                            <div class="col-md-4 mt-1">
                                <label for="explanation_language" class="form-label">Explanation Language <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The human language of similarity explanation. The options are English and Indonesian."></i> :</label>
                                <select id="explanation_language" name="explanation_language" class="form-control selectpicker  form-select" data-live-search="true" required>
                                    <option value="en">English</option>
                                    <option value="id">Indonesian</option>
                                </select>
                            </div>
                            <div class="col-md-4 mt-1">
                                <label for="minimum_similarity_threshold" class="form-label">Minimum Similarity Threshold (%) :</label>
                                <div class="row align-items-end">
                                    <div class="col-md-6">
                                        <label for="sim_threshold" class="form-label">Sim <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The minimum percentage of similarity for a submission pair to be reported. The value is from 0 to 100 inclusive."></i> </label>
                                        <input type="number" id="sim_threshold" name="sim_threshold" class="form-control" min="0" max="100" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="dissim_threshold" class="form-label">Dissim <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="How unique a submission so that it can be reported as ``overly unique''. The submission might be a result from another collague. The value is from 0 to 100 inclusive."></i> </label>
                                        <input type="number" id="dissim_threshold" name="dissim_threshold" class="form-control" min="0" max="100" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row  mb-3">
                            <div class="col-md-4 mt-1">
                                <label for="maximum_reported_submission_pairs" class="form-label">Maximum Reported Submission Pairs <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The maximum number of reported submission pairs with high similarity. Larger value will display more submission pairs for manual check but will make the execution runs slower."></i> :</label>
                                <input type="number" id="maximum_reported_submission_pairs" name="maximum_reported_submission_pairs" class="form-control" min="0" required>
                            </div>
                            <div class="col-md-4 mt-1">
                                <label for="minimum_matching_length" class="form-label">Minimum Matching Length <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="It defines how many similar tokens ('words') are required for a part of the content to be reported. Larger value will mitigate the occurrence of coincidental similarity, but it will make the tool less resilient to disguises."></i> :</label>
                                <input type="number" id="minimum_matching_length" name="minimum_matching_length" class="form-control" min="0" required>
                            </div>
                            <div class="col-md-4 mt-1">
                                <label for="ai_generated_sample" class="form-label" >AI Generated Sample <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="This refers to a directory containing content generated by AI as a sample. The tool will report any submissions that are similar to it as ``suspected of AI misuse''."></i> :</label>
                                <input type="text" id="ai_generated_sample" name="ai_generated_sample" class="form-control" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 mt-1">
                                <label for="similarity_measurement" class="form-label">Similarity Measurement <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="How similarities will be detected. The options are MinHash, Super-Bit, Jaccard, Cosine, and RKRGST (running Karp-Rabin greedy string tiling). MinHash and Super-Bit are the most time efficient while RKRGST is the slowest."></i> :</label>
                                <select id="similarity_measurement" name="similarity_measurement" class="form-control selectpicker  form-select" data-live-search="true" onchange="toggleFields()" required>
                                    <option selected>Open this select menu</option>
                                    <option value="MinHash">MinHash</option>
                                    <option value="Super-Bit">Super-Bit</option>
                                    <option value="Jaccard">Jaccard</option>
                                    <option value="Cosine">Cosine</option>
                                    <option value="RKRGST">RKR-GST</option>
                                </select>
                            </div>
                            <div class="col-md-4 mt-1" id="templateDirectoryPath" style="display:none;">
                                <label for="template_directory_path" class="form-label" >Template Directory Path <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="This refers to a directory containing tenplate content stored as submission files. The tool will try to remove all template content in student submissions prior comparison."></i> :</label>
                                <input type="text" id="template_directory_path" name="template_directory_path" class="form-control">
                            </div>
                            <div class="col-md-4 mt-1" id="commonContent" style="display:none;">
                                <label for="common_content" class="form-label">Common Content <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="If this feature is turned on, the tool will try to remove all similar contents that are common among student submissions. This might result in longer processing time."></i> :</label>
                                <select id="common_content" name="common_content" class="form-control form-select">
                                    <option value="true">Allow</option>
                                    <option value="false">Disallow</option>
                                </select>
                            </div>
                            <div class="col-md-4 mt-1" id="td1" style="display:none;">
                                <label for="number_of_clusters" class="form-label">Number of Clusters:</label>
                                <input type="number" id="number_of_clusters" name="number_of_clusters" class="form-control">
                            </div>
                            <div class="col-md-4 mt-1" id="td2" style="display:none;">
                                <label for="number_of_stages" class="form-label">Number of Stages:</label>
                                <input type="number" id="number_of_stages" name="number_of_stages" class="form-control">
                            </div>
                            <div class="col-md-4 mt-1" style="display:none;">
                                <input type="text" id="user_id" name="user_id" class="form-control" value="{{ $guid }}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 mt-1">
                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

@endsection
@section('vendor-javascript')
    <script src="{{ asset('./assets/dashboard/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-responsive/datatables.responsive.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-checkboxes-jquery/datatables.checkboxes.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-buttons/datatables-buttons.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-buttons-bs5/buttons.bootstrap5.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-buttons/buttons.html5.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-buttons/buttons.print.js') }}"></script>
    <!-- Row Group JS -->
    <script src="{{ asset('./assets/dashboard/datatables-rowgroup/datatables.rowgroup.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-rowgroup-bs5/rowgroup.bootstrap5.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endsection
@section('custom-javascript')
    <script type="text/javascript">
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

        $(".selectpicker").selectpicker()
        var title = [];
        $('#mySelect option').each(function(){
            title.push($(this).attr('title'));
        });

        $("ul.selectpicker li").each(function(i){
            $(this).attr('title',title[i]).tooltip({container:"#tooltipBox"});
        })

        // function toggleInputLang() {
        //     var submissionLanguage = document.getElementById("submission_language");
        //     var selectedValue = submissionLanguage.options[submissionLanguage.selectedIndex].value;
        //     var templateDirectoryPath = document.getElementById("templateDirectoryPath");
        //     var commonContent = document.getElementById("commonContent");
        //     var td1 = document.getElementById("td1");
        //     var td2 = document.getElementById("td2");

        //     if (selectedValue === "java" || selectedValue === "py") {
        //         templateDirectoryPath.style.display = "inline";
        //         commonContent.style.display = "inline";
        //         td1.classList.remove("mt-1");
        //         td1.classList.add("mt-3");
        //         td2.classList.remove("mt-1");
        //         td2.classList.add("mt-3");
        //     } else {
        //         templateDirectoryPath.style.display = "none";
        //         commonContent.style.display = "none";
        //         td1.classList.remove("mt-3");
        //         td1.classList.add("mt-1");
        //         td2.classList.remove("mt-3");
        //         td2.classList.add("mt-1");
        //     }
        // }

        function toggleInputSubtype() {
            var submissionType = document.getElementById("submission_type");
            var selectedValue = submissionType.options[submissionType.selectedIndex].value;
            var zipoption = document.getElementById("zipoption");
            var diroption = document.getElementById("diroption");
            var expoption = document.getElementById("expoption");

            if (selectedValue === "zip") {
                zipoption.style.visibility = "visible";
                zipoption.querySelector('input').required = true;
                diroption.style.visibility = "hidden";
                diroption.querySelector('input').required = false;
                expoption.style.visibility = "hidden";
            } else if (selectedValue === "dir") {
                diroption.style.visibility = "visible";
                diroption.querySelector('input').required = true;
                zipoption.style.visibility = "hidden";
                zipoption.querySelector('input').required = false;
                expoption.style.visibility = "hidden";
            } else if (selectedValue === "file") {
                diroption.style.visibility = "visible";
                diroption.querySelector('input').required = true;
                zipoption.style.visibility = "hidden";
                zipoption.querySelector('input').required = false;
                expoption.style.visibility = "hidden";
            } else {
                zipoption.style.visibility = "hidden";
                diroption.style.visibility = "hidden";
                expoption.style.visibility = "visible";
            }
        }

        function toggleFields() {
            var selectBox = document.getElementById("similarity_measurement");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            var td1 = document.getElementById("td1");
            var td2 = document.getElementById("td2");

            // Check if the selected value should display td2
            if (selectedValue === "MinHash" || selectedValue === "Super-Bit") {
                td1.style.display = "inline";
                td2.style.display = "inline";
            } else {
                td1.style.display = "none";
                td2.style.display = "none";
            }
        }
        $(document).ready(function() {
            $('#form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                console.log(formData);
                for (var pair of formData.entries()) {
                    console.log(pair[0] + ', ' + pair[1]);
                }

                $.ajax({
                    type: "POST",
                    url: "{{ env('URL_API') }}/api/v1/form",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function(request) {
                        request.setRequestHeader("Authorization", "Bearer {{ $token }}");
                        $("#card-block").block({
                            message: '<div class="spinner-border text-primary" role="status"></div>',
                            css: {
                                backgroundColor: "transparent",
                                border: "0"
                            },
                            overlayCSS: {
                                backgroundColor: "#fff",
                                opacity: 0.8
                            }
                        });
                    },
                    success: function(result) {
                        $.unblockUI();
                        toastr.options.closeButton = true;
                        toastr.options.timeOut = 1000;
                        toastr.options.onHidden = function() {
                            var url = "{{ route('result') }}";
                            window.location.href = url;
                        }
                        toastr.success(
                            "Success add data", "Success"
                        );
                    },
                    error: function(xhr, status, error) {
                        $.unblockUI();
                        try {
                            var jsonResponse = JSON.parse(xhr.responseText);
                            toastr.options.closeButton = true;
                            toastr.error(jsonResponse['message'], "Error");
                        } catch (e) {
                            console.error("Error parsing JSON response:", e);
                            console.error("Response text:", xhr.responseText);
                            toastr.error("An error occurred", "Error");
                        }
                    },
                    complete: function() {
                        $.unblockUI();
                    }
                });
            });
        });


    </script>
@endsection
