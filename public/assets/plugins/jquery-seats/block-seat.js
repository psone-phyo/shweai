function get_seat_map(seat_row,first_col,second_col,third_col=null){

    var seatMap = [];

        for (var i = 0; i < seat_row; i++) {

            var row = '';
            for (var j = 0; j < first_col; j++) {
                row += 's';
            }
            row += '_';
            for (var k = 0; k < second_col; k++) {
                row += 's';
            }
            //for 1+1+1
            if (third_col !== null && third_col > 0) {
                row += '_'; // Space between second and third column
                for (var m = 0; m < third_col; m++) {
                    row += 's';
                }
            }
            seatMap.push(row);
        }

    return seatMap;
}
// function get_seat_map(seat_row,first_col,second_col,third_col=null,select_prefix){

//     var seatMap = [];

//         for (var i = 0; i < seat_row; i++) {

//             var row = '';
//             for (var j = 0; j < first_col; j++) {
//                 row += 's';
//             }
//             if (select_prefix == 'A-4' && i == 4){
//                 row += '___';
//             }else if (select_prefix == 'RC-2' && i == 1 || select_prefix == 'RC-2'  && i == 2){
//                 row += '___';
//             }
//             else{
//                 row += '_';
//                 for (var k = 0; k < second_col; k++) {
//                     row += 's';
//                 }
//                 //for 1+1+1
//                 if (third_col !== null && third_col > 0) {
//                     row += '_'; // Space between second and third column
//                     for (var m = 0; m < third_col; m++) {
//                         row += 's';
//                     }
//                 }
//             }
//             row="'"+row+"'";
//             seatMap.push(row);
//         }

//     return seatMap;
// }


function show_seat_plan(seatMap)
{

        // var bus_structure = ($('#bus_structure').find(":selected").text()).split('+');
        var bus_structure = document.getElementById('bus_structure').value.split('+');
        $show_counter = $('#counter');
        var seat_row = $('#col').val();
        var select_prefix = $('#prefix').val();

        var first_col = parseInt(bus_structure[0]);
        var second_col = parseInt(bus_structure[1]);

        var num = 0;
        var firstSeatLabel = 1;
        var prefix = select_prefix.charCodeAt();
        var newrow = 0;
        var max = (first_col + second_col) * 10;
        var $total = $('#total');
        var temp = 0;
        var currentcol;
        var totalcol = first_col + second_col;

        if($('#frontend_booking').val() == "yes")
        {
            var price = parseFloat($('#route_price').val());
        }else{
            var price = 0;
        }
        $('.seatCharts-row').val(seatMap);
        $('.seatCharts-row').remove();
        $('.seatCharts-legendItem').remove();
        $('#seat-map,#seat-map *').unbind().removeData();

        sc = $('#seat-map').seatCharts({
                    map: seatMap,
                    seats: {
                        s: {
                            price: price,
                            classes: 'economy-class', //your custom CSS class
                            category: ''
                        }

                    },
                    naming: {
                        top: false,
                        getLabel: function (character, row, column) {
                            if (select_prefix == 'numeric-4') {

                                if (column == 1 || column == 2) {
                                    return firstSeatLabel++;
                                }
                                if (column == 4 || column == 5) {
                                    return max--;
                                }

                            }
                            else if (select_prefix == 'numeric-5') {
                                if (column == 1) {
                                    return ( firstSeatLabel++ + 3);
                                }

                                if (column == 2) {
                                    return ( firstSeatLabel++ + 1);
                                }

                                if (column == 3) {
                                    num = 1;
                                    return ( firstSeatLabel++ + 2);
                                }

                                if (column == 4) {
                                    return ( firstSeatLabel++ - ( 1 + num ));
                                }

                                if (column == 5) {
                                    return ( firstSeatLabel++ - ( 3 + num ) );
                                }
                            }

                            else if (select_prefix == 'A-1') {
                                var yarzartun_prefix = 'A'.charCodeAt(); // Start from 'A'

                                if (newrow != row) {
                                    newcol = 0;
                                }

                                newcol++;
                                newrow = row;

                                var rowLabel = String.fromCharCode(yarzartun_prefix + row - 1);

                                if (newcol == 1){
                                    currentcol = totalcol;
                                }

                                if (newcol == 1) {
                                    return rowLabel + currentcol--;
                                }
                                if (newcol == 2) {
                                    return rowLabel + currentcol--;
                                }
                                if (newcol == 3) {
                                    return rowLabel + currentcol--;
                                }
                                if (newcol == 4) {
                                    return rowLabel + currentcol--;
                                }
                                if (newcol == 5) {
                                    return rowLabel + currentcol--;
                                }
                                return '';
                            }
                            else if (select_prefix == 'A-2') {
                                var yarzartun_prefix = 'A'.charCodeAt();
                                if (newrow != row) {
                                    newcol = 0;
                                }
                                newcol++;
                                newrow = row;

                                return row + String.fromCharCode(yarzartun_prefix + newcol - 1);
                            }
                            else if (select_prefix == 'A-3') {
                                var yarzartun_prefix = 'A'.charCodeAt() + first_col + second_col - 1; // Calculate ASCII code of the start letter

                                if (newrow != row) {
                                    newcol = 0;
                                }
                                newcol++;
                                newrow = row;

                                return String.fromCharCode(yarzartun_prefix - newcol + 1) + row; // Convert back to letter
                            }

                            else if (select_prefix == 'A-4') {
                                var yarzartun_prefix = 'A'.charCodeAt(); // Start from 'A'

                                if (newrow != row) {
                                    newcol = 0;
                                }

                                newcol++;
                                newrow = row;
                                var rowLabel = String.fromCharCode(yarzartun_prefix + row - 1);

                                if (newcol == 1) {
                                    return rowLabel + '1';
                                }
                                if (newcol == 2) {
                                    return rowLabel + '2';
                                }
                                if (newcol == 3) {
                                    return rowLabel + '3';
                                }
                                if (newcol == 4) {
                                    return rowLabel + '4';
                                }
                                if (newcol == 5) {
                                    return rowLabel + '5';
                                }
                                return '';
                            }
                            else if (select_prefix == 'RC') {
                                var rowLabel = 'RC';
                            if (newrow != row) {
                                newcol = 0;
                            }

                            newcol += 2;
                            newrow = row;

                            if (newcol == 2) {
                                return rowLabel + (firstSeatLabel++);
                            }
                            if (newcol == 4) {
                                return rowLabel + (firstSeatLabel++);
                            }
                            if (newcol == 6) {
                                return rowLabel + (firstSeatLabel++);
                            }
                            if (newcol == 8) {
                                return rowLabel + (firstSeatLabel++);
                            }
                            return ''; // Empty space
                            }
                            else if (select_prefix == 'RC-2') {
                                var rowLabel = 'A';

                                if (newrow != row) {
                                    newcol = 0;
                                }
                                newcol++;
                                newrow = row;

                                if (newcol == 1) {
                                    return rowLabel + (firstSeatLabel++);
                                }
                                if (newcol == 2) {
                                    if (temp == 0){
                                        temp = ++seat_row;
                                    }
                                    return rowLabel + (temp++);
                                }
                                if (newcol == 3) {
                                    return rowLabel + (temp++);
                                }
                                if (newcol == 4) {
                                    return rowLabel + (temp++);
                                }
                                if (newcol == 5) {
                                    return rowLabel + (temp++);
                                }
                                return rowLabel + row;
                            }
                            else if (parseInt(prefix) == 1) {
                                return firstSeatLabel++;
                            }
                            else if (select_prefix == 'numeric-3') {

                                if (column == 1 || column == 2) {
                                    return firstSeatLabel++;
                                }

                                if (column == 3) {
                                    num = 1;
                                    return ( firstSeatLabel++ + 2 );
                                }

                                if (column == 4) {
                                    return ( firstSeatLabel++ + 1 ) - num;
                                }

                                if (column == 5) {
                                    return ( firstSeatLabel++ - 1 ) - num;
                                }

                            }
                            else if (select_prefix == 'numeric-L') {

                                if (row == seat_row) {
                                    return firstSeatLabel++;
                                } else {
                                    if (row == ( seat_row - 1 )) {
                                        if (column == 1) {
                                            return ( firstSeatLabel++ - 1);
                                        }

                                        if (column == 2) {
                                            return ( firstSeatLabel++ - 1);
                                        }

                                        if (column == 4) {
                                            return ( firstSeatLabel++ );
                                        }
                                        return firstSeatLabel++;
                                    } else {
                                        if (column == 1) {
                                            return ( firstSeatLabel++ - 1);
                                        }

                                        if (column == 2) {
                                            return ( firstSeatLabel++ - 1);
                                        }

                                        if (column == 4) {
                                            num = 2;
                                            return ( firstSeatLabel++ + num);
                                        }
                                        return firstSeatLabel++;
                                    }
                                }
                            }else if (select_prefix == 'numeric-L2') {
                                // console.log(column);

                                // if (column <= first_col + second_col + 1) {
                                //     return firstSeatLabel++;
                                // }
                                return firstSeatLabel++;
                            }

                            else if (select_prefix == 'numeric-Desc') {

                                if (column == 1) {
                                    return ( firstSeatLabel++ + 2 ) - num;
                                }
                                if( column == 2) {
                                    return ( firstSeatLabel++ )
                                }

                                if (column == 3) {
                                    num = 1;
                                    return ( firstSeatLabel++ + 2 );
                                }

                                if (column == 4) {
                                    return ( firstSeatLabel++ - 2) - num;
                                }

                                if (column == 5) {
                                    return ( firstSeatLabel++ ) - num;
                                }

                            }else if (select_prefix == 'numeric-6') {
                                if (row == 5 || row == 6) {
                                    if (column == 1) {
                                        return ( firstSeatLabel++ - 2);
                                    }
                                }else {
                                    if (column == 1) {
                                        return ( firstSeatLabel++);
                                    }
                                }

                                if( column == 2) {
                                    return ( firstSeatLabel++ )
                                }
                                if (row == 4 || row == 5) {
                                    if (column == 3 || column == 4) {
                                        num = 1;
                                        return ( firstSeatLabel++ +1);
                                    }
                                }else {
                                    if (column == 3) {
                                        num = 1;
                                        return ( firstSeatLabel++);
                                    }
                                }


                                if (column == 4) {
                                    return ( firstSeatLabel++ +1) - num;
                                }

                                if (column == 5) {
                                    return ( firstSeatLabel++ ) - num;
                                }

                            }
                            else {
                                if (newrow != row) {
                                    newcol = 0;
                                }
                                newcol++;
                                newrow = row;
                                return String.fromCharCode(prefix + row - 1) + newcol;
                            }
                        }
                    },
                    legend: {
                        node: $('#legend'),
                        items: [
                            ['s', 'available', seat_availableSeat],
                            ['l', 'selected', seat_selectedSeat],
                            ['b', 'unavailable', seat_disabledSeat],
                            ['r', 'booking', seat_bookingSeat],
                            // ['a', 'booked', 'Already Booked'],
                            ['group', 'group-seat', seat_group, 'fa-users'],
                            ['monk', 'monk-seat', seat_monk, 'fa-praying-hands'],
                            ['male', 'male-seat', seat_male, 'fa-male'],
                            ['female', 'female-seat', seat_female, 'fa-female'],

                        ]
                    },
                    click: function () {

                        var block_map = $('#block_map').val();

                        if($('#frontend_booking').val() == "yes")
                        {
                            var $cart = $('#selected-seats');
                            var $counter = $('#counter');

                            var selected_map = $('#selected_map').val();
                            var seat_no = $('#seat_no').val();
                            var adult = parseFloat($('#adult').val());
                            var price = parseFloat($('#route_price').val());
                            if (this.status() == 'available' || this.status() == 'for-user') {

                                if (adult <= parseInt(sc.find('selected').length + 1)) {
                                    $('.checkout-button').removeAttr('disabled');
                                } else {
                                    $('.checkout-button').attr('disabled', 'disabled');
                                }

                                if (adult < parseInt(sc.find('selected').length) + 1) {
                                    Swal.fire(seat_select_only);
                                    return this.status() == 'for-user' ? 'for-user' : 'available';
                                } else {
                                    //let's create a new <li> which we'll add to the cart items
                                    $('<li class="d-flex justify-content-between mr-5">' + '<div class="">' + this.data().category + ' Seat # ' + this.settings.label + ': <b> ' + this.data().price.toLocaleString() + '</b> MMK </div><a href="#SEATLAYOUT" class="cancel-cart-item text-danger text-4 d-block"><i class="far fa-minus-square text-danger"></i></a></li>')
                                            .attr('id', 'cart-item-' + this.settings.id)
                                            .data('seatId', this.settings.id)
                                            .appendTo($cart);

                                    selected_map += "'" + this.settings.id + "',";

                                    $('#selected_map').val(selected_map);

                                    seat_no += this.settings.label + ",";

                                    $('#seat_no').val(seat_no);

                                    $counter.text(sc.find('selected').length + sc.find('blocked').length + 1);
                                    let selected_total = (Number(recalculateTotal(sc)) + Number(this.data().price)).toLocaleString()  + " MMK";
                                    $total.text(selected_total.toLocaleString());

                                    return 'selected';
                                }

                            } else if (this.status() == 'selected') {
                                removeMap = "'" + this.settings.id + "',";
                                selected_map = selected_map.replace(removeMap, '');

                                $('#selected_map').val(selected_map);

                                removeMap = this.settings.label + ",";
                                seat_no = seat_no.replace(removeMap, '');

                                $('#seat_no').val(seat_no);

                                $counter.text(sc.find('selected').length + sc.find('blocked').length - 1);
                                //remove the item from our cart
                                $('#cart-item-' + this.settings.id).remove();
                                let unselected_total = (Number(recalculateTotal(sc)) - Number(this.data().price)).toLocaleString() + " MMK";
                                $total.text(unselected_total.toLocaleString());


                                if(adult >= parseInt(sc.find('selected').length)){
                                    $('.checkout-button').attr('disabled', 'disabled');
                                }

                                return this.status() == 'for-user' ? 'for-user' : 'available';

                            } else if (this.status() == 'unavailable') {
                                return 'unavailable';
                            } else {
                                return this.style();
                            }
                        } else {
                            var seat_id = $('#seat_id').val();
                            var single_remove_block_map = $('#single_remove_block_map').val();
                            var single_block_map = $('#single_block_map').val();
                            var selected_map = $('#selected_map').val();
                            var seat_no = $('#seat_no').val();

                            if (this.status() == 'available') {

                                $('#adult').val(sc.find('selected').length + 1).trigger('change');

                                selected_map += "'" + this.settings.id + "',";
                                $('#selected_map').val(selected_map);

                                seat_no += this.settings.label + ",";
                                $('#seat_no').val(seat_no);

                                $show_counter.text(sc.find('selected').length + 1);

                                return 'selected';

                            }
                            else if(this.status() == 'selected') {

                                remove_map = "'" + this.settings.id + "',";

                                selected_map = selected_map.replace(remove_map, '');
                                $('#selected_map').val(selected_map);

                                remove_map = this.settings.label + ",";
                                seat_no = seat_no.replace(remove_map, '');
                                $('#seat_no').val(seat_no);

                                $('#adult').val(sc.find('selected').length - 1).trigger('change');

                                $show_counter.text(sc.find('selected').length - 1);

                                return 'available';
                            }
                            else if(this.status() == 'unavailable') {

                                single_remove_block_map = "'" + this.settings.id + "',";
                                block_map = block_map.replace(single_remove_block_map, '');
                                $('#block_map').val(block_map);
                                $('#single_remove_block_map').val(block_map);

                                $show_counter.text(sc.find('unavailable').length - 1);

                                return 'available';
                            }
                            else if(this.status() == 'for-user') {


                                return this.style();
                            }
                            else {
                                return this.style();
                            }
                        }


                    }
        });

        $('#selected-seats').on('click', '.cancel-cart-item', function () {
              //let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
          sc.get($(this).parents('li:first').data('seatId')).click();

          if (adult == parseInt($('#counter').html())) {
            $('.checkout-button').removeAttr('disabled');
          } else {
            $('.checkout-button').attr('disabled', 'disabled');
           }

           $total.text(recalculateTotal(sc) + " MMK");
      });



        var block_map = $('#block_map').val();
            block_map = block_map.replace(/(\'|\")/gm,'');
            block_map = block_map.split(',');
        if(block_map.length){
            //let's pretend some seats have already been booked
            sc.get(block_map).status('unavailable');
        }

        //let's pretend some seats have already been booked

        var booked_seat = $('#booked_seat').val();
            booked_seat = booked_seat.replace(/(\'|\")/gm,'');
            booked_seat = booked_seat.split(',');
        if(booked_seat.length){
            //let's pretend some seats have already been booked
            sc.get(booked_seat).status('booked');
            for (i = 0; i < booked_seat.length; i++) {
                if(booked_seat[i]){
                    $('#'+booked_seat[i]).html('<i class="fa fa-users"></i>').attr('data-toggle','tooltip').attr('data-placement','top').attr('title','group');
                }
            }
        }
        load_seat_plan_icon($('#booked_icon').val());

        fetchdata();
}

function fetchdata(){
    $.ajax({
        type: 'get',
        url: window.location.origin+'/bus/booking-bus-seat/'+$('#route_id').val()+'/'+$('#seat_id').val()+'/'+$('#departureDate').val(),
        dataType: 'json',
        success: function (response) {

            sc.find('booking').each(function () {
                sc.get([this.settings.id]).status('available');
            });

            sc.get(response.bookingMap).status('booking');
            load_seat_plan_icon(response.bookedUserJson);
        }
    });
}

function load_seat_plan_icon(booked_user_json)
{
    if(booked_user_json)
    {
        var booked_user_json = JSON.parse(booked_user_json);
        var female = '<i class="fa fa-female"></i>';
        var male   = '<i class="fa fa-male"></i>';
        var monk   = '<i class="fa fa-praying-hands"></i>';
        var group  = '<i class="fa fa-users"></i>';

        for (i = 0; i < booked_user_json.length; i++) {

            var selected_seat = booked_user_json[i].selected_seat;
            var all_selected_seat = selected_seat.split(',');

            for (j = 0; j < all_selected_seat.length; j++) {

                if(all_selected_seat[j]){
                    if(booked_user_json[i].passenger_type == 'female'){
                        $('#'+all_selected_seat[j]).html(female).attr('data-toggle','tooltip').attr('data-placement','top').attr('title',booked_user_json[i].passenger_type);
                    }
                    else if(booked_user_json[i].passenger_type == 'male')
                    {
                        $('#'+all_selected_seat[j]).html(male).attr('data-toggle','tooltip').attr('data-placement','top').attr('title',booked_user_json[i].passenger_type);
                    }
                    else if(booked_user_json[i].passenger_type == 'monk')
                    {
                        $('#'+all_selected_seat[j]).html(monk).attr('data-toggle','tooltip').attr('data-placement','top').attr('title',booked_user_json[i].passenger_type);
                    }
                    else
                    {
                        $('#'+all_selected_seat[j]).html(group).attr('data-toggle','tooltip').attr('data-placement','top').attr('title',booked_user_json[i].passenger_type);
                    }
                }

            }
        }
    }


}


function load_seat_plan(seatMap=null){
        var bus_structure = ($('#bus_structure').find(":selected").text()).split('+');

        var seat_row = $('#col').val();
        var first_col = parseInt(bus_structure[0]);
        var second_col = parseInt(bus_structure[1]);
        var third_col = parseInt(bus_structure[2]);
        var newline = String.fromCharCode(13, 10);

        if(seatMap){
            var seatMap = seatMap.replace(/(\r\n|\n|\r)/gm,'');
                seatMap = seatMap.split(',');
        }
        else{
            var seatMap = get_seat_map(seat_row,first_col,second_col,third_col);
        }
        $('#counter').html(0);
        $('#seat_map').val(seatMap.join(','+newline));
        show_seat_plan(seatMap);
}

function recalculateTotal(sc) {
    var total = 0;

    //basically find every selected seat and sum its price
    sc.find('selected').each(function () {
        total += this.data().price;
    });
    return total;
}

   $(".seatCharts-legendList li:nth-child(3)" ).remove();
    $(".seatCharts-legendList > .seatCharts-legendItem > .male" ).html('<i class="fa fa-male"></i>');
    $(".seatCharts-legendList > .seatCharts-legendItem > .female" ).html('<i class="fa fa-female"></i>');
    $(".seatCharts-legendList > .seatCharts-legendItem > .group" ).html('<i class="fa fa-users"></i>');
    $(".seatCharts-legendList > .seatCharts-legendItem > .monk" ).html('<i class="fa fa-praying-hands"></i>');

$(function() {
    load_seat_plan($('#seat_map').val());
    Echo.channel(publicChannelId)
    .listen('.bnf.seat.'+$('#seat_id').val()+'.blocked', (message) => {
        sc.get(message.payload.selected_seat).status('booking');
        console.log(message.payload.selected_seat);
    });
    if(cartChannelId) {
        Echo.channel(cartChannelId)
        .listen('.bnf.seat.'+$('#seat_id').val()+'.booked', (message) => {
            sc.get(message.payload.selected_seat).status('booked');
            $('#select-busseats').modal('hide');
            $('#seat_layout').html('');
            $('#seat_div').addClass('d-none');
            Swal.fire(seat_already_booked);
            console.log(message.payload.selected_seat);
        })
        .listen('.bnf.seat.'+$('#seat_id').val()+'.created', (message) => {
            sc.get(message.payload.selected_seat).status('booking');
            window.location = message.payload.redirect_url;
            console.log(message.payload.redirect_url);
        });
    }


});
