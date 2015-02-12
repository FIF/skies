
var user_id  = '';

function getUserProfile() {
    if (localStorage.getItem('user_profile') !== null) {
        user_profile = JSON.parse(localStorage["user_profile"]);
        user_id  = user_profile.user_id;
    }
}

function checkUserProfile() {
    if( (user_id == '') || (typeof user_id == 'undefined') ) {    // User id not set
        return false;
    }
}

function sendUserProfile() {
    checkUserProfile();

    $.ajax({
        type: 'POST',
        url: '{{ route("ajaxUserProfile") }}',
        data: {
            user_id: user_id,
        },
        success: function(data) {
            console.log(data);
        },
        async: false
    });
}

$(document).ready(function() {
    sendUserProfile();
    if(typeof user_id != 'undefined' && (user_id > 0)) {
        setUserId();
    }
});
