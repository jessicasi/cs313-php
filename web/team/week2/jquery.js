$("#jqButton").click(function(){
    var color = $('#jqColor').val();
    $("#jqCustom").css("background-color", color);
});

$("#fadeButton").click(function(){
    $("#fade").fadeToggle("5000");

    if ($("#fadeButton").text() === "Fade Out"){
    $("#fadeButton").text("Fade In");
    } else {
        $("#fadeButton").text("Fade Out")
    }
});
