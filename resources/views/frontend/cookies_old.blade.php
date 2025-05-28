@extends('frontend.master')
@section('content')

<main class="cookies-page">
    <div class="py-md-8 py-4 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- caption-->
                    <h1 class="fw-bold mb-1 display-4 text-primary">Cookies</h1>
                    <p class="mt-2">At E-Ascencia, we use cookies and tracking technologies to enhance your browsing experience, prevent fraud, analyze traffic, and provide personalized content. Cookies are small data files stored on your device when you visit our website. They help us remember your preferences and improve site functionality. You can manage cookies through your browser settings.
                      
                      </p>
                      <p class="mt-2">Tracking technologies, such as web beacons and pixel tags, work alongside cookies to gather data about how you interact with our website. This information helps us understand user behaviour and optimize our services to meet your needs better.</p>
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
                                <li class="breadcrumb-item active" aria-current="page">Cookies</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="pb-8 pt-7 bg-white">
        <div class="container">
          <!-- javascript behavior vertical pills -->
          <div class="row">
            <div class="col-md-3">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-Third-Party-Cookies-tab" data-bs-toggle="pill" href="#v-pills-Third-Party-Cookies" role="tab" aria-controls="v-pills-Third-Party-Cookies" aria-selected="false">Third-Party Cookies</a>
                <a class="nav-link" id="v-pills-Cookies-Preference-tab" data-bs-toggle="pill" href="#v-pills-Cookies-Preference" role="tab" aria-controls="v-pills-Cookies-Preference" aria-selected="false">Cookie Preferences</a>
                <a class="nav-link" id="v-pills-Functional-Cookies-tab" data-bs-toggle="pill" href="#v-pills-Functional-Cookies" role="tab" aria-controls="v-pills-Functional-Cookies" aria-selected="false">Functional Cookies</a>
                <a class="nav-link" id="v-pills-Social-Media-Cookies-tab" data-bs-toggle="pill" href="#v-pills-Social-Media-Cookies" role="tab" aria-controls="v-pills-Social-Media-Cookies" aria-selected="false">Social Media Cookies</a>
                <a class="nav-link" id="v-pills-Advertising-Cookies-tab" data-bs-toggle="pill" href="#v-pills-Advertising-Cookies" role="tab" aria-controls="v-pills-Advertising-Cookies" aria-selected="false">Advertising Cookies</a>
                <a class="nav-link" id="v-pills-Strictly-Necessary-Cookies-tab" data-bs-toggle="pill" href="#v-pills-Strictly-Necessary-Cookies" role="tab" aria-controls="v-pills-Strictly-Necessary-Cookies" aria-selected="false">Strictly Necessary Cookies</a>
                <a class="nav-link" id="v-pills-Performance-Cookies-tab" data-bs-toggle="pill" href="#v-pills-Performance-Cookies" role="tab" aria-controls="v-pills-Performance-Cookies" aria-selected="false">Performance Cookies</a>
                <a class="nav-link" id="v-pills-Cookies-privacy-policy-tab" data-bs-toggle="pill" href="#v-pills-Cookies-privacy-policy" role="tab" aria-controls="v-pills-Cookies-privacy-policy" aria-selected="false"> Privacy Policy Section</a>

              </div>
            </div>
            <div class="col-md-9 mt-3 mt-md-0 cookiesMobileSection">
              <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-Third-Party-Cookies" role="tabpanel" aria-labelledby="v-pills-Third-Party-Cookies">
                  <p>Third-party cookies are set by services that are not part of E-Ascencia. These cookies are used by external providers, such as analytics companies and advertisers, to track your online activities across different websites.</p>
                  <p class="mt-2">We partner with third-party service providers to enhance our website functionality and deliver relevant advertisements. While we strive to work with trusted partners, we encourage you to review their privacy policies to understand how they handle your data.</p>
                </div>
                <div class="tab-pane fade" id="v-pills-Cookies-Preference" role="tabpanel" aria-labelledby="v-pills-Cookies-Preference-tab">
                  <p>We use cookies to store or retrieve information on your browser, which may relate to you, your preferences, or your device. Cookies are primarily used to make the site function as expected. You can manage your cookie preferences through your browser settings or our website's cookie consent tool. By adjusting these settings, you can choose which types of cookies you allow or block, giving you control over your online privacy.</p>
                  <p class="mt-2">However, please note that disabling certain cookies may impact your experience on our website. If you block these cookies, it may affect essential functions, the overall quality of our website, and our services.</p>
                </div>
                <div class="tab-pane fade" id="v-pills-Functional-Cookies" role="tabpanel" aria-labelledby="v-pills-Functional-Cookies-tab">
                  <p>Functional cookies are used to enhance your experience on a website by remembering your preferences and providing advanced features. These cookies store details such as your login credentials, language selection, or region, so you do not need to re-enter this information each time you visit the website.</p>
                  <p class="mt-2">Functional cookies enable core website functionalities such as user login, account management, and language preferences. These cookies ensure that our website operates smoothly and provides a personalized experience for you.</p>
                  <p class="mt-2">Without these cookies, certain functionalities on websites could be compromised, leading to a less tailored and efficient user experience. We use these cookies to remember your settings and preferences, making your visits more convenient.</p>
                </div>
                <div class="tab-pane fade" id="v-pills-Social-Media-Cookies" role="tabpanel" aria-labelledby="v-pills-Social-Media-Cookies-tab">
                  <p>Social networking platforms set social media cookies to track your interaction with our content and allow you to share it on your social networks. These cookies also enable social media features, such as "like" and "share" buttons.</p>
                  <p class="mt-2">By integrating these cookies, we make it easier for you to engage with our content on social media. However, they also collect data about your browsing habits, which the social media platforms may use for their purposes.</p>
                </div>
                <div class="tab-pane fade" id="v-pills-Advertising-Cookies" role="tabpanel" aria-labelledby="v-pills-Advertising-Cookies-tab">
                  <p>Advertising cookies collect information about your browsing habits to deliver ads that are relevant to your interests. These cookies track your visits to our website and other sites to show you targeted advertisements.</p>
                  <p class="mt-2">We use advertising cookies to provide a more personalized advertising experience. By understanding your interests, we can display ads that are more likely to be of interest to you, enhancing your overall online experience.</p>
                </div>
                <div class="tab-pane fade" id="v-pills-Strictly-Necessary-Cookies" role="tabpanel" aria-labelledby="v-pills-Strictly-Necessary-Cookies-tab">
                  <p>Strictly necessary cookies are essential for our website's basic functioning. They enable core features like security, network management, and accessibility. Without these cookies, our website cannot operate properly.</p>
                  <p class="mt-2">These cookies do not store any personally identifiable information. They are crucial for ensuring that our site performs optimally, providing you with a secure and reliable browsing experience.</p>
                </div>
                <div class="tab-pane fade" id="v-pills-Performance-Cookies" role="tabpanel" aria-labelledby="v-pills-Performance-Cookies">
                  <p>
                    Performance cookies collect data on how users interact with our website, including pages visited and any error messages encountered. These cookies help us understand and improve site performance.
                  </p>
                  <p class="mt-2">By analyzing the data from performance cookies, we can enhance our website's functionality and user experience. This allows us to identify and fix issues, ensuring a smooth and efficient browsing experience for you.</p>
                </div>
                <div class="tab-pane fade" id="v-pills-Cookies-privacy-policy" role="tabpanel" aria-labelledby="v-pills-Cookies-privacy-policy">
                  <h4 class="mb-0 text-primary fw-bold">
                    Cookie Policy:
                  </h4>
                  <p class="mt-0">At E-Ascencia, we value your privacy and are committed to ensuring the security of your personal information. We use cookies to enhance user experience, prevent fraud, and analyze traffic. You can manage cookies through your browser settings. We implement Google Analytics Advertising Features responsibly.</p>
                  <p class="mt-1">Here's a breakdown of how we utilize cookies and similar technologies:</p>
                  <h4 class="mt-3 mb-0 text-primary fw-bold">What Are Cookies:</h4>
                  <p>Cookies are small files stored on your device that help us understand your interactions on the E-Ascencia website. These may include pixels, tags, and other tracking mechanisms.</p>
                  <h4 class="mt-3 mb-0 text-primary fw-bold">Why Do We Use Cookies:</h4>
                  <p>Cookies play a crucial role in improving your browsing experience, analyzing website traffic, and customizing content to better tailor our services to your needs.</p>
                  <h4 class="mt-3 mb-0 text-primary fw-bold">Types of Cookies We Use:</h4>
                  <p> <strong class="heading-subtitle"> Necessary Cookies: </strong> Essential for basic functionality, navigation, and secure access to designated areas.</p>
                  <p><strong class="heading-subtitle">Analytical Cookies:</strong> Collect information about website usage to aid in performance enhancement.</p>
                  <p><strong class="heading-subtitle">Functional Cookies: </strong> Improve your experience by remembering preferences and settings.</p>
                  <p><strong class="heading-subtitle">Marketing Cookies: </strong> Personalize content and promotions based on your interests.</p>
                  <h4 class="mt-3 mb-0 text-primary fw-bold">Your Control Over Cookies:</h4>
                  <p class="mt-0">You have the ability to manage and delete cookies through your browser settings. Please be aware that disabling certain cookies may impact your overall website experience.</p>
                  <h4 class="mt-3 mb-0 text-primary fw-bold">Third-Party Cookies: </h4>
                  <p class="mt-0">Our E-Ascencia may utilize third-party services, such as links to other websites, to offer specific programs and products. These external sites have their own privacy policies, which are beyond our control. When you leave our site to visit these external links, you are subject to their policies, not ours. If you are unable to locate a site's privacy policy, we recommend contacting them directly for clarification.</p>
                 <p class="mt-1"> For any questions or concerns about our use of cookies or our privacy practices, please feel free to reach out to us at <a  href="mailto:support@eascencia.mt"> support@eascencia.mt</a><span style="color: #000">.</span></p>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</main>

@endsection