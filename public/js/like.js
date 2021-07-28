$(document).on("click", ".like", function () {
    var _this = $(this);

    var _url = "/like/" + _this.attr("data-model-id") + "/" + _this.attr("data-type");

    console.log(_url);

    $.get(_url, function (data) {

        if (data == "0") {
            _this.nextAll(".warning").removeClass("d-none").delay(800).fadeOut(1000);
            console.log('Owner');

        } else {
            _this.addClass("btn-danger unlike").removeClass('btn-primary like');
            _this.find(".fa").addClass("fa-thumbs-down").removeClass('fa-thumbs-up');

            var increment = _this.nextAll(".count");
            increment.html(parseInt(increment.html()) + 1);
        }
    });
});

$(document).on("click", ".unlike", function () {
    var _this = $(this);

    var _url = "/unlike/" + _this.attr("data-model-id") + "/" + _this.attr("data-type");

    console.log(_url);

    $.get(_url, function (data) {
        _this.addClass("btn-primary like").removeClass('btn-danger unlike');
        _this.find(".fa").addClass("fa-thumbs-up").removeClass('fa-thumbs-down');

        var increment = _this.nextAll(".count");
        increment.html(parseInt(increment.html()) - 1);

        console.log(data);
    });

})
