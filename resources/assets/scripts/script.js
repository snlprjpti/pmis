/**
 * Created by amrit on 6/9/15.
 */
$.fn.extend({
    treed: function (o) {

        var openedClass = 'glyphicon-minus-sign';
        var closedClass = 'glyphicon-plus-sign';

        if (typeof o != 'undefined'){
            if (typeof o.openedClass != 'undefined'){
                openedClass = o.openedClass;
            }
            if (typeof o.closedClass != 'undefined'){
                closedClass = o.closedClass;
            }
        };

        //initialize each of the top levels
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this); //li with children ul
            branch.prepend("<i class='indicator " + closedClass + "'></i>");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children().children().toggle();
        });
        //fire event from the dynamically added icon
        tree.find('.branch .indicator').each(function(){
            $(this).on('click', function () {
                $(this).closest('li').click();
            });
        });
        //fire event to open branch if the li contains an anchor instead of text
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
        //fire event to open branch if the li contains a button instead of text
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
    }
});
(function () {

    $(document).keydown(function (e) {
        if (e.ctrlKey && e.keyCode == 36) {
            $('header.container').slideToggle();
        }
    });
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'icheckbox_square-blue',
        increaseArea: '20%' // optional

    });
    $('select').select2();

    $('.summernote').summernote({
        height: 200 ,                // set editor height
        focus: true,
        onImageUpload: function(files) {
            uploadImage(files[0]);

        }
    });
    //$('#tree').treed({openedClass : 'ion-chevron-down', closedClass : 'ion-chevron-right'});
    $('#tree a').click(function () {
        $('#tree a').each(function () {
            $(this).removeClass('active');
        });
        $(this).addClass('active');

    })

        function uploadImage(file)
    {
        var data = new FormData();
        data.append("image", file);
        data.append("_token", token);
        $.ajax({
            data: data,
            type: "POST",
            url: summernoteUploadImageUrl,
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
                $('.summernote').summernote('editor.insertImage', url);
                //editor.insertImage(welEditable, url);
            }
        });

    }
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
    });

    $('ul.nav li.dropdown').hover(function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(100);
    }, function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(100);
    });

    $('[data-toggle="tooltip"]').tooltip()

    $(document).on('click', '.delete', function (event) {
        event.preventDefault();

        var $this = $(this);

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {

            var $_from = $this.closest("form").attr('id');

            $('#' + $_from).submit();

        });
    });


    /*
     population clock
     */

    //var checkTime = function (i) {
    //    if (i < 10) {
    //        i = "0" + i;
    //    }
    //    return i;
    //}
    $('#affix').affix({
        offset: {
            top: 200
        }
    });


}());
var number_format = function(number, decimals, dec_point, thousands_sep) {  // Format a number with grouped thousands
    var i, i_a, j, kp, kw, kd, km;
    // input sanitation & defaults
    if (isNaN(decimals = Math.abs(decimals))) {
        decimals = 2;
    }
    if (dec_point == undefined) {
        dec_point = ",";
    }
    if (thousands_sep == undefined) {
        thousands_sep = ".";
    }
    i = parseInt(number = (+number || 0).toFixed(decimals)) + "";
    i_a = parseInt(Math.abs(i)) + "";
    if ((j = i_a.length) > 3) {
        j = j % 3;
    }
    else {
        j = 0;
    }

    km = (j ? i_a.substr(0, j) + thousands_sep : "");
    kw = i_a.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
    kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");
    if (i < 0) {
        kp = '-';
    } else {
        kp = '';
    }
    return kp + km + kw + kd;
}

var extract = function(pop_start, births_sec, deaths_sec, migration_sec, sex_ratio,census_year,census_month,census_day) {
    //gdp_sec, debt_start, debt_sec
    now = new Date();
    d_start = new Date(census_year, census_month, census_day);
    d_year = new Date(now.getFullYear(), 0, 1);
    d_today = new Date();
    d_today.setHours(0);
    d_today.setMinutes(0);
    d_today.setSeconds(0);
    d_today.setMilliseconds(0);

    sec_now_start = (now - d_start) / 1000;
    sec_today = (now - d_today) / 1000;
    sec_year = (now - d_year) / 1000;

    pop_now_r = pop_start + sec_now_start * (births_sec - deaths_sec + migration_sec);
    pop_now_female = pop_now_r / (1 + sex_ratio);
    pop_now_male = pop_now_r * sex_ratio / (1 + sex_ratio);
    pop_now_male_perc = pop_now_male * 100 / pop_now_r;
    pop_now_female_perc = pop_now_female * 100 / pop_now_r;
    pop_now = number_format(pop_now_r, 0, '.', ' ');
    pop_now_female = number_format(pop_now_female, 0, '.', ' ');
    pop_now_male = number_format(pop_now_male, 0, '.', ' ');
    pop_now_male_perc = number_format(pop_now_male_perc, 1, '.', ' ') + "%";
    pop_now_female_perc = number_format(pop_now_female_perc, 1, '.', ' ') + "%";
    births_today_r = sec_today * births_sec;
    births_today = number_format(births_today_r, 0, '.', ' ');
    births_year_r = sec_year * births_sec;
    births_year = number_format(births_year_r, 0, '.', ' ');
    deaths_today_r = sec_today * deaths_sec;
    deaths_today = number_format(deaths_today_r, 0, '.', ' ');
    deaths_year_r = sec_year * deaths_sec;
    deaths_year = number_format(deaths_year_r, 0, '.', ' ');
    net_migration_today_r = sec_today * migration_sec;
    net_migration_today = number_format(net_migration_today_r, 0, '.', ' ');
    net_migration_year_r = sec_year * migration_sec;
    net_migration_year = number_format(net_migration_year_r, 0, '.', ' ');
    pop_growth_today_r = births_today_r - deaths_today_r + net_migration_today_r;
    pop_growth_today = number_format(pop_growth_today_r, 0, '.', ' ');
    pop_growth_year_r = births_year_r - deaths_year_r + net_migration_year_r;
    pop_growth_year = number_format(pop_growth_year_r, 0, '.', ' ');

    //gdp_today_r = sec_today * gdp_sec;
    //gdp_today = number_format(gdp_today_r, 0, '.', ' ');
    //gdp_today_pc_r = gdp_today_r / pop_now_r;
    //gdp_today_pc = number_format(gdp_today_pc_r, 0, '.', ' ');
    //gdp_this_year_r = sec_year * gdp_sec;
    //gdp_this_year = number_format(gdp_this_year_r, 0, '.', ' ');
    //gdp_this_year_pc_r = gdp_this_year_r / pop_now_r;
    //gdp_this_year_pc = number_format(gdp_this_year_pc_r, 0, '.', ' ');
    //total_public_debt_r = debt_start + sec_year * debt_sec;
    //total_public_debt = number_format(total_public_debt_r, 0, '.', ' ');
    //total_public_debt_pc_r = total_public_debt_r / pop_now_r;
    //total_public_debt_pc = number_format(total_public_debt_pc_r, 0, '.', ' ');
    //public_debt_today_r = sec_today * debt_sec;
    //public_debt_today = number_format(public_debt_today_r, 0, '.', ' ');
    //public_debt_this_year_r = sec_year * debt_sec;
    //public_debt_this_year = number_format(public_debt_this_year_r, 0, '.', ' ');

    $('.cc1').html(pop_now);
    $('.cc2').html(pop_now_male);
    $('.cc3').html(pop_now_female);
    $('.cc4').html('(' + pop_now_male_perc + ')');
    $('.cc5').html('(' + pop_now_female_perc + ')');
    $('.cc6').html(births_year);
    $('.cc7').html(births_today);
    $('.cc8').html(deaths_year);
    $('.cc9').html(deaths_today);
    $('.cc10').html(net_migration_year);
    $('.cc11').html(net_migration_today);
    $('.cc12').html(pop_growth_year);
    $('.cc13').html(pop_growth_today);

}
