
$(document).ready(function(){
     var commentId


   $(`.edit_comment`).click(function() {


        commentId = $(this).attr("data-edit");
     //    alert(commentId)

        $(`#input_reply_${commentId}`).css("display", "flex");
        $(`#reply_${commentId}`).css("display", "none");

   })

   $(".cancel_comment").click(function() {
        commentId = $(this).attr("id");
        const number = commentId.slice(12,commentId.length);

        $(`#input_reply_${number}`).css("display", "none");
        $(`#reply_${number}`).css("display", "flex");

    })

});