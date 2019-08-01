$(function() {
    $("#district_info").on("click",
    function() {
        $.areaSelected({
            success: function(a) {
                $("#district_info").val(a.district_info).attr({
                    "data-areaid": a.district_id,
                    "data-areaid2": a.district_id_2 == 0 ? a.district_id_1: a.district_id_2
                })
            }
        })
    })
});