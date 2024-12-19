document.addEventListener('DOMContentLoaded', function() {
    const items = [
        { name: "Book", points: 50, image: "book.jpg" },
        { name: "Course Access", points: 150, image: "course.jpg" },
        { name: "Software License", points: 200, image: "software.jpg" },
        { name: "Event Ticket", points: 100, image: "event.jpg" }
    ];

    const container = document.getElementById('itemsContainer');
    items.forEach(item => {
        const div = document.createElement('div');
        div.className = 'item';
        div.innerHTML = `<img src="${item.image}" alt="${item.name}">
                         <h3>${item.name}</h3>
                         <p>${item.points} Points</p>
                         <button onclick="exchangeItem('${item.name}', ${item.points})">Exchange</button>`;
        container.appendChild(div);
    });
});

function exchangeItem(name, points) {
    alert(`Exchanged ${points} points for ${name}!`);
    // This function would realistically communicate with a backend to process the exchange.
}
