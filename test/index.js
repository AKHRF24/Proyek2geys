let totalPoints = 0; // This should be fetched from the server in a real application

document.getElementById('dashboardBtn').addEventListener('click', function() {
    document.getElementById('dashboard').classList.add('active');
    document.getElementById('marketplace').classList.remove('active');
});

document.getElementById('marketplaceBtn').addEventListener('click', function() {
    document.getElementById('marketplace').classList.add('active');
    document.getElementById('dashboard').classList.remove('active');
});

document.getElementById('goToLogin').addEventListener('click', function() {
    window.location.href = 'login.html';
});

function exchangePoints(points) {
    if (totalPoints >= points) {
        totalPoints -= points;
        alert("You've exchanged " + points + " points!");
        document.getElementById('totalPoints').innerText = totalPoints;
    } else {
        alert("Not enough points.");
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Initialize points (should be fetched from server)
    document.getElementById('totalPoints').innerText = totalPoints;
});
