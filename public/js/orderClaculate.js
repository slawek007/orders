function Round(n, k)
{
    var factor = Math.pow(10, k+1);
    n = Math.round(Math.round(n*factor)/10);
    return n/(factor/10);
}

function calculateProductPrice(quantity, unitPrice, loop, vat) {
    var subtotal = document.querySelector('.subtotalText-'+loop).innerText;
    document.querySelector('.totalText-'+loop).innerText = subtotal*quantity;

    var allTotal = document.querySelectorAll('.totalText');
    var totalPrice = 0;

    for (let index = 0; index < allTotal.length; index++) {
        totalPrice = totalPrice+Number(allTotal[index].innerText);
    }
    document.querySelector('.orderSubTotal').value = totalPrice;
    document.querySelector('.orderVat').value = Round(totalPrice*vat/100,2);
    document.querySelector('.orderTotalWithVat').value = Round(totalPrice*(1+(vat/100)),2);
  }


