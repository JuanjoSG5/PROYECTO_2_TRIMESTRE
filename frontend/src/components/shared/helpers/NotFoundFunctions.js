import $ from 'jquery';

export function drawClock() {
    for (let i = 0; i < 60; i++) {
        let minuteOrSecond = (i < 10) ? '0' + i : i;
        $('#seconds').append('<li data-item=' + minuteOrSecond + '>' + minuteOrSecond + '</li>');
    }
    for (let i = 0; i < 60; i++) {
        let minuteOrSecond = (i < 10) ? '0' + i : i;
        $('#minutes').append('<li data-item=' + minuteOrSecond + '>' + minuteOrSecond + '</li>');
    }
    for (let i = 0; i < 24; i++) {
        let hour = (i < 10) ? '0' + i : i;
        $('#hours').append('<li data-item=' + hour + '>' + hour + '</li>');
    }
}

export function placeHands() {
    const hourDegree = 15;
    const minuteOrSecondDegree = 6;
    $('#seconds li').each(function (index) {
        $(this).css({ transform: 'rotateZ(' + minuteOrSecondDegree * index + 'deg) translateX(' + parseInt(200) + 'px)' });
    });
    $('#minutes li').each(function (index) {
        $(this).css({ transform: 'rotateZ(' + minuteOrSecondDegree * index + 'deg) translateX(' + parseInt(170) + 'px)' });
    });
    $('#hours li').each(function (index) {
        $(this).css({ transform: 'rotateZ(' + hourDegree * index + 'deg) translateX(' + parseInt(140) + 'px)' });
    });
}

const TIME = 1;

export function updateSeconds(ts, timer) {
    let seconds = ts % 60;
    if (ts === 0 && timer) updateMinutes(0, timer);
    let deg = 360 / 60 * seconds;
    $('#seconds li').removeClass('active');
    $('#seconds li').eq(seconds).addClass('active');
    $('#seconds').css({ transform: 'rotateZ(-' + deg + 'deg)' });
    ts++;
    if (timer) setTimeout(function () { updateSeconds(ts, timer) }, TIME * 1000);
}

export function updateMinutes(tm, timer) {
    let minutes = tm % 60;
    if (tm === 0 && timer) updateHours(0, timer);
    let deg = 360 / 60 * minutes;
    $('#minutes li').removeClass('active');
    $('#minutes li').eq(minutes).addClass('active');
    $('#minutes').css({ transform: 'rotateZ(-' + deg + 'deg)' });
    tm++;
    if (timer) setTimeout(function () { updateMinutes(tm, timer) }, TIME * 60000);
}

export function updateHours(th, timer) {
    let hours = th % 24;
    let deg = 360 / 24 * hours;
    $('#hours li').removeClass('active');
    $('#hours li').eq(hours).addClass('active');
    $('#hours').css({ transform: 'rotateZ(-' + deg + 'deg)' });
    th++;
    if (timer) setTimeout(function () { updateHours(th, timer) }, TIME * 3600000);
}

export function startClock() {
    let d = new Date();
    let hours = d.getHours();
    let minutes = d.getMinutes();
    let seconds = d.getSeconds();
    updateHours(hours, 0);
    updateMinutes(minutes, 0);
    updateSeconds(seconds, 0);
    setTimeout(startClock, 1000);
}
