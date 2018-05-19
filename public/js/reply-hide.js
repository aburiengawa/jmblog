(function() {
    $('#ajax-comment-container').on('click', '.reply-link', function(){
        this.previousElementSibling.classList.toggle("hide-element");
        this.nextElementSibling.classList.toggle("hide-element");
        this.classList.toggle("reply-link-hidden");
    });
    $('#ajax-comment-container').on('click', '.reply-hide', function(){
        this.parentElement.classList.toggle("hide-element");
        this.parentElement.previousElementSibling.previousElementSibling.classList.toggle("hide-element");
        this.parentElement.previousElementSibling.classList.toggle("reply-link-hidden");
    });
  // var replyLink = document.getElementsByClassName("reply-link");
  // var replyHide = document.getElementsByClassName("reply-hide");
  // for(var i = 0; i < replyLink.length; i++) {
    // replyLink[i].addEventListener("click", function(){
    //   this.previousElementSibling.classList.toggle("hide-element");
    //   this.nextElementSibling.classList.toggle("hide-element");
    //   this.classList.toggle("reply-link-hidden");
    // });

  // }
 // for(var i = 0; i < replyHide.length; i++) {
 //  replyHide[i].addEventListener("click", function(){
 //      this.parentElement.classList.toggle("hide-element");
 //      this.parentElement.previousElementSibling.previousElementSibling.classList.toggle("hide-element");
 //      this.parentElement.previousElementSibling.classList.toggle("reply-link-hidden");
 //    });
 //  }
})();
// function replyHideLink () {
//   var replyLink = document.getElementsByClassName("reply-link");
//   var replyHide = document.getElementsByClassName("reply-hide");
//   for(var i = 0; i < replyLink.length; i++) {
//     replyLink[i].addEventListener("click", function(){
//       this.previousElementSibling.classList.toggle("hide-element");
//       this.nextElementSibling.classList.toggle("hide-element");
//       this.classList.toggle("reply-link-hidden");
//     });
//   }
//  for(var i = 0; i < replyHide.length; i++) {
//   replyHide[i].addEventListener("click", function(){
//       this.parentElement.classList.toggle("hide-element");
//       this.parentElement.previousElementSibling.previousElementSibling.classList.toggle("hide-element");
//       this.parentElement.previousElementSibling.classList.toggle("reply-link-hidden");
//     });
//   }
// }
function prependReplyHideLink () {
  var replyLink = document.getElementsByClassName("prepend-reply-link");
  var replyHide = document.getElementsByClassName("prepend-reply-hide");
  for(var i = 0; i < replyLink.length; i++) {
    replyLink[i].addEventListener("click", function(){
      this.previousElementSibling.classList.toggle("hide-element");
      this.nextElementSibling.classList.toggle("hide-element");
      this.classList.toggle("reply-link-hidden");
    });
  }
 for(var i = 0; i < replyHide.length; i++) {
  replyHide[i].addEventListener("click", function(){
      this.parentElement.classList.toggle("hide-element");
      this.parentElement.previousElementSibling.previousElementSibling.classList.toggle("hide-element");
      this.parentElement.previousElementSibling.classList.toggle("reply-link-hidden");
    });
  }
}