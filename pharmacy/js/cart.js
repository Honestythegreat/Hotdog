function addtocart(id, name, milligram, price, Prescribed) {
    // Log the values being sent to the server
    console.log("Adding to cart:", { id, name, milligram, price, Prescribed });

    fetch('addtocart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id, name: name, milligram: milligram, price: price, Prescribed: Prescribed }) // Update keys here
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
    })
    .catch(error => console.error('Error: ', error));
}
    