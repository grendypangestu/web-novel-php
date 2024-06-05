$(document).ready(function () {
    $("#search-form").submit(function (e) {
        e.preventDefault();
        var keyword = $("#search-input").val();

        $.ajax({
            url: "search.php",
            type: "GET",
            data: { keyword: keyword },
            success: function (response) {
                $("#search-results").html(response);
            }
        });
    });
});
