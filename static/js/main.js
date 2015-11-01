$(document).ready(function(){
    $("#url").focus();

    $(document).click(function(){
        $("#user_dropdown").hide();
    });
    $("#user_link").click(function(e){
        e.stopPropagation();
        $("#user_dropdown").show();
    });

    $('#click-count').counter({
        start: $("#cch").val(),
        end: 98340684743,
        time: 2,
        step: 500,
        callback: function() {
            alert("I'm done!");
        }
    });
});

function urlShorten(){

    var baseURL = "st_.ir/";
    var url = $('#url').val();
    //url = encodeURIComponent(url);
    var wish = $('#wish').val();
    var dataString = {
        'url' : url,
        'wish': wish
    }
    $("#loader").css('display', 'inline-block');

    $.ajax({
        type : "POST",
        url : "/app/shorten.php",
        data : dataString,
        dataType : 'json',
        cache : false,
        success : function(responseValue){
            if(responseValue.status){
                $("#url").val('');
                $("#wish").val('');

                $("#url").val("http://" + baseURL + responseValue.output);
                $("#url").select();

                var primaryURL = "";
                if(responseValue.url.length >= 100)
                    primaryURL = responseValue.url.substring(0, 100) + "...";
                else
                    primaryURL = responseValue.url;

                $("#shortens").css('display', 'block').prepend("<div class='shorten'><div class='first_row'><img class='favicon' src='favicons/default.png' width='16px' height='16px' /><h4 class='title'></h4></div><p class='description'></p><p class='primary_url'>"+
                    primaryURL +
                    "</p><div class='uri_box'><input type='text' class='shorten_url' value='"+ baseURL + responseValue.output
                    +"' spellcheck='false' readonly='readonly' /><a class='stat_link' href='"+ responseValue.output +"+'>کلیک "
                    + responseValue.clicks +"</a></div></div>").children(':first')
                    .css('display', 'none').show('slow');
                if (responseValue.checked === true){
                    $("#shortens").children(":first").children(".first_row").children(".favicon").attr("src", "favicons/"+responseValue.favicon);
                    $("#shortens").children(":first").children(".first_row").children(".title").text(responseValue.title);
                    $("#shortens").children(":first").children(".description").text(responseValue.description);
                }
                else{
                    $.ajax({
                        type : "POST",
                        url : "/app/linkdata.php",
                        data : "uri="+responseValue.output,
                        dataType : 'json',
                        cache : false,
                        success : function(response){
                            if(response.status === true){
                                $("#shortens").children(":first").children(".first_row").children(".favicon").attr("src", "favicons/"+response.favicon);
                                $("#shortens").children(":first").children(".first_row").children(".title").text(response.title);
                                $("#shortens").children(":first").children(".description").text(response.description);
                            }
                            else
                                alert("Ø®Ø·Ø§");
                        }
                    });
                }

            }
            else
                showError(responseValue.output);

            $("#loader").css('display', 'none');
        },
        error : function(){
            alert("Error");
        }
    });

}

$(".shorten_url").live('click', function() {
    var $this = $(this);
    $this.select();

    // Work around Chrome's little problem
    $this.mouseup(function() {
        // Prevent further mouseup intervention
        $this.unbind("mouseup");
        return false;
    });
});

function showError(data){
    $("#error").remove();
    $("body").prepend("<div id='error'></div>");
    $("#error").text(data).slideDown('fast').delay(5000).slideUp('fast');
}

;(function($) {
    $.fn.counter = function(options) {
        // Set default values
        var defaults = {
            start: 0,
            end: 10,
            time: 10,
            step: 1000,
            callback: function() { }
        }
        var options = $.extend(defaults, options);
        // The actual function that does the counting
        var counterFunc = function(el, increment, end, step) {
            var value = parseInt(el.html(), 10) + increment;
            if(value >= end) {
                el.html(Math.round(end));
                options.callback();
            } else {
                el.html(Math.round(value));
                setTimeout(counterFunc, step, el, increment, end, step);
            }
        }
        // Set initial value
        $(this).html(Math.round(options.start));
        // Calculate the increment on each step
        var increment = (2 * options.time);
        // Call the counter function in a closure to avoid conflicts
        (function(e, i, o, s) {
            setTimeout(counterFunc, s, e, i, o, s);
        })($(this), increment, options.end, options.step);
    }
})(jQuery);