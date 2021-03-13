$(document).ready(function(){
   $(".edit_comment").click(function() {
        var commentId = $(".edit_comment").attr("id");

        $(`#input_reply_${commentId}`).css("display", "flex");
        $(`#reply_${commentId}`).css("display", "none");

   })

   $(".cancel_comment").click(function() {
        var commentId = $(".cancel_comment").attr("id");
        const number = commentId.slice(12,commentId.length);

        $(`#input_reply_${number}`).css("display", "none");
        $(`#reply_${number}`).css("display", "flex");

    })

});