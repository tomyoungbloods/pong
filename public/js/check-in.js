function getAllPlayers() {
    // Ajax request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/ajax/players/get-all',
        method:'POST',
        success: function(response) {
            $('#players-loaded').empty().append(response);
            checkInPlayerClick();
        },
        errors: function(response) {
            alert(response);
            console.log(response);
        }
    });
}

function checkInPlayerSubmit(id) {
    // Ajax request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/ajax/players/check-in',
        method:'POST',
        data: {id: id},
        success: function(response) {
            console.log(response);
            getAllPlayers();
        },
        errors: function(response) {
            alert(response);
            console.log(response);
        }
    });
}

function checkInPlayerClick() {
    $('.player-btn').on('click', function() {
        checkInPlayerSubmit($(this).data('id'));
    });
}

jQuery(document).ready(function($) {
    getAllPlayers();
});