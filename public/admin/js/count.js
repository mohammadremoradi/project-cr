function countChar(val, limit) {
    var len = val.value.length;
    if (len >= limit) {
        val.value = val.value.substring(0, limit);
    }
    if (limit == 59) {
        $("#title_count").text(limit - len);
    }
    if (limit == 150) {
        $("#dis_count").text(limit - len);
    }
}
function counterTitle(val) {
    var len = val.value.length;
    $("#counterTitle").text(len);
}
function counterBody(val) {
    var len = val.value.length;
    $("#counterBody").text(len);
}
