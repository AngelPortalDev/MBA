// $(document).ready(function () {
//     var csrfToken = $('meta[name="csrf-token"]').attr("content");
//     var baseUrl = window.location.origin;
//     var studentBaseUrl = window.location.origin + "/student";
//     var reader = new FileReader();
//     var img = new Image();

    
//     var classAttributeValue =  $(".videoPlayer").attr("id");

    
    
//     const video = document.getElementById('videoPlayer-{{$id}}');

//     if(classAttributeValue){
//         var oriIdValue = classAttributeValue.split("-");
//         var oriId = oriIdValue[1];
//         const player = new playerjs.Player(document.getElementById("videoPlayer-"+oriId));
//         player.pause();
//         player.on('ready', () => {
//             console.log("ready");
//         });
//         // Event handler when the player is played
//         player.on('play', () => {
//             player.on('timeupdate', (data) => {

//                 if(data.seconds == data.duration){
//                     if ($("#bi-" + oriId).find(".bi-pause-fill")){

//                         $("#bi-"+oriId).removeClass('bi-pause-fill').addClass('bi-check2');
//                     }
    
//                     if ($("#bi-" + oriId).find("bi-play-fill")) {
    
//                         $("#bi-"+oriId).removeClass('bi-play-fill').addClass('bi-check2');
    
//                     }
//                 }
                
//             });
        

//         });
//         player.on('pause', (data) => {
            
//                 player.on('timeupdate', (data) => {

//                     if(data.seconds == data.duration){
//                         if ($("#bi-" + oriId).find(".bi-pause-fill")){
    
//                             $("#bi-"+oriId).removeClass('bi-pause-fill').addClass('bi-check2');
//                         }
        
//                         if ($("#bi-" + oriId).find(".bi-play-fill")){
        
//                             $("#bi-"+oriId).removeClass('bi-play-fill').addClass('bi-check2');
        
//                         }
//                     }else{
//                         var span = $("#bi-" + oriId).find('span');
                       
//                         var icon = span.find('.bi.bi-pause-fill');
//                         if (!icon.length) {
//                             console.log("dfdf");
//                         } 
//                         var icons = span.find('.bi.bi-play-fill');
//                         if (!icons.length) {
//                             console.log("thik");
                           
//                         }
            
        
//                         // if ($("#bi-" + oriId).find(".bi-pause-fill")){
//                         //     console.log("hiity");
                            
//                         //     $("#bi-"+oriId).removeClass('bi-pause-fill').addClass('bi-play-fill');
//                         // }
        
//                         // if ($("#bi-" + oriId).find(".bi-play-fill")){
//                         //     console.log("byety");
        
//                         //     $("#bi-"+oriId).removeClass('bi-play-fill').addClass('bi-pause-fill');
        
//                         // }
//                         // if ($("#bi-" + oriId).find(".bi-check2")){
//                         //     console.log("hiifgggty");
    
//                         //     $("#bi-"+oriId).removeClass('bi-check2').addClass('bi-play-fill');
    
//                         // }
//                     }
                    
//                 });

        
            
//         });
//         player.on('timeupdate', (data) => {

//             console.log(data.duration);
//             console.log(data.seconds);
//             console.log("tieesdfdfeasdfa");

//             // var span = $("#bi-" + oriId).find('span');
//             var $spans = $("#bi-" + oriId).find('span');

//             // Check if any <span> elements were found
//             if ($spans.length) {
//                 // Loop through each <span> element
//                 $spans.each(function() {
//                     // Find the .bi.bi-pause-fill element within this <span>
//                     var $icon = $(this).find('.bi.bi-pause-fill');
                    
//                     // Check if $icon exists and has the class 'bi-play-fill'
//                     if ($icon.length && $icon.hasClass('bi-play-fill')) {
//                         // If $icon exists and has the class 'bi-play-fill', remove the class 'bi-play-fill'
//                         $icon.removeClass('bi-play-fill');
//                         console.log("Gdfg");
//                         // Log the class attribute of $icon after removing 'bi-play-fill'
//                         console.log('Class attribute of the icon after removing "bi-play-fill":', $icon.attr('class'));
//                     } else {
//                         // If $icon does not have the class 'bi-play-fill', log a message or perform other actions
//                         console.log('The icon does not have the class "bi-play-fill".');
//                     }
//                 });
//             } else {
//                 // If no <span> elements were found, log a message or perform other actions
//                 console.log('No <span> elements found within the specified container.');
//             }

//             if(data.seconds == data.duration){
//                 console.log("tieevdfe");
//                 $("#bi-"+oriId).removeClass('bi-play-fill').addClass('bi-check2');
//             }else{
//                 // if ($("#bi-" + oriId).hasClass("bi-pause-fill")) {

//                 //     $("#bi-"+oriId).removeClass('bi-pause-fill').addClass('bi-play-fill');
//                 // }

//                 // if ($("#bi-" + oriId).hasClass("bi-play-fill")) {

//                 //     $("#bi-"+oriId).removeClass('bi-play-fill').addClass('bi-pause-fill');

//                 // }

//             }
            
//         });
//     }
//     let previousTabId = null;
//     let currentTabId = null;

//         // Select all elements with class "pause-fill" within an element with ID "yourElementId"
//         var elementsWithPauseFillClass = $('.tab-link').find('.check2');
    
//         // Do something with the selected elements
//         elementsWithPauseFillClass.each(function(){
//             // Your actions here
//             console.log("fgfddfdsfg");
//         });

// $('.tab-link').click(function(event) {
//     event.preventDefault();
//     $('.tab-link').css({
//         'color': '',
//         'background-color': '',
//         'padding': ''
//     });
//     if($(this).data('icons') != 'pdf'){
//         console.log("dfdsfdsf");

//         var elementsWithPauseFillClass = $('.tab-link').find('.check2');
    
//         // Do something with the selected elements
//         elementsWithPauseFillClass.each(function(){
//             // Your actions here
//             console.log("fgfdg");
//         });

      
//         $('.tab-link .bi').removeClass('bi-pause-fill').addClass('bi-play-fill');
//         $(this).find('.bi').toggleClass('bi-play-fill bi-pause-fill');
      

//         previousTabId = currentTabId;
//         currentTabId = $(this).attr('id');
//         console.log(currentTabId);

//         previousTabId = previousTabId;
//         if(previousTabId){
//             var oriIdValue = previousTabId.split("-");
//             var oriId = oriIdValue[1];

//             const playerPrevious = new playerjs.Player(document.getElementById("videoPlayer-"+oriId));
//             // Event handler when the player is ready
//             playerPrevious.on('ready', () => {});

//             playerPrevious.on('pause', () => {});

//             playerPrevious.pause();

//             // var myDiv = $("#bi-" + oriId);

          
            
//         }else{
//             var firstTab = $('.tab-link').first();
//             const firstTabId = firstTab.attr('id');
//             if(firstTabId){
//             var oriIdValue = firstTabId.split("-");
//             var oriId = oriIdValue[1];

//             console.log("hiiiii");
//             const playerFirst = new playerjs.Player(document.getElementById("videoPlayer-"+oriId));
//             // Event handler when the player is ready
//             playerFirst.on('ready', () => {});

//             playerFirst.on('pause', () => {});

//             playerFirst.pause();
            
//             // var $myDiv = $("#bi-" + oriId);
//             }

//             $("p").bind("click", function(){
//                 alert("The paragraph was clicked.");
//               });
//             // if (!$myDiv.hasClass('bi-check2')) {
//             //     console.log("fffddsfsdf");
//             //     $('.tab-link .bi').removeClass('bi-pause-fill').addClass('bi-play-fill');
//             //     $(this).find('.bi').toggleClass('bi-play-fill bi-pause-fill');
//             //     // $myDiv.addClass('bi-play-fill');
//             // } else {
//             //     console.log("fffdfsdcbv");
//             //     // $('.tab-link .bi').removeClass('bi-pause-fill').addClass('bi-play-fill');
//             //     // $(this).find('.bi').toggleClass('bi-play-fill bi-pause-fill');
//             // }
//             // Event listener for the 'seek to 10 seconds' button
            
//         }

//         var oriIdValue = currentTabId.split("-");
//         var oriId = oriIdValue[1];

//         const player = new playerjs.Player(document.getElementById("videoPlayer-"+oriId));
//         var oriId = $(this).data('ori-id');    
//         console.log(oriId);   
//         $('#ori-'+oriId+'-tab').css({
//             'border-radius': '3px',
//             'background-color': 'whitesmoke'
//         });

//         player.on('ready', () => {
//             console.log("readytech");
//         });
//         // Event handler when the player is played
//         player.on('play', (data) => {
//             console.log("playtech");
//             player.on('timeupdate', (data) => {
//                 console.log(oriId);
                
//                 if(data.seconds == data.duration){
//                     if ($("#bi-" + oriId).find(".bi-pause-fill")){

//                         $("#bi-"+oriId).removeClass('bi-pause-fill').addClass('bi-check2');
//                     }
    
//                     if ($("#bi-" + oriId).find(".bi-play-fill")){
    
//                         $("#bi-"+oriId).removeClass('bi-play-fill').addClass('bi-check2');
    
//                     }
//                 }
                
//             });
//         });
      
     
//         player.pause();

 
        
//         player.on('pause', () => {
//             player.on('timeupdate', (data) => {

//                 if(data.seconds == data.duration){
//                     if ($("#bi-" + oriId).find(".bi-pause-fill")){
//                         console.log("test");
//                         $("#bi-"+oriId).removeClass('bi-pause-fill').addClass('bi-check2');
//                     }
    
//                     if ($("#bi-" + oriId).find(".bi-play-fill")){
//                         console.log("test56");
                        
//                         $("#bi-"+oriId).removeClass('bi-play-fill').addClass('bi-check2');
    
//                     }
//                 }else{
                    
//                     var $span = $("#bi-" + oriId).find('span');
//                     var $icon = $span.find('.bi.bi-pause-fill');
//                     if (!$icon.length) {
//                         console.log("dfdf");
//                         // If $icon is false or undefined, add a class to another element
//                         $('#another-element').addClass('your-class');
//                         $("#bi-"+oriId).removeClass('bi-play-fill').addClass('bi-pause-fill');
        
//                     } 
//                     var $icons = $span.find('.bi.bi-play-fill');
//                     if (!$icons.length) {
//                         console.log("dfdffgd");
//                         // If $icon exists, perform other actions
//                         console.log('The icon exists:', $icon);
//                         console.log(oriId);
//                         $("#bi-"+oriId).removeClass('bi-pause-fill').addClass('bi-play-fill');
//                         $("#bi-"+oriId).removeClass('bi-play-fill').addClass('bi-pause-fill');

//                         // addClass('bi-pause-fill');
        
//                     }
        
//                     $(".tab-link .bi").bind("click", function(){
//                         $("#bi-"+oriId).removeClass('bi-pause-fill').addClass('bi-play-fill');

//                     });
//                     // if ($("#bi-" + oriId).find(".bi-pause-fill")){

//                     //     console.log("hii12");

//                     //     $("#bi-"+oriId).removeClass('bi-pause-fill').addClass('bi-play-fill');
//                     // }else{
//                     //     console.log("bye1278");

//                     // }
    
//                     // if ($("#bi-" + oriId).find(".bi-play-fill")){
//                     //     console.log("bye12");
    
//                     //     $("#bi-"+oriId).removeClass('bi-play-fill').addClass('bi-pause-fill');
    
//                     // }else{
//                     //     console.log("bye1290");

//                     // }
//                     // if ($("#bi-" + oriId).find(".bi-check2")){
//                     //     console.log("hiifggg12");

//                     //     $("#bi-"+oriId).removeClass('bi-check2').addClass('bi-play-fill');

//                     // }else{
//                     //     console.log("bye12fdgf90");

//                     // }
//                 }
                
//             });

          
//     });
//     }else{
        
//         var previousTabId =  $(".videoPlayer").attr("id");       
//         var oriIdValue = previousTabId.split("-");
//         var oriId = oriIdValue[1];
      
        
//         // $("#videoPlayer-"+oriId).on('load', function() {
    
//         // const playerPrevious = new playerjs.Player(document.getElementById("videoPlayer-"+oriId));
//         //     // Event handler when the player is ready
//         //     playerPrevious.on('ready', () => {});

//         //     playerPrevious.on('pause', () => {});

//         //     playerPrevious.pause();

//         //     // var myDiv = $("#bi-" + oriId);

//         // }
//     }

// });

// });

