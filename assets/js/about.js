/*$(document).ready(function () {
    $(document).on('click', '.workeducation_link', function () {
        console.log('clicked--------------------------***');
        $('.about_menu_data').empty();
        $('.overview_menu').hide();
        var userid = $(this).data('userid');
        var profileid = $(this).data('profileid');
        $('.active_about_link').removeClass();
        $(this).addClass('active_about_link');

        $.post(
            'http://localhost/facebook/core/ajax/aboutSubmit.php',
            {
                workeducation: userid,
                profileid: profileid,
            },
            function (data) {
                console.log(data);
                $('.about_menu_data').empty().html(data);
            }
        );
    });
    $(document).on('click', '.placeslived_link', function () {
        $('.about_menu_data').empty();
        $('.overview_menu').hide();
        var userid = $(this).data('userid');
        var profileid = $(this).data('profileid');
        $('.active_about_link').removeClass();
        $(this).addClass('active_about_link');

        $.post(
            'http://localhost/facebook/core/ajax/aboutSubmit.php',
            {
                placeslived: userid,
                profileid: profileid,
            },
            function (data) {
                console.log(data);
                $('.about_menu_data').empty().html(data);
            }
        );
    });
    $(document).on('click', '.contacts_link', function () {
        $('.about_menu_data').empty();
        $('.overview_menu').hide();
        var userid = $(this).data('userid');
        var profileid = $(this).data('profileid');
        $('.active_about_link').removeClass();
        $(this).addClass('active_about_link');

        $.post(
            'http://localhost/facebook/core/ajax/aboutSubmit.php',
            {
                contacts_basic: userid,
                profileid: profileid,
            },
            function (data) {
                console.log(data);
                $('.about_menu_data').empty().html(data);
            }
        );
    });
});
 */
