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
        
        $("#sliderOpacity").val(defaults[0]);
        $("#sliderOpacity").next().html(defaults[0]);
        
        $("#sliderSaturation").val(defaults[1]);
        $("#sliderSaturation").next().html(defaults[1]);
        
        $("#sliderBrightness").val(defaults[2]);
        $("#sliderBrightness").next().html(defaults[2]);
        
        $("#sliderHue").val(defaults[3]);
        $("#sliderHue").next().html(defaults[3]);
        
        $("#sliderGray").val(defaults[4]);
        $("#sliderGray").next().html(defaults[4]);
        
        $("#sliderBlur").val(defaults[5]);
        $("#sliderBlur").next().html(defaults[5]);
        
    });
    
});