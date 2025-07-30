function get_seat_map(seat_row, first_col, second_col, third_col = null, select_prefix) {
    const seatMap = [];

    for (let i = 0; i < seat_row; i++) {
        let row = '';

        // First column seats
        for (let j = 0; j < first_col; j++) {
            row += 's';
        }

        // Aisle
        row += '_';

        // Determine if this row should skip second and third columns
        const isSkipRow =
            (select_prefix === 'A-4' && i === 4) ||
            (select_prefix === 'RC-2' && (i === 1 || i === 2));

        if (isSkipRow) {
            // Add placeholders instead of seats for skipped columns
            const totalSkips = second_col + (third_col ? third_col + 1 : 0);
            row += '_'.repeat(totalSkips);
        } else {
            // Second column seats
            for (let k = 0; k < second_col; k++) {
                row += 's';
            }

            // Optional third column
            if (third_col !== null && third_col > 0) {
                row += '_';
                for (let m = 0; m < third_col; m++) {
                    row += 's';
                }
            }
        }

        seatMap.push("'" + row + "'");
    }

    return seatMap;
}

function show_seat_plan(seatMap)
{
            var bus_structure = ($('#bus_structure').find(":selected").text()).split('+');
            $counter = $('#counter');
            var seat_row = $('#col').val();
            var select_prefix = $('#prefix').val();

            var first_col = parseInt(bus_structure[0]);
            var second_col = parseInt(bus_structure[1]);
            // var third_col = parseInt(bus_structure[2]);


            var num = 0;
            var firstSeatLabel = 1;
            var prefix = select_prefix.charCodeAt();
            var newrow = 0;
            var max = (first_col + second_col) * 10;
            var temp = 0;
            var currentcol;
            var totalcol = first_col + second_col;
            $('.seatCharts-row').val(seatMap);
            $('.seatCharts-row').remove();
            $('.seatCharts-legendItem').remove();
            $('#seat-map,#seat-map *').unbind().removeData();

        sc = $('#seat-map').seatCharts({
                    map: seatMap,
                    seats: {
                        s: {
                            price: '0',
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
                                if (column <= first_col + second_col + 1) {
                                    return firstSeatLabel++;
                                }
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
                                ['s', 'available', 'Available Seat'],
                                ['b', 'unavailable', 'Disabled Seat']
                            ]
                        },
                        click: function () {

                            var block_map = $('#block_map').val();

                            if (this.status() == 'available') {

                                block_map += "'" + this.settings.id + "',";

                                $('#block_map').val(block_map);

                                $counter.text(sc.find('unavailable').length + 1);

                                return 'unavailable';

                            }
                            else if(this.status() == 'unavailable') {

                                removeMap = "'" + this.settings.id + "',";
                                block_map = block_map.replace(removeMap, '');

                                $('#block_map').val(block_map);

                                $counter.text(sc.find('unavailable').length - 1);

                                return 'available';
                            }
                            else {
                                return this.style();
                            }
                        }
            });

        var block_map = $('#block_map').val();
            block_map = block_map.replace(/(\'|\")/gm,'');
            block_map = block_map.split(',');
        if(block_map.length){
            //let's pretend some seats have already been booked
            sc.get(block_map).status('unavailable');
        }
}

function load_seat_plan(seatMap=null){
        var bus_structure = ($('#bus_structure').find(":selected").text()).split('+');
        var select_prefix = $('#prefix').val();
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
            var seatMap = get_seat_map(seat_row,first_col,second_col,third_col,select_prefix);
        }
        $('#counter').html(0);
        $('#seat_map').val(seatMap.join(','+newline));
        show_seat_plan(seatMap);
}

var start = moment().subtract(0, 'months');
var end = moment();
var max_date = moment().add(3, 'months');

function cb(start, end) {
    $('#bus_seat_range input').val(start.format('D-M-YYYY') + ' - ' + end.format('D-M-YYYY'));
}


$(document).ready(function() {

    load_seat_plan();

            $(".select2").change(function(){
                load_seat_plan();
            });

            $("#seat_map").change(function(){

                var seatMap = $(this).val();
                load_seat_plan(seatMap);
            });

            $('#seat_custom').on('change', function(event, state) {
                if($('#seat_custom').is(':checked')){
                    $('#seat_custom_div').removeClass('d-none');
                }
                else{
                    load_seat_plan();
                    $('#seat_custom_div').addClass('d-none');
                }
            });

            $('#seat_custom_show').on('change', function(event, state) {
                if($("#seat_custom_show").is(':checked')) {
                     $('#seat_custom_div').removeClass('d-none');
                }
                else {
                    load_seat_plan();
                    $('#seat_custom_div').addClass('d-none');
                }
            });

            $('#bus_seat_range').daterangepicker({
                        format: 'D-M-YYYY',
                        separator: ' - ',
                        startDate: moment(),
                        endDate: moment(),
                        maxDate: max_date,
                        ranges: {
                            'Today': [moment(), moment()],
                            'This Month': [moment(), moment().endOf('month')]
                        },
                        minDate: '{{ date("m/d/Y") }}'
                    }, cb);
             cb(start, end);

});
