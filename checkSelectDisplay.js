const swim = document.getElementById('swimming');
const camp = document.getElementById('camping');
const select = document.getElementById('check-select');

function display() {
    (camp.checked) ? select.style.display = 'inline-block' : select.style.display = 'none';
}

swim.onclick = () => display();
camp.onclick = () => display();