

function removeAddedItem(i){
    let orderProductShortDescription=JSON.parse(sessionStorage.getItem('orderProductShortDescription'));
    let orderSupplierId=JSON.parse(sessionStorage.getItem('orderSupplierId'));
    let orderProductId=JSON.parse(sessionStorage.getItem('orderProductId'));

    let description = orderProductShortDescription.slice(0, i).concat(orderProductShortDescription.slice(i + 1, orderProductShortDescription.length));
    let supplierId = orderSupplierId.slice(0, i).concat(orderSupplierId.slice(i + 1, orderSupplierId.length));
    let productId = orderProductId.slice(0, i).concat(orderProductId.slice(i + 1, orderProductId.length));

    sessionStorage.setItem('orderProductShortDescription', JSON.stringify(description));
    sessionStorage.setItem('orderProductId', JSON.stringify(productId));
    sessionStorage.setItem('orderSupplierId', JSON.stringify(supplierId));
    showAddedItem();
}

  function showAddedItem(){

    var newLi = document.querySelector(".listOfaddedProducts");
    let itemsToAdd=new Array();
    let description=JSON.parse(sessionStorage.getItem('orderProductShortDescription'));
    let supplierId=JSON.parse(sessionStorage.getItem('orderSupplierId'));
    console.log(description[1]);
    if (sessionStorage.getItem('orderProductId')){
    JSON.parse(sessionStorage.getItem('orderProductId')).forEach(function(productId, index){
        itemsToAdd[index] = '<li><input id="addedProduct" name="addedProduct[]" type="hidden" value="'+productId+'">'+description[index]+' <a class="btn btn btn-danger btn-sm" style="color:white" onclick="removeAddedItem('+index+')">usuń</a></li>';
    })
    itemsToAdd.push('<input id="orderSupplierId" name="orderSupplierId" type="hidden" value="'+supplierId[0]+'">');
    newLi.innerHTML = itemsToAdd.join('');

    }
}


function addToOrder(event, addToProductAdress, tokenCode, supplierId, productShortDescription, productId){

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

window.onload=showAddedItem();
