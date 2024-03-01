let selectedItemCategory = "";

function debounce(func, timeout = 300) {
    let timer;
    return (...args) => {
      clearTimeout(timer);
      timer = setTimeout(() => {
        func.apply(this, args);
      }, timeout);
    };
}

function updateVolume(itemId, vol) {
    $wire.updateItemVolume(itemId, vol);
}

function updateSelectedItemCategory() {
    // Mengambil nilai dari select kategori
    const categorySelect = document.getElementById('kategori');
    selectedItemCategory = categorySelect.value;

    // Log untuk debugging
    console.log("Selected Item Category:", selectedItemCategory);
    window.livewire.emit('updateCategory', selectedItemCategory);
}

// Fungsi untuk menambah volume
function incrementVolume(itemId) {
    const volumeDisplay = document.getElementById(`volume${itemId}`);
    let volume = parseInt(volumeDisplay.innerText);
    volumeDisplay.innerText = ++volume; // Menambahkan nilai dan memperbarui tampilan
    debounce(updateVolume(itemId,volume), 300);
}

// Fungsi untuk mengurangi volume
function decrementVolume(itemId) {
    const volumeDisplay = document.getElementById(`volume${itemId}`);
    let volume = parseInt(volumeDisplay.innerText);
    if (volume > 0) { // Memastikan volume tidak menjadi negatif
        volumeDisplay.innerText = --volume; // Mengurangi nilai dan memperbarui tampilan
    }
    debounce(updateVolume(itemId,volume), 300);
}
// Fungsi untuk menambah diskon
function incrementDiscount(itemId) {
    const discountDisplay = document.getElementById(`discount${itemId}`);
    let discount = parseInt(discountDisplay.innerText);
    if (discount < 100) { // Memastikan diskon tidak lebih dari 100%
        discountDisplay.innerText = ++discount; // Menambahkan nilai dan memperbarui tampilan
    }
}

// Fungsi untuk mengurangi diskon
function decrementDiscount(itemId) {
    const discountDisplay = document.getElementById(`discount${itemId}`);
    let discount = parseInt(discountDisplay.innerText);
    if (discount > 0) { // Memastikan diskon tidak menjadi negatif
        discountDisplay.innerText = --discount; // Mengurangi nilai dan memperbarui tampilan
    }
}