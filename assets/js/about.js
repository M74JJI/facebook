$(document).ready(function () {
    $(document).on('click', '.about-workplace_company.about_flex', function () {
        console.log('a7eeeeeeeeeeeeee');
        var userid = $(this).data('userid');
        var profileid = $(this).data('profileid');
        $(this).removeClass().addClass('about_workplace_form');
        $(this)
            .empty()
            .html(
                '<div class="about_workplace_form" data-userid="' +
                    userid +
                    '" data-profileid="' +
                    profileid +
                    '" > <input type="text" class="about_input_company about_input" placeholder="Company" /> <input type="text" class="about_input_position about_input" placeholder="Position" /> <input type="text" class="about_input_city about_input" placeholder="City/Town" /> <textarea class="about_input_description about_input" placeholder="Description" style=" height: 130px; padding-top: 1rem; resize: none; font-family: inherit; " ></textarea> <span class="time_period">Time Period </span> <div class="time_period"> <input type="checkbox" name="work" checked />I currently work here </div> <div class="work_date"> From <select name="year" id="years"> <option>Year</option> </select> </div> <div class="border"></div> <div class="privacy_about_submit"> <div class="public_privacy_icon"> <img src="https://www.facebook.com/rsrc.php/v3/yR/r/ZwEccUSRMY2.png" alt="" /> Public </div> <div class="save_cacnel"> <button>Cancel</button> <button class="about-submit-btn">Save</button> </div> </div> </div>'
            );

        var btn = $(this).find('.about-submit-btn');

        $(this).on('click', '.about-submit-btn', function () {
            var company = $(this)
                .parents('.privacy_about_submit')
                .siblings('.about_input_company.about_input')
                .val();
            var position = $(this)
                .parents('.privacy_about_submit')
                .siblings('.about_input_position.about_input')
                .val();
            var city = $(this)
                .parents('.privacy_about_submit')
                .siblings('.about_input_city.about_input')
                .val();
            var description = $(this)
                .parents('.privacy_about_submit')
                .siblings('.about_input_description.about_input')
                .val();
            console.log('company--->', company);
            console.log('position--->', position);
            console.log('city--->', city);
            console.log('description--->', description);

            $.post(
                'http://localhost/facebook/core/ajax/AddUserInfos.php',
                {
                    company: company,
                    position: position,
                    userid: userid,
                    city: city,
                    description: description,
                },
                function (data) {
                    console.log(data);

                    $('.about_workplace_form').removeClass().empty().html(data);
                }
            );
        });
    });
});
