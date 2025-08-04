@extends('layouts.app')

@section('content')
    <div style="text-align: center; margin-top: 40px;">
        <h2>Session Expires In:</h2>
        <h1 id="session-timer" style="font-size: 48px; color: red;">Loading...</h1>
    </div>

    <script>
        // Total session duration in seconds (2 hours = 7200 seconds)
        let remainingTime = 7200;

        function formatTime(seconds) {
            let hrs = Math.floor(seconds / 3600);
            let mins = Math.floor((seconds % 3600) / 60);
            let secs = seconds % 60;
            return `${hrs.toString().padStart(2, '0')}:${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
        }

        function updateTimer() {
            document.getElementById('session-timer').textContent = formatTime(remainingTime);
            if (remainingTime <= 0) {
                alert("Session expired. Redirecting to login page...");
                window.location.href = "{{ route('loginPage') }}"; // or your logout route
            } else {
                remainingTime--;
            }
        }

        setInterval(updateTimer, 1000); // update every second
        updateTimer(); // initial call
    </script>
@endsection
