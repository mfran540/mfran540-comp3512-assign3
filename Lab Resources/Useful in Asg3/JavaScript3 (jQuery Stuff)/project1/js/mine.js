$(document).ready(function() {
    
    var defaults = [$("#sliderOpacity").val(), $("#sliderSaturation").val(), $("#sliderBrightness").val(), 
                    $("#sliderHue").val(), $("#sliderGray").val(), $("#sliderBlur").val()];
    
    $("#thumbBox img").on("click", function(e) {
        var newsrc = $(e.target).attr("src").replace("small", "medium");
        $("#imgManipulated img").attr("src", newsrc);
        $("#imgManipulated figcaption").html("<em>" + $(e.target).attr("alt") + "</em><br>" + $(e.target).attr("title"));
    });
    
    
    $("input").on("input", function(e) {
        var thisVal = $(e.target).val();
        var op = $("#sliderOpacity").val();
        var st = $("#sliderSaturation").val();
        var br = $("#sliderBrightness").val();
        var hr = $("#sliderHue").val();
        var gs = $("#sliderGray").val();
        var bl = $("#sliderBlur").val();
        var newVals = "opacity(" + op + "%) saturate(" + st + "%) brightness(" + br + "%) hue-rotate(" + hr + "deg) grayscale(" + gs + "%) blur(" + bl + "px)";
        $("#imgManipulated img").css("filter", newVals);
        $("#imgManipulated img").css("-webkit-filter", newVals);
        $(e.target).next().html(thisVal);
    });
    
    $("#resetFilters").on("click", function(e) {
        e.preventDefault();
        $("#imgManipulated img").css("filter", "");
        $("#imgManipulated img").css("-webkit-filter", "");
        
        var sliders = $("#sliderbox input");
        
        for (var i = 0; i < defaults.length; i++) {
            $(sliders[i]).val(defaults[i]);
            $(sliders[i]).next().html(defaults[i]);
        }
    });
    
});