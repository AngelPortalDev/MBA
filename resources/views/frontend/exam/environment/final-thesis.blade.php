<style>
    .custom-file-label {
        display: inline-block;
        cursor: pointer;
        padding: 0.375rem 0.75rem;
        margin-right: 0.5rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        color: #495057;
        background-color: #fff;
        white-space: nowrap;
    }

    .custom-file-label::after {
        content: 'Choose file';
        display: inline-block;
        padding: 0.375rem 0.75rem;
        margin-left: 0.5rem;
        border-left: 1px solid #ced4da;
    }

    .custom-file-label.selected::after {
        content: attr(data-filename);
    }

    .mainFinalThesisSection {
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        padding: 2rem;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .finalthesisjobDesc {
        background: #ffffff;
        padding: 10px;
        border-radius: 8px;
        display: inline-block;
        font-weight: 600;
    }
    .instruction-section{
        padding-left: 24px;
        padding-right: 24px;
        padding-top: 10px;
    }
</style>

<div class="header" >
    <nav class="navbar-default navbar navbar-expand-lg" style="background-color: #f1f5f9;box-shadow: none;">
        <a id="nav-toggle" href="#" class="color-blue fs-4 d-none">
            <button class="button is-text toggle-button" onclick="buttonToggleNew(this)">
                <div class="button-inner-wrapper">
                    <i class="bi bi-x toggle-icon" style="font-size: x-large"></i>
                </div>
            </button>
        </a>
        
        <a id="nav-toggle" href="#" class="color-blue fs-4">
            <button class="button is-text toggle-button" onclick="buttonToggleNew(this)">
                <div class="button-inner-wrapper">
                    <i class="bi bi-x toggle-icon" style="font-size: x-large"></i>
                </div>
            </button>
        </a>
        <div class="d-flex align-items-center justify-content-between ps-3">
            <div>
                <h3 class="mb-0 text-truncate-line-2 color-blue studentAssignmentTitle"> Final Thesis(100%)</h3>
            </div>

        </div>

    </nav>
</div>

<section class="instruction-section">
    <h4>Instructions:</h4>
    <ol>
        <li>Please ensure that the file you are uploading does not exceed 5 MB in size</li>
        <li>The report must be a minimum of 20,000 words.</li>
        <li>The document must be submitted as a PDF file. Only PDF files will be accepted for submission.</li>
    </ol>
</section>

<section class="container-fluid ps-5 pt-2">
    <div class="row justify-content-center">
        <div class="mainFinalThesisSection">
            <form class="finalthesisExamFormData">
                <div class="col-md-12 mb-5">
                    <div class="d-flex justify-content-between">
                        <h5 class="color-blue mb-0">
                            Question 1: Please submit a written recommendation (one-page-report) regarding the candidate suitability for the role.
                        </h5>
                        <p class="fw-bold color-blue">[100 Marks]</p>
                    </div>

                    <div class="col-md-4 mt-2">
                        <div class="mb-1 d-flex">
                            <div class="input-group" style="flex-wrap: inherit">
                                <label class="custom-file-label" for="customFile1" data-filename="">Choose PDF file</label>
                                <input type="file" class="custom-file-input" id="customFile1" name="docFile" accept="application/pdf" style="display: none" onchange="updateFileName(this)">
                                <button type="button" class="btn btn-primary">Upload</button>
                            </div>
                        </div>
                    </div>
                    <small>File size should be less than 5 MB</small>

                </div>
            </form>

            <div class="col-12 mb-6">
                <button type="button" class="btn btn-primary">Final Submit</button>
            </div>
        </div>
    </div>
</section>

<script>
    function updateFileName(input) {
        var fileName = input.files[0].name;
        var label = document.querySelector('.custom-file-label');
        label.classList.add('selected');
        label.setAttribute('data-filename', fileName);
    }
</script>
