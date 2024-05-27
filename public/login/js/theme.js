//# sourceMappingURL=theme.js.map
(function (a) {
    a(window).on("load", function () {
        a(".lds-ellipsis").fadeOut();
        a(".preloader").delay(333).fadeOut("slow");
        a("body").delay(333)
    });
    a("#otp-screen .form-control").keyup(function () {
        0 == this.value.length ? a(this).blur().parent().prev().children(".form-control").focus() : this.value.length == this.maxLength && a(this).blur().parent().next().children(".form-control").focus()
    });
    var b;
    a(".video-btn").on("click", function () {
        b = a(this).data("src")
    });
    a("#videoModal").on("shown.bs.modal", function (c) {
        a("#video").attr("src",
                b + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0&amp;rel=0")
    });
    a("#videoModal").on("hide.bs.modal", function (c) {
        a("#video").attr("src", b)
    });
    a("body").on("hidden.bs.modal", function () {
        0 < a(".modal.show").length && a("body").addClass("modal-open")
    });
    a("[data-toggle='tooltip']").tooltip({container: "body"})
})(jQuery);