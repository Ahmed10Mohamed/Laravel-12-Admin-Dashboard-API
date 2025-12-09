   function populateSelect($select, items, labelKey = 'name') {
                    $select.empty().append(`<option value="">اختر...</option>`);
                    items.forEach(item => {
                        $select.append(`<option value="${item.id}">${item.name}</option>`);
                    });
                    $select.trigger('change.select2');
                }

                function setLoading($select) {
                    $select.empty().append(`<option>جارٍ التحميل...</option>`).trigger('change.select2');
                }

                function setError($select, message) {
                    $select.empty().append(`<option>${message}</option>`).trigger('change.select2');
                }

                $(document).ready(function() {
                    $('.select2').select2({
                        placeholder: function() {
                            return $(this).data('placeholder');
                        },
                        width: '100%'
                    });

                    $('#academy_id').on('change', function() {
                        let academyId = $(this).val();
                        let $ageGroup = $('#age_group_id');
                        let $group = $('#group_id');

                        $group.empty().append('<option value="">المجموعات</option>').trigger('change.select2');

                        if (academyId) {
                            setLoading($ageGroup);
                            $.ajax({
                                url: `/Dashboard-Admin/academy/${academyId}/age-groups`,
                                method: 'GET',
                                success: function(data) {
                                    populateSelect($ageGroup, data);
                                },
                                error: function() {
                                    setError($ageGroup, 'فشل تحميل البيانات');
                                }
                            });
                        } else {
                            $ageGroup.empty().append('<option value="">المرحلة السنية</option>').trigger(
                                'change.select2');
                        }
                    });

                    $('#age_group_id').on('change', function() {
                        let ageGroupId = $(this).val();
                        let $group = $('#group_id');
                        let $package = $('#package_id');

                        if (!ageGroupId) {
                            resetSelect($group, 'المجموعات');
                            resetSelect($package, 'اختار الباقة');
                            return;
                        }

                        // ضع Loading على الليستين
                        setLoading($group);
                        setLoading($package);

                        // طلبين متوازيين (أسرع Performance)
                        $.when(
                                $.get(`/Dashboard-Admin/age-group/${ageGroupId}/groups`),
                                $.get(`/Dashboard-Admin/age-group/${ageGroupId}/packages`)
                            )
                            .done(function(groupsResponse, packagesResponse) {

                                // groupsResponse[0] === actual data
                                populateSelect($group, groupsResponse[0], 'المجموعات');
                                populateSelect($package, packagesResponse[0], 'اختار الباقة');

                            })
                            .fail(function() {
                                setError($group, 'فشل تحميل البيانات');
                                setError($package, 'فشل تحميل البيانات');
                            });
                    });

                    // أدوات مساعدة
                    function resetSelect($element, placeholder) {
                        $element.empty().append(`<option value="">${placeholder}</option>`).trigger('change.select2');
                    }


                });