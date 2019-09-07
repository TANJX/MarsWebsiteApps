(function () {
    var header = new Headroom(document.querySelector("#header"), {
        tolerance: 5,
        offset: 205,
        classes: {
            initial: "animated",
            pinned: "slideDown",
            unpinned: "slideUp"
        }
    });
    header.init();
}());
