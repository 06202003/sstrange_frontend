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
    <link href="https://cdn.jsdelivr.net/npm/intro.js@7.2.0/minified/introjs.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.css" integrity="sha512-uf06llspW44/LZpHzHT6qBOIVODjWtv4MxCricRxkzvopAlSWnTf6hpZTFxuuZcuNE9CBQhqE0Seu1CoRk84nQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('info-page')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
            {{ str_replace('-', ' ', Request::path()) }}</li>
    </ol>
    <h5 class="font-weight-bolder mb-0 text-capitalize">{{ str_replace('-', ' ', Request::path()) }}</h5>
@endsection
@section('content')
    <style>
        .custom-modal-height .modal-dialog {
            height: 80vh; /* Fixed height for the dialog */
            max-height: 80vh;
        }

        .custom-modal-height .modal-content {
            height: 100%; /* Fill the dialog with content */
        }

        .custom-modal-height .modal-body {
            height: calc(80vh - 120px); /* Adjust height based on header and footer */
            overflow-y: auto; /* Scroll within modal body if content overflows */
        }
        .CodeMirror {
            font-size: 16px;
            line-height: 1.5;
        }

        .CodeMirror pre {
            font-family: "Courier New", monospace;
        }
    </style>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid px-3  flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="col-md-12">
                    <!-- Upload PDF Form -->
                    <div class="card " id="addpdf" style="height: 25vh;">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Add Questions</h4>
                        </div>
                        <div class="card-body">
                            <form id="upload-form" enctype="multipart/form-data">
                                <div class="row ">
                                    <div class="col-md-12 " style="margin-bottom:4rem">
                                        <label for="pdf" class="form-label">PDF</label>
                                        <input class="form-control w-100" type="file" id="pdf" name="pdf" accept="application/pdf">
                                        <button type="submit" class="btn btn-primary w-100 mt-2">Submit</button>
                                    </div>
                                </div>
                               
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- Display Parsed Text -->
                    <div class="card" id="generatecode" style="height: auto; min-height:40vh;">
                        <div class="card-header d-flex align-items-center">
                            <h4 class="mb-0">Generate Code from Questions</h4>
                            <button type="button" id="settingprompt" class="btn btn-secondary ms-auto" data-bs-toggle="modal" data-bs-target="#settingsModal">
                                <i class="fa-solid fa-gears"></i>
                            </button>
                            <!-- Settings Modal -->
                            <div class="modal fade" id="settingsModal" tabindex="-1" aria-labelledby="settingsModalLabel" aria-hidden="true">
                                <div class=" modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="settingsModalLabel">AI Generated Code - Manual Prompt</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body ">
                                            <form id="manual-prompt-form">
                                                <div class="mb-3">
                                                    <label for="manualPrompt" class="form-label">Enter Manual Prompt:</label>
                                                    <textarea id="manualPrompt" class="form-control" rows="5" placeholder="Type your manual prompt here..."></textarea>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Prompt</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <form id="parsed-form">
                                <div class="row mt-2">
                                    <div class="col-md-12 mt-1">
                                        <textarea id="pdf-text" class="form-control" rows="5" placeholder="Parsed text will appear here..."></textarea>
                                    </div>
                                </div>
                                <!-- Language Selection Dropdown -->
                                <div class="row mt-3">
                                    <div class="col-md-12 mt-1">
                                        <label for="language">Batasan Materi:</label>
                                        <input class="form-control w-100" type="text" id="batasan_materi" name="batasan_materi">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6 mt-1">
                                        <label for="language">Select Programming Language:</label>
                                        <select id="language" class="form-control selectpicker  form-select" data-live-search="true">
                                            <option value="python">Python</option>
                                            <option value="java">Java</option>
                                            <option value="csharp">C#</option>
                                            <option value="dart">Dart</option>
                                            <option value="javascript">JavaScript</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <label for="paradigm">Select Programming Paradigm:</label>
                                        <select id="paradigm" class="form-control selectpicker form-select" data-live-search="true">
                                            <option value="default">Default</option>
                                            <option value="procedural">Procedural</option>
                                            <option value="object_oriented">Object-Oriented</option>
                                        </select>
                                    </div>
                                </div>                              
                                <div class="row mt-3">
                                    <div class="col-md-12 mt-1">
                                        <button type="submit" class="btn btn-primary w-100">Generate Code</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12"  style="height: auto; min-height:40vh;overflow:auto">
                    <div class="card" id="questionlist">
                        <div class="card-header">
                            <h4 class="mb-0">Question List</h4>
                        </div>
                        <div class="card-body">
                            <div id="questions-list"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12"  style="height: 40vh;overflow:auto">
                    <div class="card" id="coderesult">
                        <div class="card-header">
                            <h4 class="mb-0">Code Result</h4>
                        </div>
                        <div class="card-body">
                            <div id="code-result"></div>
                            <div class="mt-4">
                                <form id="guid-form" style="display: none;">
                                    <div class="mb-3">
                                        <select class="form-control selectpicker form-select form-select-lg" name="simmilarity_guid" id="simmilarity_guid" data-live-search="true" data-size="5" data-dropup-auto="false">
                                    </select>    
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Update Simmilarity Result</button>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/intro.js@7.2.0/intro.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.js" integrity="sha512-8RnEqURPUc5aqFEN04aQEiPlSAdE0jlFS/9iGgUyNtwFnSKCXhmB6ZTNl7LnDtDWKabJIASzXrzD0K+LYexU9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/python/python.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/javascript/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/clike/clike.min.js"></script>
@endsection
@section('custom-javascript')
    <script type="text/javascript">
        introJs().setOptions({
            steps: [{
                title: "Welcome!",
                intro: "This is the Code Generator Page where you can generate various types of code.",
                // Menambahkan gaya khusus untuk langkah ini
                style: {
                    'text-align': 'center', // Memusatkan teks
                    'font-size': '18px' // Menambahkan ukuran font lebih besar jika perlu
                }
            }, {
                title: "Insert Questions",
                element: document.querySelector('#addpdf'),
                intro: "Insert practicum or homework questions in PDF format."
            }, {
                title: "Generate Code",
                element: document.querySelector('#generatecode'),
                intro: "Uploaded questions will be displayed, and you can generate code by inserting the necessary parameters."
            }, {             
                title: "Setting Manual Prompt",
                element: document.querySelector('#settingprompt'),
                intro: "Add your optional parameters to generate the code for your uploaded questions."

            }, {
                title: "Question List",
                element: document.querySelector('#questionlist'),
                intro: "Questions that have been filtered by regex will be displayed here."
            }, {
                title: "Generate Code",
                element: document.querySelector('#coderesult'),
                intro: "The result of the generated code will be displayed here."
            }],
            styles: {
                'intro': {
                    'width': '1000px', // Atur lebar kotak dialog
                    'height': 'auto',  // Atur tinggi kotak dialog secara otomatis
                },
                // Menambahkan gaya khusus untuk langkah pertama
                '.introjs-tooltip': {
                    'max-width': '1000px', // Atur lebar maksimum kotak dialog
                },
                '.introjs-tooltiptext': {
                    'text-align': 'center', // Memusatkan teks dalam kotak dialog
                    'font-size': '18px', // Mengatur ukuran font
                }
            }
        }).start();



        let generatedCodeStore = {};
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

    

        function copyCodeToClipboard(editorId) {
            const editor = codeMirrorInstances[editorId]; // Retrieve the CodeMirror instance
            if (editor) {
                const code = editor.getValue(); // Get the latest code content
                navigator.clipboard.writeText(code)
                    .then(() => {
                        toastr.success("Code copied to clipboard", "Success");
                    })
                    .catch((error) => {
                        toastr.error("Failed to copy code", "Error");
                        console.error("Copy failed:", error);
                    });
            } else {
                toastr.error("Editor not found", "Error");
                console.error("Editor not found for copying.");
            }
        }

        function downloadCodeWithModal(button) {
            const questionId = button.getAttribute('data-question-id'); // Get question ID from data attribute
            const language = button.getAttribute('data-language'); // Get language from data attribute
            const editorId = `modal-code-editor-${questionId.split('_')[1]}`; // Construct editor ID based on question ID
            const editor = codeMirrorInstances[editorId]; // Retrieve CodeMirror instance

            if (!editor) {
                toastr.error("Editor not found for download", "Error");
                console.error("Editor not found for downloading.");
                return;
            }

            const code = editor.getValue(); // Get the latest code content
            let fileExtension = '';

            // Determine file extension based on language
            switch (language.toLowerCase()) {
                case 'python':
                    fileExtension = '.py';
                    break;
                case 'java':
                    fileExtension = '.java';
                    break;
                case 'csharp':
                    fileExtension = '.cs';
                    break;
                case 'dart':
                    fileExtension = '.dart';
                    break;
                case 'javascript':
                    fileExtension = '.js';
                    break;
                default:
                    fileExtension = '.txt';
            }

            // Construct the filename
            const fileName = `${questionId}_code${fileExtension}`;

            // Create a Blob for the file download
            const blob = new Blob([code], { type: 'text/plain' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = fileName;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }

        const codeMirrorInstances = {}; // Store instances by editorId
        function initializeCodeMirrorEditor(editorId, code, language) {
            // Check if an instance already exists for this editorId
            if (codeMirrorInstances[editorId]) {
                // Update content if it already exists
                codeMirrorInstances[editorId].setValue(code);
                return;
            }

            const editorElement = document.getElementById(editorId);
            editorElement.value = code;

            let mode = "python"; // Default mode
            switch (language.toLowerCase()) {
                case 'java':
                    mode = "text/x-java";
                    break;
                case 'csharp':
                    mode = "text/x-csharp";
                    break;
                case 'dart':
                    mode = "dart";
                    break;
                case 'javascript':
                    mode = "javascript";
                    break;
                default:
                    mode = "python";
            }

            // Initialize CodeMirror and store the instance
            const editor = CodeMirror.fromTextArea(editorElement, {
                lineNumbers: true,
                readOnly: false,
                mode: mode,
                theme: "default",
                viewportMargin: Infinity,
                autoCloseBrackets: true,
                lineWrapping: true
            });
            editor.setSize("100%", "70vh");
            codeMirrorInstances[editorId] = editor; // Store the instance for future reference
        }

        let savedPrompt = "";
        let generatedCodeStoring = [];
        let completedRequests = 0;

        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "{{ env('URL_API') }}/api/v1/form",
                beforeSend: function(request) {
                    request.setRequestHeader("Authorization",
                        "Bearer {{ $token }}");
                },
                success: function(result) {
                    var taskList = $('#simmilarity_guid');
                    taskList.empty();
                    
                    // Append options to the select element
                    result.data.forEach(function(simmilarity) {
                        taskList.append('<option value="' + simmilarity.guid + '">' + simmilarity.filename + '</option>');
                    });

                    // Refresh the selectpicker to show the new options
                    $('#simmilarity_guid').selectpicker('refresh');
                },
                error: function(xhr, status, error) {
                    var jsonResponse = JSON.parse(xhr.responseText);
                }
            });

            $('#upload-form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "{{ env('URL_API') }}/api/v1/testing",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function(request) {
                        request.setRequestHeader("Authorization", "Bearer {{ $token }}");
                        // $("#card-block").block({
                        //     message: '<div class="spinner-border text-primary" role="status"></div>',
                        //     css: {
                        //         backgroundColor: "transparent",
                        //         border: "0"
                        //     },
                        //     overlayCSS: {
                        //         backgroundColor: "#fff",
                        //         opacity: 0.8
                        //     }
                        // });
                    },
                    success: function(result) {
                        $('#questions-list').empty();
                        var questionsText = '';

                        // If result contains 'questions', loop through and display them
                        if (result && result.length > 0) {
                            result.forEach(function(question) {
                                questionsText += 'Question ' + question.number + ': ' + question.question + '\n\n';
                            });
                        } else {
                            questionsText = "No questions found.";
                        }

                        // Insert the parsed questions into the textarea
                        $('#pdf-text').val(questionsText);

                        // Display success message
                        toastr.success("PDF processed successfully", "Success");
                    },
                    error: function(xhr) {
                        $.unblockUI();
                        toastr.error(xhr.responseJSON.message, "Error");
                    },
                    complete: function() {
                        $.unblockUI();
                    }
                });
                
            });
                       
            $('#manual-prompt-form').on('submit', function(e) {
                e.preventDefault();
                savedPrompt = $('#manualPrompt').val().trim(); // Get the value from the textarea
                $('#settingsModal').modal('hide'); // Close the modal after saving
                toastr.success("Prompt saved successfully", "Success");
            });


            $('#parsed-form').on('submit', function(e) {
                e.preventDefault();
                var parsedText = $('#pdf-text').val(); // Dapatkan teks yang sudah diparsing
                var selectedLanguage = $('#language').val(); // Dapatkan bahasa pemrograman yang dipilih
                var batasanMateri = $('#batasan_materi').val(); // Dapatkan input batasan materi
                var paradigm = $('#paradigm').val(); 
                var totalQuestions = 0;
         

                if (parsedText.trim() === '') {
                    toastr.error("No text to display.", "Error");
                    return;
                }

                var questionBlocks = parsedText.split(/Question\s*\d+:/i).filter(Boolean);
                totalQuestions = questionBlocks.length; // Total questions to process
                $('#questions-list').empty();

                questionBlocks.forEach(function(questionBlock, index) {
                    var question = questionBlock.trim();

                    $('#questions-list').append(`
                        <div class="card" style="height: 100px; overflow: auto; margin-bottom: 10px;">
                            <div class="card-body p-2">
                                <strong>Question ${index + 1}:</strong> ${question}
                            </div>
                        </div>
                    `);


                    console.log("Saved Prompt:", savedPrompt);
                    console.log("Question " + (index + 1) + ":", question);

                    // Call Flask backend
                    $.ajax({
                        type: "POST",
                        url: "http://localhost:5000/generate-code", // URL ke Flask API
                        contentType: "application/json",
                        data: JSON.stringify({
                            question: question,
                            language: selectedLanguage,
                            batasan: batasanMateri,
                            paradigm: paradigm,
                            prompt: savedPrompt || undefined
                        }),
                        success: function(result) {
                            const questionId = `question_${index + 1}`;
                            let cleanCode = result.code.replace(/```[a-z]*\n/g, '').replace(/```/g, '');
                            generatedCodeStore[questionId] = cleanCode; // Simpan kode ke dalam objek JavaScript
                            generatedCodeStoring.push({ question: question, code: cleanCode });
                            const modalId = `codeModal_${index + 1}`;
                            $('#code-result').append(`
                                <button class="btn btn-info my-2 w-100" data-bs-toggle="modal" data-bs-target="#${modalId}">Show Code for Question ${index + 1}</button>

                                <!-- Modal Dinamis -->
                                <div class="modal fade custom-modal-height" id="${modalId}" tabindex="-1" aria-labelledby="${modalId}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="${modalId}Label">Generated Code for Question ${index + 1}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                             
                                                <textarea class="CodeMirror" id="modal-code-editor-${index + 1}" style="display: none;">${cleanCode}</textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" onclick="copyCodeToClipboard('modal-code-editor-${index + 1}')">Copy</button>
                                                <button class="btn btn-primary" data-question-id="${questionId}" data-language="${selectedLanguage}" onclick="downloadCodeWithModal(this)">Download Code</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);
                                //    <pre id="modal-code-content-${index + 1}" class="bg-light p-3 rounded">${cleanCode}</pre>
                            // Initialize CodeMirror when the modal is shown
                            $(`#${modalId}`).on('shown.bs.modal', function () {
                                initializeCodeMirrorEditor(`modal-code-editor-${index + 1}`, cleanCode, selectedLanguage);
                            });
                                        
                            // Check if all requests have been completed
                            // completedRequests++;
                            // if (completedRequests === totalQuestions) {
                            //     sendCollectedCode();
                            // }

                            console.log(result.code)
                            // Display success message
                            toastr.success("Code generated successfully", "Success");
                        },
                        error: function(xhr) {
                            toastr.error("Error generating code", "Error");
                        }
                    });
                });
                $('#guid-form').show();
                // Display success message
                toastr.success("Parsed text displayed as JSON", "Success");
            });
        });

        $('#guid-form').on('submit', function(e) {
            e.preventDefault();
            
            // Get the selected GUID from the dropdown
            const simmilarityGuid = $('#simmilarity_guid').val();
            if (!simmilarityGuid) {
                toastr.error("Please select a valid GUID.", "Error");
                return;
            }
            // Log the GUID and proceed to send collected code
            console.log("Selected Simmilarity GUID:", simmilarityGuid);
            sendCollectedCode(simmilarityGuid);
        });
        
        // Function to send all collected code to the next route
        function sendCollectedCode(simmilarityGuid) {
            // Log the aggregated data for testing
            console.log("Aggregated Code Data with GUID:", { guid: simmilarityGuid, generated_code: generatedCodeStoring});

            // Proceed with the POST request
            $.ajax({
                type: "POST",
                url: "{{ env('URL_API') }}/api/v1/updateform",
                contentType: "application/json",
                data: JSON.stringify({
                    guid: simmilarityGuid,              
                    generated_code: generatedCodeStoring   
                }),
                beforeSend: function(request) {
                    request.setRequestHeader("Authorization", "Bearer {{ $token }}");
                },
                success: function(response) {
                    toastr.options.closeButton = true;
                    toastr.options.timeOut = 1000;
                    toastr.options.onHidden = function() {
                        var url = "{{ route('result') }}";
                        window.location.href = url;
                    }
                    toastr.success("Data updated successfully", "Success");
                },
                error: function(xhr) {
                    toastr.error("Error updating data", "Error");
                }
            });
        }

    </script>
@endsection


