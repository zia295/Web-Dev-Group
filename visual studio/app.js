document.addEventListener('DOMContentLoaded', function() {
    const deviceList = document.getElementById('device-list');
    
    // Example devices
    const devices = [
        { name: 'Enigma Machine', description: 'A World War II-era encryption device.' },
        { name: 'Rubber Ducky', description: 'A USB device that acts as a keyboard to execute commands.' }
    ];
    
    devices.forEach(device => {
        const item = document.createElement('div');
        item.innerHTML = `<h3>${device.name}</h3><p>${device.description}</p>`;
        deviceList.appendChild(item);
    });
});
