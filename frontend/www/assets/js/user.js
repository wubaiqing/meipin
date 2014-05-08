var User = {};
User.Config = {
    'version' : 1.0,
};

User.Address = (function () {
    return {
        'changeProvince' : function () {
            var url = $('#getProvinceUrl').val();
            $('#userProvince').change(function () {
                $.getJSON(url, {'provinceId' : $(this).val()}, function (json) {
                    if (json.status == 0) {
                        return false;
                    }
                    $('#userCity').html(json.data);
                });
            });
        }
    }
})();
