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
            var myTable = jQuery('#myTable');
            
            $('#players-loaded').empty().append(response);
            $(document).on('keydown', function(){
            
                var numberOfCells = jQuery('#myTable td').length;
                var currentElement = jQuery('td.active');

                console.log(event.keyCode);
                

                if(event.keyCode == 37) {

                    var currentID = currentElement.attr('id').split('');
                    currentID.splice(currentID.length-1, 1, +currentID[currentID.length - 1]-1);

                    var newID = currentID.join('');
                    var newElement = jQuery('#' + newID);

                    if( newElement.length ){
                        currentElement.removeClass('active');
                        newElement.addClass('active');
                    } else {
                        console.log('not found');
                    }

                }

                else if (event.keyCode == 39) {

                    var currentID = currentElement.attr('id').split('');
                    currentID.splice(currentID.length-1, 1, +currentID[currentID.length - 1]+1);

                    var newID = currentID.join('');
                    var newElement = jQuery('#' + newID);

                    if( newElement.length ){
                        currentElement.removeClass('active');
                        newElement.addClass('active');
                    } else {
                        console.log('not found');
                    }


                }
                
                else if (event.keyCode == 38) {

                    var currentID = currentElement.attr('id').split('');
                    currentID.splice(2,1, +currentID[2]-1);

                    var newID = currentID.join('');
                    var newElement = jQuery('#' + newID);

                    if( newElement.length ){
                        currentElement.removeClass('active');
                        newElement.addClass('active');
                    } else {
                        console.log('not found');
                    }

                }
                else if (event.keyCode == 40) {

                    var currentID = currentElement.attr('id').split('');
                    currentID.splice(2,1, +currentID[2]+1);

                    var newID = currentID.join('');
                    var newElement = jQuery('#' + newID);

                    if( newElement.length ){
                        currentElement.removeClass('active');
                        newElement.addClass('active');
                    } else {
                        console.log('not found');
                    }

                }

                else if (event.keyCode == 82) { //Enter keycode
                    checkInPlayerSubmit($('td.active .player-btn').data('id'));
                }  

            });
            
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
            $(document).off('keydown');
            getAllPlayers();
        },
        errors: function(response) {
            alert(response);
            console.log(response);
            
        }
    });
}


jQuery(document).ready(function($) {
    getAllPlayers();
}); 