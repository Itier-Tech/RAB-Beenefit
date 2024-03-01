document.addEventListener('DOMContentLoaded', () => {
    window.livewire.on('resetTimer', data => {
        let duration = data.duration;
        let display = document.getElementById('timer');
        startTimer(duration, display);
    });

    function startTimer(duration, display) {
        let timer = duration, minutes, seconds;
        const interval = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
            display.textContent = '(' + minutes + ":" + seconds + ')';
            if (--timer < 0) {
                timer = duration;
                clearInterval(interval);
                window.livewire.emit('resendOtp');
            }
        }, 1000);
    }
});