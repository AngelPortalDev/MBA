@extends('frontend.master')
@section('content')

<style>
    .course-details-play-icon {
    height: 45px;
    width: 45px;
    background-color: #2b3990;
    border-radius: 50%;
    color: #dae138;
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 2;
    font-size: 24px;
}
    .course-details-play-icon::before {
    color: #dae138;
    font-size: 14px;
    display: flex
;
    justify-content: center;
    align-items: center;
    vertical-align: middle;
    margin: 0 auto;
    margin-top: 0px;
    border-radius: 50%;
    margin-left: 10px;
    font-size: 24px;
    }

    .video-container {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }
</style>

<main>
    <div class="py-md-8 py-4 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- caption-->
                    <h1 class="fw-bold mb-1 display-4">Frequently Asked Questions</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- container  -->
    <div class="pt-3 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div>
                        <!-- breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Faq</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="py-8 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mb-4">
                        <h2 class="mb-0 fw-semibold">Most asked</h2>
                    </div>
                    <div class="accordion accordion-flush" id="accordionExample">
                        <div class="border p-3 rounded-3 mb-2" id="headingOne">
                            <h3 class="mb-0 fs-4">
                                <a href="#" class="d-flex align-items-center text-inherit active collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <span class="me-auto">What are MQF and EQF?</span>
                                    <span class="collapse-toggle ms-4">
                                        <i class="fe fe-chevron-down"></i>
                                    </span>
                                </a>
                            </h3>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                <div class="pt-2">
                                    MQF stands for Malta Qualifications Framework. It is a national qualifications framework used in Malta to structure qualifications and ensure consistency and quality in education. It serves as a reference for understanding and comparing the levels of different qualifications within the Maltese educational system and across various fields of study. The MQF aims to facilitate lifelong learning and recognize all forms of learning, including formal, non-formal, and informal education. <br><br>
                                    The MQF is structured into eight levels, each representing a unique stage of learning. These levels are about acquiring knowledge and developing skills and competencies. Each level is a stepping stone, leading to the next and reflecting the increasing complexity and depth of knowledge required. <br><br>
                                    EQF stands for European Qualifications Framework. It is a common European reference framework designed to make national qualifications more readable and understandable across different countries and systems within Europe. It acts as a translation device to help educational institutions, employers, and individuals compare qualifications across European countries. EQF promotes greater transparency, mobility, and lifelong learning across Europe. <br><br>
                                    The alignment of the MQF with the EQF not only ensures that Malta's qualifications are easily understood and respected throughout Europe but also fosters enhanced educational and professional opportunities for its citizens. This alignment provides individuals with a clear roadmap for career development, showing progression routes through various levels of education and training. Moreover, it enhances the global recognition of qualifications, opening up worldwide opportunities for E-Ascencia and Ascencia Malta graduates.
                                    
                                </div>
                            </div>
                        </div>
                        <!-- Card  -->
                        <!-- Card header  -->
                        <div class="border p-3 rounded-3 mb-2" id="headingTwo">
                            <h3 class="mb-0 fs-4">
                                <a href="#" class="d-flex align-items-center text-inherit collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span class="me-auto">What are ECTS?</span>
                                    <span class="collapse-toggle ms-4">
                                        <i class="fe fe-chevron-down"></i>
                                    </span>
                                </a>
                            </h3>

                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="pt-3">
                                    ECTS stands for European Credit Transfer System. ECTS credits measure how much work is needed to finish a course or program. Each course in a program has a certain number of ECTS credits assigned to it. These credits show how much time and effort is required to complete the course, including attending lectures, doing assignments, and taking exams. <br><br>
                                    One ECTS credit equals about 25 to 30 hours of work. So, if a course is worth 3 ECTS credits, you can expect to spend about 75 to 90 hours on it. A full academic year is usually worth 60 ECTS credits. This means that students are expected to work a total of 1,500 to 1,800 hours over the year to earn those credits. <br><br>
                                    ECTS makes the educational process straightforward and transparent. It helps different universities understand and recognize other institutions' qualifications and study periods. This means that if you study abroad or transfer to a different university in the EU, you can carry over the credits you have already earned. The system ensures that your academic progress is recognized and valued, making it easier for you to move between different institutions while continuing your studies smoothly.<br><br>
                                    At E-Ascencia, courses are structured according to ECTS standards, ensuring the credits assigned reflect the expected workload and learning outcomes. Students expect each course to have clearly defined learning outcomes and workload requirements, ensuring a consistent and transparent educational experience.<br><br>
                                    By meticulously assigning and reviewing ECTS credits, E-Ascencia Malta supports student mobility, academic recognition, and flexible learning pathways within Europe’s higher education framework.
                                    
                                </div>
                            </div>
                        </div>
                        <!-- Card  -->
                        <!-- Card header  -->
                        <div class="border p-3 rounded-3 mb-2" id="headingThree">
                            <h3 class="mb-0 fs-4">
                                <a href="#" class="d-flex align-items-center text-inherit active collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span class="me-auto">What is the MFHEA?</span>
                                    <span class="collapse-toggle ms-4">
                                        <i class="fe fe-chevron-down"></i>
                                    </span>
                                </a>
                            </h3>

                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="pt-3">
                                    The MFHEA in Malta stands for the Malta Further and Higher Education Authority. The MFHEA plays a vital role in upholding educational standards in Malta. The MFHEA is an independent regulatory body that oversees and ensures the quality and standards of further and higher education institutions across the country. This includes verifying that these institutions adhere to national and international benchmarks for quality education. To maintain and elevate these standards, the MFHEA conducts external quality assurance audits. <br><br>
                                    The MFHEA authority grants accreditation to educational institutions and verifies that they meet required educational standards. This accreditation serves as a stamp of approval, indicating that an institution meets the required educational standards and provides quality education to national and international students. E-Ascencia and Ascencia Malta have received approval from MFHEA, assuring students and parents that the qualifications offered by the institution are legitimate and trustworthy.<br><br>
                                    Moreover, MFHEA offers valuable guidance and information to students, assisting them in making informed decisions about their education and career paths. Those seeking assistance can visit the MFHEA website for support.<br><br>
                                    Overall, MFHEA is a pivotal authority in Malta, ensuring the quality and recognition of further and higher education. Beyond regulation, it also develops educational policies, supports students, and promotes lifelong learning. Through its oversight of institutions and programs, MFHEA maintains high educational standards and helps students achieve their academic and career aspirations.

                                </div>
                            </div>
                        </div>
                        <!-- Card  -->
                        <!-- Card header  -->
                        <div class="border p-3 rounded-3 mb-2" id="headingFour">
                            <h3 class="mb-0 fs-4">
                                <a href="#" class="d-flex align-items-center text-inherit active collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <span class="me-auto">Difference between module and award</span>
                                    <span class="collapse-toggle ms-4">
                                        <i class="fe fe-chevron-down"></i>
                                    </span>
                                </a>
                            </h3>

                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="pt-3">
                                    Modules and Awards are both used in education to recognize and certify learning achievements. However, they have some key differences. A module is a unit of study that usually runs for a set period of time (e.g., six weeks) and covers a specific topic or set of topics. It often involves classwork, assignments, and exams to assess the learner's understanding. Completing a module typically earns a certain number of credit points, which can be applied towards a degree. <br><br>
                                    Modules are the individual units of study within a program that focus on specific topics and contribute credits toward the qualification. <br><br>
                                    On the other hand, an award is a certificate that E-Ascencia provides to its students after they successfully complete a module. This award certifies that students have successfully completed a particular module on a specific date.
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="mb-4 mt-6">
                        <h2 class="mb-0 fw-semibold">General inquiries</h2>
                    </div>
                    <!-- accordion  -->
                    <div class="accordion accordion-flush" id="accordionExample2">
                        <div class="border p-3 rounded-3 mb-2" id="headingEight">
                            <h3 class="mb-0 fs-4">
                                <a href="#" class="d-flex align-items-center text-inherit" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                    <span class="me-auto">What data does E-Ascencia collect from users?</span>
                                    <span class="collapse-toggle ms-4">
                                        <i class="fe fe-chevron-down"></i>
                                    </span>
                                </a>
                            </h3>
                            <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample2">
                                <div class="pt-2">
                                    <p>As an educational portal offering online courses, E-Ascencia may collect various types of data from users to enhance their learning experience and provide effective services. The data collected may include:</p>
                                    <p class="mt-2">Personal Information:</p>
                                    <ul>
                                        <li>Full name</li>
                                        <li>Email address</li>
                                        <li>Date of birth</li>
                                        <li>Gender</li>
                                        <li>Contact information (phone number, address)</li>
                                    </ul>
                                    <p>Account Information:</p>
                                    <ul>
                                        <li>Username</li>
                                        <li>Password (encrypted for security)</li>
                                        <li>Profile picture (optional)</li>
                                    </ul>
                                    <p>Educational Background:</p>
                                    <ul>
                                        <li>Academic qualifications</li>
                                        <li>Employment history</li>
                                        <li>Current job position (for professionals)</li>
                                    </ul>
                                    <p>Payment Information:</p>
                                    <ul>
                                        <li>Credit/debit card details</li>
                                        <li>Billing address</li>
                                        <li>Payment history</li>
                                    </ul>
                                    <p>Technical Data:</p>
                                    <ul>
                                        <li>IP address</li>
                                        <li>Browser type and version</li>
                                        <li>Device information (such as operating system screen resolution)</li>
                                        <li>Session duration and activity logs</li>
                                    </ul>
                                    <p>User Preferences and Interests:</p>
                                    <ul>
                                        <li>Preferred language</li>
                                        <li>Course preferences</li>
                                        <li>Feedback and survey responses</li>
                                    </ul>
                                    <p>Usage Data:</p>
                                    <ul>
                                        <li>Pages visited</li>
                                        <li>Course materials accessed</li>
                                        <li>Progress within courses (e.g., quizzes taken, assignments submitted)</li>
                                    </ul>
                                    <p>Communication Data:</p>
                                    <ul>
                                        <li>Correspondence with customer support</li>
                                        <li>Interaction with discussion forums or chat features</li>
                                    </ul>
                                    <p>E-ascension needs to handle this data responsibly and ensure compliance with data protection regulations such as GDPR (General Data Protection Regulation) or similar laws, depending on the jurisdiction. It typically involves obtaining explicit consent from users before collecting their data, implementing security measures to protect personal information, and providing users with control over their data through options such as account settings and data deletion requests. Additionally, E-Ascencia should have a transparent privacy policy outlining how they collect, use, and protect user data.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Card  -->
                        <!-- Card header  -->
                        <div class="border p-3 rounded-3 mb-2" id="headingNine">
                            <h3 class="mb-0 fs-4">
                                <a href="#" class="d-flex align-items-center text-inherit" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                    <span class="me-auto">How are users' data used?</span>
                                    <span class="collapse-toggle ms-4">
                                        <i class="fe fe-chevron-down"></i>
                                    </span>
                                </a>
                            </h3>
                            <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-bs-parent="#accordionExample2">
                                <div class="pt-3">
                                    <p class="mb-2">E-Ascencia uses the data collected from users in the following ways:</p>
                                    <ol>
                                        <li>Personal Information: We use your details like your name, email, date of birth, gender, and contact information needed to set up and manage your account, as well as for communication purposes and personalizing your learning experience.</li>
                                        <li>Account Information: Your username and password help you securely access our platform, while your profile picture (if provided) helps personalize your account.</li>
                                        <li>Educational Background: We collect your academic and employment history to understand your background better and tailor course recommendations to your needs.</li>
                                        <li>Payment Information: Your payment details are used to process course payments securely and efficiently.</li>
                                        <li>Technical Data: We gather technical information like your IP address, browser type, and device details to ensure our website runs smoothly and to troubleshoot any issues you may encounter.</li>
                                        <li>User Preferences and Interests: Your language preferences and course interests help us recommend relevant courses and content that match your needs and preferences. We also use feedback and survey responses to improve our services.</li>
                                        <li>Usage Data: We track your activity on our platform, such as the pages you visit and your progress within courses, to understand how you use our services and to improve them accordingly.</li>
                                        <li>Communication Data: We use correspondence data to assist you with any inquiries or issues you may have and to facilitate interaction through discussion forums or chat features.</li>
                                    </ol>
                                    <p>Overall, we use your data to provide you with a personalized and seamless learning experience while ensuring the security and privacy of your information.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Card  -->
                        <!-- Card header  -->
                        <div class="border p-3 rounded-3 mb-2" id="headingTen">
                            <h3 class="mb-0 fs-4">
                                <a href="#" class="d-flex align-items-center text-inherit active" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                    <span class="me-auto">Is the user's data shared with third parties?</span>
                                    <span class="collapse-toggle ms-4">
                                        <i class="fe fe-chevron-down"></i>
                                    </span>
                                </a>
                            </h3>
                            <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-bs-parent="#accordionExample2">
                                <div class="pt-3">
                                    <p>E-Ascencia takes your privacy seriously and does not share your data with third parties unless it is necessary to provide our services or required by law. In cases where third-party service providers are involved, we ensure that they adhere to strict privacy and security standards to protect your information. Your data is never sold or shared for marketing purposes without your explicit consent. We are committed to safeguarding your privacy and maintaining the confidentiality of your data.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Card  -->
                        <!-- Card header  -->
                        <div class="border p-3 rounded-3 mb-2" id="headingEleven">
                            <h3 class="mb-0 fs-4">
                                <a href="#" class="d-flex align-items-center text-inherit active" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                    <span class="me-auto">How do you comply with privacy laws and regulations?</span>
                                    <span class="collapse-toggle ms-4">
                                        <i class="fe fe-chevron-down"></i>
                                    </span>
                                </a>
                            </h3>
                            <div id="collapseEleven" class="collapse" aria-labelledby="headingEleven" data-bs-parent="#accordionExample2">
                                <div class="pt-3">
                                    <p>E-Ascencia complies with privacy laws and regulations by following strict guidelines to protect your personal information. We ensure that your data is collected and used responsibly, with your consent and for legitimate purposes only. Our approach to privacy follows guidelines such as the General Data Protection Regulation (GDPR). This regulation establishes rules for safeguarding personal data and ensuring individuals' privacy rights are respected. We prioritize your privacy and take measures to safeguard your data against unauthorized access, misuse, or disclosure. If you have any worries or questions about how we manage your information, please do not feel free to reach out to us.</p>
                                </div>
                            </div>
                        </div>
                        <div class="border p-3 rounded-3 mb-2" id="headingSixteen">
                            <h3 class="mb-0 fs-4">
                                <a href="#" class="d-flex align-items-center text-inherit active" data-bs-toggle="collapse" data-bs-target="#collapseSixteen" aria-expanded="false" aria-controls="collapseSixteen">
                                    <span class="me-auto">How often are your privacy policies reviewed and updated?</span>
                                    <span class="collapse-toggle ms-4">
                                        <i class="fe fe-chevron-down"></i>
                                    </span>
                                </a>
                            </h3>
                            <div id="collapseSixteen" class="collapse" aria-labelledby="headingSixteen" data-bs-parent="#accordionExample2">
                                <div class="pt-3">
                                    <p> <strong> Review and Updates:</strong> E-Ascencia makes sure to review and update its privacy policy at least once a year. It is important to ensure that the policy stays current and aligns with any changes in laws or regulations regarding data privacy. However, if there are significant changes in the business operations or approaches to handling data, E-Ascencia may opt to review and update the policy more frequently.</p>
                                    <p> <strong>Factors Driving Updates:</strong> E-Ascencia understands that various factors can necessitate updates to its privacy policy. These factors include advancements in technology, changes in regulations governing data protection, or shifts in the company's strategies related to data handling. By staying responsive to these factors, E-Ascencia ensures that its privacy policy remains relevant and effective in safeguarding user data.</p>
                                    <p> <strong> Updates with New Products or Services: </strong> Whenever E-Ascencia introduces a new product or service, it takes the opportunity to review and update its privacy policy accordingly. It ensures that the policy encompasses any new data collection or usage practices associated with the new offering, thereby maintaining transparency and compliance with privacy standards.</p>

                                    <p class="mt-2">E-Ascencia communicates privacy policy updates to users through various channels. It may include sending email notifications to registered users, displaying notices on the website, or providing pop-up messages upon logging in. By proactively informing users about changes to the privacy policy, E-Ascencia promotes transparency and allows users to stay informed about how their data is handled.</p>
                                </div>
                            </div>
                        </div>
                        <div class="border p-3 rounded-3 mb-2" id="headingSeventeen">
                            <h3 class="mb-0 fs-4">
                                <a href="#" class="d-flex align-items-center text-inherit active" data-bs-toggle="collapse" data-bs-target="#collapseSeventeen" aria-expanded="false" aria-controls="collapseSeventeen">
                                    <span class="me-auto">Who can I contact for further questions or concerns about privacy?</span>
                                    <span class="collapse-toggle ms-4">
                                        <i class="fe fe-chevron-down"></i>
                                    </span>
                                </a>
                            </h3>
                            <div id="collapseSeventeen" class="collapse" aria-labelledby="headingSeventeen" data-bs-parent="#accordionExample2">
                                <div class="pt-3">
                                    <p>For further questions or concerns about privacy, you can contact E-Ascencia 's designated privacy officer or data protection officer. Their contact information should be available in the privacy policy or on the website's contact page. Alternatively, you can reach out to E-Ascencia 's customer support team for assistance with privacy-related inquiries.</p>

                                </div>
                            </div>
                        </div>
                        <div class="border p-3 rounded-3 mb-2" id="headingEighteen">
                            <h3 class="mb-0 fs-4">
                                <a href="#" class="d-flex align-items-center text-inherit active" data-bs-toggle="collapse" data-bs-target="#collapseEighteen" aria-expanded="false" aria-controls="collapseEighteen">
                                    <span class="me-auto">Is there a refund policy in place?</span>
                                    <span class="collapse-toggle ms-4">
                                        <i class="fe fe-chevron-down"></i>
                                    </span>
                                </a>
                            </h3>
                            <div id="collapseEighteen" class="collapse" aria-labelledby="headingEighteen" data-bs-parent="#accordionExample2">
                                <div class="pt-3">
                                    <p class="mb-2">Yes, E-Ascencia has a refund policy. If you buy a course and are not happy, you can get your money back within 14 days. Usually, you will get a refund the same way you paid. But there might be some rules, and sometimes you will only get credit instead of cash. You can find more details about our refund policy below.</p>
                                    <p class="fw-bold mb-2">Refund Policy:</p>

                                            <p>1. Full Refund:</p>
                                            <ul>
                                                <li>You can get a full refund if you cancel your course enrollment within 14 days of purchasing the course.</li>
                                                <li>It applies if you have yet to access any course materials beyond the introductory sections.</li>
                                            </ul>

                                            <p>2. Partial Refund:</p>
                                            <ul>
                                                <li>If you cancel your enrollment after 14 days but before completing 50% of the course, you may be eligible for a partial refund.</li>
                                                <li>The amount refunded will be proportional to the portion of the course remaining.</li>
                                            </ul>

                                            <p>3. No Refund:</p>
                                            <ul>
                                                <li>Refunds will only be provided if you have completed more than 50% of the course.</li>
                                                <li>No refund will be given if you violate our terms of service.</li>
                                            </ul>

                                            <p>4. Extra Information:</p>
                                            <p>European law mandates a 14-day "cooling-off period" for online purchases, during which consumers can cancel and receive a full refund.</p>

                                        <p class="mt-2">This policy ensures compliance with the European Union's Consumer Rights Directive.<br/>
                                            Refunds will be issued to the original payment method within a reasonable timeframe.<br/>
                                            If you have any questions or concerns regarding refunds, please contact our customer support team for assistance.
                                         </p>
                                         <p class="mt-2">We hope this explanation clarifies our <span class="fw-bold"> refund policy</span> for you.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="mb-4 mt-6">
                        <h2 class="mb-0 fw-semibold">Support</h2>
                    </div>
                    <div class="accordion accordion-flush" id="accordionExample3">
                        <div class="border p-3 rounded-3 mb-2" id="headingTwelve">
                            <h3 class="mb-0 fs-4">
                                <a href="#" class="d-flex align-items-center text-inherit" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                                    <span class="me-auto">How is my data protected?</span>
                                    <span class="collapse-toggle ms-4">
                                        <i class="fe fe-chevron-down"></i>
                                    </span>
                                </a>
                            </h3>
                            <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwelve" data-bs-parent="#accordionExample3">
                                <div class="pt-2">
                                    <p class="mb-2">Your data is protected by several measures to ensure its confidentiality and security:</p>
                                    <ol>
                                        <li>Encryption: We encrypt sensitive information like passwords and payment details to prevent unauthorized access.</li>
                                        <li>Secure Servers: We keep your information safe on secure servers with advanced security protocols to safeguard against breaches.</li>
                                        <li>Access Control: We limit access to your data to authorized personnel only, those who need it to do their duties.</li>
                                        <li>Regular Audits: We regularly check and assess our systems for any weaknesses to keep them secure.</li>
                                        <li>Data Minimization: We only collect and retain the data necessary to provide our services, reducing the risk of exposure.</li>
                                        <li>Compliance: We follow the rules, regulations, and industry standards to ensure the lawful and ethical handling of your data.</li>
                                        <li>User Awareness: We educate our staff and users about data protection best practices to promote a culture of security.</li>
                                    </ol>
                                    <p>By implementing these measures, we strive to keep your data safe and secure at all times.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Card  -->
                        <!-- Card header  -->
                        <div class="border p-3 rounded-3 mb-2" id="headingThirteen">
                            <h3 class="mb-0 fs-4">
                                <a href="#" class="d-flex align-items-center text-inherit" data-bs-toggle="collapse" data-bs-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                                    <span class="me-auto">What are my rights regarding my data?</span>
                                    <span class="collapse-toggle ms-4">
                                        <i class="fe fe-chevron-down"></i>
                                    </span>
                                </a>
                            </h3>
                            <div id="collapseThirteen" class="collapse" aria-labelledby="headingThirteen" data-bs-parent="#accordionExample3">
                                <div class="pt-3">
                                    <p class="mb-2">In compliance with the General Data Protection Regulation, as a user of E-Ascencia, you have the following rights regarding your data:</p>
                                    <ol>
                                        <li>Right to Access (Article 15): You have the right to obtain confirmation as to whether or not your data is being processed and, if so, access to that data and certain related information.</li>
                                        <li>Right to Rectification (Article 16): You can ask us to promptly fix any mistakes or missing information in your data.</li>
                                        <li>Right to Erasure (Article 17): You have the right to request the deletion of your data under certain circumstances, such as when the data is no longer necessary for the purposes for which it was collected.</li>
                                        <li>Your right to limit how your information is processed (Article 18): You have the option to ask us to limit how we use your data in certain situations, like when you believe the information is wrong or if we are using it unlawfully.</li>
                                        <li>Right to Data Portability (Article 20): You have the right to receive your data in a format that's easy to use and transfer it to another controller.</li>
                                        <li>Right to Object (Article 21): You can object to the processing of your data in certain situations, such as when legitimate interests justify the processing or is for direct marketing.</li>
                                        <li>Right to Withdraw Consent (Article 7): If we rely on your consent to process your data, you have the right to withdraw that consent at any time.</li>
                                        <li>Right to Lodge a Complaint (Article 77): If you believe that we have violated your data protection rights, you have the right to complain to a supervisory authority.</li>
                                    </ol>
                                    <p>These rights are fundamental under the GDPR and must be respected by organizations processing personal data. If you want to use any of these rights or have questions about your data, please reach out to us using the contact information outlined in our privacy policy.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Card  -->
                        <!-- Card header  -->
                        <div class="border p-3 rounded-3 mb-2" id="headingFourteen">
                            <h3 class="mb-0 fs-4">
                                <a href="#" class="d-flex align-items-center text-inherit active" data-bs-toggle="collapse" data-bs-target="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">
                                    <span class="me-auto">How long does it take to process a refund?</span>
                                    <span class="collapse-toggle ms-4">
                                        <i class="fe fe-chevron-down"></i>
                                    </span>
                                </a>
                            </h3>
                            <div id="collapseFourteen" class="collapse" aria-labelledby="headingFourteen" data-bs-parent="#accordionExample3">
                                <div class="pt-3">
                                    <p>The processing time for a refund typically depends on various factors, but we aim to process refunds as quickly as possible.<br/> Generally,your refund will be issued within 5 to 10 business days after your cancellation request has been approved. However, the specific timeframe might differ depending on your chosen payment method, financial institution policies, and any additional verification requirements. Rest assured; we work hard to speed up the process so you get your refund as quickly as possible. If you have any concerns or need further assistance regarding the status of your refund, feel free to reach out to our customer support team for assistance.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Card  -->
                        <!-- Card header  -->
                        <div class="border p-3 rounded-3 mb-2" id="headingFifteen">
                            <h3 class="mb-0 fs-4">
                                <a href="#" class="d-flex align-items-center text-inherit active" data-bs-toggle="collapse" data-bs-target="#collapseFifteen" aria-expanded="false" aria-controls="collapseFifteen">
                                    <span class="me-auto">Can I get a refund if I encounter payment issues?</span>
                                    <span class="collapse-toggle ms-4">
                                        <i class="fe fe-chevron-down"></i>
                                    </span>
                                </a>
                            </h3>
                            <div id="collapseFifteen" class="collapse" aria-labelledby="headingFifteen" data-bs-parent="#accordionExample3">
                                <div class="pt-3">
                                    <p class="mb-2">Yes, if you encounter payment issues, you may still be eligible for a refund. If your payment fails or you encounter issues during the enrollment process, please contact our customer support team immediately for assistance. We understand the urgency in fixing payment problems to ensure you can access our courses smoothly. We will work hard to find and fix the issue causing the payment failure, whether it is technical glitches or something else. Your satisfaction and uninterrupted learning are our priorities.</p>
                                    <p class="fw-bold mb-2">Refund Eligibility:</p>
                                    <p class="mb-2">If we are unable to resolve the payment issue and you are unable to access the course as a result, you may be eligible for a refund. Refund eligibility will depend on the circumstances of the payment issue and our terms of service. We carefully assess each case to ensure fairness. We aim to protect your rights while maintaining the integrity of our service.</p>
                                    <p class="mb-2">To request a refund due to payment issues, please contact our customer support team as soon as possible. Provide details about the payment problem and any relevant information to expedite the refund process. Once your refund request is approved, we will initiate the refund process according to our refund policy and European Union regulations. Refunds will be issued to the original payment method within a reasonable timeframe.</p>
                                    <p>We value open communication and are here to assist you throughout the refund process. If you have any questions or concerns regarding payment issues or refunds, please do not hesitate to reach out to our customer support team for assistance.
                                        We are committed to ensuring a smooth and fair resolution in cases of payment issues to provide you with the best possible experience.
                                    </p>                                        
                                </div>
                            </div>
                        </div>
                         <!-- Card  -->
                        <!-- Card header  -->
                        <div class="border p-3 rounded-3 mb-2" id="headingNinteen">
                            <h3 class="mb-2 fs-4">
                              <a href="#" class="d-flex align-items-center text-inherit active" data-bs-toggle="collapse" data-bs-target="#collapseNinteen" aria-expanded="true" aria-controls="collapseNinteen">
                                <span class="me-auto">How to enroll for a DBA?</span>
                                <span class="collapse-toggle ms-4">
                                  <i class="fe fe-chevron-down"></i>
                                </span>
                              </a>
                            </h3>
                          
                            <div id="collapseNinteen" class="collapse show" aria-labelledby="headingNinteen" data-bs-parent="#accordionExample3">
                              <?php 
                                $libraryId = '253882';
                                $pullZone = 'https://vz-8beca12f-70b.b-cdn.net/';
                                $videoUrl = "https://iframe.mediadelivery.net/embed/$libraryId/82c2a69d-1242-4fd7-94b6-9eaf2401f92f";
                              ?>
                              <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="video-container open-video-modal" data-video-url="https://iframe.mediadelivery.net/embed/253882/82c2a69d-1242-4fd7-94b6-9eaf2401f92f?autoplay=true">
                                        <i class="bi bi-play-fill btn-outline-primary fs-2 course-details-play-icon"></i>
                                        <img src="{{ asset('frontend/images/DBA-Thumbnail.jpg')}}" class="img-fluid"/>
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
    <!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content bg-white">
        <div class="modal-body p-0 position-relative">
            <i class="bi bi-x fs-2 text-white couser-detail-modal-close-button" data-bs-dismiss="modal" aria-label="Close"></i>
          <div class="ratio ratio-16x9" style="width:100%">
            <iframe id="videoFrame" src="" allowfullscreen allow="autoplay" width="100%"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const videoContainers = document.querySelectorAll('.open-video-modal');
    const modal = new bootstrap.Modal(document.getElementById('videoModal'));
    const videoFrame = document.getElementById('videoFrame');

    videoContainers.forEach(container => {
      container.addEventListener('click', function () {
        const videoUrl = this.getAttribute('data-video-url');
        videoFrame.src = videoUrl;
        modal.show();
      });
    });

    document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
      videoFrame.src = "";
    });
  });

</script>

@endsection