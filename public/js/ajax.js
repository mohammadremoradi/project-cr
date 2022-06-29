function changeStatus(id) {
    var element = $("#" + id);
    var shape = $("#shape" + id);
    var url = element.attr("data-url");
    var value = element.val();

    $.ajax({
        url: url,
        type: "GET",
        success: function (response) {

            console.log(response)
            if (response.status) {
                console.log(response.status)

                if (response.active) {

                    element.val("active");
                    element.removeClass("btn-outline-success");
                    element.addClass("btn-outline-danger");
                    element.html("click to be inactive");

                    shape.removeClass("text-danger");
                    shape.addClass("text-success");

                    success("record is actived");
                } else {
                    element.val("inactive");
                    element.removeClass("btn-outline-danger");
                    element.addClass("btn-outline-success");
                    element.html("click to be active");

                    shape.removeClass("text-success");
                    shape.addClass("text-danger");

                    success("record disabled");
                }
            } else {

                element.val(value);
                success("try again");
            }
        },

        error: function () {
            console.log('connection')

            error("faild connection");
        },
    });

    function success(message) {
        var successToastTag =
            '<section class="toast" style="position: absolute; bottom: 0; right: 0;" data-delay="5000">\n' +
            '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
            '<strong class="mr-auto">' +
            message +
            "</strong>\n" +
            '<button type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">\n' +
            '<span aria-hidden="true">&times;</span>\n' +
            "</button>\n" +
            "</section>\n" +
            "</section>";

        $(".toast-wrapper").append(successToastTag);
        $(".toast")
            .toast("show")
            .delay(5500)
            .queue(function () {
                $(this).remove();
            });
    }

    function error(message) {
        var errorToastTag =
            '<section class="toast" data-delay="5000">\n' +
            '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
            '<strong class="mr-auto">' +
            message +
            "</strong>\n" +
            '<button type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">\n' +
            '<span aria-hidden="true">&times;</span>\n' +
            "</button>\n" +
            "</section>\n" +
            "</section>";

        $(".toast-wrapper").append(errorToastTag);
        $(".toast")
            .toast("show")
            .delay(5500)
            .queue(function () {
                $(this).remove();
            });
    }
}
