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
                  <h4 class="mt-3 mb-0 text-primary fw-bold">1. What Are Cookies:</h4>
                  <p>A cookie is a small text file that a website stores on your computer or mobile device when you visit our website or platform (www.eascencia.mt).</p>
                  <h4 class="mt-3 mb-0 text-primary fw-bold">2. Are there different type of cookies?</h4>
                  <p>Yes, cookies are divided into two broad categories, being first-party cookies and third-party cookies.</p>
                  <p>First-party Cookies are those placed directly by us and are used only by us. We use Cookies to facilitate and improve your experience and to provide and improve our services.</p>
                  <p>By accessing and using our website and platform (www.eascencia.mt), you may also receive certain third-party Cookies on your computer or device. Third-party Cookies are those placed by websites, services, and/or parties other than us. Third-party Cookies are used on the Platform for web-analytical purposes and to collect and analyse information about site performance and usage.    These Cookies are not integral to the functioning of the Platform and your use and experience of the Platform will not be impaired by refusing consent to them.</p>
                  <p>Cookies are essentially categorised as follows:</p>
                  <p><strong class="heading-subtitle"><u>Essential and Non-Essential Cookies:</u></strong></p>
                  <p><ul><li>Essential Cookies: These cookies are necessary for the basic functionality of the website. They ensure that key features like security, user login, and preferences are operational. Without these, the site wouldn't work properly.</li></ul></p>
                  <p><ul><li>Non-Essential Cookies: These cookies are not strictly necessary for the website to work, but they enhance user experience and gather data. They can include analytical, advertising, and functional cookies that personalize content, track performance, and enable targeted advertising.</li></ul></p>
                  <p><strong class="heading-subtitle"><u>First-Party and Third-Party Cookies:</u></strong></p>
                  <p><ul><li>First-Party Cookies: These cookies are set by the website you are visiting directly. They usually serve functions like remembering user preferences, login information, or items in a shopping cart. The data from first-party cookies is generally only accessible by the site that set them.</li></ul></p>
                  <p><ul><li>Third-Party Cookies: These are set by domains other than the one you are visiting. Commonly used for tracking and advertising purposes, third-party cookies allow advertisers to track users across multiple sites to serve targeted ads.</li></ul></p>
                  <p><strong class="heading-subtitle"><u>Session and Persistent Cookies:</u></strong></p>
                  <p><ul><li>Session Cookies: These cookies are temporary and are only active during the user's visit to a website. They get deleted once the browser is closed. They are useful for remembering information as users navigate between pages during a session, like items in a shopping cart.</li></ul></p>
                  <p><ul><li>Persistent (Permanent) Cookies: These cookies remain on the user's device for a set period, even after the session ends. They help the website remember user preferences or login information over repeated visits, providing a more consistent user experience.</li></ul></p>
                  <h4 class="mt-3 mb-0 fw-bold">What types of cookies are used?; What choices do I have?</h4>
                  <p>We use the following cookies:</p>

                  <p>
                    <ol type="i">
                      <li>Strictly Necessary Cookies:</li>
                      <table>
                          <thead>
                              <tr>
                                  <th>Cookie Key</th>
                                  <th>Cookie Type</th>
                                  <th>Expiration</th>
                                  <th>Description</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>XSRF-TOKEN</td>
                                  <td>First-party</td>
                                  <td>2 hours</td>
                                  <td>This cookie is written to help with site security in preventing Cross-Site Request Forgery attacks.</td>
                              </tr>
                              <tr>
                                  <td>LS_CSRF_TOKEN</td>
                                  <td>Third-party</td>
                                  <td>Session</td>
                                  <td>This cookie is used to help prevent Cross-Site Request Forgery (CSRF) attacks. It ensures that submissions coming from forms on a website are made by the user currently logged in, enhancing site security.</td>
                              </tr>
                          </tbody>
                      </table>
                  
                      <li>Performance Cookies:</li>
                      <table>
                          <thead>
                              <tr>
                                  <th>Cookie Key</th>
                                  <th>Cookie Type</th>
                                  <th>Expiration</th>
                                  <th>Description</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>_ga_W7Z6Y4BCE8</td>
                                  <td>First-party</td>
                                  <td>1 year 1 month</td>
                                  <td>This cookie is used by Google Analytics to persist session state.</td>
                              </tr>
                              <tr>
                                  <td>_ga</td>
                                  <td>First-party</td>
                                  <td>1 year 1 month</td>
                                  <td>This cookie name is associated with Google Universal Analytics - which is a significant update to Google's more commonly used analytics service. This cookie is used to distinguish unique users by assigning a  randomly generated number as a client identifier. It is included in each page request in a site and used to calculate visitor, session and campaign data for the sites analytics reports.</td>
                              </tr>
                              <tr>
                                  <td>uesign</td>
                                  <td>Third-party</td>
                                  <td>1 month</td>
                                  <td>This cookie is used to track user engagement and interaction with the website in order to improve service delivery and user experience. It may collect data related to user's session and behavior on the site.</td>
                              </tr>
                          </tbody>
                      </table>
                      
                      <li>Targeting Cookies:</li>
                      <table>
                          <thead>
                              <tr>
                                  <th>Cookie Key</th>
                                  <th>Cookie Type</th>
                                  <th>Expiration</th>
                                  <th>Description</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>_fbp</td>
                                  <td>First-party</td>
                                  <td>3 months</td>
                                  <td>Used by Meta to deliver a series of advertisement products such as real time bidding from third party advertisers.</td>
                              </tr>
                          </tbody>
                      </table>
                  
                    </ol>
                  </p>
                  <p>[unclassified] </p>
                  
                  <p><strong class="heading-subtitle">Other:</strong></p>
                  <p>All Cookies are used in accordance with current applicable law.</p>
                  <p>Before Cookies are placed on your computer or device, you will be shown a prompt/pop-up  requesting your consent to set those Cookies. By giving your consent to the placing of Cookies you are enabling us to provide the best possible experience and service to you. You may, if you wish, deny consent to the placing of Cookies; however certain features may not function fully or as intended.</p>
                  <p>Certain features depend on Cookies to function and are, as such, considered to be “strictly necessary” in terms of applicable law. Your consent will not be sought to place these Cookies, but it is still important that you are aware of them. You may still block these Cookies by changing your internet browser’s settings as detailed below, but please be aware that the Platform may not work properly if you do so.</p>
                  <p>In addition to the controls that we provide, you can choose to enable or disable Cookies in your internet browser. Most internet browsers also enable you to choose whether you wish to disable all Cookies or only third-party Cookies. By default, most internet browsers accept Cookies, but this can be changed. For further details, please consult the help menu in your internet browser or the documentation that came with your device.</p>
                  <p>You can choose to delete Cookies on your computer or device at any time, however you may lose any information that enables you to access Our Site more quickly and efficiently including, but not limited to, login and personalisation settings.</p>
                  <p>It is recommended that you keep your internet browser and operating system up-to-date and that you consult the help and guidance provided by the developer of your internet browser and manufacturer of your computer or device if you are unsure about adjusting your privacy settings. The links below provide instructions on how to control Cookies in all mainstream browsers:</p>
                  <ol type="a">
                    <li>Google Chrome: <a href="https://support.google.com/chrome/answer/95647?hl=en-GB">https://support.google.com/chrome/answer/95647?hl=en-GB</a></li>
                    <li>Microsoft Internet Explorer: <a href="https://support.microsoft.com/en-us/topic/how-to-delete-cookie-files-in-internet-explorer-bca9446f-d873-78de-77ba-d42645fa52fc">https://support.microsoft.com/en-us/topic/how-to-delete-cookie-files-in-internet-explorer-bca9446f-d873-78de-77ba-d42645fa52fc</a></li>
                    <li>Microsoft Edge: <a href="https://support.microsoft.com/en-us/windows/manage-cookies-in-microsoft-edge-view-allow-block-delete-and-use-168dab11-0753-043d-7c16-ede5947fc64d">https://support.microsoft.com/en-us/windows/manage-cookies-in-microsoft-edge-view-allow-block-delete-and-use-168dab11-0753-043d-7c16-ede5947fc64d</a></li>
                    <li>Safari (macOS): <a href="https://support.apple.com/kb/PH21411?viewlocale=en_GB&locale=en_GB">https://support.apple.com/kb/PH21411?viewlocale=en_GB&locale=en_GB</a></li>
                    <li>Safari (iOS): <a href="https://support.apple.com/en-gb/HT201265">https://support.apple.com/en-gb/HT201265</a></li>
                    <li>Mozilla Firefox: <a href="https://support.mozilla.org/en-US/kb/enable-and-disable-Cookies-website-preferences">https://support.mozilla.org/en-US/kb/enable-and-disable-Cookies-website-preferences</a></li>
                    <li>Android: <a href="https://support.google.com/chrome/answer/95647?co=GENIE.Platform%3DAndroid&hl=en (Please refer to your device’s documentation for manufacturers’ own browsers)">https://support.google.com/chrome/answer/95647?co=GENIE.Platform%3DAndroid&hl=en (Please refer to your device’s documentation for manufacturers’ own browsers)</a></li>
                  </ol>
                  <p>For more information on cookies please visit <a href="https://www.allaboutcookies.org/">https://www.allaboutcookies.org/</a></p>

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