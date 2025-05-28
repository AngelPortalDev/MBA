
<div class="modal fade" id="{{ $modalId ?? 'instructionModal' }}" aria-hidden="true" aria-labelledby="instructionModalToggleLabel"
    tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="instructionModalToggleLabel">Declaration:</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="modalCloseBtn" ></button>
                <div class="d-flex justify-content-center mt-3 d-none" id="countdownContainer">
                    <p id="countdownText" class="fw-bold text-danger">Auto-submitting in <span id="modalCountdownTimer">15</span> seconds...</p>
                </div>
            </div>
            <div class="modal-body">
                <!-- Declaration Section -->
                <div class="mt-0">
                    <p>I, <strong>{{auth()->user()->name. ' '. auth()->user()->last_name}}</strong>, hereby declare that <strong>{{ isset($exam_name) ? $exam_name : 'assessment' }}</strong> I submitted is entirely my original work.</p>
                    <p>I confirm that:</p>
                    <ol class="ps-0">
                        <li class="ms-4">I have not used any unauthorized sources or aids in completing this
                            assignment.</li>
                        <li class="ms-4">All ideas, concepts, and arguments presented in this assignment are
                            my own unless properly cited and referenced.</li>
                        <li class="ms-4">I have not copied material from any source, including the Internet,
                            without properly crediting the original author(s).</li>
                        <li class="ms-4">I have not collaborated with any other individual to complete this
                            assignment unless expressly permitted by the lecturer.</li>
                        <li class="ms-4">I understand that any form of academic dishonesty, including
                            plagiarism, will result in severe consequences, as outlined in EAscencia's academic
                            integrity policy.</li>
                    </ol>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="instruction_check" name='has_accepted_exam_instructions'
                            >
                        <label class="form-check-label" for="instruction_check">
                            I acknowledge that my submission is subject to scrutiny and verification for
                            originality by the ementor or academic authorities.
                        </label>
                    </div>
                </div>

                <!-- OK Button -->
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary {{$submit_button_class}}" data-bs-dismiss="modal" aria-label="Close" id="acceptButton"
                     {!! $extraRequirement !!} data-instruction="false">Final Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
