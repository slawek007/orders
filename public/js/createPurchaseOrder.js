
window.onload = function(){
document.querySelector('.PurchaseNumberSubmit').addEventListener('click',generateOrderNumber);
document.querySelector('.PurchaseNumberDestroy').addEventListener('click',deleteOrderNumber);
}

//funkcja do zaokraglania
function Round(n, k)
{
    var factor = Math.pow(10, k+1);
    n = Math.round(Math.round(n*factor)/10);
    return n/(factor/10);
}

//przeliczanie po zmianie ilości
function calculateProductPrice(quantity, unitPrice, loop, vat) {
    var subtotal = document.querySelector('.subtotalText-'+loop).innerText;
    document.querySelector('.totalText-'+loop).innerText = subtotal*quantity;

    var allTotal = document.querySelectorAll('.totalText');
    var totalPrice = 0;

    for (let index = 0; index < allTotal.length; index++) {
        totalPrice = totalPrice+Number(allTotal[index].innerText);
    }
    document.querySelector('.orderSubTotal, .totalInput-'+loop+'').value = Round(totalPrice,2);
    document.querySelector('.orderVat').value = Round(totalPrice*vat/100,2);
    document.querySelector('.orderTotalWithVat').value = Round(totalPrice*(1+(vat/100)),2);
    //document.querySelector('.totalInput-'+loop+'').value=totalPrice;
  }




//pobieranie danych dostawcy z bazy na podstawie listy select
function getCustomerData(event, tokenCode){
    event.preventDefault();
    let customerId = event.target.value;
    let json = JSON.stringify({
        customerId: customerId
    });

    let xhr = new XMLHttpRequest();
    xhr.open('GET', '/getcustomerData/'+customerId+'/', true);
    xhr.setRequestHeader('X-CSRF-TOKEN', tokenCode);
    xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');

    xhr.send(json);
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200)
        {
                let dataResponse=JSON.parse(xhr.responseText);

                if (dataResponse.company)
                {
                    let ul = event.target.parentNode.querySelector('.customerData');
                        ul.querySelectorAll('li').forEach(el => el.remove());

                    var li = document.createElement('li');
                        li.innerHTML = dataResponse.contact_person;
                        ul.appendChild(li);

                        var li = document.createElement('li');
                        li.innerHTML = dataResponse.company;
                        ul.appendChild(li);

                        var li = document.createElement('li');
                        li.innerHTML = dataResponse.street;
                        ul.appendChild(li);

                        var li = document.createElement('li');
                        li.innerHTML = dataResponse.zip_code+' '+dataResponse.city;
                        ul.appendChild(li);

                    displayEvents('success', 'Dane miejsca dostawy zostały zaktualizowane');
                }
                else{
                    displayEvents('error', 'Błąd systemu, prosimy o kontakt z administratorem');
                }
        }
    }
}
//przeliczanie wartosci jednostkowej
function subTotalPriceCalculate(dim1, dim2, dim3, density, productTypeId, loop){
    let newPrice = document.querySelector('.priceValue-'+loop+'').value;
    let subTotal = dim1*dim2*dim3*density/1000000;
    let qty = document.querySelector('.quantity-'+loop+'').value;
    document.querySelector('.subtotalText-'+loop+'').innerText=subTotal*newPrice;
    document.querySelector('.totalText-'+loop+'').innerText=subTotal*newPrice*qty;
    document.querySelector('.totalInput-'+loop+'').value=subTotal*newPrice;
}

//generowanie nr zamówienia
function generateOrderNumber(){
    let tokenCode = document.querySelector('meta[name="csrf-token"]').content;
    let xhr = new XMLHttpRequest();
    xhr.open('GET', '/purchaseordernumber/create/', true);
    xhr.setRequestHeader('X-CSRF-TOKEN', tokenCode);
    xhr.send();
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200)
        {
            let dataResponse=JSON.parse(xhr.responseText);
            document.querySelector('.generatedPurchaseNumber').innerText = dataResponse.purchaseNumber[0];
            document.querySelector('input[name="purchaseNumber"]').value = dataResponse.purchaseNumber[0];
            document.querySelector('.PurchaseNumberSubmit').setAttribute("style","display:none;");
            document.querySelector('.PurchaseNumberDestroy').setAttribute("id",dataResponse.purchaseNumber[1]);
            document.querySelector('.PurchaseNumberDestroy').setAttribute("style","display:inline-block;");
        }
    }
}

function deleteOrderNumber(){
    let tokenCode = document.querySelector('meta[name="csrf-token"]').content;
    let deleteId = document.querySelector('.PurchaseNumberDestroy').getAttribute("id");
    let xhr = new XMLHttpRequest();

    xhr.open('DELETE', '/purchaseordernumber/'+deleteId, true);
    xhr.setRequestHeader('X-CSRF-TOKEN', tokenCode);
    xhr.send();
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200)
        {
            document.querySelector('.generatedPurchaseNumber').innerText = 'PPL/___/__/__/PO';
            document.querySelector('.PurchaseNumberDestroy').setAttribute("style","display:none;");
            document.querySelector('.PurchaseNumberSubmit').setAttribute("style","display:inline-block;");

        }
    }
}
//button zmiany ceny jednostkowej

function showChangeButton(element) {
    element.children[1].classList.remove('d-none');
}

//zmiana ceny jednostkowej
function changeUnitPrice(event, loop, updateProductAdress, supplierId,dim1, dim2, dim3, density, productTypeId){

    let tokenCode = document.querySelector('meta[name="csrf-token"]').content;
    var formData = event.target.parentNode;
    let json = JSON.stringify({
        supplierId: supplierId,
        newPrice: formData.firstElementChild.value});
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
                    subTotalPriceCalculate(dim1, dim2, dim3, density, productTypeId, loop);
                    displayEvents('success', 'Cena ' +dataResponse['productChangedName']+ ' została zaktualizowana');


                }
        }
    }
}

