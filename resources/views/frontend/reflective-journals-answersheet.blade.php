@extends('frontend.master')
@section('content')
<main>
    <section class="p-lg-5 py-7">
        <div class="container">

            <!-- Content -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-3 mb-xl-0">
                    <!-- Card -->
                    <div class="card mb-4">
                        <!-- Card body -->
                        <div class="card-body py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="fw-bold mb-0 color-blue ">Reflective Journals
                                    <span class="fs-6 fw-semibold">Award in Professional Development</span>
                                </h3>

                            </div>

                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">

                                    <div class="lh-1">
                                        <h4 class="mb-1"> Student Name: <span class="color-blue">Ross</span>
                                        </h4>
                                    </div>
                                </div>
                                <div>
                                    <a href="javascript:history.back()" class="btn btn-outline-primary">Back</a>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- Card -->
                    <div class="card rounded-3">
                        <!-- Card body -->
                        <section class="container px-4 pt-4">


                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    {{-- <p> <strong>Instructions:</strong> You need to be keeping a log of what you have learnt, your accomplishments and reflections and they you will be provided with a monthly update from your module e-mentor about what learning outcomes needed to be met during the previous month, information about your progress, and guidance on where you need to reflect on your progress.
                                    </p> --}}
                                    <p class="mb-0">An Reflective Journals is a document that you prepare over a period studying. It will include your feelings, your insights and your learning experiences. It details what you have learned, the impact of that learning, what it meant to you and how you will use that learning experience in the future. It may include a section on challenges faced, how you worked through those challenges and what you would do differently.</p>
                                    <p>It may also contain a section on reading or articles you read and what you learned from those or indeed theories or models that you can apply in the future.</p>
                                    <p>It is about growth and development.</p>
                                </div>
                                <hr>


                                    <div class="col-md-12 mb-5">
                                        <label for="textarea-input" class="form-label">
                                            <h5 class="color-blue mb-0"> 
                                                Reflective Journal Title</h5>
                                        </label>

                                        <input type="hidden" name="question_id" id="question_id" value="1">
                                        <input type="hidden" name="assignment_mark" id="assignment_mark" value="15">
                                        {{-- <h5>Answer:</h5> --}}
                                        {{-- <p> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quae quaerat reprehenderit culpa expedita alias corrupti repellat dolores ullam repellendus fugiat omnis soluta, perspiciatis placeat tempora, aliquam ab excepturi et illo, ipsam eius laborum provident nobis sapiente! Nesciunt pariatur cum voluptatum, rerum velit quam doloremque praesentium! Consectetur at aliquam quidem dolore itaque modi quis, quam quas sed labore iste cupiditate aspernatur ea ex error magni eveniet corrupti id quo quaerat illum rem. Reprehenderit ea ipsa labore minima, iure voluptates repudiandae rerum minus quos sed aliquam quis provident deleniti. Nihil accusantium repudiandae magni corrupti laborum, dolor at aperiam autem iure odit pariatur reiciendis quos. Eaque quod molestiae repudiandae, nulla excepturi corporis fuga alias facilis asperiores velit libero modi accusamus aspernatur laboriosam, fugit quaerat in ex sed! Nesciunt, voluptate commodi consequuntur quam quod, atque non dolorem nam fugiat sint mollitia, cum assumenda itaque! Facilis quisquam eos illum consequatur qui deleniti ipsa. Molestiae aut inventore facilis, numquam et facere, quos eaque temporibus nemo, minus assumenda voluptas repellendus? Consequuntur quas autem molestiae vitae eum sequi assumenda perspiciatis dolore suscipit aperiam doloribus, recusandae impedit tenetur sint maiores ipsam quisquam, voluptatibus at facere et reiciendis. Commodi reiciendis expedita quod voluptatum possimus ea laboriosam suscipit eius molestias facere.</p> --}}
                                    
                                        {{-- <div class="row"> --}}
                                            
                                        
                                            
                                        {{-- </div> --}}
                                        <div class="d-flex">
                                            <div>
                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewReflectiveJournals">View <i class="bi bi-eye"></i></button>
                                            </div>
                                            {{-- <div class="color-blue d-flex align-items-end ms-3">
        
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label fw-bold" for="flexSwitchCheckDefault">Check</label>
                                                </div>
                                            </div> --}}
                                        </div>
                                    
                                    </div>
                                    <hr>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="viewReflectiveJournals" tabindex="-1" aria-labelledby="viewReflectiveJournals" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-3" id="viewReflectiveJournals">Reflective Journals</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    {{-- <div class="col-md-12 mb-2">
                                                        <label class="form-label fs-4 color-blue" for="Reflective Journals Title">Reflective Title</label>
                                                        <input type="text " id="Reflective Journals Title" contenteditable="false" class="form-control mb-3 shadow-none" value="{{isset($portfolio['title']) ? $portfolio['title'] : ''}}"  required readonly>

                                                    </div> --}}
                                                    {{-- @foreach($portfolio['answers'] as $answer) --}}
                                                        {{-- <div class="col-md-12 mb-4">
                                                            <label class="form-label" for="Reflective Journals Title">1. Main points </label>
                                                            
                                                            <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly>{{isset($portfolio['answers'][0]->answer) ? $portfolio['answers'][0]->answer : "" }}</textarea>
                                                        </div>

                                                        <div class="col-md-12 mb-4">
                                                            <label class="form-label" for="Reflective Journals Title">2. Models and theories introduced</label>
                                                            
                                                            <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly>{{isset($portfolio['answers'][1]->answer) ? $portfolio['answers'][1]->answer : '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-12 mb-4">
                                                            <label class="form-label shadow-none" for="Reflective Journals Title">3. Key learnings</label>
                                                            
                                                            <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly>{{isset($portfolio['answers'][2]->answer) ? $portfolio['answers'][2]->answer : ''}}</textarea>
                                                        </div>
                                                        <div class="col-md-12 mb-4">
                                                            <label class="form-label" for="Reflective Journals Title">4. Challenges faced </label>
                                                            
                                                            <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly>{{isset($portfolio['answers'][3]->answer) ? $portfolio['answers'][3]->answer : ''}}</textarea>
                                                        </div>
                                                        <div class="col-md-12 mb-4">
                                                            <label class="form-label" for="Reflective Journals Title">5. How can I use what I learned in the future?</label>
                                                            
                                                            <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly>{{isset($portfolio['answers'][4]->answer) ? $portfolio['answers'][4]->answer : ""}}</textarea>
                                                        </div>
                                                        <div class="col-md-12 mb-4">
                                                            <label class="form-label" for="Reflective Journals Title">6. How has this learning facilitated personal growth?</label>
                                                            
                                                            <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly>{{isset($portfolio['answers'][5]->answer) ? $portfolio['answers'][5]->answer : "" }}</textarea>
                                                        </div>
                                                        <div class="col-md-12 mb-4">
                                                            <label class="form-label" for="Reflective Journals Title">7. Any additional reflections</label>
                                                            
                                                            <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly>{{isset($portfolio['answers'][6]->answer) ? $portfolio['answers'][6]->answer : ""}}</textarea>
                                                        </div> --}}
                                                    {{-- @endforeach --}}

                                                    {{-- <div class="col-12 mb-6 text-center">
                                                        <a href="#" class="btn btn-primary">Submit</a>
                                                    
                                                    </div> --}}
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            {{-- <button type="button" class="btn btn-primary">Save</button> --}}
                                            </div>
                                        </div>
                                        </div>
                                    </div>


                                {{-- <div class="col-md-12 mb-5">
                                    <label for="textarea-input" class="form-label">
                                        <h5 class="color-blue mb-0"> 
                                            2. Reflective Journals Title 2 </h5>
                                    </label>

                                    <input type="hidden" name="question_id" id="question_id" value="1">
                                    <input type="hidden" name="assignment_mark" id="assignment_mark" value="15"> --}}
                                    {{-- <h5>Answer:</h5> --}}
                                    {{-- <p> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quae quaerat reprehenderit culpa expedita alias corrupti repellat dolores ullam repellendus fugiat omnis soluta, perspiciatis placeat tempora, aliquam ab excepturi et illo, ipsam eius laborum provident nobis sapiente! Nesciunt pariatur cum voluptatum, rerum velit quam doloremque praesentium! Consectetur at aliquam quidem dolore itaque modi quis, quam quas sed labore iste cupiditate aspernatur ea ex error magni eveniet corrupti id quo quaerat illum rem. Reprehenderit ea ipsa labore minima, iure voluptates repudiandae rerum minus quos sed aliquam quis provident deleniti. Nihil accusantium repudiandae magni corrupti laborum, dolor at aperiam autem iure odit pariatur reiciendis quos. Eaque quod molestiae repudiandae, nulla excepturi corporis fuga alias facilis asperiores velit libero modi accusamus aspernatur laboriosam, fugit quaerat in ex sed! Nesciunt, voluptate commodi consequuntur quam quod, atque non dolorem nam fugiat sint mollitia, cum assumenda itaque! Facilis quisquam eos illum consequatur qui deleniti ipsa. Molestiae aut inventore facilis, numquam et facere, quos eaque temporibus nemo, minus assumenda voluptas repellendus? Consequuntur quas autem molestiae vitae eum sequi assumenda perspiciatis dolore suscipit aperiam doloribus, recusandae impedit tenetur sint maiores ipsam quisquam, voluptatibus at facere et reiciendis. Commodi reiciendis expedita quod voluptatum possimus ea laboriosam suscipit eius molestias facere.</p> --}}
                                   
                                    {{-- <div class="row"> --}}
                                        
                                       
                                        
                                    {{-- </div> --}}
                                    {{-- <div class="d-flex">
                                        <div>
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewPortfolio">View <i class="bi bi-eye"></i></button>
                                        </div>
                                        <div class="color-blue d-flex align-items-end ms-3">
    
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                                <label class="form-check-label fw-bold" for="flexSwitchCheckDefault">Check</label>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                                <hr>
                                <div class="col-md-12 mb-5">
                                    <label for="textarea-input" class="form-label">
                                        <h5 class="color-blue mb-0"> 
                                            3. Reflective Journals Title 3 </h5>
                                    </label>

                                    <input type="hidden" name="question_id" id="question_id" value="1">
                                    <input type="hidden" name="assignment_mark" id="assignment_mark" value="15"> --}}
                                    {{-- <h5>Answer:</h5> --}}
                                    {{-- <p> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quae quaerat reprehenderit culpa expedita alias corrupti repellat dolores ullam repellendus fugiat omnis soluta, perspiciatis placeat tempora, aliquam ab excepturi et illo, ipsam eius laborum provident nobis sapiente! Nesciunt pariatur cum voluptatum, rerum velit quam doloremque praesentium! Consectetur at aliquam quidem dolore itaque modi quis, quam quas sed labore iste cupiditate aspernatur ea ex error magni eveniet corrupti id quo quaerat illum rem. Reprehenderit ea ipsa labore minima, iure voluptates repudiandae rerum minus quos sed aliquam quis provident deleniti. Nihil accusantium repudiandae magni corrupti laborum, dolor at aperiam autem iure odit pariatur reiciendis quos. Eaque quod molestiae repudiandae, nulla excepturi corporis fuga alias facilis asperiores velit libero modi accusamus aspernatur laboriosam, fugit quaerat in ex sed! Nesciunt, voluptate commodi consequuntur quam quod, atque non dolorem nam fugiat sint mollitia, cum assumenda itaque! Facilis quisquam eos illum consequatur qui deleniti ipsa. Molestiae aut inventore facilis, numquam et facere, quos eaque temporibus nemo, minus assumenda voluptas repellendus? Consequuntur quas autem molestiae vitae eum sequi assumenda perspiciatis dolore suscipit aperiam doloribus, recusandae impedit tenetur sint maiores ipsam quisquam, voluptatibus at facere et reiciendis. Commodi reiciendis expedita quod voluptatum possimus ea laboriosam suscipit eius molestias facere.</p> --}}
                                   
                                    {{-- <div class="row"> --}}
                                        
                                       
                                        
                                    {{-- </div> --}}
                                    {{-- <div class="d-flex">
                                        <div>
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewPortfolio">View <i class="bi bi-eye"></i></button>
                                        </div>
                                        <div class="color-blue d-flex align-items-end ms-3">
    
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                                <label class="form-check-label fw-bold" for="flexSwitchCheckDefault">Check</label>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                                <hr> --}}
                                {{-- <div class="col-md-12 mb-5">
                                    <label for="textarea-input" class="form-label">
                                        <h5 class="color-blue mb-0"> 
                                            2. Reflective Journals Title 2 </h5>
                                    </label>

                                    <input type="hidden" name="question_id" id="question_id" value="1">
                                    <input type="hidden" name="assignment_mark" id="assignment_mark" value="15">
                                    <h5>Answer:</h5>
                                    <p> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quae quaerat reprehenderit culpa expedita alias corrupti repellat dolores ullam repellendus fugiat omnis soluta, perspiciatis placeat tempora, aliquam ab excepturi et illo, ipsam eius laborum provident nobis sapiente! Nesciunt pariatur cum voluptatum, rerum velit quam doloremque praesentium! Consectetur at aliquam quidem dolore itaque modi quis, quam quas sed labore iste cupiditate aspernatur ea ex error magni eveniet corrupti id quo quaerat illum rem. Reprehenderit ea ipsa labore minima, iure voluptates repudiandae rerum minus quos sed aliquam quis provident deleniti. Nihil accusantium repudiandae magni corrupti laborum, dolor at aperiam autem iure odit pariatur reiciendis quos. Eaque quod molestiae repudiandae, nulla excepturi corporis fuga alias facilis asperiores velit libero modi accusamus aspernatur laboriosam, fugit quaerat in ex sed! Nesciunt, voluptate commodi consequuntur quam quod, atque non dolorem nam fugiat sint mollitia, cum assumenda itaque! Facilis quisquam eos illum consequatur qui deleniti ipsa. Molestiae aut inventore facilis, numquam et facere, quos eaque temporibus nemo, minus assumenda voluptas repellendus? Consequuntur quas autem molestiae vitae eum sequi assumenda perspiciatis dolore suscipit aperiam doloribus, recusandae impedit tenetur sint maiores ipsam quisquam, voluptatibus at facere et reiciendis. Commodi reiciendis expedita quod voluptatum possimus ea laboriosam suscipit eius molestias facere.</p>

                                    <div class="row">
 
                                        <div class="color-blue d-flex align-items-end">
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                                <label class="form-check-label fw-bold" for="flexSwitchCheckDefault">Check</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="col-md-12 mb-5">
                                    <label for="textarea-input" class="form-label">
                                        <h5 class="color-blue mb-0"> 
                                            3. Reflective Journals Title 3 </h5>
                                    </label>

                                    <input type="hidden" name="question_id" id="question_id" value="1">
                                    <input type="hidden" name="assignment_mark" id="assignment_mark" value="15">
                                    <h5>Answer:</h5>
                                    <p> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quae quaerat reprehenderit culpa expedita alias corrupti repellat dolores ullam repellendus fugiat omnis soluta, perspiciatis placeat tempora, aliquam ab excepturi et illo, ipsam eius laborum provident nobis sapiente! Nesciunt pariatur cum voluptatum, rerum velit quam doloremque praesentium! Consectetur at aliquam quidem dolore itaque modi quis, quam quas sed labore iste cupiditate aspernatur ea ex error magni eveniet corrupti id quo quaerat illum rem. Reprehenderit ea ipsa labore minima, iure voluptates repudiandae rerum minus quos sed aliquam quis provident deleniti. Nihil accusantium repudiandae magni corrupti laborum, dolor at aperiam autem iure odit pariatur reiciendis quos. Eaque quod molestiae repudiandae, nulla excepturi corporis fuga alias facilis asperiores velit libero modi accusamus aspernatur laboriosam, fugit quaerat in ex sed! Nesciunt, voluptate commodi consequuntur quam quod, atque non dolorem nam fugiat sint mollitia, cum assumenda itaque! Facilis quisquam eos illum consequatur qui deleniti ipsa. Molestiae aut inventore facilis, numquam et facere, quos eaque temporibus nemo, minus assumenda voluptas repellendus? Consequuntur quas autem molestiae vitae eum sequi assumenda perspiciatis dolore suscipit aperiam doloribus, recusandae impedit tenetur sint maiores ipsam quisquam, voluptatibus at facere et reiciendis. Commodi reiciendis expedita quod voluptatum possimus ea laboriosam suscipit eius molestias facere.</p>

                                    <div class="row">
 
                                        <div class="color-blue d-flex align-items-end">
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                                <label class="form-check-label fw-bold" for="flexSwitchCheckDefault">Check</label>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}


                            </div>
                        </section>
                    </div>
                </div>


            </div>
        </div>
    </section>
</main>
@endsection


  <!-- Modal -->
  <div class="modal fade" id="viewReflectiveJournals" tabindex="-1" aria-labelledby="viewReflectiveJournalsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-3" id="viewReflectiveLabel">Reflective Journals</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
                <div class="col-md-12 mb-4">
                    <label class="form-label" for="Reflective Title">Q1. What have I learned about continuous learning, and how will I apply it? </label>
                    <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly></textarea>
                </div>

            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save</button> --}}
        </div>
      </div>
    </div>
  </div>