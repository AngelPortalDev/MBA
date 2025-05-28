
<div class="header">
    <nav class="navbar-default navbar navbar-expand-lg" style="background-color: #f1f5f9;box-shadow: none;">
        <a id="nav-toggle" href="#" class="color-blue fs-4 ">
            <button class="button is-text is-opened ms-2 m-2 m-md-0 m-md-0" id="menu-button" onclick="buttonToggle()">
                <div class="button-inner-wrapper">
                    <i id="menu-icon" class="bi-x" style="font-size: x-large"></i>
                </div>
            </button>
        </a>
        <div class="d-flex align-items-center justify-content-between ps-3">
            <div>
                <h3 class="mb-0 text-truncate-line-2 color-blue">E-portfolio</h3>
            </div>

        </div>

    </nav>
</div>

<!-- Page Header -->


<!-- Container fluid -->
<section class="container-fluid ps-4 pe-3">
    {{-- E-portfolio --}}
    <div class="row">



        <div class="col-md-12 mb-3">
            <b>What is an E-portfolio?</b>
            <p>An E-portfolio is a document that you prepare over a period studying.  It will include your feelings, your insights and your learning experiences.  It details what you have learned, the impact of that learning, what it meant to you and how you will use that learning experience in the future. It may include a section on challenges faced, how you worked through those challenges and what you would do differently. </p>
            <p>It may also contain a section on reading or articles you read and what you learned from those or indeed theories or models that you can apply in the future. </p>
            <p>It is about growth and development. </p>
        </div>

        <div class="col-md-12 mb-2">
            <label class="form-label fs-4 color-blue" for="E-portfolio Title">E-portfolio Title</label>
            <input type="text " id="E-portfolio Title" class="form-control  mb-3" placeholder="E-portfolio Title" required>

        </div>

        <div class="col-md-12 mb-4">
            <label class="form-label" for="E-portfolio Title">1. Main points </label>
             
            <textarea class="form-control" id="siteDescription" placeholder="Write here..." required="" rows="10"></textarea>
            <small>(Ensure your written answer are between 500 and 1000 words.)</small>
        </div>

        <div class="col-md-12 mb-4">
            <label class="form-label" for="E-portfolio Title">2. Models and theories introduced</label>
             
            <textarea class="form-control" id="siteDescription" placeholder="Write here..." required="" rows="10"></textarea>
            <small>(Ensure your written answer are between 500 and 1000 words.)</small>
        </div>
        <div class="col-md-12 mb-4">
            <label class="form-label" for="E-portfolio Title">3. Key learnings</label>
             
            <textarea class="form-control" id="siteDescription" placeholder="Write here..." required="" rows="10"></textarea>
            <small>(Ensure your written answer are between 500 and 1000 words.)</small>
        </div>
        <div class="col-md-12 mb-4">
            <label class="form-label" for="E-portfolio Title">4. Challenges faced </label>
             
            <textarea class="form-control" id="siteDescription" placeholder="Write here..." required="" rows="10"></textarea>
            <small>(Ensure your written answer are between 500 and 1000 words.)</small>
        </div>
        <div class="col-md-12 mb-4">
            <label class="form-label" for="E-portfolio Title">5. How can I use what I learned in the future?</label>
             
            <textarea class="form-control" id="siteDescription" placeholder="Write here..." required="" rows="10"></textarea>
            <small>(Ensure your written answer are between 500 and 1000 words.)</small>
        </div>
        <div class="col-md-12 mb-4">
            <label class="form-label" for="E-portfolio Title">6. How has this learning facilitated personal growth?</label>
             
            <textarea class="form-control" id="siteDescription" placeholder="Write here..." required="" rows="10"></textarea>
            <small>(Ensure your written answer are between 500 and 1000 words.)</small>
        </div>
        <div class="col-md-12 mb-4">
            <label class="form-label" for="E-portfolio Title">7. Any additional reflections</label>
             
            <textarea class="form-control" id="siteDescription" placeholder="Write here..." required="" rows="10"></textarea>
            <small>(Ensure your written answer are between 500 and 1000 words.)</small>
        </div>

        <div class="col-12 mb-6 text-center">
            <a href="#" class="btn btn-primary">Submit</a>
            {{-- <p class="mt-2 fw-bold">(Student can submit up to 20 E-portfolios for each module.)</p> --}}
        </div>

        <div class="col-12 mb-6">
            <div class="card">
                <div class="card-body">
                    <!-- row -->
                    <div class="row gx-3">
                        <div class="col-md-12">
                            <label for="customerNotes" class="form-label">
                                <h3 class="color-blue submittedPortfolioListTitle">Submitted E-portfolio List</h3>
                            </label>
                            <h4 class="mb-2"><a href="#" class="text-inherit">1. E-portfolio Title 1</a> <span class="badge bg-success-soft">Submitted</span> </h4>
                            <h4 class="mb-2"><a href="#" class="text-inherit">2. E-portfolio Title 2</a> <span class="badge bg-success-soft">Submitted</span> </h4>
                            <h4 class="mb-2"><a href="#" class="text-inherit">3. E-portfolio Title 3</a> <span class="badge bg-success-soft">Submitted</span> </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
</section>

