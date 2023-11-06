//map data start        
var markers = [];

fetch('http://localhost/P00197013_MINTHANTWIN_DW_Winter2023/locationMapData.php')
    .then(response => response.json())
    .then(data => {
        for(var i in data) markers.push(data[i]);
        
        var map = L.map('map').setView([lat, log], 8);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([52.6294, 1.2965]).addTo(map)
            .bindPopup("GWSC Headquarter", { autoClose: false, closeOnClick: false, closeButton: false })
            .openPopup();

        for(var i in markers) {
            L.marker([markers[i].Lat, markers[i].Log]).addTo(map)
            .bindPopup(markers[i].Name, { autoClose: false, closeOnClick: false, closeButton: false })
            .openPopup();
        }                
    })
    .catch(err => console.log(err));                           
//