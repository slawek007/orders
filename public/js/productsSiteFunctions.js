    function addToCart(event, tokenCode, supplierId, productShortDescription, productId){

        event.preventDefault();

        let json = JSON.stringify({
            productId: productId,
            productShortDescription: productShortDescription,
            supplierId: supplierId
        });
        console.log('przed wysłaneim do kontrolera');
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '/addtocart/', true);
        xhr.setRequestHeader('X-CSRF-TOKEN', tokenCode);
        xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');

        xhr.send(json);
        xhr.onreadystatechange = function() {
            if(xhr.readyState == 4 && xhr.status == 200)
            {
                    let dataResponse=JSON.parse(xhr.responseText);
                    console.log(dataResponse.status);
                    if (dataResponse)
                    {
                       console.log('udało się HURRA');

                        displayEvents(dataResponse.status, dataResponse.statusDescription);
                    }
                    else{
                        console.log('nie udało się :');
                        displayEvents(dataResponse.status, dataResponse.statusDescription);
                    }
            }
        }
    }


    function addToOrderold(event, addToProductAdress, tokenCode, supplierId, productShortDescription, productId){

        Array.prototype.hasValue = function(value) {
            var i;
            for (i=0; i<this.length; i++) { if (this[i] === value) return true; }
            return false;
          }

        event.preventDefault();
        var formData = event.target.parentNode;
        var dataDescription = [productShortDescription];
        var dataProductId = [productId];
        var dataSupplierId = [supplierId];
        var sessionData = sessionStorage.getItem('orderProductId');

        if (sessionData){
            //Jeżeli jest już dodany produkt to odczytujemy sejsę
            let orderProductShortDescription=JSON.parse(sessionStorage.getItem('orderProductShortDescription'));
            let orderSupplierId=JSON.parse(sessionStorage.getItem('orderSupplierId'));
            let orderProductId=JSON.parse(sessionStorage.getItem('orderProductId'));

            if (orderSupplierId.hasValue(supplierId) || orderSupplierId == 0 ){
            //Sprawdzamy czy nowy produkt nie ma innego dostawcy
                if (orderProductId.hasValue(productId)){
                //Sprawdzamy czy nowy produkt nie jest już dodany
                    displayEvents('error', productShortDescription + ' jest już w zamówieniu');
                }
                else{
                    orderProductShortDescription.push(productShortDescription);
                    orderProductId.push(productId);
                    orderSupplierId.push(supplierId);
                    sessionStorage.setItem('orderProductShortDescription', JSON.stringify(orderProductShortDescription));
                    sessionStorage.setItem('orderProductId', JSON.stringify(orderProductId));
                    sessionStorage.setItem('orderSupplierId', JSON.stringify(orderSupplierId));
                    displayEvents('off', '');
                }
            }
            else{
                displayEvents('error', 'Próbujesz dodać produkt od innego dostawcy');
            }
        }
        else{
            //Jeżeli produktu nie ma to przesłane dane przypisujemy do sesji konwertując do JSON
            sessionStorage.setItem('orderProductShortDescription', JSON.stringify(dataDescription));
            sessionStorage.setItem('orderProductId', JSON.stringify(dataProductId));
            sessionStorage.setItem('orderSupplierId', JSON.stringify(dataSupplierId));
        }
        showAddedItem();
    };

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
