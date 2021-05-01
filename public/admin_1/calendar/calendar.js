function Calendar(c){

    calendarTemplate = `<div class="calendar-header">
        <div class="vr-line"></div>
            <div class="title">
            <div class="current-date">January 01,
            Tuesday, 2019</div>
            <div class="reminders" id="next">
                <p id="next_events"></p>
            </div>
        </div>
    </div>
    <div class="calendar-body">
        <div class="calendar-year">
                <div class="year-spinner">
                    <span class="btn up-btn"></span>
                    <div class="years-container">
                        <h3 class="buffer-top">2021</h3>
                        <h3 class="next-up">2020</h3>
                        <h3 class="current-year">2019</h3>
                        <h3 class="previous-down">2018</h3>
                        <h3 class="buffer-bottom">2017</h3>
                    </div>
                    <span class="btn down-btn"></span>
                </div>
        </div>
        <div class="months-container">
            <!-- <span class="btn previous-btn"></span> -->
                <p class="JAN"></p>
                <p class="FEB"></p>
                <p class="MAR"></p>
                <p class="APR"></p>
                <p class="MAY"></p>
                <p class="JUN"></p>
                <p class="JUL"></p>
                <p class="AUG"></p>
                <p class="SEP"></p>
                <p class="OCT"></p>
                <p class="NOV"></p>
                <p class="DEC"></p>
            <!-- <span class="btn next-btn"></span> -->
            </div>
            <div class="days-header">
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
            </div>
            <div class="days-body"></div>
        <div class="plus" id="plus"></div>
        </div>`;


    let calendar = c;
    calendar.prepend(calendarTemplate);
    let monthsSelector = calendar.find('.months-container');
    let yearSpinner = calendar.find('.year-spinner');
    let calendarDaysBody = calendar.find('.days-body');
    let currentDateLbl = calendar.find('.current-date');
    let jumpTodayBtn = calendar.find('.jump-today');
    let prevBtn = calendar.find('.prev-btn');
    let nextBtn = calendar.find('.next-btn');

    let current;
    let nextUp;
    let bufferTop;
    let	previousDown;
    let bufferBottom;

    let today = new Date();
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();

    // let week = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

    let m = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    let months = new Map();

    let selectedDay;

// initialize elements and data
    (function (){
        for(let i = 0; i < 12; i++){
            // console.log(m[i] + " ");
            months.set(m[i].toUpperCase(), i);
            months.set(i, m[i].toUpperCase());
        }
        currentDateLbl.html(m[currentMonth + 12] + ' ' + today.getDate() +' ' + currentYear);
        selectedMonth(currentMonth);
        selectedYear(currentYear);
        showCalendar(currentMonth, currentYear);
    })();

    // generate calendar days
    function showCalendar(month, year){
        // get starting day gap/spaces
        let firstDay = (new Date(year, month)).getDay();
        // get total days in a month
        let daysInMonth = 32 - new Date(year, month, 32).getDate();
        // console.log('Days in Month: ', daysInMonth);

        // calendar body content
        calendarDaysBody.html('');

        let data = new Date();
        let or = data.getDate()
        let ned = data.getDay();

        // currentDateLbl.html('<p class="week"><span id="sh_or">'+week[ned]+'</span></p><p>'+mnts[currentMonth] + ' <span id="or">' +or+'</span></p>');
        currentDateLbl.html('<p class="week"><span id="sh_or"></span></p><p><span id="am">'+mnts[currentMonth] + '</span> <span id="or">' +or+'</span></p>');


        // start calendar days to 1
        let date = 1;

        // loop 5 times (4/5 weeks every month)
        for(let i = 0; i < 6; i++){
            // create initial row element
            let row = $('<div class="days-body-row"></div>');

            for(let j = 0; j < 7; j++){
                if(i === 0 && j < firstDay){
                    // create empty column elements
                    let cell = $('<div class="day"><p></p></div>');
                    // append cell to the row
                    row.append(cell);
                }

                else if(date > daysInMonth){
                    // stop the loop if the last day in a month is less than the date
                    // row += `</div>`;
                    break;
                }

                else{
                    // create days element
                    if(date <10){
                        var tiv = "0"+date;
                    }else{
                        tiv = date
                    }
                    let cell = $(`<div class="day"><p class="amsativ" id="${tiv}" onclick="this_day(this)">${date}</p></div>`);
                    if(date === today.getDate() && year === today.getFullYear() && month === today.getMonth()){
                        // add class to the current date
                        cell = $(`<div class="day current-day-block"><p class="current-day amsativ" id="${date}"  onclick="this_day(this)">${date}</p></div>`);
                    }
                    // append cell to the row
                    row.append(cell);
                    date++;
                }
            }
            // append rows to the calendar
            calendarDaysBody.append(row);
        }
    }

    function selectedMonth(mm){
        monthsSelector.find('p').removeClass('selected-month');
        monthsSelector.find(`.${months.get(mm)}`).addClass('selected-month');
        currentMonth = mm;
        showCalendar(mm, currentYear);
    }

    function selectedYear(yy){
        let node = $(`<h3 class="buffer-top">${yy+2}</h3><h3 class="next-up">${yy+1}</h3><h3 class="current-year" id="year">${yy}</h3><h3 class="previous-down">${yy-1}</h3><h3 class="buffer-bottom">${yy-2}</h3>`);
        yearSpinner.find('.years-container').html(node);
    }

    function rollDown(){
        current = yearSpinner.find('.current-year');
        nextUp = yearSpinner.find('.next-up');
        bufferTop = yearSpinner.find('.buffer-top');
        previousDown = yearSpinner.find('.previous-down');
        bufferBottom = yearSpinner.find('.buffer-bottom');
        let bufferNew = `<h3 class="buffer-top">${parseInt(current.html()) + 3}</h3>`;
        // prepend new element and remove last element
        yearSpinner.find('.years-container').prepend(bufferNew);
        bufferBottom.remove();

        // transition
        bufferTop.css('top', '0');
        bufferTop.css('transform', 'translateX(-50%)');
        bufferTop.removeClass('buffer-top');
        bufferTop.addClass('next-up');
        nextUp.css('top', '50%')
        nextUp.css('transform', 'translate(-50%, -50%)');
        nextUp.removeClass('next-up');
        nextUp.addClass('current-year');
        current.css('top', '85%');
        current.removeClass('current-year');
        current.css('transform', 'translate(-50%, -85%)');
        current.addClass('previous-down');
        previousDown.css('top', '110%');
        previousDown.css('transform', 'translate(-50%, 0)');
        previousDown.removeClass('previous-down');
        previousDown.addClass('buffer-bottom');

        currentYear = parseInt(nextUp.html());
        showCalendar(currentMonth, currentYear);
    }

    function rollUp(){
        current = yearSpinner.find('.current-year');
        nextUp = yearSpinner.find('.next-up');
        bufferTop = yearSpinner.find('.buffer-top');
        previousDown = yearSpinner.find('.previous-down');
        bufferBottom = yearSpinner.find('.buffer-bottom');
        let bufferNew = `<h3 class="buffer-bottom">${parseInt(current.html()) - 3}</h3>`;

        yearSpinner.find('.years-container').append(bufferNew);
        bufferTop.remove();

        current.css('top', '0');
        current.css('transform', 'translate(-50%, 0)');
        current.removeClass('current-year');
        current.addClass('next-up');
        previousDown.css('top', '50%');
        previousDown.css('transform', 'translate(-50%, -50%)');
        previousDown.removeClass('previous-down');
        previousDown.addClass('current-year');
        bufferBottom.css('top', '85%');
        bufferBottom.css('transform', 'translate(-50%, -85%)');
        bufferBottom.removeClass('buffer-bottom');
        bufferBottom.addClass('previous-down');
        nextUp.css('top', '-100%');
        nextUp.css('transform', 'translate(-50%, 0)');
        nextUp.removeClass('next-up');
        nextUp.addClass('buffer-top');

        currentYear = parseInt(previousDown.html());
        showCalendar(currentMonth, currentYear);
    }

    monthsSelector.find('p').on('click', function (){
        if(!$(this).hasClass('selected-month'))selectedMonth(months.get($(this).attr('class')));
    });

// day selector
    calendar.on('click', '.day' ,function(){
        // prevent the user from selecting empty cells
        if(($(this).find('p').html()) != ''){
            calendar.find('.day').removeClass('selected-day');
            calendar.find('p').removeClass('selected-p');
            $(this).addClass('selected-day');
            $(this).find('p').addClass('selected-p');
            selectedDay = parseInt($(this).find('p').html());
            // console.log(selectedDay);
        }
    });

// jump to current date
    jumpTodayBtn.on('click', function () {
        let prevYear = currentYear;
        currentMonth = today.getMonth();
        currentYear = today.getFullYear();
        if(prevYear > currentYear){
            prevYear = prevYear - currentYear;
            // console.log(prevYear);
            let timer = setInterval(function(){
                if(prevYear == 1){
                    clearInterval(timer);
                }
                rollUp();
                prevYear--;
            },150);
        }

        else if(prevYear < currentYear){
            prevYear = currentYear - prevYear;
            let timer = setInterval(function(){
                if(prevYear == 1){
                    clearInterval(timer);
                }
                rollDown();
                prevYear--;
            },150);
        }
        selectedMonth(currentMonth);
    });

// next month
    nextBtn.on('click', () => {
        if(currentMonth > 10){
            currentMonth = 0;
            currentYear++;
            // selectedYear(currentYear);
            rollDown();
        }else{
            currentMonth++;
        }
        selectedMonth(currentMonth);
        showCalendar(currentMonth, currentYear);
    });
// previous month
    prevBtn.on('click', () => {
        if(currentMonth < 1){
            currentMonth = 11;
            currentYear--;
            rollUp();
        }else{
            currentMonth--;
        }
        selectedMonth(currentMonth);
        showCalendar(currentMonth, currentYear);
    });

// year selector
    yearSpinner.find('.up-btn').on('click', rollDown);

    yearSpinner.find('.down-btn').on('click', rollUp);

    this.getSelectedDate = function(){
        return {
            'month' : currentMonth,
            'day' : selectedDay,
            'year' : currentYear,
            'fullDate' : `${m[currentMonth+12]} ${selectedDay} ${currentYear}`
        };
    }

}

let c = $('.calendar');
let calendar = new Calendar(c);
