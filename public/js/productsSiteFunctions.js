function showSavebutton(element) {
    element.querySelector('.changePriceValueButton').classList.remove('d-none');
}

function updateDatabase(event, updateProductAdress, tokenCode, supplierId){
    event.preventDefault();

    var formData = event.target.parentNode;
    let json = JSON.stringify({
        supplierId: supplierId,
        newPrice: formData.firstElementChild.value
    });

    var xhr = new XMLHttpRequest();
    xhr.open('PATCH', updateProductAdress, true);
    xhr.setRequestHeader('X-CSRF-TOKEN', tokenCode);
    xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');

    xhr.send(json);
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
                let dataResponse=JSON.parse(xhr.responseText);
                if (dataResponse['success']){
                    formData.querySelector('.changePriceValueButton').classList.add('d-none');
                    displayEvents('success', 'Cena ' +dataResponse['productChangedName']+ ' została zaktualizowana');
                }
        }
    }
}
