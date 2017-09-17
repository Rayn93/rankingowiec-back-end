
$(window).scroll(function() {
    if ($(this).scrollTop() > 1){
        $('#header-top').addClass("sticky");
    }
    else{
        $('#header-top').removeClass("sticky");
    }
});



$(document).ready(function () {

// OSKRYPTOWANIE DLA MENU

    var $height = $(window).height();

    $("#header-top .traggle-menu").css("height", $height);

    $("#header-top .burger").click(function () {
        $(".traggle-menu").show("slide", { direction: "left" }, 500);
    });

    $(".close").click(function () {
        $(".traggle-menu").hide("slide", "right", 500);
    });

//Bootstrap karuzela
     $("#myCarousel").carousel({
         interval: 9000,
         pause: "hover"
     });


//Select 2
    $('.select-block').select2({
        minimumResultsForSearch: Infinity,
        theme: "classic"
    });

//Bootstrap Tooltip
    $('[data-toggle="tooltip"]').tooltip();

//Bootstrap tabs

    $('#rank-tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });







////PODMIANA KLASY PRZY SZEROKOŚCI OKNA 620PX DLA SEKCJI KATEGORIE
//
//     var width = $(window).width();
//     if (width < 620) {
//         $("#category .padding").removeClass("col-xs-4").addClass("col-xs-6")
//     }

////dotdotdot
//
//    $(".dot-wrapper h3").dotdotdot({
//        //	configuration goes here
//    });


});


// Voting system with AJAX
function changeVoteButton($itemId , $rankingId, $upOrDown) {

    var getTeamsUrl = Routing.generate('ranking_voting');

    $('.thumb_'+$upOrDown+'_'+$itemId).children().addClass('chooseme');
    $('.thumb_'+$upOrDown+'_'+$itemId).siblings().addClass('chooseother');
    $('.thumb_up_'+$itemId).removeAttr('onclick');
    $('.thumb_down_'+$itemId).removeAttr('onclick');

    var data;

    if ($upOrDown == 'up'){
        data = {rankingId: $rankingId, itemId: $itemId, plus: 1, minus: 0}
    }
    else if($upOrDown == 'down'){
        data = {rankingId: $rankingId, itemId: $itemId, plus: 0, minus: 1}
    }

    $.ajax({
        type: "POST",
        url: getTeamsUrl,
        data: data,
        dataType: 'json',
        timeout: 3000,
        success: function(response){
            $.cookie("ratingSystem_rank" + $rankingId + "_item"+$itemId , "Rated", { expires : 7 }); // Add jQuery Cookie Plugin to use this function
            $('.thumb_up_'+$itemId+' .appear').text(response.plus);
            $('.thumb_down_'+$itemId+' .appear').text(response.minus);
            $('.result_'+$itemId+' .span').text(response.total);
        },
        error: function() {
            $('.result_'+$itemId+' span').text('Error!!!');
        }
    });

}

////PODMIANA KLASY PRZY SZEROKOŚCI OKNA 620PX DLA SEKCJI KATEGORIE
//$(window).resize(function () {
//
//    var width = $(window).width();
//    if (width < 620) {
//        $("#category .padding").removeClass("col-xs-4").addClass("col-xs-6")
//    }
//
//    else {
//        $("#category .padding").removeClass("col-xs-6").addClass("col-xs-4")
//    }
//});
//
//
//
////SKRYP ODPOWIADAJĄCY ZA PRAWIDŁOWE WYŚWIETLANIE STRONY NA TEL KOM.
//
//var scale = 1 / (window.devicePixelRatio || 1);
//var content = 'width=device-width, initial-scale=' + scale + ', minimum-scale=' + scale;
//
//document.querySelector('meta[name="viewport"]').setAttribute('content', content);



//PIE CHART ON OBJECT PAGE

var myCanvas = document.getElementById("myCanvas");
myCanvas.width = 200;
myCanvas.height = 200;

var ctx = myCanvas.getContext("2d");

function drawPieSlice(ctx,centerX, centerY, radius, startAngle, endAngle, color ){
    ctx.fillStyle = color;
    ctx.beginPath();
    ctx.moveTo(centerX,centerY);
    ctx.arc(centerX, centerY, radius, startAngle, endAngle);
    ctx.closePath();
    ctx.fill();
}

var Piechart = function(options){
    this.options = options;
    this.canvas = options.canvas;
    this.ctx = this.canvas.getContext("2d");
    this.colors = options.colors;

    this.draw = function(){
        var total_value = 0;
        var color_index = 0;
        for (var categ in this.options.data){
            var val = this.options.data[categ];
            total_value += val;
        }

        var start_angle = 0;
        for (categ in this.options.data){
            val = this.options.data[categ];
            var slice_angle = 2 * Math.PI * val / total_value;

            drawPieSlice(
                this.ctx,
                this.canvas.width/2,
                this.canvas.height/2,
                Math.min(this.canvas.width/2,this.canvas.height/2),
                start_angle,
                start_angle+slice_angle,
                this.colors[color_index%this.colors.length]
            );

            start_angle += slice_angle;
            color_index++;
        }

        start_angle = 0;
        for (categ in this.options.data){
            val = this.options.data[categ];
            slice_angle = 2 * Math.PI * val / total_value;
            var pieRadius = Math.min(this.canvas.width/2,this.canvas.height/2);
            var labelX = this.canvas.width/2 + (pieRadius / 2) * Math.cos(start_angle + slice_angle/2);
            var labelY = this.canvas.height/2 + (pieRadius / 2) * Math.sin(start_angle + slice_angle/2);

            var labelText = Math.round(100 * val / total_value);
            this.ctx.fillStyle = "white";
            this.ctx.font = "bold 20px Arial";
            this.ctx.fillText(labelText+"%", labelX,labelY);
            start_angle += slice_angle;
        }
    };


};

var myPiechart = new Piechart(
    {
        canvas:myCanvas,
        data:rankingData,
        colors:["#4875ff","#ff1719"]
    }
);
myPiechart.draw();

//END PIE CHART ON OBJECT PAGE



