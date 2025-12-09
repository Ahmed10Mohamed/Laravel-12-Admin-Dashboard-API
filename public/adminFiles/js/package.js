$(document).ready(function () {
    $("#academy_id").on("change", function () {
        let academyId = $(this).val();
        let $ageGroup = $("#age_group_id");
        if (academyId) {
            setLoading($ageGroup);
            $.ajax({
                url: `/Dashboard-Admin/academy/${academyId}/age-groups`,
                method: "GET",
                success: function (data) {
                    populateSelect($ageGroup, data);
                },
                error: function () {
                    setError($ageGroup, "فشل تحميل البيانات");
                },
            });
        } else {
            $ageGroup
                .empty()
                .append('<option value="">المرحلة السنية</option>')
                .trigger("change.select2");
        }
    });
});

function populateSelect($select, items, labelKey = "name") {
    $select.empty().append(`<option value="">اختر...</option>`);
    items.forEach((item) => {
        $select.append(`<option value="${item.id}">${item[labelKey]}</option>`);
    });
    $select.trigger("change.select2");
}

function setLoading($select) {
    $select
        .empty()
        .append(`<option>جارٍ التحميل...</option>`)
        .trigger("change.select2");
}

function setError($select, message) {
    $select
        .empty()
        .append(`<option>${message}</option>`)
        .trigger("change.select2");
}
