<!-- Header import -->
@extends('admin.layouts.main')
@section('content')


<!-- Container fluid -->
<section class="p-4">
    <div class="container">
        <div id="courseForm" class="bs-stepper">
            <div class="row justify-content-center">
                <div class="col-md-10 col-12">
                    <!-- Card -->
                    <div class="card mb-4 ">

                        <div id="courseForm" class="bs-stepper">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-12">
                                    <!-- Card -->
                                    <div class="card mb-4 mt-4">
                                    <!-- Card body -->
                                    <form class="w-100 courseDocsForm" enctype="multipart/form-data">
                                      
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <h3 class="mb-2 editExamTitle">{{isset($articleData) && !empty($articleData) ? 'Edit Document' :  'Add Document'}}</h3>
                                                <button class="btn btn-outline-primary custum-btn-mobile" onclick="goBack()"><a class="nav-link " href="{{ route('admin.course.journal-articles') }}">Back </a></button>
                                            </div>
                                            {{-- <div class="w-100 d-flex justify-content-between">
                                                <h3 class="mb-2"><a href="#" class="text-inherit editExamTitle">Upload Document</a></h3>
                                                <a class="nav-link " href="{{ route('admin.course.journal-articles') }}">Document
                                            </div> --}}
                                            <!-- quiz -->
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="w-100">
                                                        <div>
                                                            <label class="form-label" for="editState">Select
                                                                Section <span class="text-danger">*</span></label>
                                                            <select class="form-select select2" name="section_id"
                                                                id="section_id" required="">
                                                                <option value="">Select</option>
                                                                {{-- <option
                                                                    value="{{ isset($articleData[0]['section_id']) && !empty($articleData[0]['section_id']) ? base64_encode($articleData[0]['section_id']) : ''}}"
                                                                    selected>
                                                                    {{ isset($articleData[0]['section']['section_name']) && !empty($articleData[0]['section']['section_name']) ? $articleData[0]['section']['section_name'] : "Select"}}
                                                                </option>
                                                                @foreach(getDropDownlist('course_section_masters',['section_name','id'])
                                                                as $stud)
                                                                @if (isset($articleData[0]['section_id']) && !empty($articleData[0]['section_id']) && $articleData[0]['section_id'] != $stud->id)
                                                                <option value="{{ base64_encode($stud->id)}}">
                                                                    {{$stud->section_name}}
                                                                </option>
                                                                @else
                                                                    <option value="{{ base64_encode($stud->id)}}">
                                                                    {{$stud->section_name}}
                                                                </option>
                                                                   @endif
                                                                @endforeach --}}

                                                                <?php $SectionData = getData('course_section_masters',['id','section_name'],['is_deleted'=>'No'],'','id','DESC');?>
                                                                @foreach($SectionData as $list)   
                                                                    @php $section_id = '';  @endphp
                                                                    @if(!empty($articleData))
                                                                        @php $section_id = $articleData[0]['section_id']; @endphp
                                                                    @endif
                                                                    <option value="{{ base64_encode($list->id)}}" @if($list->id == $section_id) selected @endif >{{htmlspecialchars_decode($list->section_name)}}</option>
                                                                @endforeach    
                                                            </select>
                                                            <div class="invalid-feedback" id="section_id_error">Please choose section.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mt-3 mt-md-0">
                                                    <div class="w-100">
                                                        <label class="form-label text-md-nowrap" for="editState">Document
                                                            Title <span class="text-danger">*</span></label>
                                                        <input type="text" name="journal_title" id="journal_title"
                                                            class="form-control" placeholder="Document Title"
                                                            required="" value="{{ isset($articleData[0]['docs_title'])  ? $articleData[0]['docs_title'] : ''}}">
                                                            <input type="hidden" value="{{ isset($articleData[0]['id']) && !empty($articleData[0]['id'])  ? base64_encode($articleData[0]['id']) : ''}}" name="article_id" id="article_id">
                                                             <input type="hidden" value="{{ isset($articleData[0]['file']) && !empty($articleData[0]['file'])  ? base64_encode($articleData[0]['file']) : ''}}" name="exist_url">
                                                             <small>Document title must be between 3 to 255 characters.</small>
                                                        <div class="invalid-feedback" id="journal_title_error">Please enter Document Title.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-header ">
                                            <div class="row justify-content-between">
                                                <div class="col-md-8">
                                                    <h4 class="mb-0">Upload here <span class="text-danger">*</span></h4>
                                                    <p class="mb-0">Add One Document at a Time for Student Study</p>
                                                </div>
                                                <div class="col-md-4">

                                                    @if (isset($articleData) && Storage::disk('local')->exists($articleData[0]['file']))
                                                    <div class="mt-3 text-end">
                                                        @php 
                                                        $fileExtension = pathinfo($articleData[0]['file'], PATHINFO_EXTENSION);
                                                        @endphp
                                                        @if (strtolower($fileExtension) === 'pdf')
                                                            <a href="{{ Storage::url($articleData[0]['file']) }}" class="btn btn-primary" target="_blank"> See Document <i
                                                                class="fe fe-eye"></i></a>
                                                        @else
                                                            <a onclick="ExcelContentDownload('{{ $articleData[0]['file'] }}', '{{ $articleData[0]['doc_file_name'] }}')" class="btn btn-primary" target="_blank">
                                                                See Document <i class="fe fe-eye"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">

                                            <div class=" rounded p-2 mb-2">

                                                <div class="list-group list-group-flush border-top-0" id="courseList">
                                                    <div id="courseOne">

                                                        <div class="mb-3">
                                                            <div class="custom-file-container mb-2">
                                                                <label class="input-container">
                                                                    <input accept=".pdf,.xls,.xlsx"  name="docsFile" aria-label="Choose File" class="form-control docsFile" id="inputLogo" type="file" draggable="false">
                                                                    <span class="input-visible">{{ isset($articleData[0]['doc_file_name']) ? $articleData[0]['doc_file_name'] : 'Choose file...' }} <span class="browse-button">Upload</span></span>
                                                                </label>
                                                                <small > ( PDF,EXCEL Max Size: 5 MB)</small>
                                                                <div class="invalid-feedback" id="journal_file_error">Please upload file.</div>
                                                            </div>
                                                            {{-- <div class="input-group mb-1">
                                                                <input type="file" name="docsFile" class="form-control"
                                                                    id="inputLogo" accept=".pdf">
                                                                <label class="input-group-text"
                                                                    for="inputLogo">Upload</label>
                                                            </div>
                                                         

                                                             --}}
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <button class="btn btn-primary addJournalDocs" type="button"
                                                name="submit">Save Now</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</main>

{{-- Delete video  --}}
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                Are you really want to delete Question?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    function ExcelContentDownload(file,file_name) {
        var newUrl = "{{ Storage::url('') }}" + file + "#toolbar=0&navpanes=0&scrollbar=0";
        var a = document.createElement('a');
        a.href = newUrl;
        a.download = file_name; // Set the desired file name for the download
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }

    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "Select Section",
            width: '100%'
        });
    });


    </script>
    @endsection