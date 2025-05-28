@extends('frontend.master')

@section('content')
<section class="pt-8 pb-4 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-12 col-12 mb-6">
                <!-- Instructions Card -->
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-body p-5">
                        <!-- Title -->
                        <h3 class="mb-4 text-primary fw-bold">
                            📌 Submission Guidelines
                        </h3>

                        <!-- Instructions List -->
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item bg-transparent">
                                ✅ A detailed report delivered as a PDF and formatted in ACM style (2) (maximum length of 10 pages).
                            </li>
                            <li class="list-group-item bg-transparent">
                                📚 References to academic literature: Ensure citations are included for all referenced papers and sources.
                            </li>
                            <li class="list-group-item bg-transparent">
                                💻 Your submission should also contain the supporting code in a Jupyter Notebook. Additionally, all necessary files should be included in a compressed (ZIP) folder with the following:
                                <ul class="mt-1">
                                    <li>📄 A README file that provides clear instructions on how to execute the code.</li>
                                    <li>📋 A requirements.txt file that lists all dependencies required for running the code.</li>
                                </ul>
                            </li>
                            <li class="list-group-item bg-transparent">
                                ✅ Ensure that the code is functional, well-documented, and reproducible.
                            </li>
                        </ul>

                        <!-- Additional Information -->
                        <p class="mb-3">
                            📥 For more details, download the guideline PDF below.
                        </p>

                        <!-- Compact Download Button -->
                        <a href="{{ asset('frontend/images/guidline.pdf') }}" target="_blank" class="btn btn-sm btn-outline-primary shadow-sm mb-4">
                            📄 Download PDF
                        </a>

                        <!-- GitHub ID Input Group -->
                        <div class="mb-3">
                            <label for="githubId" class="form-label fw-semibold">
                                🔗 Enter your GitHub ID
                            </label>
                            <div class="input-group shadow-sm">
                                <input type="text" id="githubId" class="form-control" placeholder="e.g., username123">
                                <button class="btn btn-primary">🚀 Submit</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
